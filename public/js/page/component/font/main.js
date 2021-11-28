

//Onclick copy button - copy pre text 
$(document).on('click','.copy-btn',function(){
    var $temp = $("<textarea>");
    $("body").append($temp);
    $temp.val($("#pre").text()).select();
    document.execCommand("copy");
    $temp.remove();
    swal('','Copied','success');
})
