// LAZY LOAD FUNCTION
function lazyLoad() {
    $('iframe').each(function () {
        var frame = $(this);
        var frameTop = $(frame).offset().top;
        var frameBottom = $(frame).offset().top + $(frame).outerHeight(true)+1500;
        var scrollTop = $(window).scrollTop()+1400;
        if(scrollTop>frameTop && scrollTop<frameBottom && !$(frame).attr('src'))
            $(frame).attr('src', $(frame).attr('data-src'));
            
        if(scrollTop>frameBottom)
            $(frame).removeAttr('src');
    });
}
var throttled = _.throttle(lazyLoad, 100);
$(window).scroll(throttled);
lazyLoad();


