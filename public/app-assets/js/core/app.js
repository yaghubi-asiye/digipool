/*=========================================================================================
  File Name: app.js
  Description: Template related app JS.
  ----------------------------------------------------------------------------------------
  Item Name: Chameleon Admin - Modern Bootstrap 4 WebApp & Dashboard HTML Template + UI Kit
  Version: 1.2
  Author: ThemeSelection
  Author URL: https://themeselection.com/
==========================================================================================*/

(function(window, document, $) {

    'use strict';
    var $html = $('html');
    var $body = $('body');


    $(window).on('load', function() {

        var rtl;
        var compactMenu = false; // Set it to true, if you want default menu to be compact

        if ($('html').data('textdirection') == 'rtl') {
            rtl = true;
        }

        setTimeout(function() {
            $html.removeClass('loading').addClass('loaded');
        }, 1200);

        $.app.menu.init(compactMenu);

        // Navigation configurations
        var config = {
            speed: 300 // set speed to expand / collpase menu
        };
        if ($.app.nav.initialized === false) {
            $.app.nav.init(config);
        }

        Unison.on('change', function(bp) {
            $.app.menu.change();
        });

        var $sidebar_img = $('.main-menu').data('img'),
        $sidebar_img_container = $('.navigation-background');

        if( $sidebar_img_container.length > 0 && $sidebar_img !== undefined ){
            $sidebar_img_container.css('background-image','url("' + $sidebar_img + '")');
        }

        // Tooltip Initialization
        $('[data-toggle="tooltip"]').tooltip({
            container: 'body'
        });

        //Hide navbar search box on close click
        var toogleBtn = $(".header-navbar .navbar-search-close");
        $(toogleBtn).click(function(event) {
            $('.navbar-search .dropdown-toggle').click();
        });

        // Top Navbars - Hide on Scroll
        if ($(".navbar-hide-on-scroll").length > 0) {
            $(".navbar-hide-on-scroll.fixed-top").headroom({
                "offset": 205,
                "tolerance": 5,
                "classes": {
                    // when element is initialised
                    initial: "headroom",
                    // when scrolling up
                    pinned: "headroom--pinned-top",
                    // when scrolling down
                    unpinned: "headroom--unpinned-top",
                }
            });
            // Bottom Navbars - Hide on Scroll
            $(".navbar-hide-on-scroll.fixed-bottom").headroom({
                "offset": 205,
                "tolerance": 5,
                "classes": {
                    // when element is initialised
                    initial: "headroom",
                    // when scrolling up
                    pinned: "headroom--pinned-bottom",
                    // when scrolling down
                    unpinned: "headroom--unpinned-bottom",
                }
            });
        }

        //Match content & menu height for content menu
        setTimeout(function() {
            if ($('body').hasClass('vertical-content-menu')) {
                setContentMenuHeight();
            }
        }, 500);

        function setContentMenuHeight() {
            var menuHeight = $('.main-menu').height();
            var bodyHeight = $('.content-body').height();
            if (bodyHeight < menuHeight) {
                $('.content-body').css('height', menuHeight);
            }
        }

        // Collapsible Card
        $('a[data-action="collapse"]').on('click', function(e) {
            e.preventDefault();
            $(this).closest('.card').children('.card-content').collapse('toggle');
            $(this).closest('.card').find('[data-action="collapse"] i').toggleClass('ft-plus ft-minus');

        });

        // Toggle fullscreen
        $('a[data-action="expand"]').on('click', function(e) {
            e.preventDefault();
            $(this).closest('.card').find('[data-action="expand"] i').toggleClass('ft-maximize ft-minimize');
            $(this).closest('.card').toggleClass('card-fullscreen');
        });

        //  Notifications & messages scrollable
        $('.scrollable-container').each(function(){
            var scrollable_container = new PerfectScrollbar($(this)[0],{
                wheelPropagation: false,
            });
        });

        // Reload Card
        $('a[data-action="reload"]').on('click', function() {
            var block_ele = $(this).closest('.card');

            // Block Element
            block_ele.block({
                message: '<div class="ft-refresh-cw icon-spin font-medium-2"></div>',
                timeout: 3000, //unblock after 2 seconds
                overlayCSS: {
                    backgroundColor: '#FFF',
                    cursor: 'wait',
                },
                css: {
                    border: 0,
                    padding: 0,
                    backgroundColor: 'none'
                }
            });
        });



        // Close Card
        $('a[data-action="close"]').on('click', function() {
            $(this).closest('.card').removeClass().slideUp('fast');
        });

        // Match the height of each card in a row
        setTimeout(function() {
            $('.row.match-height').each(function() {
                $(this).find('.card').not('.card .card').matchHeight(); // Not .card .card prevents collapsible cards from taking height
            });
        }, 500);


        $('.card .heading-elements a[data-action="collapse"]').on('click', function() {
            var $this = $(this),
                card = $this.closest('.card');
            var cardHeight;

            if (parseInt(card[0].style.height, 10) > 0) {
                cardHeight = card.css('height');
                card.css('height', '').attr('data-height', cardHeight);
            } else {
                if (card.data('height')) {
                    cardHeight = card.data('height');
                    card.css('height', cardHeight).attr('data-height', '');
                }
            }
        });

        // Add open class to parent list item if subitem is active except compact menu
        var menuType = $body.data('menu');
        if (menuType != 'vertical-compact-menu' && menuType != 'horizontal-menu' && compactMenu === false) {
            if ($body.data('menu') == 'vertical-menu-modern') {
                if (localStorage.getItem("menuLocked") === "true") {
                    $(".main-menu-content").find('li.active').parents('li').addClass('open');
                }
            } else {
                $(".main-menu-content").find('li.active').parents('li').addClass('open');
            }
        }
        if (menuType == 'vertical-compact-menu' || menuType == 'horizontal-menu') {
            $(".main-menu-content").find('li.active').parents('li:not(.nav-item)').addClass('open');
            $(".main-menu-content").find('li.active').parents('li').addClass('active');
        }

        //card heading actions buttons small screen support
        $(".heading-elements-toggle").on("click", function() {
            $(this).parent().children(".heading-elements").toggleClass("visible");
        });

        //  Dynamic height for the chartjs div for the chart animations to work
        var chartjsDiv = $('.chartjs'),
            canvasHeight = chartjsDiv.children('canvas').attr('height');
        chartjsDiv.css('height', canvasHeight);

        $('.nav-link-search').on('click', function() {
            var $this = $(this),
                searchInput = $(this).siblings('.search-input');

            if (searchInput.hasClass('open')) {
                searchInput.removeClass('open');
            } else {
                searchInput.addClass('open');
            }
        });

		$('.main-menu-content').css('visibility','visible');
    });


    $(document).on('click', '.menu-toggle, .modern-nav-toggle', function(e) {
        e.preventDefault();

        // Toggle menu
        $.app.menu.toggle();

        setTimeout(function() {
            $(window).trigger("resize");
        }, 200);

        if ($('#collapsed-sidebar').length > 0) {
            setTimeout(function() {
                if ($body.hasClass('menu-expanded') || $body.hasClass('menu-open')) {
                    $('#collapsed-sidebar').prop('checked', false);
                } else {
                    $('#collapsed-sidebar').prop('checked', true);
                }
            }, 1000);
        }

        return false;
    });

    $(document).on('click', '.close-navbar', function(e) {
        e.preventDefault();

        // Toggle menu
        $.app.menu.toggle();
    });

    $(document).on('click', '.open-navbar-container', function(e) {

        var currentBreakpoint = Unison.fetch.now();

        // Init drilldown on small screen
        $.app.menu.drillDownMenu(currentBreakpoint.name);

        // return false;
    });

    $(document).on('click', '.main-menu-footer .footer-toggle', function(e) {
        e.preventDefault();
        $(this).find('i').toggleClass('pe-is-i-angle-down pe-is-i-angle-up');
        $('.main-menu-footer').toggleClass('footer-close footer-open');
        return false;
    });

    // Add Children Class
    $('.navigation').find('li').has('ul').addClass('has-sub');

    $('.carousel').carousel({
        interval: 2000
    });

    // Page full screen
    $('.nav-link-expand').on('click', function(e) {
        if (typeof screenfull != 'undefined') {
            if (screenfull.enabled) {
                screenfull.toggle();
            }
        }
    });
    if (typeof screenfull != 'undefined') {
        if (screenfull.enabled) {
            $(document).on(screenfull.raw.fullscreenchange, function() {
                if (screenfull.isFullscreen) {
                    $('.nav-link-expand').find('i').toggleClass('ft-minimize ft-maximize');
                } else {
                    $('.nav-link-expand').find('i').toggleClass('ft-maximize ft-minimize');
                }
            });
        }
    }

    $(document).on('click', '.mega-dropdown-menu', function(e) {
        e.stopPropagation();
    });

    $(document).ready(function() {

        /**********************************
         *   Form Wizard Step Icon
         **********************************/
        $('.step-icon').each(function() {
            var $this = $(this);
            if ($this.siblings('span.step').length > 0) {
                $this.siblings('span.step').empty();
                $(this).appendTo($(this).siblings('span.step'));
            }
        });
    });

    // Update manual scroller when window is resized
    $(window).resize(function() {
        $.app.menu.manualScroller.updateHeight();
    });

	!function(t,e,n){"use strict";n(".custom-file input").change(function(t){n(this).next(".custom-file-label").html(t.target.files[0].name)})}(window,document,jQuery);

})(window, document, jQuery);


$(document).ready(function() {
	$.fn.digits = function(){
		return this.each(function(){
			$(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
		})
	}

	$(document).on('click', 'a[href^="#"]', function(event) {
		event.preventDefault();
		if(!$(this).hasClass('nav-link') && !$(this).parent().hasClass('carousel'))
			$("html, body").animate({ scrollTop: $($(this).attr("href")).offset().top }, 500);
	});

	if($('.chk-remember').length){
        $('.chk-remember').iCheck({
            checkboxClass: 'icheckbox_flat-green',
            radioClass: 'iradio_square-blue',
        });
    }
	if($('.skin-square').length){
		$(".skin-square input").iCheck({
            checkboxClass: "icheckbox_square-red",
            radioClass: "iradio_square-red"
		});
	}




});


$(".numbers").keypress(function (e) {
	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
		return false;
	}
});


$(document).ready(function () {
	"use strict";
	var t = document.getElementsByClassName("needs-validation");
	Array.prototype.filter.call(t, function (t) {
		t.addEventListener("submit", function (e) {
			!1 === t.checkValidity() && (e.preventDefault(), e.stopPropagation()), t.classList.add("was-validated");
			if($(this).find("input:invalid,select:invalid").length && $(this).find("input:invalid,select:invalid").is(":visible")){
				$([document.documentElement, document.body]).animate({
					scrollTop: $(this).find("input:invalid,select:invalid").offset().top-150
				}, 800);
			}
		}, !1)
	})


	$(function(){
		var url = window.location.pathname,
			urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
		var i=0;
		if($('.navigation-main').length){
			$('.navigation-main a').each(function(){
				if(urlRegExp.test(this.href.replace(/\/$/,'')) && i==0){
					if($(this).parent().parent().hasClass('menu-content'))
						$(this).parent().addClass('active');
					else
						$(this).parent().addClass('open');
					i=i+1;
				}
			});
		}
		if($('.menu-profile').length){
			$('.menu-profile a').each(function(){
				if(urlRegExp.test(this.href.replace(/\/$/,''))){
					$(this).addClass('active');
				}
			});
		}

	});

});

$('input.price').keyup(function(event) {

	// skip for arrow keys
	if(event.which >= 37 && event.which <= 40) return;

	// format number
	$(this).val(function(index, value) {
		return value
			.replace(/\D/g, "")
			.replace(/\B(?=(\d{3})+(?!\d))/g, ",")
			;
	});
});

function delay(callback, ms) {
	var timer = 0;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			callback.apply(context, args);
		}, ms || 0);
	};
}

function copyToClipboard(element)
{
	var $temp = $('<input>');
	$('body').append($temp);
	if($(element).val()!="")
		$temp.val($(element).val()).select();
	else
		$temp.val($(element).find('span').html()).select();
	document.execCommand('copy');
	$temp.remove();
	$(element).attr('data-original-title','کپی شد!');
	$('.tooltip-inner').html('کپی شد!');
}



//jQuery blockUI plugin
function loading(){
	$.blockUI({
            message: '<span class="spinner-grow" style="width: 5rem; height: 5rem;"></span>',
            overlayCSS: {
                backgroundColor: '#FFF',
                opacity: 0.7,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'transparent'
            }
        });
}
function unloading(){
	$.unblockUI();
}

 $(function() {
	$(".notification-dropdown a").sort(sort_li).appendTo('.notification-dropdown');
	function sort_li(a, b) {
		return ($(b).data('sort')) > ($(a).data('sort')) ? 1 : -1;
	}
});


function toLatin(str){
	var
		persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
		arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];

  if(typeof str === 'string'){
    for(var i=0; i<10; i++){
      str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
    }
  }
  return str;
};

$("input[type=text] , input[type=email], input[type=number]").bind("keypress",function(event) {
	return event.target.value = toLatin(event.target.value);
})

//firebase
navigator.serviceWorker.register('https://irpay.in/panel/js/firebase-messaging-sw.js')
    .then((registration) => {
        messaging.useServiceWorker(registration);
    });

const firebaseConfig = {
    apiKey: "AIzaSyBf3N2tmE4Kzl5vuc6j15K0wgkqdyh_td8",
    authDomain: "irPay-1e384.firebaseapp.com",
    databaseURL: "https://irPay-1e384.firebaseio.com",
    projectId: "irPay-1e384",
    storageBucket: "irPay-1e384.appspot.com",
    messagingSenderId: "145742585360",
    appId: "1:145742585360:web:39ec473e815ae909"
};
firebase.initializeApp(firebaseConfig);

// Retrieve Firebase Messaging object.
const messaging = firebase.messaging();

messaging.requestPermission().then(function() {
    //console.log('Notification permission granted.');
    // TODO(developer): Retrieve an Instance ID token for use with FCM.
    return messaging.getToken();
})
    .then(function(token){
        console.log(token);
        insert_token(token);
    })
    .catch(function(err) {
        console.log('Unable to get permission to notify.', err);
    });
messaging.onMessage(function(payload) {
    Swal.fire({
        position: 'bottom-start',
        type: 'success',
        title: payload.notification.title,
        text: payload.notification.body,
        showConfirmButton: false,
        timer: 5000
    })
});

function insert_token(token) {
    if($('meta[name="firebase_token"]').attr('content') != token){
        $.post("https://www.irpay.in/panel/token",
            {token: token, _token: $('meta[name="_token"]').attr('content'),
            });
    }
}



function ElementBlock(elementsId){
	$(elementsId).block({
		message: '<div class="spinner-border text-primary"></div>',
		overlayCSS: {
			backgroundColor: '#fff',
			opacity: 0.8,
			cursor: 'wait'
		},
		css: {
			border: 0,
			padding: 0,
			backgroundColor: 'transparent'
		}
	});
	$(elementsId).attr('disabled','disabled');
}

function ElementUnBlock(elementsId){
	$(elementsId).unblock();
	$(elementsId).removeAttr('disabled');
}

function toLatin(str){
	var
		persianNumbers = [/۰/g, /۱/g, /۲/g, /۳/g, /۴/g, /۵/g, /۶/g, /۷/g, /۸/g, /۹/g],
		arabicNumbers  = [/٠/g, /١/g, /٢/g, /٣/g, /٤/g, /٥/g, /٦/g, /٧/g, /٨/g, /٩/g];

  if(typeof str === 'string'){
    for(var i=0; i<10; i++){
      str = str.replace(persianNumbers[i], i).replace(arabicNumbers[i], i);
    }
  }
  return str;
};

$("input[type=text] , input[type=email], input[type=number]").bind("keypress",function(event) {
	return event.target.value = toLatin(event.target.value);
})


function timerResend(timer = 60){
	$("#mdtimer span").text(timer);
	$("#makingdifferenttimer").delay(600).fadeOut();
	$("#mdtimer").delay(1000).fadeIn();
	var sec = timer-1;
	var timer = setInterval(function () {
		$("#mdtimer span").text(sec--);
		if (sec == 0) {
			$("#makingdifferenttimer").delay(1000).fadeIn(1000);
			$("#mdtimer").delay(600).fadeOut();
			clearInterval(timer);
		}
	}, 1000);
}



$(document).ready(function () {
	if($('#myText1').length){
		$('#myText1,#myText2').digitbox({float:true,grouping:1, separator:',', truevalue:0});
		$('#mySelect1,#mySelect2').selectpicker({
			liveSearch: true,
			maxOptions: 1
		});
	}

	var mySelect1 = $('#mySelect1');
	var mySelect2 = $('#mySelect2');
	var previous;

	mySelect1.on('focus', function () {
		previous = this.value;
	}).change(function() {
		$('#mySelect1,#mySelect2,#frm button').prop("disabled", false);

		var varSelect1 = mySelect1.val();
		var varSelect2 = mySelect2.val();
		$('#myText1,#myText2').attr('placeholder','عدد را درج کنید')


		if(mySelect1.val() !='rial'){
			mySelect2.find('option').prop('disabled', true);
			mySelect2.find('option[value="rial"]').prop('disabled', false);
			$('#model').html('فروش'),$('#about').html('به');
			$('#cur').html(varSelect1);
			$('#myText1').val( 1 );


		}else if( mySelect1.val() !='rial' && mySelect2.val() !='rial' ){
			mySelect2.find('option').prop('disabled', false);
			mySelect2.find('option[value="rial"]').prop('disabled', true);
			$('#model').html('خرید'),$('#about').html('از');
			$('#cur').html(varSelect2);
			//$('#myText1').val( 1 );
		}else{
			mySelect2.find('option').prop('disabled', false);
			mySelect2.find('option[value="rial"]').prop('disabled', true);
			$('#model').html('خرید'),$('#about').html('از');
			$('#cur').html('psvouchers');
			//$('#myText1').val( 100000 );

		}
		mySelect2.val(mySelect2.find("option:not([disabled]):first").val());
		mySelect1.selectpicker('refresh');
		mySelect2.selectpicker('refresh');
		textCalculate();
	});

	mySelect2.on('change', function () {
		if(mySelect2.val() !='rial'){
			$('#model').html('خرید'),$('#about').html('از');
			$('#cur').html(mySelect2.val());

		}else{
			$('#model').html('فروش'),$('#about').html('به');
			$('#cur').html(mySelect1.val());
		}
		textCalculate()
	});
});
