window.addEventListener('scroll', ()=>{
	const scrolled=window.scrollY;

	console.log(scrolled);
});



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

        // if(scroll > 580){
        //     $("projects-container div").removeClass("bgcolor1");
        //     $("projects-container div").addClass("bgcolor");           
        // }
        // else{
        //     $("projects-container div").removeClass("bgcolor");
        //     $("projects-container div").addClass("bgcolor1");
        // }
    })
    $(document).on('click', 'a[href^="#"]', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: $($.attr(this, 'href')).offset().top
        }, 500);
    });
});

$(document).ready(function(){
    $(".center").slick({
        dots: true,
        infinite: true,
        centerMode: true,
        slidesToShow: 3,
        autoplay: true,
        autoplaySpeed: 2500,
        focusOnSelect: true,
        slidesToScroll: 3,
        responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 2
          }
        },
        {
          breakpoint: 480,
          settings: {
            arrows: false,
            centerMode: true,
            centerPadding: '40px',
            slidesToShow: 1
          }
        }
      ]
    });
});