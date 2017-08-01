<?php

require './config.php';
require './database.php';

if( !isset($_GET['token']) ) {
    exit('Invalid Request');
}

$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);

$token = trim($_GET['token']);
$query = $db->query("SELECT * FROM kamen WHERE token = \"{$token}\"");

if( !$row = $query->row() ) {
    exit('Page Not Found');
}

use Thenbsp\Wechat\Jssdk;

$jssdk = new Jssdk($accessToken);
$jssdk->addApi('onMenuShareAppMessage');
$jssdk->addApi('onMenuShareTimeline');

?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<title><?php if($row['text1']) echo "{$row['text1']}让{$row['text2']}武汉造，你呢？";else echo "卡门"; ?></title>
<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
<link rel="stylesheet" href="css/kamen.css">
<link rel="stylesheet" href="http://fun-x.b0.upaiyun.com/kamen/css/animate.min.css">
</head>
<body>
    <div class="kamen" style="display:block;overflow:auto;">
        <div class="page page9">
            <div class="p_video video_full_screen" style="display:none;">
                <video id="video0" data-index="0" poster="img/video.jpg" x-webkit-airplay="true" webkit-playsinline="true" preload="auto" src="video/1.mp4" autoplay loop></video>
            </div>
            <div class="p_element page9_bg"></div>
            <div class="p_element p9_bg"></div>
            <div class="p_element p9_nickname animated bounceInDown">“<?php echo $row['nickname'] ?: '-'; ?>”</div>
            <?php 
                if($row['text1']) echo "<div class='p_element p9_mytitle animated bounceInDown'>这是我的武汉造</div>"; 
            ?>
            <div class="p_element p9_img">
                <img src="<?php echo $row['pic']; ?>" width="240px" height="312px">
                <?php 
                    if($row['text1']) {
                        echo "<div class='p_element p9_tab1'>我是<span class='p9_name'>{$row['text1']}</span>，</div><div class='p_element p9_tab2'>我让#<span class='p9_title'>{$row['text2']}</span>，<span class='wuhan'></span><span style='margin-left:53px'>#</span><div class='logo_icon'></div></div>";
                        if(isset($_GET['share'])){
                            echo "<div class='p_element p9_btn p9_btn2 animated bounceIn'></div>";
                        }else{
                            echo "<div class='p_element p9_btn p9_btn1 animated bounceIn'></div>";
                        }
                    }else{
                        echo "<div class='p_element p9_tab1' style='width:30%;padding-left:5px;font-size:18px;''>别理我，</div><div class='p_element p9_tab2' style='padding-left:5px;font-size:18px;''>我就静静抢个座<div class='logo_icon'></div></div>";
                        if(isset($_GET['share'])){
                            echo "<div class='p_element p9_btn p9_btn3 animated bounceIn'></div>";
                        }else{
                            echo "<div class='p_element p9_btn p9_btn1 animated bounceIn'></div>";
                        }
                    }
                ?>
            </div>
            <?php 
                if($row['text1'] && !(isset($_GET['share']))){
                    echo "<div class='p_element p9_word animated fadeInUp'></div>";
                }
            ?>
        </div>
        <div class="page go_share"></div>
        <div class="page share">
            <input type="text" class="input1 share_input" maxlength="11">
            <div class="share_btn"></div>
        </div>
        <div class="shared">
            <div class="share_close"></div>
        </div>
    </div>
    <div id="orientLayer" class="mod-orient-layer">
        <div class="mod-orient-layer__content">
            <i class="icon mod-orient-layer__icon-orient"></i>
            <div class="mod-orient-layer__desc">为了更好的体验，请使用竖屏浏览</div>
        </div>
    </div>
</body>
<script src="js/jquery.min.js"></script>
<script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script type="text/javascript">
var isShare = "<?php isset($_GET['share']); ?>";
wx.config(<?php echo $jssdk->getConfig(); ?>);
wx.ready(function() {
    var options = {
        title: "<?php echo $row['text1']; ?>让<?php echo $row['text2']; ?>武汉造，你呢？",
        desc: '最美武汉 大家造',
        link: 'http://m.fun-x.cn/kamen/result.php?token=<?php echo $row["token"]; ?>&share',
        imgUrl: 'http://fun-x.b0.upaiyun.com/kamen/img/share.jpg',
        success: function() {
            if(!isShare){
                $(".go_share").hide();
                $(".share").show();
            }
        },
        cancel: function() {
            $("#share").hide();
        }
    };

    wx.onMenuShareTimeline({
        title: options.title,
        link: options.link,
        imgUrl: options.imgUrl,
        success: options.success,
        cancel: options.cancel
    });

    wx.onMenuShareAppMessage({
        title: options.title,
        desc: options.desc,
        link: options.link,
        imgUrl: options.imgUrl,
        success: options.success,
        cancel: options.cancel
    });
});

$(function() {
    $(".p9_btn1").on('click', function(){
        $(".go_share").show()
    });
    $(".go_share").on('click', function(){
        $(".go_share").hide()
    });
    $(".share_close").on('click', function(){
        $(".shared").hide()
    });

    $(".p9_btn2").click(function(){
        location.href="http://m.fun-x.cn/kamen/";
    })

    $(".share_btn").click(function(){       
        var tel = $(".share_input").val();
        if(tel==''){
            alert("手机号不能为空");
        }else{
            reg=/^[1][358][0-9]{9}$/; 
            if(!reg.test(tel)){
                alert("请输入正确的11位手机号");
            }else{      
                var data={mobile:tel};
                $.post("",data,function(response){              
                    if(response.code == "success"){
                        $(".shared").show();
                    }else{
                        console.log(response.info)
                    } 
                },"json");
            }
        }  
   })

    if(getVersions().android){
        $(".p_video").hide();
        $(".page9_bg").show();
    }else{
        setVideoScreen(".video_full_screen",'center center');
    }

    setTimeout(function(){
        $(".p9_btn").removeClass("bounceIn").addClass("pulse infinite")
    },4500)

    function setVideoScreen(e, n){
        var w = document.documentElement.clientWidth;
        var h = document.documentElement.clientHeight;
        var t, i = w / h, r = 320 / 504;
        t = i < r ? h / 504 :w / 320;
        $(e).attr("style","-webkit-transform:scale(" + t + ");transform:scale(" + t + ");-webkit-transform-origin:"+n+";transform-origin:"+n+";");
    }

    function getVersions(){
        var u = navigator.userAgent, app = navigator.appVersion;
        return {
            trident: u.indexOf('Trident') > -1, //IE内核
            presto: u.indexOf('Presto') > -1, //opera内核
            webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
            gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,//火狐内核
            mobile: !!u.match(/AppleWebKit.*Mobile.*/), //是否为移动终端
            ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
            android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
            iPhone: u.indexOf('iPhone') > -1 , //是否为iPhone或者QQHD浏览器
            iPad: u.indexOf('iPad') > -1, //是否iPad
            webApp: u.indexOf('Safari') == -1, //是否web应该程序，没有头部与底部
            weixin: u.indexOf('MicroMessenger') > -1, //是否微信 （2015-01-22新增）
            qq: u.match(/\sQQ/i) == " qq" //是否QQ
        };
    }
});
</script>
</html>