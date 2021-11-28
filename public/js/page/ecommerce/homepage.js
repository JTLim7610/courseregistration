



$(document).ready(function(){

  
    // Banner slick setting 
    $('.banner-slick').slick({
        arrows: false,
        dots: true,
        infinite: true,
        autoplay: true,
        autoplaySpeed: 4000,
        adaptiveHeight: true
    });



    // Insta feed animation 
    $(document).on("mouseenter", ".feed-item", function() {
        $('.feed-item').addClass('hover');
        $(this).removeClass('hover');
    });
    $(document).on("mouseleave", ".feed-item", function() {
        $('.feed-item').removeClass('hover');
    });


    // product animation 
    $(document).on("mouseenter", ".product-item", function() {
        $('.product-item').addClass('hover');
        $(this).removeClass('hover');
    });
    $(document).on("mouseleave", ".product-item", function() {
        $('.product-item').removeClass('hover');
    });


    //Fav function 
    $(document).on('click','.fav-btn',function(){

        //Get current fav array 
        var currentFav = JSON.parse(localStorage.getItem("fav"));
        var productID = $(this).attr('data-code');

        //Save fav 
        if(!currentFav || $.inArray(productID, currentFav)==-1)
        {
            if(!currentFav)  currentFav=[];            
            currentFav.push(productID);
            localStorage.setItem("fav", JSON.stringify(currentFav));
        }

        console.log(JSON.parse(localStorage.getItem("fav")))
            
    })



});

