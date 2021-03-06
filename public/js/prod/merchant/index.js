/*! WOW wow.js - v1.3.0 - 2016-10-04
* https://wowjs.uk
* Copyright (c) 2016 Thomas Grainger; Licensed MIT */!function(a,b){if("function"==typeof define&&define.amd)define(["module","exports"],b);else if("undefined"!=typeof exports)b(module,exports);else{var c={exports:{}};b(c,c.exports),a.WOW=c.exports}}(this,function(a,b){"use strict";function c(a,b){if(!(a instanceof b))throw new TypeError("Cannot call a class as a function")}function d(a,b){return b.indexOf(a)>=0}function e(a,b){for(var c in b)if(null==a[c]){var d=b[c];a[c]=d}return a}function f(a){return/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(a)}function g(a){var b=arguments.length<=1||void 0===arguments[1]?!1:arguments[1],c=arguments.length<=2||void 0===arguments[2]?!1:arguments[2],d=arguments.length<=3||void 0===arguments[3]?null:arguments[3],e=void 0;return null!=document.createEvent?(e=document.createEvent("CustomEvent"),e.initCustomEvent(a,b,c,d)):null!=document.createEventObject?(e=document.createEventObject(),e.eventType=a):e.eventName=a,e}function h(a,b){null!=a.dispatchEvent?a.dispatchEvent(b):b in(null!=a)?a[b]():"on"+b in(null!=a)&&a["on"+b]()}function i(a,b,c){null!=a.addEventListener?a.addEventListener(b,c,!1):null!=a.attachEvent?a.attachEvent("on"+b,c):a[b]=c}function j(a,b,c){null!=a.removeEventListener?a.removeEventListener(b,c,!1):null!=a.detachEvent?a.detachEvent("on"+b,c):delete a[b]}function k(){return"innerHeight"in window?window.innerHeight:document.documentElement.clientHeight}Object.defineProperty(b,"__esModule",{value:!0});var l,m,n=function(){function a(a,b){for(var c=0;c<b.length;c++){var d=b[c];d.enumerable=d.enumerable||!1,d.configurable=!0,"value"in d&&(d.writable=!0),Object.defineProperty(a,d.key,d)}}return function(b,c,d){return c&&a(b.prototype,c),d&&a(b,d),b}}(),o=window.WeakMap||window.MozWeakMap||function(){function a(){c(this,a),this.keys=[],this.values=[]}return n(a,[{key:"get",value:function(a){for(var b=0;b<this.keys.length;b++){var c=this.keys[b];if(c===a)return this.values[b]}}},{key:"set",value:function(a,b){for(var c=0;c<this.keys.length;c++){var d=this.keys[c];if(d===a)return this.values[c]=b,this}return this.keys.push(a),this.values.push(b),this}}]),a}(),p=window.MutationObserver||window.WebkitMutationObserver||window.MozMutationObserver||(m=l=function(){function a(){c(this,a),"undefined"!=typeof console&&null!==console&&(console.warn("MutationObserver is not supported by your browser."),console.warn("WOW.js cannot detect dom mutations, please call .sync() after loading new content."))}return n(a,[{key:"observe",value:function(){}}]),a}(),l.notSupported=!0,m),q=window.getComputedStyle||function(a){var b=/(\-([a-z]){1})/g;return{getPropertyValue:function(c){"float"===c&&(c="styleFloat"),b.test(c)&&c.replace(b,function(a,b){return b.toUpperCase()});var d=a.currentStyle;return(null!=d?d[c]:void 0)||null}}},r=function(){function a(){var b=arguments.length<=0||void 0===arguments[0]?{}:arguments[0];c(this,a),this.defaults={boxClass:"wow",animateClass:"animated",offset:0,mobile:!0,live:!0,callback:null,scrollContainer:null,resetAnimation:!0},this.animate=function(){return"requestAnimationFrame"in window?function(a){return window.requestAnimationFrame(a)}:function(a){return a()}}(),this.vendors=["moz","webkit"],this.start=this.start.bind(this),this.resetAnimation=this.resetAnimation.bind(this),this.scrollHandler=this.scrollHandler.bind(this),this.scrollCallback=this.scrollCallback.bind(this),this.scrolled=!0,this.config=e(b,this.defaults),null!=b.scrollContainer&&(this.config.scrollContainer=document.querySelector(b.scrollContainer)),this.animationNameCache=new o,this.wowEvent=g(this.config.boxClass)}return n(a,[{key:"init",value:function(){this.element=window.document.documentElement,d(document.readyState,["interactive","complete"])?this.start():i(document,"DOMContentLoaded",this.start),this.finished=[]}},{key:"start",value:function(){var a=this;if(this.stopped=!1,this.boxes=[].slice.call(this.element.querySelectorAll("."+this.config.boxClass)),this.all=this.boxes.slice(0),this.boxes.length)if(this.disabled())this.resetStyle();else for(var b=0;b<this.boxes.length;b++){var c=this.boxes[b];this.applyStyle(c,!0)}if(this.disabled()||(i(this.config.scrollContainer||window,"scroll",this.scrollHandler),i(window,"resize",this.scrollHandler),this.interval=setInterval(this.scrollCallback,50)),this.config.live){var d=new p(function(b){for(var c=0;c<b.length;c++)for(var d=b[c],e=0;e<d.addedNodes.length;e++){var f=d.addedNodes[e];a.doSync(f)}});d.observe(document.body,{childList:!0,subtree:!0})}}},{key:"stop",value:function(){this.stopped=!0,j(this.config.scrollContainer||window,"scroll",this.scrollHandler),j(window,"resize",this.scrollHandler),null!=this.interval&&clearInterval(this.interval)}},{key:"sync",value:function(){p.notSupported&&this.doSync(this.element)}},{key:"doSync",value:function(a){if("undefined"!=typeof a&&null!==a||(a=this.element),1===a.nodeType){a=a.parentNode||a;for(var b=a.querySelectorAll("."+this.config.boxClass),c=0;c<b.length;c++){var e=b[c];d(e,this.all)||(this.boxes.push(e),this.all.push(e),this.stopped||this.disabled()?this.resetStyle():this.applyStyle(e,!0),this.scrolled=!0)}}}},{key:"show",value:function(a){return this.applyStyle(a),a.className=a.className+" "+this.config.animateClass,null!=this.config.callback&&this.config.callback(a),h(a,this.wowEvent),this.config.resetAnimation&&(i(a,"animationend",this.resetAnimation),i(a,"oanimationend",this.resetAnimation),i(a,"webkitAnimationEnd",this.resetAnimation),i(a,"MSAnimationEnd",this.resetAnimation)),a}},{key:"applyStyle",value:function(a,b){var c=this,d=a.getAttribute("data-wow-duration"),e=a.getAttribute("data-wow-delay"),f=a.getAttribute("data-wow-iteration");return this.animate(function(){return c.customStyle(a,b,d,e,f)})}},{key:"resetStyle",value:function(){for(var a=0;a<this.boxes.length;a++){var b=this.boxes[a];b.style.visibility="visible"}}},{key:"resetAnimation",value:function(a){if(a.type.toLowerCase().indexOf("animationend")>=0){var b=a.target||a.srcElement;b.className=b.className.replace(this.config.animateClass,"").trim()}}},{key:"customStyle",value:function(a,b,c,d,e){return b&&this.cacheAnimationName(a),a.style.visibility=b?"hidden":"visible",c&&this.vendorSet(a.style,{animationDuration:c}),d&&this.vendorSet(a.style,{animationDelay:d}),e&&this.vendorSet(a.style,{animationIterationCount:e}),this.vendorSet(a.style,{animationName:b?"none":this.cachedAnimationName(a)}),a}},{key:"vendorSet",value:function(a,b){for(var c in b)if(b.hasOwnProperty(c)){var d=b[c];a[""+c]=d;for(var e=0;e<this.vendors.length;e++){var f=this.vendors[e];a[""+f+c.charAt(0).toUpperCase()+c.substr(1)]=d}}}},{key:"vendorCSS",value:function(a,b){for(var c=q(a),d=c.getPropertyCSSValue(b),e=0;e<this.vendors.length;e++){var f=this.vendors[e];d=d||c.getPropertyCSSValue("-"+f+"-"+b)}return d}},{key:"animationName",value:function(a){var b=void 0;try{b=this.vendorCSS(a,"animation-name").cssText}catch(c){b=q(a).getPropertyValue("animation-name")}return"none"===b?"":b}},{key:"cacheAnimationName",value:function(a){return this.animationNameCache.set(a,this.animationName(a))}},{key:"cachedAnimationName",value:function(a){return this.animationNameCache.get(a)}},{key:"scrollHandler",value:function(){this.scrolled=!0}},{key:"scrollCallback",value:function(){if(this.scrolled){this.scrolled=!1;for(var a=[],b=0;b<this.boxes.length;b++){var c=this.boxes[b];if(c){if(this.isVisible(c)){this.show(c);continue}a.push(c)}}this.boxes=a,this.boxes.length||this.config.live||this.stop()}}},{key:"offsetTop",value:function(a){for(;void 0===a.offsetTop;)a=a.parentNode;for(var b=a.offsetTop;a.offsetParent;)a=a.offsetParent,b+=a.offsetTop;return b}},{key:"isVisible",value:function(a){var b=a.getAttribute("data-wow-offset")||this.config.offset,c=this.config.scrollContainer&&this.config.scrollContainer.scrollTop||window.pageYOffset,d=c+Math.min(this.element.clientHeight,k())-b,e=this.offsetTop(a),f=e+a.clientHeight;return d>=e&&f>=c}},{key:"disabled",value:function(){return!this.config.mobile&&f(navigator.userAgent)}}]),a}();b["default"]=r,a.exports=b["default"]});
(function ($) {

	"use strict";

	var fullHeight = function () {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function () {
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
		$('#sidebar').toggleClass('active');
		if(!$("#sidebar").hasClass('active'))
			$('#sidebar').removeClass('expand');
		else 
			$("#sidebar").addClass('expand');
	});



	//On hover menu bar 
	$(document).on('mouseover', '#sidebar', function () {
		$(this).addClass('expand');
		$("#content").addClass('expand');

	})
	$(document).on('mouseout', '#sidebar', function () {
		$(this).removeClass('expand');
		$("#content").removeClass('expand');
	})

	//On hover menu icon 
	$(document).on('mouseover', '.menu-icon', function () {
        $(this).delay(200).queue(function(){
            var help = $(this).find('.help-icon');
            $(".guideline-img").attr('src',$(help).attr('help-img'));
            $(".guideline-title").html($(help).attr('help-title'));
            $(".guideline-desc").html($(help).attr('help-desc'));
            
            if(help.attr('help-title'))
            {
                setTimeout(function(){
                    $(".guideline-panel").addClass("active"); 
                },200);
            }             
        });

	})
	$(document).on('mouseout', '.menu-icon', function () {
	
        if($(".guideline-panel").hasClass('active'))
            $(".guideline-panel").removeClass("active");
        else 
        {
            $(this).finish();
            setTimeout(function(){
                $(".guideline-panel").removeClass("active");
            },300);
        }
	})

    
})(jQuery);



$(document).ready(function() {

    //Nicescroll 
    $("#main-menu").niceScroll({
        cursorwidth: '0px',
        cursorborder: 'none',
        cursorborderradius:'0px',        
    });


});

// Function to get lazy load setting 
function getLazySetting()
{
    return {
        afterLoad: function(element) {            
            $(element).addClass('loaded') ;
        },
    };
}

//Function to show loader
function showLoader() {
    $(".page-loader").fadeIn(300);
}


//Function to hide Loader
function hideLoader() {
    $(".page-loader").fadeOut();
}


//Hide loader for IOS device
window.addEventListener("pageshow", function() {
    setTimeout(function(){
        hideLoader();
    },500)
}, false);

(function () {
	window.onpageshow = function(event) {
		if (event.persisted) {
			window.location.reload();
		}
	};
})();


//Page loader   
//window.onload=function() { hideLoader(); }

$(document).ready(function() {

    // Check if is in iframe
    inIframe();

    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');  
    hideLoader();
    setTimeout(function(){hideLoader();},1000);
    
    //Onsubmit form - auto show loader 
    $("form").submit(function() {
        if(!$(this).hasClass('hide-form'))
            showLoader();
    });

    //If hide-form class is added will not show loader onsumbit 
    $(".hide-form").submit(function() {
        hideLoader();
    });

    //localization
    $(".language-select").change(function() {
        showLoader();
        $.ajax({
            url: '/en/language/change',
            type: 'POST',
            data: {
                _token: CSRF_TOKEN,
                language: $(this).val()
            },
            dataType: 'JSON',
            success: function(data) {
                location.href = $(this).val();
            }
        });     
    });
    
    //loader button
    $(document).on("click", "a", function () {
        if($(this).attr('href') != null  &&  !$(this).attr('href').includes("#"))
        {
            showLoader();
            window.location.href = $(this).attr('href');
        }
    });
    $(document).on('click','.no-loader, a[target="_blank"]',function(){
        setTimeout(function(){
            hideLoader();
        },200)
    })

    //localization
    $(".language-select").change(function() {
        showLoader();
        location.href = $(this).val();
    });
    

    //WOW animation
    new WOW().init();

    //Lazy loader     
    if($('.lazy').length)
        $('.lazy').lazy(getLazySetting());

    
    // Form button : change modal title, button name and clear form input 
    $(document).on('click','.global-form-btn',function(){
        
        // Check if got target modal 
        if(target = $(this).data('target'))
        {
            // Check if got change modal title 
            if(title = $(this).data('title'))
                $(target + " .modal-title").html(title);

            // Check if got change modal content 
            if(content = $(this).data('content'))
                $(target + " #actionContent").html(content);
            else 
                $(target + " #actionContent").html($("#defaultActionText").val());

            // Check if got change modal action             
            if(submitTitle = $(this).data('submit-title'))
                $(target + " .submit-btn").html(submitTitle);

            // Check if got modal submit acction text     - to improve modal UX   
            if(submitTitle = $(this).data('submit-text'))
                $(target + " .submit-btn").attr('data-text',submitTitle);

            // Check if got clear form 
            if($(this).data('clear'))
            {
                $(target + " .modal-body input:not([type=button]):not([type=submit]):not([type=radio]):not([type=checkbox])").val('');        
                $(target + " .modal-body select").val('').change();        
                $(target + " .clear-section").val('');        
                $(target + " .clear-section").html('');        
                $(target + " .hide-section").hide();  
                
                // If got uploader 
                if(key = $(this).data('uploader'))
                {
                    $("#"+key+"-hide").show();
                    $("#" + key + "-image-response").attr('src', '');            
                    $("#" + key + "-image-name").html('');            
                }
            }

            // Check if got action route 
            if(actionRoute = $(this).data('action-route'))
            {                
                $(target + " #actionForm").attr('action',actionRoute);

                // Check if got action remark                      
                if($(this).data('remark') === true)
                    $(target + " .remark-section").show();
                else 
                    $(target + " .remark-section").hide();

            }                            

            // Check if got mode 
            editor = $(this).data('editor');
            if(mode = $(this).data('mode'))
            {
                
                switch(mode) {
                    case 'view':
                        $(target).attr('data-mode','view');
                        $(target + " .edit-show, "+target + " .create-show").hide();        
                        $(target + " .view-show").show();  
                        $(target + "  input").prop('disabled',true);     
                        $(target + "  select").prop('disabled',true);    
                        $(target + " input[type='checkbox']").prop('checked',false);
                        $(target + "  p.required").addClass('no-required');    
                        if(editor)            
                        {
                            tinymce.get(editor).mode.set("readonly");
                            $("#"+ editor).siblings('.tox-tinymce').addClass('readonly');
                        }                
                        break;
                    case 'create':
                        $(target).attr('data-mode','create');
                        $(target + " .edit-show, "+target + " .view-show").hide();        
                        $(target + " .create-show").show();     
                        $(target + "  input").prop('disabled',false);     
                        $(target + "  select").prop('disabled',false);     
                        $(target + " input[type='checkbox']").prop('checked',false);  
                        $(target + "  p.required").removeClass('no-required');     
                        if(editor)
                        {
                            tinymce.get(editor).mode.set("design");
                            $("#"+ editor).siblings('.tox-tinymce').removeClass('readonly');
                            tinyMCE.get(editor).setContent('');
                        }                            
                        break;
                   
                    case 'edit':
                        $(target).attr('data-mode','edit');
                        $(target + " .create-show, "+target + " .view-show").hide();        
                        $(target + " .edit-show").show(); 
                        $(target + "  input").prop('disabled',false);     
                        $(target + "  input.disabled").prop('disabled',true);     
                        $(target + "  select").prop('disabled',false);     
                        $(target + " input[type='checkbox']").prop('checked',false);
                        $(target + "  p.required").removeClass('no-required');     
                        if(editor)              
                        {
                            tinymce.get(editor).mode.set("design");
                            $("#"+ editor).siblings('.tox-tinymce').removeClass('readonly');
                            tinyMCE.get(editor).setContent('');
                        }                                      
                        break;
                   
                }
            }

            // Check if got ajax grab data 
            routeCallback = $(this).data('route-callback');
            uploaderKey = $(this).data('uploader')
            if(route = $(this).data('route'))
            {
                
                showLoader();
                $.ajax({
                    type: 'GET', 
                    url: '/' + window.location.pathname.split( '/' )[1] + route,
                    success: function (data) {        

                        //Insert data to all input 
                        $.each(data, function( index, value ) {
                            $(target + " input[name='"+index+"']:not([type=radio])").val(value);                    
                            $(target + " textarea[name='"+index+"']").html(value);                    
                            $(target + " select[name='"+index+"']").val(value).change();                    
                        });

                        if(editor && data.content)
                            tinyMCE.get(editor).setContent(data.content);
                      
                        // CHeck if got custom route callback function 
                        if(routeCallback){                            
                            if(mode == 'view')
                            {
                                $(target + "  input").prop('disabled',false);     
                                $(target + "  textarea").prop('disabled',false);     
                                $(target + "  select").prop('disabled',false);    
                                window[routeCallback](data, target);           
                                $(target + "  textarea").prop('disabled',true);     
                                $(target + "  input").prop('disabled',true);     
                                $(target + "  select").prop('disabled',true);                    
                            }
                            else 
                                window[routeCallback](data, target);                           
                        }      
                       
                        // Check if got uploader
                        if(uploaderKey )
                        {                                     
                            $("#"+uploaderKey+"-hide").hide();
                            $("#" + uploaderKey + "-image-response").attr('src', (data.attachment_image)?data.attachment_image:data.attachment);                                  
                            $("#" + uploaderKey + "-image-name").html(data.attachment);                                  
                        }
                
                        hideLoader();
                    }
                });
            }
                   
            //Check if got custom function 
            if(f = $(this).data('function'))        
                window[f](target);                    
        }

    })



    //Action button  : pass value to specific target id based on attribute ( put below is becuase need to clear data first only insert data )
    $(document).on("click", ".action-btn", function () {
        var target = $(this).attr("target-id").split('||');
        var targetVal = $(this).attr('value').split('||');
        $.each(target, function( index, value ) {
            $("#" + value).val(targetVal[index]);
        });
    });


    // Custom-toggle
    if($('.custom-toggle').length)
    {
        $('.custom-toggle').each(function(i, obj) {
            checkToggle(obj);
        });
        $(document).on('change','.custom-toggle',function(){
            checkToggle(this);
        });
    }
    function checkToggle(obj)
    {        
        if($(obj).is(":checked"))
            $(obj).parent().find('.checkbox-input-hidden').slideDown().find('input').prop('required',true);
        else 
            $(obj).parent().find('.checkbox-input-hidden').slideUp().find('input').prop('required',false);

        if($(obj).data('not-required'))
            $(obj).parent().find('input').prop('required',false);
    }


    // Check if is in iframe
    function inIframe () {
        try {
            if(window.self !== window.top)        
                $("html").addClass('embed');                       
        } 
        catch (e) {
            return true;
        }
    }


});

