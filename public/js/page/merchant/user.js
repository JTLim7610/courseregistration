$(document).ready(function () {

    // If click on view button 
    $(document).on('click', '.view-btn', function () {
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        var id = $(this).val();
        showLoader();
        $('.product-list').html('');
        $.ajax({
            type: 'GET',
            url: 'user/get/' + id,
            success: function (data) {
                //Insert data to all input 
                $.each(data, function (index, value) {
                    $("[data-name='" + index + "']").val(value);
                });
                data.products.forEach(function(item) {
                    $('.product-list').append("<li>"+item.name_en+"</li>");
                });
                data.referrals.forEach(function(item) {
                    $('.referral-list').append("<li>"+item.name+"</li>");
                });
                $("[data-name='total_referral']").html(data.total_referral);
                $("[data-name='total_product']").html(data.total_product);
                hideLoader();
            }
        });

        if($(this).attr('data-close-check'))
            $('.closed-btn').hide();
        else 
            $('.closed-btn').show();
    })





})