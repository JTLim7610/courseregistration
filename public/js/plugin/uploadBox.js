


/*
    #1 - Flexible file upload design  x 
    #2 - File type checking 
    #3 - File optimization ? https://embed.plnkr.co/plunk/v5JU2v  
    #4 - Seperate file checking and optimization function  x 
    #5 - File display  x 
    #6 - Multiple file display  x 

*/


// File Upload

//Function to check file format 
function fileTypeChecking(file, type)
{
    if(type =="image")
        return /\.(?=jpg|png|jpeg|jfif|gif|webp|tiff|mp3|mp4|wmv|avi|mov|webm|flv|avchd|ogg|mkv|wav)/gi.test(file.name)
    if(type == "attachment")
        return /\.(?=csv|xlsx|pdf|doc|docx)/gi.test(file.name)
}



//Function to initalize uploadBox
function initialUploadBox(key, type='image')
{

    var fileInputID = key + "-upload";
    var fileDragID = key + "-drag";
    var labelID = key + "-hide";


    //Initialize 
    function Init() {            
        var fileSelect = document.getElementById(fileInputID);
        fileSelect.addEventListener("change", fileSelectHandler, false);          
    }


    //File drag hover
    function fileDragHover(e) {            
        var fileDrag = document.getElementById(fileDragID);
        e.stopPropagation();
        e.preventDefault();
        fileDrag.className =
            e.type === "dragover" ? "hover" : "modal-body file-upload";
    }
    

    //File select
    function fileSelectHandler(e) {
        
        var files = e.target.files || e.dataTransfer.files;            
        fileDragHover(e);

        var filesLength = files.length;
        if(filesLength == 1){            
            parseFile(files[0]);            
        }
        else {
            // Process all File objects            
            for (var i = 0, f; (f = files[i]); i++) {
                parseFile(f);
            }            
        }

        
    }

    //Parse file 
    function parseFile(file) {  
        var isGood = fileTypeChecking(file, type);                        
        if (isGood) {
            $("#"+labelID).hide();
                              
            // AJAX upload file to filemanager 
            showLoader();                                    
            var formData = new FormData();
            formData.append('file', $('#'+fileInputID)[0].files[0]); 
            formData.append('fileAccept',type); 
            $.ajax({
                type: 'POST',
                url: "/file/store",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {                    
                    $("#" + key + "-uploader .clear-input").val('');
                    $("#" + key + "-image-response").attr('src', data.data.path);
                    $("#" + key + "-uid").val(data.data.uid);
                    $("#" + key + "-image-name").html(data.data.name + '.' + data.data.extension);                     
                    hideLoader();
                },
                error: function (jqXHR) {                
                    hideLoader();
                    swal('',JSON.parse(jqXHR.responseText).message,'error');
                }
            });
        
        
            // Display image             
            

        } else {                  
            document.getElementById(labelID).classList.remove("hidden");                   
            swal('','Invalid File Format. 文件格式不对','warning'); 
        }
    }

    
    // Check for the various File API support.
    if (window.File && window.FileList && window.FileReader) {
        Init();
    } else {            
        document.getElementById(fileDragID).style.display = "none";                       
    }


    // File manager button 
    $(document).on('click','.filemanager-btn',function(e){
        e.preventDefault();    
        var key = $(this).data('key');
        $("#insertFileBtn").attr('data-targetsource', key + "-image-response")
        $("#insertFileBtn").attr('data-targetuuid', key + "-uid");
        $("#insertFileBtn").attr('data-targetname', key + "-image-name");
        $("#insertFileBtn").attr('data-targetpath', key + "-image-path");
        $("#insertFileBtn").attr('data-targetuploader', key + "-uploader");

        // Get filemanager type 
        var type = $(this).data('type');
        if(!type) type = null;

        $("#fileManager").attr('data-type',type);        
        $("#fileManager").modal('show');        
    })

}
