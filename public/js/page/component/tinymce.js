$(document).ready(function(){
    

    // TinyMCE Initialization 
    tinymce.init({
        selector: '.wysiwyg',
        relative_urls : false,
        remove_script_host : false,
        document_base_url: $('meta[name="app-url"]').attr('content'),
        plugins: [
            'advlist paste imagetools textpattern noneditable quickbars preview autolink link image lists charmap  hr media table emoticons'
        ],      
        toolbar: 'styleselect  fontsizeselect| bold italic | alignleft aligncenter alignright alignjustify | ' +
        'bullist numlist outdent indent | insertfile link image media | undo redo | ' +
        'forecolor backcolor |  emoticons charmap | table  hr',
        menubar: 'file edit view insert format table ',    
        toolbar_mode: 'sliding',         
        image_title: true, 
        height: 600,     
        quickbars_insert_toolbar: 'image quicktable  | emoticons charmap',
        quickbars_selection_toolbar: 'bold italic | formatselect  forecolor backcolor | | quicklink ',
        file_picker_types: 'image',
        file_picker_callback: customFilePicker,
        images_upload_handler: customImageUploadHandler,
        media_poster: false,
        media_alt_source: false,
        content_style: 'img {max-width: 100%;height:auto}' 
    });


    // UX Improve 
    $(document).on('click','.tox-dialog-wrap__backdrop',function(){
        $(".tox-dialog__header button[aria-label='Close']").click();
    })


    // Function to handle quick upload 
    function customImageUploadHandler(blobInfo, success, failure)
    {                
        showLoader();
        var formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        $.ajax({
            type: 'POST',
            url: "/file/store",
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => { 
                success(data.data.path);
                hideLoader();
            },
            error: function (jqXHR) {                
                hideLoader();
                swal('',JSON.parse(jqXHR.responseText).message,'error');
            }
        });
    }


    // Function to handle file picker 
    function customFilePicker(cb)
    {         
        $("#fileManager").modal('show');            
        $('#fileManager').on('hidden.bs.modal', function () {     
            if($("#insertFileBtn").attr('data-source'))                
                cb($("#insertFileBtn").attr('data-source'), {alt: $("#insertFileBtn").attr('data-source')});                
        })
        
        
    }

    
})


 


