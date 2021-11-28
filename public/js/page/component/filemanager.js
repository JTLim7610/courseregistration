$(document).ready(function(){    



    /*******************  FILE MANAGER SECTION  ******************/



    $('#fileManager .search-form').on('keyup keypress', function(e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) { 
          e.preventDefault();
          return false;
        }
    });


    // On select image : hightlight
    $(document).on('click','#fileManager .tab-content img',function(){
        $("img.selected").removeClass('selected');
        $(this).addClass('selected');
    })

    // On tab  
    $(document).on('click','#fileManager #pills-tab',function(){
        $("#personalDeleteBtn").hide();
        $("#fileInfoName").html('');
        $("#fileInfoSize").html('');
    })


    // On double click iamge 
    $(document).on('dblclick', 'img.selected', function(e) {
        $("#insertFileBtn").click();
    })


    // On insert selected image 
    $(document).on('click','#insertFileBtn',function(){

        // Check if got select image 
        if(!$('img.selected').length)
        {
            swal('',$(this).data('error'), "error");
            return false;
        }

        // Import selected image 
        $("#insertFileBtn").attr('data-source',$('img.selected').attr('src'));               
        if(target = $("#insertFileBtn").attr('data-targetsource'))         
        {            
            $("#"+ $("#insertFileBtn").attr('data-targetuploader') + " .clear-input").val('');   
            $("#"+ target).attr('src',$('img.selected').attr('src'));             
            $("#" +$("#insertFileBtn").attr('data-targetpath')).val($('img.selected').attr('src')); 
            $("#" +$("#insertFileBtn").attr('data-targetuuid')).val($('img.selected').attr('data-uid')); 
            $("#" +$("#insertFileBtn").attr('data-targetname')).html((filename=$('img.selected').data('filename'))?filename:'');   
              
        }       
           
        $("#fileManager").modal('hide');
        if($("#insertFileBtn").data('targetname'))
            $(".uploaded-hide").hide();
                
    })



    // Filemanager modal on load
    $('#fileManager').on('show.bs.modal', function (e) {        
        $(".personal-result").html('');  

        // Check file manager type 
        setTimeout(function(){
            var type =$("#fileManager").attr('data-type');
            if(type && type == 'attachment'){
                $("#fileManager #pills-tab").hide();
                $("#fileManager input[name='fileAccept']").val('attachment');
                searchPersonal(0, 'attachment');
            }
            else {            
                $("#fileManager #pills-tab").show();
                $("#fileManager input[name='fileAccept']").val('image');
                $("#pills-personal-tab").click();
            }
        },400)
    })

    // Filemanager modal on hide
    $('#fileManager').on('hide.bs.modal', function (e) {        
        setTimeout(function(){
            $("#insertFileBtn").attr({"data-targetname": '', "data-targetuid": '', "data-source": '', "data-filename": '', "data-targetpath" : '', "data-targetuuid":'',"data-targetsource":'',"data-targetuploader":''});
        },500)
        
    })


    /*******************  FILE EXPLORER SECTION  ******************/
    
    var fetchingPersonal = false;  


    // Onclick upload button 
    $(document).on('click','.upload-btn',function(){
        $("#personalUpload").click();
    })


    // Onclick delete attacvhmetn button 
    $(document).on('click','#personalDeleteBtn',function(){
        confirmationAlert(function(e){
            if(e){
                var deleteID = $(".personal-img-box img.selected").attr('data-uid');
                $.ajax({
                    url: '/file/delete',
                    type: 'POST',
                    data: {
                        _token: CSRF_TOKEN,                                            
                        deleteID: deleteID,                      
                    },
                    dataType: 'JSON',
                    success: function () {      
                        swal('','File deleted','success');
                        $(".personal-img-box img.selected").parent().parent().remove();
                        $("#storageRefresh").show();
                        $("#fileInfoName").attr('data-name', '');
                        $("#fileInfoSize").attr('data-size', ''); 
                        $("#fileInfoName").html('');
                        $("#fileInfoSize").html(''); 
                    }
                });
            }
        })
    })


    // on upload file 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).on('change','#personalUpload',function(e){
        showLoader();
        e.preventDefault();
        var form = document.getElementById("personalUploadForm");
        var formData = new FormData(form);
        $.ajax({
            type: 'POST',
            url: $("#personalUploadForm").data('route'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: (data) => {
                form.reset();                
                $("#personalPos").val(parseInt($("#personalPos").val())+1) ;
                $(".personal-result").prepend(`<div class='col-sm-4 col-xl-3 col-6'><div class='personal-img-box'><img data-filename='${data.data.name}.${data.data.extension}'  data-uid='${data.data.uid}' data-fileSize='${data.data.size}' src='${(data.data.fileType == 'attachment')?'/img/icon/attachment.png':data.data.path}'/></div></div>`)  
                $(".no-personal").hide(); 
                resizeImageBox();                              
                hideLoader();
            },
            error: function (jqXHR) {                
                hideLoader();
                swal('',JSON.parse(jqXHR.responseText).message,'error');
            }
        });
    })


    // On click searcch personal tab 
    $(document).on('click','#pills-personal-tab',function(){       
        fetchingPersonal=false;
        $(".personal-result").html('');        
        $(".no-personal").hide(); 
        $("#personalExplorerQuery").val('');  
        searchPersonal();              
    })


    // On click searcch  button 
    $(document).on('click','.search-personal',function(){              
        $(".personal-result").html('');  
        $(".no-personal").hide();
        searchPersonal();  
    })


    // Bind enter key to search 
    $('#personalExplorerQuery').on('keypress', function (e) {
        
        if(e.which === 13)
        {
            $(".personal-result").html('');  
            $(".no-personal").hide();
            searchPersonal();
        }
            
    });
    

    // Detect selected
    $(document).on('click','#fileManager .personal-img-box img',function(){
        $("#fileInfoName").attr('data-name', $("#fileInfoName").html());
        $("#fileInfoSize").attr('data-size', $("#fileInfoSize").html()); 
        $("#personalDeleteBtn").show();
    })

    
    
    // Detect hover and display info
    $(document).on({
        mouseenter: function () {
            var img = $(this).find("img");
            var size = $(img).attr('data-filesize');
            fileSize = (parseFloat(size)/1e+6).toFixed(2) + " MB";
            if(fileSize == "0.00 MB") fileSize = (parseFloat(size)/1000).toFixed(2) + " KB";
            $("#fileInfoName").html($(img).attr('data-filename'));            
            $("#fileInfoSize").html(fileSize);            
        },
        mouseleave: function () {
            $("#fileInfoName").html( $("#fileInfoName").attr('data-name')?$("#fileInfoName").attr('data-name'):'');
            $("#fileInfoSize").html($("#fileInfoSize").attr('data-size')?$("#fileInfoSize").attr('data-size'):'');
        }
    }, ".personal-img-box");

    
    // Detech scroll    
    $("#fileManager #pills-personal").scroll(function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight-300) {    
            if ($("#personalPos").val() != -1)                
                searchPersonal($("#personalPos").val());                       
        } 
    });


    // Function to search personal attachment API
    function searchPersonal(pos = 0 , type=null)
    {               

        // Check if fethcing 
        if(!fetchingPersonal)
        {
            
            fetchingPersonal = true;
            $("#pills-personal .inpage-loader").show();
    
            // 1. Call api to grab GIF
            $.ajax({

                url: '/file',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,                    
                    pos : pos,
                    fileType : $("#fileManager").attr('data-type'),
                    search: $("#personalExplorerQuery").val()
                },
                dataType: 'JSON',
                success: function (data) {      
                    
                     // 2. Check if got result              
                     if(!data || data.length == 0)
                     {
                         $("#personalPos").val(-1);
                         if($("#personalExplorerQuery").val() && pos == 0)
                            $(".no-personal").show();                             
                        if(pos == 0)
                            $(".no-personal").show();                             
                     }                    
                     else 
                     {   
                         
                         // 3. Update pos 
                         $("#personalPos").val(parseInt(pos) + parseInt(data.length));

                         // 4. Insert attachment 
                         $.each(data, function( index, value ) {
                            var meta =JSON.parse(value.meta);        
                            var attachment = value.path;
                            if(meta.fileType=='attachment') attachment = '/img/icon/attachment.png';
                            if(meta.fileType=='video') attachment = '/img/icon/video.png';

                            $(".personal-result").append(`<div class='col-sm-4 col-lg-3  col-6'><div class='personal-img-box'><img class='lazy' data-filename='${meta.name}.${meta.extension}' data-filesize='${value.size}' data-uid='${value.uid}' data-src='${attachment}'/></div></div>`)
                        });        
                        $(".lazy").lazy(getLazySetting());
                        setTimeout(function(){resizeImageBox();$(".no-personal").hide();},300)
                     }       
                     $("#pills-personal .inpage-loader").hide();                        
                     fetchingPersonal = false;        
                }
            });
        }       

    }


    /*******************  GIF SECTION  ******************/

    var fetchingGIF = false;
    var columnSize = [0,0,0,0,0];


    // Bind enter key to search gif
    $('#gifQuery').on('keypress', function (e) {
       
        if(e.which === 13)
        {
            $(".no-gif").hide();
            $(".gif-result .gif-column").html(''); 
            columnSize = [0,0,0,0,0]; 
            searchGIF('search', 0);
            
        }
           
    });


    // On click searcch gif button 
    $(document).on('click','.search-gif',function(){              
        $(".gif-result .gif-column").html('');  
        $(".no-gif").hide();
        columnSize = [0,0,0,0,0];
        searchGIF('search', 0);
        
    })


    // On click searcch gif tab 
    $(document).on('click','#pills-gif-tab',function(){     
        fetchingGIF = false;  
        $(".gif-result .gif-column").html('');  
        $(".no-gif").hide();       
        columnSize = [0,0,0,0,0];
        searchGIF('trending',0);
        $("#GIFQuery").val('');        
    })


    // Detech scroll    
    $("#fileManager #pills-gif").scroll(function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight-500) {    
            if ($("#GIFPos").val() != -1)       
            {
                if($("#GIFQuery").val())
                    searchGIF('search',$("#GIFPos").val());                
                else{
                    columnSize = [0,0,0,0,0];
                    searchGIF('trending',$("#GIFPos").val());  
                }
            }
           
        } 
    });


    // Function to search GIF API
    function searchGIF(type, pos)
    {       
        
        // Check if fethcing 
        if(!fetchingGIF)
        {
            fetchingGIF = true;
            $("#fileManager #pills-gif .inpage-loader").show();
            $("#GIFQuery").val((type=="trending")?'':$("#gifQuery").val());
    
            // 1. Call api to grab GIF
            $.ajax({
                type: 'GET', 
                url: '/api/tenor/'+ type + "/" + pos + "/" + $("#gifQuery").val() ,
                success: function (data) { 
                
                    // 2. Check if got result 
                    var results= (data)?JSON.parse(data).results:'';                
                    if(!results || results.length == 0)
                    {
                        $("#GIFPos").val(-1);
                        if(type=='search')
                            $(".no-gif").show();
                        
                    }                    
                    else 
                    {   
                        
                        // 3. Update pos 
                        $("#GIFPos").val(parseInt(pos) + parseInt(results.length));
                        $(".no-gif").hide();
    
                        // 4. Insert gif into column 
                        var columnCount = 0;
                        var columnMax = 5;
                        if($(window).width() < 800) columnMax = 2; 
                        if($(window).width() < 600) columnMax = 1; 
                        $.each(results, function( index, value ) {
                            if(value.media[0].gif)               
                            {

                                var ci = 0;
                                var cv = columnSize[0];
                                $.each(columnSize, function(i,k){
                                    if(cv>k)
                                    {
                                        cv = k;
                                        ci = i;
                                    }
                                })

                                $(".gif-column.column-"+ci).append(`<img class='lazy' data-src='${value.media[0].tinygif.url}'/>`);
                                columnSize[ci] = $(".gif-column.column-"+ci).height();
                            }
                            if(columnCount== columnMax)
                                columnCount=0;
                        });                         
                                               
                    }     
                    $('.lazy').lazy(getLazySetting());
                    setTimeout(function(){selfLazyLoad()},300);
                    $("#fileManager #pills-gif .inpage-loader").hide();                       
                    fetchingGIF = false;                    
                }
            });
        }       
    }




    /*******************  PRESET SECTION  ******************/


    var fetchingPreset = false;

    // On click searcch preset tab 
    $(document).on('click','#pills-preset-tab',function(){   
        fetchingPreset = false;    
        $(".preset-result").html('');        
        $(".no-preset").hide(); 
        $(".presetQuery").val('');  
        searchPreset();              
    })

    // On click vertical preset tab 
    $(document).on('click','#pills-preset .v-tab',function(){       
        $(".preset-result").html('');        
        $(".no-preset").hide(); 
        $(".presetQuery").val('');  
        searchPreset();              
    })


    // On click searcch gif button 
    $(document).on('click','.search-preset',function(){              
        $(".preset-result").html('');  
        $(".no-preset").hide();
        searchPreset();  
    })


    // Bind enter key to search gif
    $('.presetQuery').on('keypress', function (e) {
        
        if(e.which === 13)
        {
            $(".preset-result").html('');  
            $(".no-preset").hide();
            searchPreset();
        }
            
    });
    

    // Detech scroll    
    $("#fileManager #pills-preset .tab-content").scroll(function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight-300) {    
            if ($("#presetPos").val() != -1)                
                searchPreset($("#presetPos").val());                       
        } 
    });


    // Function to search preset attachment API
    function searchPreset(pos = 0 )
    {       
        
        // Check if fethcing 
        if(!fetchingPreset)
        {
            fetchingPreset = true;
            $("#pills-preset .inpage-loader").show();
    
            // 1. Call api to grab GIF
            $.ajax({

                url: '/preset',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,                    
                    directory : $(".v-tab.active").data('name'),
                    pos : pos,
                    search: $(".presetQuery").val()
                },
                dataType: 'JSON',
                success: function (data) {      

                     // 2. Check if got result              
                     if(!data || data.length == 0)
                     {
                         $("#presetPos").val(-1);
                         if($(".presetQuery").val())
                            $(".no-preset").show();                             
                     }                    
                     else 
                     {   
                         
                         // 3. Update pos 
                         $("#presetPos").val(parseInt(pos) + parseInt(data.length));

                         // 4. Insert attachment 
                         $.each(data, function( index, value ) {
                            $(".preset-result").append(`<div class='col-sm-3 col-xl-3 col-4'><img src='/${value.url}'/></div>`)
                        });        

                  
                     }       
                     $("#pills-preset .inpage-loader").hide();                        
                     fetchingPreset = false;        
                }
            });
        }       

    }


    // Function to optimize lazy laod
    function selfLazyLoad()
    {
        if($(".lazy").length)    
        {
            $('.lazy').each(function(i, obj) {
                if(!$(obj).hasClass('loaded'))
                {
                    $(obj).addClass('loaded');
                    $(obj).attr('src',$(obj).data('src'));
                }
            });
        }
    }

    // Function to auto resize image box 
    function resizeImageBox()
    {
        // Auto adjust height 
        if($(".personal-img-box").length)    
            $('.personal-img-box').css({'height':$('.personal-img-box').width()+'px'});                
    }


})

