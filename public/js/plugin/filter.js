/**
 * hover figure caption with mouse direction
 * Licensed under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 * 
 * Copyright 2016 MAAB
 * http://www.github.com/maab16/hover-figure-caption-with-mouse-direction
 */
 
;(function($,window,document,undefined){
    'use strict';

    var deafults = {

            containerWidth : $(".container").width(),
            containerHeight : 0,
            nOfRow : 0,
            nOfColumn : 0,
            aspectRatio : '1:1',
            containerMargin : '0px auto',
            itemWidth : 0,
            itemHeight : 0,
            itemDistance : 20,
            animationSpeed : 300,
            containerAnimationDelay : 100,
            allContainerAnimationSpeed : 500,
            easing                      : 'swing',
            margin : 0,
            responsive : [
                {
                    breakpoint : 1600,
                    containerWidth : $(".container").width(),     
                    settings : {
                        nOfRow : 4,
                        nOfColumn : 4
                    }
                },
                {
                    breakpoint : 1200,
                    containerWidth : $(".container").width(),     
                    settings : {
                        nOfRow : 4,
                        nOfColumn : 4
                    }
                },
                {
                    breakpoint : 992,    
                    containerWidth : $(".container").width(),                
                    settings : {
                        nOfRow : 3,
                        nOfColumn : 3
                    }
                },
                {
                    breakpoint : 768,       
                    containerWidth : $(".container").width(),             
                    settings : {
                        nOfRow : 3,
                        nOfColumn : 3
                    }
                },
                {
                    breakpoint : 650,       
                    containerWidth : $(".container").width(),             
                    settings : {
                        nOfRow : 2,
                        nOfColumn : 2
                    }
                }
            ]

    }

    function filterData(element,options){

        this.settings   = $.extend({},deafults,options);
        this.element    = $(element);
        this.win        = $(window).width();
        this.all        = this.element.find('>div');
        this.totalItems      = this.all.length;
        //this.containerWidth  = (this.settings.containerWidth == 0) ? this.element.width() : this.settings.containerWidth;
        //this.nOfColumn       = (this.settings.nOfColumn == 0) ? Math.round(this.containerWidth/this.all.width()) : this.settings.nOfColumn;
        //this.nOfRows         = (this.settings.nOfRow == 0) ? Math.ceil(this.totalItems/this.nOfColumn) : this.settings.nOfRow;
        var self = this;

    

        this.init();

    };

    filterData.prototype = {

        init : function(){
                var self = this;
                if (self.win >= 1200) {
                    self.setSettings(1200);
                }else if (self.win >= 992) {
                    self.setSettings(992);
                }else if (self.win >= 768) {
                    self.setSettings(768);
                }else if (self.win < 768) {
                    self.setSettings(650);
                }
                else if(self.win < 650)
                {
                    self.containerWidth-=30;
                }                
                self.nOfRows = Math.ceil(self.totalItems/self.nOfColumn)                 
                self.itemWidth       = (self.settings.itemWidth == 0) ? self.containerWidth/self.nOfColumn : self.settings.itemWidth;
                if(self.win  >= 992)
                    self.itemHeight       = self.getHeightFromRatio()+20;   
                else if(self.win  >= 768)    
                    self.itemHeight       = self.getHeightFromRatio()+100;   
                else 
                    self.itemHeight       = self.getHeightFromRatio()+100;   
                self.containerHeight = self.nOfRows*(self.itemHeight + 120);
                self.top = 0,
                self.j=0,
                self.k=0;
                //Style Container
                self.element.css({
                    width : self.containerWidth,
                    height : self.containerHeight,
                    position : 'relative',
                    overflow : 'hidden',
                    margin : '0px auto'
                });
                //Style Each Item
                self.all.each(function(i,item){
                    if (self.j*self.itemWidth >= self.element.width()) {
                        self.j = 0;
                        self.k++;
                    }
                    $(this).css({
                        width : self.itemWidth,
                        height : self.itemHeight,
                        position : 'absolute',
                        left : (self.j*self.itemWidth),
                        top  : self.k*self.itemHeight,
                        paddingTop : self.settings.itemDistance,                        
                    });
                    self.j++;
                });
                // Style Figure
                self.all.find('figure').css({
                    width : '100%',
                    height : '100%'
                });
                //Style Images
                self.all.find('img').css({
                    width : '100%',
                    height : '100%'
                });
                $('a[href^="#"] , button').on('click', function(event) {                    
                    self.$item = $(this).data('filter');
                    if (undefined !== self.$item) {
                        $(this).addClass('active-filter');
                        self.items = self.element.find('div'+self.$item);
                        self.totalItems = self.items.length;
                        self.m=0;
                        self.n=0;
                    }          
                    if ($(this).hasClass('active-filter')) {
                        self.controllDisplay();
                    }
                });
        },
        controllDisplay : function(){
            switch(this.$item){
                case 'all':
                    this.displayAll();
                    break;
                default :
                    this.displaySingleCategory();
                    break;
            }
        },
        setScreen : function(){
        
            var self = this;
            if (self.win >= 1200) {
                self.setSettings(1200);
            }else if (self.win >= 992) {
                self.setSettings(992);
            }else if (self.win >= 768) {
                self.setSettings(768);
            }else if (self.win < 768) {
                self.setSettings(650);
            }
            //console.log('win : '+self.win);
            //console.log('container : '+self.containerWidth);
            //console.log('container : '+self.nOfColumn);
            self.settings.animationSpeed = 0;
            self.settings.containerAnimationDelay = 0;
            self.settings.allContainerAnimationSpeed = 0;
            self.nOfRows = Math.ceil(self.totalItems/self.nOfColumn)    
            self.itemWidth       = (self.settings.itemWidth == 0) ? self.containerWidth/self.nOfColumn : self.settings.itemWidth;
            self.itemHeight         = self.getHeightFromRatio();
            self.top = 0,
            self.j=0,
            self.k=0;
            self.containerHeight = self.nOfRows*(self.itemHeight + 120);
            
            //Style Container
            self.element.css({
                width : self.containerWidth,
                height : self.containerHeight,
                position : 'relative',
                overflow : 'hidden',
                // margin : self.settings.margin
            });

            self.button = $('body').find('button');
            self.button.each(function(){
                self.$item = $(this).data('filter');
                if ($(this).hasClass('active-work')) {
                    self.items = self.element.find('div'+self.$item);
                    self.totalItems = self.items.length;
                    self.m=0;
                    self.n=0;
                    self.controllDisplay();
                }
                
            });   
        },
        setSettings : function(breakpoint){
            var self = this;
            $.each(self.settings.responsive,function(index,responsive){
                if (responsive.breakpoint == breakpoint){
                    self.nOfColumn  = responsive.settings.nOfColumn;
                    self.nOfRows = responsive.settings.nOfRow;
                    self.containerWidth = responsive.containerWidth;
                }
            });
         
        },
        getRgba : function(hex,alpha=1) {
            var r,g,b,a=alpha,
                //match = hex.match(/^#?(([0-9a-zA-Z]{3}){1,3})$/),
                match = hex.match(/^#([0-9a-f]{3}|[0-9a-f]{6})$/i),
                hex = (match !== null) ? match[1] : '000';
                //console.log(hex);

            if (hex.length == 6) {
                r = parseInt(hex.substring(0, 2), 16);
                g = parseInt(hex.substring(2, 4), 16);
                b = parseInt(hex.substring(4, 6), 16);
            }else if (hex.length == 3) {
                r = parseInt(hex.substring(0, 1) + hex.substring(0, 1), 16);
                g = parseInt(hex.substring(1, 2) + hex.substring(1, 2), 16);
                b = parseInt(hex.substring(2, 3) + hex.substring(2, 3), 16);
            }
            return r+','+g+','+b+','+a;
        },
        getHeightFromRatio : function(){
            this.ratio = this.settings.aspectRatio.split(':');
            return Math.ceil((this.itemWidth*this.ratio[1])/this.ratio[0]);
        },
        displayAll : function(){
            var self = this;
            // Display all
            self.all.css({
                display : 'block',
                opacity : 1,
                transform : 'scale(1)',
                transition : 'all 0.5s ease'
            });
            // Animate all
            self.all.each(function(i,item){
                if (self.m*self.itemWidth >= self.element.width()) {
                    self.m = 0;
                    self.n++;
                }
                $(this).css({
                    display : 'block',
                    opacity : 1,
                    width : self.itemWidth,
                    height : self.itemHeight,
                    position : 'absolute',
                }).animate({
                    left : (self.m*self.itemWidth),
                    top  : self.n*self.itemHeight
                },
                self.settings.animationSpeed,
                self.settings.easing);
                self.m++;
            });
            self.element
            .delay(self.settings.containerAnimationDelay)
            .animate({
                height : self.containerHeight
            },self.settings.allContainerAnimationSpeed);
        },
        displaySingleCategory : function(){
            var self = this,
                Rows = Math.ceil(self.totalItems/self.nOfColumn),
                containerHeight;
                if (Rows <= self.nOfRows) {
                    containerHeight = (self.itemHeight + 120 )*Rows;
                }else{
                    containerHeight =  (self.itemHeight + 120 )*self.nOfRows;
                }
            if (self.$item != undefined) {
                // Hide all if not match current items
                self.all.each(function(i,item){
                    if (!self.matchCurrent(item)) {
                        $(this).css({
                            display : 'block',
                            opacity : 0,
                            transform : 'scale(0)',
                            transition : 'all 0.5s ease'
                        });
                    }
                });
                // Show all element if matches current items
                self.items.css({
                        display : 'block',
                        opacity : 1,
                        transform : 'scale(1)',
                        transition : 'all 0.5s ease',
                    });
                // Animate all items
                $(self.items).each(function(i,item){
                    if (self.m*self.itemWidth >= self.element.width()) {
                        self.m = 0;
                        self.n++;
                    }
                    $(item).css({
                        display : 'block',
                        opacity : 1,
                        width : self.itemWidth,
                        height : self.itemHeight,
                        position : 'absolute',
                    });
                    $(this).animate({
                        left : self.m*self.itemWidth,
                        top  : self.n*self.itemHeight
                    },
                    self.settings.animationSpeed,
                    self.settings.easing);
                    self.m++;
                });
                self.element.delay(self.settings.containerAnimationDelay)
                .animate({
                    height : containerHeight
                },self.settings.allContainerAnimationSpeed);
            }
        },
        matchCurrent : function(current){
            var currentItems = $.map(self.items, function(value, index) {
                    return [value];
                });
            for (var i = 0; i < currentItems.length; i++) {
                if (current === currentItems[i]) {
                    return true;
                }
            }
            return false;
        }
    };

    $.fn.filterData = function(options){

        return this.each(function(){

            if (!$.data(this,'filterData')) {

                $.data(this,'filterData',new filterData(this,options));
            }
        });
    };


})(jQuery,window,document);