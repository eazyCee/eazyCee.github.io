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