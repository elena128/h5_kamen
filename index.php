<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <title>琴台音乐厅请你看汉造《卡门》</title>
    <link rel="stylesheet" href="css/animate.min.css">
    <link rel="stylesheet" href="css/kamen.css">
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <script type="text/javascript">
        var img_url="";
    </script>
    <script src="js/jquery.min.js"></script>
    <script src="js/touch.min.js"></script>
    <script src="js/jquery.cropit.js"></script>
    <script src="./js/exif.js"></script>
    <script src="js/kamen.js?hh"></script>
</head>
<body>
    <audio id="sound" src="http://fun-x.b0.upaiyun.com/kamen/audio/bg_music6.mp3" loop></audio>
    <div class="loading">
        <div class="loading_progress"></div>
        <div class="loading_word animated bounceIn"></div>
    </div>
    <div class="control">
        <div class="start"></div>
        <div class="close"></div>
    </div>
    <div class="kamen" style="display:block;">
        <div class="p_element kamen_bg"></div>
        <div class="p0_video video_full_screen">
            <video id="video0" data-index="0" poster="img/video.jpg" x-webkit-airplay="true" webkit-playsinline="true" preload="auto" src="http://fun-x.b0.upaiyun.com/kamen/video/1.mp4" loop></video>
            <div class="p_element video_bg"></div>
        </div>
        <div class="page page0">
            <div class="p_element p0_word1 animated bounceInDown"></div>
            <div class="p_element p0_btn1 animated rollIn"></div>
            <div class="p_element p0_btn2 animated lightSpeedIn"></div>
            <div class="p_element p0_word2"></div>
        </div>
        <div class="page page1">
            <div class="slide2 p1_slide2">
                <div class="p_element p1_img2"></div>
                <div class="p_element p1_word3 animated rotateInDownLeft"></div>
                <div class="p_element next_page animated lightSpeedIn"></div>
            </div>
            <div class="slide1 p1_slide1">
                <div class="p_element p1_img1"></div>
                <div class="p_element p1_word1 animated fadeInUpBig"></div>
                <div class="p_element p1_word2 animated fadeInLeftBig"></div>
                <div class="p_element next_pic animated lightSpeedIn"></div>
            </div>
        </div>
        <div class="page page2">
            <div class="slide2 p2_slide2">
                <div class="p_element p2_img2"></div>
                <div class="p_element p2_word3 animated rotateInDownRight"></div>
                <div class="p_element next_page animated lightSpeedIn"></div>
            </div>
            <div class="slide1 p2_slide1">
                <div class="p_element p2_img1"></div>
                <div class="p_element p2_word1 animated fadeInUpBig"></div>
                <div class="p_element p2_word2 animated fadeInLeftBig"></div>
                <div class="p_element next_pic animated lightSpeedIn"></div>
            </div>
        </div>
        <div class="page page3">
            <div class="slide2 p3_slide2">
                <div class="p_element p3_img2"></div>
                <div class="p_element p3_word3 animated rotateInDownRight"></div>
                <div class="p_element next_page animated lightSpeedIn"></div>
            </div>
            <div class="slide1 p3_slide1">
                <div class="p_element p3_img1"></div>
                <div class="p_element p3_word1 animated fadeInUpBig"></div>
                <div class="p_element p3_word2 animated fadeInLeftBig"></div>
                <div class="p_element next_pic animated lightSpeedIn"></div>
            </div>
        </div>
        <div class="page page4">
            <div class="slide2 p4_slide2">
                <div class="p_element p4_img2"></div>
                <div class="p_element p4_word3 animated rotateInUpLeft"></div>
                <div class="p_element next_page animated lightSpeedIn"></div>
            </div>
            <div class="slide1 p4_slide1">
                <div class="p_element p4_img1"></div>
                <div class="p_element p4_word1 animated fadeInUpBig"></div>
                <div class="p_element p4_word2 animated fadeInLeftBig"></div>
                <div class="p_element next_pic animated lightSpeedIn"></div>
            </div>
        </div>
        <div class="page page5">
            <div class="p_element p5_img_b">
                <div class="p5_img p5_img1 animated fadeIn"></div>
                <div class="p5_img p5_img2 animated fadeIn"></div>
                <div class="p5_img p5_img3 animated fadeIn"></div>
                <div class="p5_img p5_img4 animated fadeIn"></div>
                <div class="p5_img p5_img5 animated fadeIn"></div>
                <div class="p5_img p5_img6 animated fadeIn"></div>
                <div class="p5_img p5_img7 animated fadeIn"></div>
                <div class="p5_img p5_img8 animated fadeIn"></div>
                <div class="p5_img p5_img9 animated fadeIn"></div>
                <div class="p5_img p5_img10 animated fadeIn"></div>
                <div class="p5_img p5_img11 animated fadeIn"></div>
                <div class="p5_img p5_img12 animated fadeIn"></div>
                <div class="p5_img p5_img13 animated fadeIn"></div>
                <div class="p5_img p5_img14 animated fadeIn"></div>
                <div class="p5_img p5_img15 animated fadeIn"></div>
                <div class="p5_img p5_img16 animated fadeIn"></div>
            </div>
            <div class="p_element p5_word_b1 p5_word_b">
                <div class="p_element p5_word1 animated fadeIn"></div>
                <div class="p_element p5_word2 animated fadeIn"></div>
                <div class="p_element p5_word3 animated fadeIn"></div>
                <div class="p_element p5_word4 animated fadeIn"></div>
                <div class="p_element p5_word5 animated fadeIn"></div>
                <div class="p_element p5_word6 animated fadeIn"></div>
                <div class="p_element p5_next1 next_text animated lightSpeedIn"></div>
            </div>
            <div class="p_element p5_word_b2 p5_word_b">
                <div class="p_element p5_word21 animated fadeIn"></div>
                <div class="p_element p5_word22 animated fadeIn"></div>
                <div class="p_element p5_word23 animated fadeIn"></div>
                <div class="p_element p5_word24 animated fadeIn"></div>
                <div class="p_element p5_word25 animated fadeIn"></div>
                <div class="p_element p5_next2 next_text animated lightSpeedIn"></div>
            </div>
        </div>
        <div class="page page6">
            <div class="p_element p6_bg"></div>
            <div class="p_element p6_btn animated bounceInLeft"></div>
            <div class="p_element p6_word animated fadeInUp"></div>
            <div class="p_element p6_block animated bounceInRight">
                <div class="p_element p6_img p6_img1"></div>
                <div class="p_element p6_img p6_img2"></div>
                <div class="p_element p6_img p6_img3"></div>
            </div>
        </div>
        <div class="page page7">
            <div class="input_b">
                <input type="file" class="input cropit-image-input">
                <div class="image_block">
                    <div class="cropit-image-preview" style="height: 260px;width: 200px;"></div>
                </div>
                <input type="range" class="cropit-image-zoom-input">
                <div class="input_icon animated bounceIn"></div>
                <input type="hidden" name="image-data" class="hidden-image-data" />
                <div class="input_replay">重新<br>上传</div>
            </div>
            <div class="text_b animated bounceInLeft">
                <div class="text1"><span>我是</span><input type="text" class="input1" maxlength="4" placeholder="琴台君"></div>
                <div class="text2"><span>我让#</span><input type="text" class="input2" maxlength="4" placeholder="最美卡门"><span class="text_icon"></span><span style="margin-left:75px">#</span></div>
            </div>
            <div class="btn_block animated bounceIn">
                <div class="p7_btn1"></div>
                <div class="p7_btn2"></div>
            </div>
        </div>
    </div>
    <div id="orientLayer" class="mod-orient-layer">
        <div class="mod-orient-layer__content">
            <i class="icon mod-orient-layer__icon-orient"></i>
            <div class="mod-orient-layer__desc">为了更好的体验，请使用竖屏浏览</div>
        </div>
    </div>
</body>
</html>