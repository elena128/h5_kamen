$(function(){
    var isSlide = false;
    var isNext = false;
    var isText = false;
    var isPic = false;
    var page = 1;
    var pic = 1;
    var isLeft;
    var time;
    setTimeout(function(){
        $(".loading_word").removeClass("bounceIn").addClass("pulse infinite")
    },1500)
    document.ontouchmove = function(e){ e.preventDefault(); };
    PreLoadImg([
        'img/loading_word.png',
        'img/close_icon.png',
        'img/close.png',
        'img/start.png',
        'img/video.jpg',
        'img/p0.png',
        'img/add.png',
        'img/next.png',
        'img/next_page.png',
        'img/p0_btn1.png',
        'img/p0_btn2.png',
        'img/p0_word1.png',
        'img/p0_word2.png',
        'img/p1_img1.jpg',
        'img/p1_img2.jpg',
        'img/p2_img1.jpg',
        'img/p2_img2.jpg',
        'img/p3_img1.jpg',
        'img/p3_img2.jpg',
        'img/p4_img1.jpg',
        'img/p4_img2.jpg',
        'img/p1_word1.png',
        'img/p1_word2.png',
        'img/p1_word3.png',
        'img/p2_word1.png',
        'img/p2_word2.png',
        'img/p2_word3.png',
        'img/p3_word1.png',
        'img/p3_word2.png',
        'img/p3_word3.png',
        'img/p4_word1.png',
        'img/p4_word2.png',
        'img/p4_word3.png',
        'img/p5_img1.png',
        'img/p5_img2.png',
        'img/p5_img3.png',
        'img/p5_img4.png',
        'img/p5_img5.png',
        'img/p5_img6.png',
        'img/p5_img7.png',
        'img/p5_img8.png',
        'img/p5_img9.png',
        'img/p5_img10.png',
        'img/p5_img11.png',
        'img/p5_img12.png',
        'img/p5_img13.png',
        'img/p5_img14.png',
        'img/p5_img15.png',
        'img/p5_img16.png',
        'img/p6.jpg',
        'img/p6_word.png',
        'img/p6_next.png',
        'img/p6_prev.png',
        'img/p6_btn.png',
        'img/p6_btn.png',
        'img/p7_btn1.png',
        'img/p7_btn2.png',
        'img/p7_img.png',
        'img/p8_btn1.png',
        'img/p8_btn2.png',
        'img/p8_btn3.png',
        'img/p8_word.png',
        'img/share.png',
        'img/share_pic.png',
        'img/pic_b.png',
        'img/pic.jpg',
        'img/pic1.png',
        'img/pic2.png',
        'img/pic3.png'
    ], function () {
        $(".loading").fadeOut("fast");
        $(".page0").fadeIn();
        $(".control").fadeIn();
        document.getElementById("sound").play();
        setVideoScreen(".video_full_screen",'center center')
        if(getVersions().android){
            $(".kamen_bg").show()
            $(".p0_video").hide()
            setTimeout(function(){
                $(".p0_btn1").fadeIn()
                $(".p0_btn2").fadeIn()
            },3000)
        }else{
            $(".p0_video").fadeIn();
            $(".video_bg").fadeIn();
            $("#video0")[0].play();
            $("#video0")[0].addEventListener("play",function(evt) {
                document.getElementById("sound").play();
                
            });
            $("#video0")[0].addEventListener("ended",function(evt) {
            });
            setTimeout(function(){
                $(".p0_btn1").fadeIn()
                $(".p0_btn2").fadeIn()
            },0)
        }
    }, $(".loading_progress"));
    
    $(window).touchstart(function(){
        $("video")[0].play();
    })
    
    $(".start").click(function () {
        $(".start").hide();
        $(".close").show();
        document.getElementById("sound").pause();
    });

    $(".close").click(function () {
        $(".start").show();
        $(".close").hide();
        document.getElementById("sound").play();
    });

    $(".p0_btn1").click(function () {
        $(".p0_video").fadeOut(2000)
        $(".page0").fadeOut(2000)
        setTimeout(function(){
            $(".kamen_bg").show();
        },2000)
        nextScene(page);
    });

    $(".p0_btn2").click(function () {
        $(".p0_video").fadeOut(2000)
        page = 5;
        nextScene(page);
    });

    $(".p6_btn").click(function () {
        page = page+1;
        nextScene(page);
    });
    
    $(".p6_prev").click(function(){
        clearInterval(time);
        prevPic();
    })
    $(".p6_next").click(function(){
        clearInterval(time);
        nextPic();
    })

    touch.on('.kamen', 'swipeleft swiperight', function(ev){
        if(isSlide){
            if(ev.type == "swipeleft"){
                isSlide = false;
                changePic(page);
            }
        }
        if(isNext){
            isNext = false;
            if(ev.type == "swipeleft"){
                page = page+1;
                isLeft = true;
                nextScene(page);
            }else if(ev.type == "swiperight"){
                page = page-1;
                if(page >= 1){
                    isLeft = false;
                    nextScene(page);
                }else{
                    page = 1;
                    isNext = true;
                }
            }
        }
        if(isPic){
            if(ev.type == "swipeleft"){
                clearInterval(time);
                nextPic();
            }else if(ev.type == "swiperight"){
                clearInterval(time);
                prevPic();
            }
            
        }
        if(isText){
            if(ev.type == "swipeleft"){
                isText = false;
                $(".p5_word_b1").hide()
                $(".p5_word_b2").show()
                isNext = true;
            }else if(ev.type == "swiperight"){
                
            }
            
        }
    });

    $('.input_b').cropit({

    });
    $(".cropit-image-input").click(function(){
        setTimeout(function(){
            $('.input_replay').show();
            $(".input_icon").hide();
            $(".cropit-image-preview").show()
        },2000)
    })
    $(".input_replay").click(function(){
        $(".input_icon").show();
        $(".cropit-image-preview").hide()
    })
    $('.p7_btn1').click(function() {
        var text1 = $('.input1').val();
        var text2 = $('.input2').val();
        var imageData = $('.input_b').cropit('export');
        if( !text1 ) {
            alert("请输入你的名字");
            $('.input1').focus();
            return false;
        }

        if( !text2 ) {
            alert("请输入你的最美宣言");
            $('.input2').focus()
            return false;
        }

        if( !imageData ) {
            alert("请上传照片");
            return false;
        }else{
            $(".page9").show().find(".p9_img img").attr("src",imageData);
            $(".p9_name").text(text1)
            $(".p9_title").text(text2)
        }
    });

    $('.p7_btn2').click(function() {
        var imageData = $('.input_b').cropit('export');
        if( !imageData ) {
            alert("想要占座，文字可以不填，图片还是要上传的哦~");
            return false;
        }else{
            $(".page9").show().find(".upimg").attr("src",imageData);
            $(".hastext,.notext").toggle()
        }
    });

    $(".p9_btn1,.p9_btn3").click(function(){
        $(".share").show()
    });

    $(".share").click(function(event){
        if(event.target == this){
            $(this).hide()
        }
    })

    function changePic(page){
        $(".p"+page+"_slide2").fadeIn(2000);
        $(".page"+page+" .next_pic").hide()
        $(".p"+page+"_slide1").addClass('rotate1');
        setTimeout(function(){
            isNext = true;
        },2000)
    }

    function nextScene(page){
        if(isLeft){
            $(".page"+(page-1)).fadeOut(2000);
        }else{
            $(".page"+(page+1)).fadeOut(2000);
        }
        $(".page"+page+" .next_pic").show()
        $(".page"+page).fadeIn(2000);
        if(page < 5){
            setTimeout(function(){
                isSlide = true;
                $(".slide1").removeClass('rotate1');
                $(".slide2").hide();
            },3000)
        }
        if(page == 5){
            setTimeout(function(){
                // $(".p5_word_b").animate({"opacity":"0.9"},1000)
                isText = true;
            },10000);
        }
        if(page == 6){
            time = setInterval(function(){
                isPic = true;
                nextPic();
            },4000)
            setTimeout(function(){
                $(".p6_btn").removeClass("bounceInLeft").addClass("pulse infinite")
            },3000)
        }
        if(page == 7){
            // $(".kamen").css("overflow","auto");
            document.ontouchmove=function(e){e.stopPropagation();};
            setTimeout(function(){
                $(".btn_block").removeClass("bounceIn").addClass("pulse infinite")
            },3500)
        }
    }
    function slidePic(pic){
        $(".p6_img").fadeOut(2000);
        $(".p6_img"+pic).fadeIn(2000);
    }
    function nextPic(){
        pic = pic+1;
        if(pic > 3){
            pic = 1;
        }
        slidePic(pic);
    }
    function prevPic(){
        pic = pic-1;
        if(pic < 1){
            pic = 3;
        }
        slidePic(pic);
    }

    function PreLoadImg(sources, callback, perEl) {
        var count = 0,
            images = {},
            imgNum = 0;
        for (src in sources) {
            imgNum++;
        }
        for (src in sources) {
            images[src] = new Image();
            images[src].onload = function () {
                if (perEl !== undefined) {
                    var progress = ~~((count + 1) * 100 / sources.length);
                    perEl.html(progress);
                }
                if (++count >= imgNum) {
                    setTimeout(function () {
                        callback(images);
                    }, 500);
                }
            }
            images[src].src = sources[src];
        }
    }
});
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
    function setVideoScreen(e, n){
        var w = document.documentElement.clientWidth;
        var h = document.documentElement.clientHeight;
        var t, i = w / h, r = 320 / 504;
        t = i < r ? h / 504 :w / 320;
        $(e).attr("style","-webkit-transform:scale(" + t + ");transform:scale(" + t + ");-webkit-transform-origin:"+n+";transform-origin:"+n+";");
    }
//function rotateImg(img, direction,canvas) {
//    //alert(img);
//    //最小与最大旋转方向，图片旋转4次后回到原方向
//    var min_step = 0;
//    var max_step = 3;
//    //var img = document.getElementById(pid);
//    if (img == null)return;
//    //img的高度和宽度不能在img元素隐藏后获取，否则会出错
//    var height = img.height;
//    var width = img.width;
//    //var step = img.getAttribute('step');
//    var step = 2;
//    if (step == null) {
//        step = min_step;
//    }
//    if (direction == 'right') {
//        step++;
//        //旋转到原位置，即超过最大值
//        step > max_step && (step = min_step);
//    } else {
//        step--;
//        step < min_step && (step = max_step);
//    }
//    //img.setAttribute('step', step);
//    /*var canvas = document.getElementById('pic_' + pid);
//     if (canvas == null) {
//     img.style.display = 'none';
//     canvas = document.createElement('canvas');
//     canvas.setAttribute('id', 'pic_' + pid);
//     img.parentNode.appendChild(canvas);
//     }  */
//    //旋转角度以弧度值为参数
//    var degree =  90 * Math.PI / 180;
//    var ctx = canvas.getContext('2d');
//    switch (step) {
//        case 0:
//            canvas.width = width;
//            canvas.height = height;
//            ctx.drawImage(img, 0, 0);
//            break;
//        case 1:
//            canvas.width = height;
//            canvas.height = width;
//            ctx.rotate(degree);
//            ctx.drawImage(img, 0, -height);
//            break;
//        case 2:
//            canvas.width = width;
//            canvas.height = height;
//            ctx.rotate(degree);
//            ctx.drawImage(img, -width, -height);
//            break;
//        case 3:
//            canvas.width = height;
//            canvas.height = width;
//            ctx.rotate(degree);
//            ctx.drawImage(img, -width, 0);
//            break;
//    }
//}
