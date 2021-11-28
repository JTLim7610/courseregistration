$(document).ready(function(){
    $(document).on('click','.check-order-btn',function(){
        $("." + $(this).data('form')).submit();
    })
})