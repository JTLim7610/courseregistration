
$(document).ready(function(){


    //Filter function
    $('.filter-content').filterData();
    $('.filter-btn-section button').on('click',function(){
        $(".filter-btn-section button.active").removeClass('active');        
        $('.filter-btn-section button').removeClass('active-work');
        $(this).addClass('active-work').addClass('active');
    });

    //Hover product 
    $(document).on("mouseenter", ".product-item", function() {
        $('.product-item').addClass('hover');
        $(this).addClass('active');
    });    
    $(document).on("mouseleave", ".product-item", function() {
        $('.product-item').removeClass('hover').removeClass('active');
    });

    //Sorting function
    $(".sort-select").change(function(){
        $(this).parents('form:first').submit();
    })


    var category = getUrlParameter('category')
    if(category)
    {
        $("[data-filter='.category-"+category+"']").click();
    }
    
});


function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
};