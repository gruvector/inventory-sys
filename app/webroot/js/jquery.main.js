
var url =  window.location.protocol + "//" + window.location.host + "/";
var appRoot = "/";

//if( window.location.host == "localhost" || window.location.host.indexOf(".com") != -1 ) {
    var href = window.location.href;
    href = href.substring( href.indexOf(url) + url.length );
    appRoot = "/" + href.split("/")[0] + "/";
//}

$(function(){
//	clearFormFields({
//		clearInputs: true,
//		clearTextareas: true,
//		passwordFieldText: true,
//		addClassFocus: "focus",
//		filterClass: "default"
//	});

    /**
     * Create binding listeners to simulate toggle button states for the main
     * Member Layout navigation menu
     */
    $(".menu-nav li").click(function(e) {
        var type = this;
        $(this).addClass("active");

        $(".menu-nav li").each(function() {
            if( this != type ) {
                $(this).removeClass("active");
            }
        });
    });

    /**
     * Add binding code for the User Login Status Indicator
     */
    $(".author").click(function(e){
        $(this).toggleClass("click");
        e.stopPropagation();
    });

    $(".author .drop li").click(function(e){
        $(".author").removeClass('click');
        e.stopPropagation();
    });
    
    /**
     * Add global AJAX configuration to show progress indication when any AJAX call
     * is triggered
     */
    $("#ajax-progress").ajaxStart(function() {
        $(this).css("display","block");
    }).ajaxStop(function() {
        $(this).css("display","none");
    });

    /**
     * Functionality to add the "active state for all Main Menu buttons. Some
     * of the initial designs have the active state, so we are removing them
     * in general before adding the functionality.
     **/
    $("#main .boxes .btn").removeClass("active").click(function() {
        $(this).addClass("active");
        var btn = this;
        $("#main .boxes .btn").each(function() {
            if(this != btn) {
                $(this).removeClass("active");
            }
        });
    });

    /**
     * Adding support for click indication for the System Popup Menu (overlay)
     **/
    $("#popup-system-menu .options li").click(function() {
        $("#popup-system-menu .options li").removeClass("active");
        $(this).addClass("active");
    });

    // original code follows
	//setTimeout( function() {
            $('select').customSelect();
    //}, 1000);
        
	$('input[type=checkbox]').customCheckbox();
	$('input[type=radio]').customRadio();
	$('div.slide-menu').gallery({
		duration: 700,
		listOfSlides: 'li',
		nextBtn: 'a.down',
		prevBtn: 'a.up',
		direction: true
	});
	$('div.slideui-menu').gallery({
		duration: 700,
		listOfSlides: 'li',
		nextBtn: 'a.down',
		prevBtn: 'a.up',
		direction: true
	});
	$('div.record-gallery').gallery({
		duration: 700,
		listOfSlides: 'li',
		nextBtn: 'a.down',
		prevBtn: 'a.up',
		direction: true
	});
	$('.popup-opener').simplebox();
	initTooltip();
	printCheck();
	initTooltip2('.popup-table tr',true);
	$("#date2,#record-date,#due-date, .date_field").datepicker({
        yearRange: "-100:+10",
		showOn: "button",
		buttonImage: appRoot +  "img/ico-12.png",
		buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        minDate: new Date(1920, 1, 1),
        dateFormat: "yy-mm-dd"
	});
	$("#date4").datepicker({
		numberOfMonths: 2,
		showButtonPanel: true,
		showOn: "button",
		buttonImage: appRoot + "img/ico-12.png",
		buttonImageOnly: true,
        dateFormat: "yy-mm-dd"
	});
	inittabs('.tabs');
	inittabs('.tabs-print',true);
	initDescription();
	initComment();
	initListArea();
	initSearchResults();
	
//	initAdvanced();
});

//function initModules(){
//    var holder = $('.modules');
//    var activeClass = 'active';
//    var inactiveClass = 'inactive';
//    holder.each(function(e){
//        var els = $(this).find('li').not('.' + inactiveClass);
//        els.click(function(){
//            if ($(this).hasClass(activeClass)) $(this).removeClass(activeClass);
//            else $(this).addClass(activeClass);
//            return false;
//        });
//    });
//}
function inittabs(_holder,_add) {
    var _tabset = $(_holder);
    _tabset.each(function(){
        var _tabsetEl = $(this).find('.tabset a.tab');
        hideTabs();
        _tabsetEl.each(function(e){
            if ($(this).parents('li').hasClass('active'))
                $($(this).attr('href')).show();
            $(this).click(function(){
                if (!$(this).parents('li').hasClass('active')) {
                    hideTabs(e);
                    _tabsetEl.parents('li').removeClass('active');
                    $(this).parents('li').addClass('active');
                    $($(this).attr('href')).show();
                }
                return false;
            });
        });

        function hideTabs(_e) {
            _tabsetEl.each(function(e){
                if (_add && _e) {
                    if (e > _e) $($(this).attr('href')).hide();
                } else {
                    $($(this).attr('href')).hide();
                }
            });
        }
    });
}
function initSearchResults(){
    var popup = $('.search-popup');
    var addClass = 'search-active';
    popup.each(function(){
        var btn = popup.find('.search-submit');
        btn.click(function(){
            if (!popup.hasClass(addClass)) popup.addClass(addClass)
            return false;
        });
    });
}
function initListArea(){
    var listArea = $('.list-area');
    listArea.each(function(){
        var _this = $(this);
        var mainList = _this.find('.main-list');
        var secondaryList = _this.find('.secondary-list');
        var mainListEls = mainList.find('li');
        var btnRight = _this.find('.btn-right');
        var btnLeft = _this.find('.btn-left');
        mainListEls.click(function(){
            if ($(this).hasClass('active')) $(this).removeClass('active');
            else $(this).addClass('active');
            return false;
        });
        btnRight.click(function(){
            var list = mainList.find('li').filter('.active');
            secondaryList.append(list);
            return false;
        });
        btnLeft.click(function(){
            var list = secondaryList.find('li').filter('.active');
            mainList.append(list);
            return false;
        });
    });
}
function initComment(){
    var holder = $('.add-comment');
    var addClass = 'active';
    holder.each(function(){
        var _this = $(this);
        var submit = _this.find('.submit');
        submit.each(function(){
            if (!_this.hasClass(addClass)) {
                _this.addClass(addClass);
                $(this).attr('value','Save Comments');
            } else {
                _this.removeClass(addClass);
                $(this).attr('value','Add Comments');
            }
            $(this).click(function(){
                if (!_this.hasClass(addClass)) {
                    _this.addClass(addClass);
                    $(this).attr('value','Save Comments');
                } else {
                    _this.removeClass(addClass);
                    $(this).attr('value','Add Comments');
                }
                return false;
            });
        });
    });
}
function initDescription(){
    var holder = $('.description-popup');
    var addClass = 'active';
    holder.each(function(){
        var _this = $(this);
        var fields = _this.find('textarea,input');
        fields.focus(function(){
            if (!_this.hasClass(addClass)) _this.addClass(addClass);
        }).blur(function(){
            if (_this.hasClass(addClass)) _this.removeClass(addClass);
        });
    });

}
function initTooltip(){
    var el = $('.tooltip');
    var closeEl = '.close';
    var closer = $('.tabs-print a.tab,.tabs a.tab');
    el.each(function(){
        var _this = $(this);
        var close = _this.find(closeEl);
        close.click(function(){
            _this.hide();
            return false;
        });
    });
    closer.click(function(){
        el.hide();
    });
}
function initTooltip2(_el,_list){
    var el = $(_el);
    var addClass = 'hover';
    var closeEl = '.close';
    el.each(function(){
        var _this = $(this);
        var close = _this.find(closeEl);
        _this.click(function(){
            if (_list) el.not(_this).removeClass(addClass);
            if (!_this.hasClass(addClass)) _this.addClass(addClass);
            else _this.removeClass(addClass);
        });
        close.click(function(){
            $(this).parents(_this).removeClass(addClass);
            return false;
        });
    });
}
function printCheck(){
    var links = $('a.print-opener');
    links.click(function(){
        $('html').removeAttr('class').addClass($(this).attr('rel'))
        window.print();
        return false;
    });
}
function addClass(_el, _class){
    $(_el).click(function(){
        $(this).toggleClass(_class);
        return false;
    })
}

/*------------------------ CUSTOM SELECT'S -----------------------------*/
jQuery.fn.customSelect = function(_options2) {
    var _options = jQuery.extend({
        selectStructure: '<div class="selectArea"><div class="left"></div><div class="center"></div><a href="#" class="selectButton">&nbsp;</a><div class="disabled"></div></div>',
        selectText: '.center',
        selectBtn: '.selectButton',
        selectDisabled: '.disabled',
        optStructure: '<div class="optionsDivVisible"><ul></ul></div>',
        optList: 'ul'
    }, _options2);
    return this.each(function() {
        var select = jQuery(this);
        if(!select.hasClass('outtaHere')) {
            if(select.is(':visible')) {
                var replaced = jQuery(_options.selectStructure);
                var selectClass = select.attr('class');
                var selectText = replaced.find(_options.selectText);
                var selectBtn = replaced.find(_options.selectBtn);
                var selectDisabled = replaced.find(_options.selectDisabled).hide();
                var optHolder = jQuery(_options.optStructure);
                var optList = optHolder.find(_options.optList);
                if(select.attr('disabled')) selectDisabled.show();
                replaced.addClass(selectClass);
                select.find('option').each(function() {
                    var selOpt = $(this);
                    var _opt = jQuery('<li><a href="#">' + selOpt.html() + '</a></li>');
                    if(selOpt.attr('selected')) {
                        selectText.html(selOpt.html());
                        _opt.addClass('selected');
                    }
                    _opt.children('a').click(function() {
                        optList.find('li').removeClass('selected');
                        select.find('option').removeAttr('selected');
                        $(this).parent().addClass('selected');
                        selOpt.attr('selected', 'selected');
                        selectText.html(selOpt.html());
                        select.change();
                        optHolder.hide();
                        return false;
                    });
                    optList.append(_opt);
                });
                replaced.width(select.outerWidth());
                replaced.insertBefore(select);
                optHolder.css({
                    width: select.outerWidth(),
                    display: 'none',
                    position: 'absolute'
                });
                jQuery(document.body).append(optHolder);

                var optTimer;
                replaced.hover(function() {
                    if(optTimer) clearTimeout(optTimer);
                }, function() {
                    optTimer = setTimeout(function() {
                        optHolder.hide();
                    }, 200);
                });
                optHolder.hover(function(){
                    if(optTimer) clearTimeout(optTimer);
                }, function() {
                    optTimer = setTimeout(function() {
                        optHolder.hide();
                    }, 200);
                });
                selectBtn.click(function() {
                    if(optHolder.is(':visible')) {
                        optHolder.hide();
                    }
                    else{
                        optHolder.children('ul').css({
                            height:'auto',
                            overflow:'hidden'
                        });
                        optHolder.css({
                            top: replaced.offset().top + replaced.outerHeight(),
                            left: replaced.offset().left,
                            display: 'block'
                        });
                        if(optHolder.children('ul').height() > 100) optHolder.children('ul').css({
                            height:100,
                            overflow:'auto'
                        });
                    }
                    return false;
                });
                select.addClass('outtaHere');
            }
        }
    });
};
/*------------------------ CUSTOM RADIO'S -----------------------------*/
jQuery.fn.customRadio = function(_options){
    var _options = jQuery.extend({
        radioStructure: '<div></div>',
        radioDisabled: 'disabled',
        radioDefault: 'radioArea',
        radioChecked: 'radioAreaChecked'
    }, _options);
    return this.each(function(){
        var radio = jQuery(this);
        if(!radio.hasClass('outtaHere') && radio.is(':radio')){
            var replaced = jQuery(_options.radioStructure);
            this._replaced = replaced;
            if(radio.is(':disabled')) replaced.addClass(_options.radioDisabled);
            else if(radio.is(':checked')) replaced.addClass(_options.radioChecked);
            else replaced.addClass(_options.radioDefault);
            replaced.click(function(){
                if($(this).hasClass(_options.radioDefault)){
                    radio.change();
                    radio.attr('checked', 'checked');
                    changeRadio(radio.get(0));
                }
            });
            radio.click(function(){
                changeRadio(this);
            });
            replaced.insertBefore(radio);
            radio.addClass('outtaHere');
        }
    });
    function changeRadio(_this){
        $('input:radio[name='+$(_this).attr("name")+']').not(_this).each(function(){
            if(this._replaced && !$(this).is(':disabled')) this._replaced.removeClass().addClass(_options.radioDefault);
        });
        _this._replaced.removeClass().addClass(_options.radioChecked);
    }
};
/*------------------------ CUSTOM CHECKBOX'S -----------------------------*/
jQuery.fn.customCheckbox = function(_options){
    var _options = jQuery.extend({
        checkboxStructure: '<div></div>',
        checkboxDisabled: 'disabled',
        checkboxDefault: 'checkboxArea',
        checkboxChecked: 'checkboxAreaChecked'
    }, _options);
    return this.each(function(){
        var checkbox = jQuery(this);
        if(!checkbox.hasClass('outtaHere') && checkbox.is(':checkbox')){
            var replaced = jQuery(_options.checkboxStructure);
            this._replaced = replaced;
            if(checkbox.is(':disabled')) replaced.addClass(_options.checkboxDisabled);
            else if(checkbox.is(':checked')) replaced.addClass(_options.checkboxChecked);
            else replaced.addClass(_options.checkboxDefault);

            replaced.click(function(){
                if(checkbox.is(':checked')) checkbox.removeAttr('checked');
                else checkbox.attr('checked', 'checked');
                changeCheckbox(checkbox);
            });
            checkbox.click(function(){
                changeCheckbox(checkbox);
            });
            replaced.insertBefore(checkbox);
            checkbox.addClass('outtaHere');
        }
    });
    function changeCheckbox(_this){
        if(_this.is(':checked')) _this.get(0)._replaced.removeClass().addClass(_options.checkboxChecked);
        else _this.get(0)._replaced.removeClass().addClass(_options.checkboxDefault);
    }
};
/*------------ GALLERY --------------*/
(function($) {
	$.fn.gallery = function(options) {return new Gallery(this.get(0), options);};

	function Gallery(context, options) {this.init(context, options);}

    Gallery.prototype = {
        options:{},
        init: function (context, options){
            this.options = $.extend({
                duration: 700,
                slideElement: 1,
                autoRotation: false,
                effect: false,
                listOfSlides: 'ul > li',
                switcher: false,
                disableBtn: false,
                nextBtn: 'a.link-next, a.btn-next, a.next',
                prevBtn: 'a.link-prev, a.btn-prev, a.prev',
                circle: true,
                direction: false,
                event: 'click',
                IE: false
            }, options || {});
            var _el = $(context).find(this.options.listOfSlides);
            if (this.options.effect) this.list = _el;
            else this.list = _el.parent();
            this.switcher = $(context).find(this.options.switcher);
            this.nextBtn = $(context).find(this.options.nextBtn);
            this.prevBtn = $(context).find(this.options.prevBtn);
            this.count = _el.index(_el.filter(':last'));

            if (this.options.switcher) this.active = this.switcher.index(this.switcher.filter('.active:eq(0)'));
            else this.active = 0;
            if (this.active < 0) this.active = 0;
            this.last = this.active;

            this.woh = _el.outerWidth(true);
            if (!this.options.direction) this.installDirections(this.list.parent().width());
            else {
                this.woh = _el.outerHeight(true);
                this.installDirections(this.list.parent().height());
            }

            if (!this.options.effect) {
                this.rew = this.count - this.wrapHolderW + 1;
                if (!this.options.direction) this.list.css({
                    marginLeft: -(this.woh * this.active)
                    });
                else this.list.css({
                    marginTop: -(this.woh * this.active)
                    });
            }
            else {
                this.rew = this.count;
                this.list.css({
                    opacity: 0
                }).removeClass('active').eq(this.active).addClass('active').css({
                    opacity: 1
                }).css('opacity', 'auto');
                this.switcher.removeClass('active').eq(this.active).addClass('active');
            }

            if (this.options.disableBtn) {
                if (this.count < this.wrapHolderW) this.nextBtn.addClass(this.options.disableBtn);
                if (this.active == 0) this.prevBtn.addClass(this.options.disableBtn);
            }

            this.initEvent(this, this.nextBtn, this.prevBtn, true);
            this.initEvent(this, this.prevBtn, this.nextBtn, false);

            if (this.options.autoRotation) this.runTimer(this);

			if (this.options.switcher) this.initEventSwitcher(this, this.switcher);
		},
		installDirections: function(temp){
			this.wrapHolderW = Math.ceil(temp / this.woh);
			if (((this.wrapHolderW - 1) * this.woh + this.woh / 2) > temp) this.wrapHolderWwrapHolderW--;
		},
		fadeElement: function(){
			if ($.browser.msie && this.options.IE){
				this.list.eq(this.last).css({opacity:0});
				this.list.removeClass('active').eq(this.active).addClass('active').css({opacity:'auto'});
			}
			else{
				this.list.eq(this.last).animate({opacity:0}, {queue:false, duration: this.options.duration});
				this.list.removeClass('active').eq(this.active).addClass('active').animate({
					opacity:1
				}, {queue:false, duration: this.options.duration, complete: function(){
					$(this).css('opacity','auto');
				}});
			}
			if (this.options.switcher) this.switcher.removeClass('active').eq(this.active).addClass('active');
			this.last = this.active;
		},
		scrollElement: function(){
			if (!this.options.direction) this.list.animate({marginLeft: -(this.woh * this.active)}, {queue:false, duration: this.options.duration});
			else this.list.animate({marginTop: -(this.woh * this.active)}, {queue:false, duration: this.options.duration});
			if (this.options.switcher) this.switcher.removeClass('active').eq(this.active).addClass('active');
		},
		runTimer: function($this){
			if($this._t) clearTimeout($this._t);
			$this._t = setInterval(function(){
				$this.toPrepare($this, true);
			}, this.options.autoRotation);
		},
		initEventSwitcher: function($this, el){
			el.bind($this.options.event, function(){
				$this.active = $this.switcher.index($(this));
				if($this._t) clearTimeout($this._t);
				if (!$this.options.effect) $this.scrollElement();
				else $this.fadeElement();
				if ($this.options.autoRotation) $this.runTimer($this);
				return false;
			});
		},
		initEvent: function($this, addEventEl, addDisClass, dir){
			addEventEl.bind($this.options.event, function(){
				if($this._t) clearTimeout($this._t);
				if ($this.options.disableBtn &&($this.count > $this.wrapHolderW)) addDisClass.removeClass($this.options.disableBtn);
				$this.toPrepare($this, dir);
				if ($this.options.autoRotation) $this.runTimer($this);
				return false;
			});
		},
		toPrepare: function($this, side){
			if (($this.active == $this.rew) && $this.options.circle && side) $this.active = -$this.options.slideElement;
			if (($this.active == 0) && $this.options.circle && !side) $this.active = $this.rew + $this.options.slideElement;
			for (var i = 0; i < $this.options.slideElement; i++){
				if (side) {
					if ($this.active + 1 > $this.rew) {
						if ($this.options.disableBtn && ($this.count > $this.wrapHolderW)) $this.nextBtn.addClass($this.options.disableBtn);
					}
					else $this.active++;
				}
				else{
					if ($this.active - 1 < 0) {
						if ($this.options.disableBtn && ($this.count > $this.wrapHolderW)) $this.prevBtn.addClass($this.options.disableBtn);
					}
					else $this.active--;
				}
			}
			if ($this.active == $this.rew && side) if ($this.options.disableBtn &&($this.count > $this.wrapHolderW)) $this.nextBtn.addClass($this.options.disableBtn);
			if ($this.active == 0 && !side) if ($this.options.disableBtn &&($this.count > $this.wrapHolderW)) $this.prevBtn.addClass($this.options.disableBtn);
			if (!$this.options.effect) $this.scrollElement();
			else $this.fadeElement();
		},
		stop: function(){
			if (this._t) clearTimeout(this._t);
		},
		play: function(){
			if (this._t) clearTimeout(this._t);
			if (this.options.autoRotation) this.runTimer(this);
		}
	}
}(jQuery));
/*-------------------- LIGHTBOX ----------------------*/
(function($) {
	$.fn.simplebox = function(options) {
		return new Simplebox(this, options);
	};

	function Simplebox(context, options) {this.init(context, options);}

    Simplebox.prototype = {
        options:{},
        init: function (context, options){
            this.options = $.extend({
                duration: 300,
                linkClose: 'a.close-lightbox',
                divFader: 'fader',
                faderColor: 'black',
                opacity: 0.7,
                wrapper: '#wrapper',
                linkPopap: '.link-submit'
            }, options || {});
            this.btn = $(context);
            this.select = $(this.options.wrapper).find('select');
            this.initFader();
            this.btnEvent(this, this.btn);
        },
        btnEvent: function($this, el){
            el.click(function(){
                if ($(this).attr('href')) $this.toPrepare($(this).attr('href'));
                else $this.toPrepare($(this).attr('title'));
                return false;
            });
        },
        calcWinWidth: function(){
            this.winWidth = $('body').width();
            if ($(this.options.wrapper).width() > this.winWidth) this.winWidth = $(this.options.wrapper).width();
        },
        toPrepare: function(obj){
            this.popup = $(obj);
            this.btnClose = this.popup.find(this.options.linkClose);
            this.submitBtn = this.popup.find(this.options.linkPopap);

            if ($.browser.msie) this.select.css({
                visibility: 'hidden'
            });
            this.calcWinWidth();
            this.winHeight = $(window).height();
            this.winScroll = $(window).scrollTop();

            this.popupTop = this.winScroll + (this.winHeight/2) - this.popup.outerHeight(true)/2;
            if (this.popupTop < 0) this.popupTop = 0;
            this.faderHeight = $(this.options.wrapper).outerHeight();
            if ($(window).height() > this.faderHeight) this.faderHeight = $(window).height();

            this.popup.css({
                //top: this.popupTop,
                top: 20,
                left: this.winWidth/2 - this.popup.outerWidth(true)/2
            }).hide();
            this.fader.css({
                width: this.winWidth,
                height: this.faderHeight
            });
            this.initAnimate(this);
            this.initCloseEvent(this, this.btnClose, true);
            this.initCloseEvent(this, this.submitBtn, true);
        //			this.initCloseEvent(this, this.fader, true);
        },
        initCloseEvent: function($this, el, flag){
            el.click(function(){
                $this.popup.fadeOut($this.options.duration, function(){
                    $this.popup.css({
                        left: '-9999px'
                    }).show();
                    if ($.browser.msie) $this.select.css({
                        visibility: 'visible'
                    });
                    $this.submitBtn.unbind('click');
                    $this.fader.unbind('click');
                    $this.btnClose.unbind('click');
                    $(window).unbind('resize');
                    if (flag) $this.fader.fadeOut($this.options.duration);
                    else {
                        if ($this.submitBtn.attr('href')) $this.toPrepare($this.submitBtn.attr('href'));
                        else $this.toPrepare($this.submitBtn.attr('title'));
                    }
                });
                return false;
            });
        },
        initAnimate:function ($this){
            $this.fader.fadeIn($this.options.duration, function(){
                $this.popup.fadeIn($this.options.duration);
            });
            $(window).resize(function(){
                $this.calcWinWidth();
                $this.popup.animate({
                    left: $this.winWidth/2 - $this.popup.outerWidth(true)/2
                }, {
                    queue:false,
                    duration: $this.options.duration
                    });
                $this.fader.css({
                    width: $this.winWidth
                    });
            });
        },
        initFader: function(){
            if ($(this.options.divFader).length > 0) this.fader = $(this.options.divFader);
            else{
                this.fader = $('<div class="'+this.options.divFader+'"></div>');
                $('body').append(this.fader);
                this.fader.css({
                    position: 'fixed',
                    zIndex: 999,
                    left:0,
                    top:0,
                    background: this.options.faderColor,
                    opacity: this.options.opacity
                }).hide();
            }
        }
    }
}(jQuery));
function clearFormFields(o)
{
    if (o.clearInputs == null) o.clearInputs = true;
    if (o.clearTextareas == null) o.clearTextareas = true;
    if (o.passwordFieldText == null) o.passwordFieldText = false;
    if (o.addClassFocus == null) o.addClassFocus = false;
    if (!o.filterClass) o.filterClass = "default";
    if(o.clearInputs) {
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++ ) {
            if((inputs[i].type == "text" || inputs[i].type == "password") && inputs[i].className.indexOf(o.filterClass)) {
                inputs[i].valueHtml = inputs[i].value;
                inputs[i].onfocus = function ()	{
                    if(this.valueHtml == this.value) this.value = "";
                    if(this.fake) {
                        inputsSwap(this, this.previousSibling);
                        this.previousSibling.focus();
                    }
                    if(o.addClassFocus && !this.fake) {
                        this.className += " " + o.addClassFocus;
                        this.parentNode.className += " parent-" + o.addClassFocus;
                    }
                }
                inputs[i].onblur = function () {
                    if(this.value == "") {
                        this.value = this.valueHtml;
                        if(o.passwordFieldText && this.type == "password") inputsSwap(this, this.nextSibling);
                    }
                    if(o.addClassFocus) {
                        this.className = this.className.replace(o.addClassFocus, "");
                        this.parentNode.className = this.parentNode.className.replace("parent-"+o.addClassFocus, "");
                    }
                }
                if(o.passwordFieldText && inputs[i].type == "password") {
                    var fakeInput = document.createElement("input");
                    fakeInput.type = "text";
                    fakeInput.value = inputs[i].value;
                    fakeInput.className = inputs[i].className;
                    fakeInput.fake = true;
                    inputs[i].parentNode.insertBefore(fakeInput, inputs[i].nextSibling);
                    inputsSwap(inputs[i], null);
                }
            }
        }
    }
    if(o.clearTextareas) {
        var textareas = document.getElementsByTagName("textarea");
        for(var i=0; i<textareas.length; i++) {
            if(textareas[i].className.indexOf(o.filterClass)) {
                textareas[i].valueHtml = textareas[i].value;
                textareas[i].onfocus = function() {
                    if(this.value == this.valueHtml) this.value = "";
                    if(o.addClassFocus) {
                        this.className += " " + o.addClassFocus;
                        this.parentNode.className += " parent-" + o.addClassFocus;
                    }
                }
                textareas[i].onblur = function() {
                    if(this.value == "") this.value = this.valueHtml;
                    if(o.addClassFocus) {
                        this.className = this.className.replace(o.addClassFocus, "");
                        this.parentNode.className = this.parentNode.className.replace("parent-"+o.addClassFocus, "");
                    }
                }
            }
        }
    }
    
    function inputsSwap(el, el2) {
        if(el) el.style.display = "none";
        if(el2) el2.style.display = "inline";
    }
}


//*************************************** Browser Detection *************************//
var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{
			string: navigator.userAgent,
			subString: "Chrome",
			identity: "Chrome"
		},
		{string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari",
			versionSearch: "Version"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	]

};
//**************************************************** End of Browser Detection ***************************///
