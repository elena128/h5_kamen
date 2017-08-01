$(function(){
    document.ontouchmove = function(e){ e.preventDefault(); };
    var isSlide = true;
    var page = 6;
    var pic = 1;
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

    $(".p0_btn").click(function () {
        $("#bg").show()
        nextScene(page);
    });

    $(".getmore").click(function(){
        page = page+1;
        nextScene(page);
    })

    $(".p6_btn").click(function () {
        page = page+1;
        nextScene(page);
        $(".kamen").css("overflow","auto");
        setTimeout(function(){
            $(".p7_bg").fadeOut();
            document.ontouchmove=function(e){e.stopPropagation();};
        },4000)
    });
    
    $(".p6_prev").click(function(){
        prevPic();
    })
    $(".p6_next").click(function(){
        nextPic();
    })

    touch.on('.kamen', 'swipeleft swiperight', function(ev){
        if(isSlide){
            if(ev.type == "swipeleft"){
                if(page < 6){
                    isSlide = false;
                    changePic(page);
                }else{
                    nextPic();
                }
            }else if(ev.type == "swiperight"){
                if(page == 6){
                    prevPic();
                }
            }
        }
    });

    $('.input_b').cropit();
    $(".cropit-image-input").click(function(){
        $(this).hide();
        $('.input_replay').show();
        $(".cropit-image-preview").show()
    })
    $(".input_replay").click(function(){
        $(".cropit-image-preview").hide()
        $(".cropit-image-input").show()
    })
    $('.btn_b').click(function() {
        var text1 = $('.input1').val();
        var text2 = $('.input2').val();
        var imageData = $('.input_b').cropit('export');

        if( !text1 ) {
            alert("请输入你的名字");
            return false;
        }

        if( !text2 ) {
            alert("请输入你的最美宣言");
            return false;
        }

        if( !imageData ) {
            alert("请上传照片");
            return false;
        }

        var data = {
            text1: text1,
            text2: text2,
            pic: imageData
        }

        $.post('api.php', data, function(response) {
            if ( response.code === 'success' ) {
                location.href = 'result.php?token='+response.message;
            } else {
                alert(response.message);
            } 
        });
    });

    function changePic(page){
        isSlide = false;
        $(".p"+page+"_next").hide()
        $(".p"+page+"_slide2").show();
        $(".p"+page+"_slide1").addClass('rotate1');
        setTimeout(function(){
            $(".p"+page+"_slide2").addClass('rotate1').css({"-webkit-transform":"rotateY(90deg) scale(0.78)"});
            $(".p"+page+"_img2").show();
        },1000)
    }

    function nextScene(page){
        $(".page"+page).show();
        if(page >= 6){
            isSlide = true;
            $(".page"+page).addClass('open');
        }else{
            $(".p"+page+"_img1").show().addClass('open');
        }
        setTimeout(function(){
            $(".page"+(page-1)).hide();
            isSlide = true;
        },4500)
    }
    function slidePic(pic){
        $(".p6_img").hide();
        $(".p6_img"+pic).show();
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
});
