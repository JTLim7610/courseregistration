<script>

// Global variable
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
var toastCheck = false;

$(document).ready(function(){
 
    // Turn off autocomplete for all input 
    if($("input").length)
    {
        $('input').each(function(i, obj) {
            if(!$(obj).attr('autocomplete'))
                $(obj).attr('autocomplete',"off")
        });
    }

    // Backend  notification 
    @if(isset($errors))
        @if($errors->any())
            swal('', "{{$errors->all()[0]}}", 'warning')
        @elseif(Session::has('err'))
            swal('', "{{Session::get('err')}}", 'warning');
        @elseif(Session::has('info'))
            swal('', "{{Session::get('info')}}", 'info');
        @elseif($errors->has('email') || $errors->has('password'))
            swal('', 'Incorrect username or password', 'warning');
        @elseif($errors->has('captcha'))
            swal('', 'Incorrect Captcha', 'warning');
        @endif
    @endif
    @if(Session::has('success'))
        swal('', "{{Session::get('success')}}", 'success');
    @endif


    // Modal handling  - change to active tab 
    $('.modal').on('show.bs.modal', function (e) {                
        var active = $(this).find("[data-tab='active']");
        $(active).click();     
    })

    // Modal handling 
    $(document).on('click','.modal .nav-link',function(){
        modalHandling($(this).parentsUntil('.modal').parent());      
    })

    // Responsive table handling 
    if($(".table-responsive").length){
        const slider = document.querySelector('.table-responsive');
        let isDown = false;
        let startX;
        let scrollLeft;

        slider.addEventListener('mousedown', (e) => {
            isDown = true;
            slider.classList.add('active');
            startX = e.pageX - slider.offsetLeft;
            scrollLeft = slider.scrollLeft;
        });
        slider.addEventListener('mouseleave', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mouseup', () => {
            isDown = false;
            slider.classList.remove('active');
        });
        slider.addEventListener('mousemove', (e) => {
            if(!isDown) return;
            e.preventDefault();
            const x = e.pageX - slider.offsetLeft;
            const walk = (x - startX) * 3; //scroll-fast
            slider.scrollLeft = scrollLeft - walk;
        });
    }

    // Modal validation handling on submit
    $(document).on('click','.modal .submit-btn' ,function(e){     
        var $myForm = $(this).closest('form');
        if (!$myForm[0].checkValidity() && !$(this).hasClass('modal-next-btn')) {    
            swal('',"Please fill in all the required input field and make sure all input data are valid",'info');
            e.preventDefault();
            return false;
        }
    })

     
    // Checkbox auto detect function 
    $(document).on('change','.toggle-radio input[type="radio"]',function(){
        var target = $(this).data('target');                
        if($(this).val() == 1)
            $("."+target).slideDown();
        else 
            $("."+target).slideUp();
    })


    // Table mobile responsive handling     
    var m = $('th').length;
    $('td').each(function(i, obj) {
        var c =  $('th:eq('+(i%m)+")").text();
        $(obj).attr('data-column', c)
    });
    
    // Modal next tab &  validation handling 
    $(document).on('click','.modal-next-btn' ,function(e){  

        // Check next data validation 
        if(!modalValidation($('.modal.show')))
        {
            swal('','Please fill in all the required input field','info');
            return false;
        }

        var next = $('.modal.show').find('.nav-link.active').attr('data-next');
        $(next).click();
        e.preventDefault();
        e.stopPropagation();
        return false;
    })


    // Toast List 
    var toastList = [];      
    @if(Session::has('message') || isset($message))        
        @if(Session::has('message'))     
            @php($message = Session::get('message'))  
        @endif
        var avatar = "{{(isset($message['avatar']))?$message['avatar']:null}}";
        var title = "{{(isset($message['title']))?$message['title']:null}}";
        var description = "{{(isset($message['description']))?$message['description']:null}}";       
        toastList.push([title, description, avatar]);    
    @endif


    // Multiple toast handling 
    if (toastList && toastList.length > 0) {
        var duration = 0;
        $.each(toastList, function(index, content) {            
            if(!content[4]) content[4] = 3000;
            setTimeout(function(){
                toast(content[0],content[1],content[2],content[3],content[4],content[5],content[6],content[7]);                
            }, duration)
            duration+=content[4];
        });
    }
});


// Function to handle modal UX
function modalHandling(modal)
{

    var submitBtn = $(modal).find('.submit-btn');
    switch($(modal).find(".nav-link.active").attr('data-type'))
    {

        case "next" :  
            $(submitBtn).addClass('modal-next-btn');
            $(submitBtn).prop("type", "button");
            $(submitBtn).html('Next');
            break;
        case "submit" :
            $(submitBtn).removeClass('modal-next-btn');
            $(submitBtn).prop("type", "submit");
            $(submitBtn).html($(submitBtn).attr('data-text'));
            break;
    }
        
}

// Modal data validation 
function modalValidation(modal){
        
    // Data validaiton     
    var activeTab = $(modal).find('.tab-pane.active');
    let allAreFilled = true;
    $(activeTab)[0].querySelectorAll("[required]").forEach(function(i) {
        if (!allAreFilled) return;
        if (!i.value) allAreFilled = false;
        if (i.type === "radio") {
        let radioValueCheck = false;
        $(activeTab)[0].querySelectorAll(`[name=${i.name}]`).forEach(function(r) {
            if (r.checked) radioValueCheck = true;
        })
        allAreFilled = radioValueCheck;
        }
    })    
    if (!allAreFilled)        
        return false;
    return true;
        
}

// Confirm alert modal function 
function confirmationAlert(callback, text= 'Are you sure?', title=null) {
    swal({
        title:title,
        text: text,
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            callback(true);
            return true;
        }
        callback(false);
        return false;
    });
}


// Function to handle delay ajax 
function delay(callback, ms) {
    var timer = 0;
    return function() {
        var context = this,
            args = arguments;
        clearTimeout(timer);
        timer = setTimeout(function() {
            callback.apply(context, args);
        }, ms || 0);
    };
}


//Custom validation to check if is email 
function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
}


// Custom toast message popup
function toast(title = null, description = null, avatar =null, displayTime=500, displayDuration = 3000, type = null, currentValue = null, targetValue = null)
{
    toastCheck=true;
    var uid = new Date().valueOf()  + Math.floor(Math.random() * 10000); ;      
    var text = '<div>';
    if(title) text+=` <span class='title'>${title}</span>`;
    if(type=='progress') text+=`<div class='custom-progressbar' id='toastProgress'></div>`;
    if(type=='point') text+=`<div class='custom-point-count'><span class='counting' id='counting${uid}' data-current='${currentValue}'>${targetValue}</span> <img src='/img/icon/pt.png'/> </div>`;
    if(description) text+=description;
    if(!avatar) avatar = "/img/icon/info.png";
    text+='</div>'; 

    var myToast = Toastify({
        text:  text,     
        duration: displayDuration,
        avatar: avatar,
        position: 'right',      
    })
    setTimeout(() => {
        myToast.showToast();    
       
        if(type == 'point')
        {                          
            $("#counting"+uid).prop('Counter',$("#counting"+uid).data('current')).animate({
                Counter: $("#counting"+uid).text()
            }, {
                duration: displayDuration - 1000,                
                step: function (now) {
                    $("#counting"+uid).text(Math.ceil(now));
                }
            });            
        }      
        if(type == 'progress')
        {                          
            progressbar = new ProgressBar.Line(toastProgress,{
                strokeWidth: 4,
                easing: 'easeInOut',
                duration:  displayDuration - 1000,
                color: '#7678ed',
                trailColor: '#eee',
                trailWidth: 4,
                svgStyle: {
                    width: '100%',
                    height: '100%',
                },
                from: {
                    color: '#FFEA82'
                },
                to: {
                    color: '#ED6A5A'
                }
            });
            
            progressbar.animate(parseFloat(currentValue/targetValue));               
        }      
        
    }, displayTime);    
    
    setTimeout(function(){
        toastCheck
    }, displayDuration);
}

// //dropdown
//     const $dropdown = $(".dropdown");
//     const $dropdownToggle = $(".dropdown-toggle");
//     const $dropdownMenu = $(".dropdown-menu");
//     const showClass = "show";

//     $(window).on("load resize", function() {
//     if (this.matchMedia("(min-width: 768px)").matches) {
//         $dropdown.hover(
//         function() {
//             const $this = $(this);
//             $this.addClass(showClass);
//             $this.find($dropdownToggle).attr("aria-expanded", "true");
//             $this.find($dropdownMenu).addClass(showClass);
//         },
//         function() {
//             const $this = $(this);
//             $this.removeClass(showClass);
//             $this.find($dropdownToggle).attr("aria-expanded", "false");
//             $this.find($dropdownMenu).removeClass(showClass);
//         }
//         );
//     } else {
//         $dropdown.off("mouseenter mouseleave");
//     }
//     });

// //sticky navbar

//     window.onscroll = function() {myFunction()};

//     // Get the navbar
//     var navbar = document.getElementById("navbar");

//     // Get the offset position of the navbar
//     var sticky = navbar.offsetTop;

//     // Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
//     function myFunction() {
//     if (window.pageYOffset >= sticky) {
//         navbar.classList.add("sticky")
//     } else {
//         navbar.classList.remove("sticky");
//     }
//     }



</script>