function fadeOnScroll(){
    $(window).scroll(function(){
        $('.scroll-in').each(function(i){
            var bottomOfObject = $(this).position().top + $(this).outerHeight();
            var bottomOfWindow = $(window).scrollTop() + $(window).height();

            if (bottomOfWindow > bottomOfObject){
                $(this).animate({
                    'opacity':'1',
                }, 1000);
            }
        });
    });
}
function fadeInNoScroll(){
    $('.fade-in').each(function(i){
        $(this).animate({
            'opacity':'1'
        }, 1000);
    });
}
function main(){
    fadeOnScroll();
    fadeInNoScroll();
}

$(document).ready(main());