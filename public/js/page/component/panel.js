$(document).ready(function(){


    var resizeDelay = 200;
    var doResize = true;
    var resizer = function () {
       if (doResize) { 
            checkPanelSize(); 
            doResize = false;
       }
     };
     var resizerInterval = setInterval(resizer, resizeDelay);
     resizer();
     $(window).resize(function() {
       doResize = true;
     });
   
    $(window).on("resize", checkPanelSize());

    // Auto adjust height 
    function checkPanelSize()
    {
        if($(".custom-item-box").length)
        {
            $('.custom-item-box').css({'height':$('.custom-item-box').width()+'px'});
            $('.custom-item-box .background-image-section').each(function(i, obj) {
                $(obj).css({'height':$(obj).width()+'px'});
            });
        }
    }

})