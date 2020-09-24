$(document).ready(function (){
    $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll > 100){
            $("nav").removeClass("navTransparent");
            $("nav").addClass("navColor");   
        }
        else{
            $("nav").removeClass("navColor");
            $("nav").addClass("navTransparent");
        }
    })
     $(window).scroll(function(){
        var scroll = $(window).scrollTop();
        if(scroll > 100){
            $("highest").removeClass("imgTransparent");
        }
        else{
            $("nav").addClass("imgTransparent");
        }
    })
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    });
});