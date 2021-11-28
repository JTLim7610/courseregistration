$(document).ready(function () {

    if ($(".datepicker").length) {

        $('.datepicker').each(function(i, obj) {
            if(!$(obj).attr('readonly'))
                $(obj).flatpickr();
        });

    }

    if ($(".menu-tooltip").length) {
        //Dropdown tooltip animation
        $(".menu-tooltip").tooltipster({
            animation: "fade",
            delay: 0,
            trigger: "click",
            contentCloning: true,
            arrow: true,
            side: 'left',
            interactive: true
        });
        $(document).on('click','.tooltip_menus button',function(e){
            $(".menu-tooltip").tooltipster('hide');
        });
        $(document).on('click','.tooltipstered, .menu-tooltip',function(e){
            e.stopPropagation();        
        });
    }

});
