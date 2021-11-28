$(document).ready(function(){

    //Get data
    $(document).on('click','.translatejs',function(){
        $(".modal-title #id").val( $(this).data('id') );
        $(".modal-body #key").val(  $(this).data('key') );
        $(".modal-body #en").val(  $(this).data('en') );
        $(".modal-body #cn").val( $(this).data('cn') );
        $(".modal-body #ms").val( $(this).data('ms') );
        $(".modal-title #check").val($(this).data('index'));
    })


    //AJAX update data
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(".update-translate").click(function(){
        var en = $("#en").val();
        var cn = $("#cn").val()
        var ms = $("#ms").val()
        $("#editTranslateModal").modal('hide');
        $.ajax({
            url: 'translate/update',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                id : $("#id").val(),
                value_en : en,
                value_ms : ms,
                "value_zh-CN" : cn,
                key:$("#key").val()
            },
            dataType: 'JSON',
            success: function (data) {                                
                var index = $('#check').val();
                $(".tr_"+index).find('.en_td').html(en);
                $(".tr_"+index).find('.cn_td').html(cn);
                $(".tr_"+index).find('.ms_td').html(ms);
                Toastify({
                    text:  "<div><span class='title'>Translate content updated</span></div>",     
                    duration: 2000,
                    avatar: "/img/icon/info.png",
                    position: 'right'
                }).showToast();
            }
        });
    });
})
