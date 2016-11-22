jQuery( function ($) {

	/*------------------------------------------------------------------
		Setting up Isotope
	------------------------------------------------------------------*/
	
	var container = $('.items-container-responsive');
	container.isotope({
		itemSelector : '.item',
		layoutMode : 'fitRows'
	}, function() {
		if ( !$('html').hasClass("ie")) {
			$('.folio-item > img').imagesLoaded({
				progress: function (isBroken, $images, $proper, $broken) {
					if( !isBroken ) {
						this.animate({opacity:'1'},350, function() {
							$(this).closest('.folio-item').addClass('thumbnailLoaded');
						});
					}
				}
			});
		}
	});
	
	// Backuping rel attr for lightbox filtering
	container.children('.item').children("a[rel^='prettyPhoto']").each( function() {
		$(this).attr('data-rel','prettyPhoto[portfolio-gallery]');
	});
	
	$('.top-filter-bar ul li a').click( function() {
		
		var selector = $(this).attr('data-filter');

		container.find('#containerMsg').remove();
		
		container.children('.item').children("a[rel^='prettyPhoto']").each( function() {
			$(this).attr('rel',$(this).attr('data-rel'));
		});
		
		container.children('.item').filter(function() {
			return $(this).is( selector );
		}).find("a[rel^='prettyPhoto']").each( function() {
			$(this).attr('rel','prettyPhoto[portfolio-filtered-gallery]');
		}).prettyPhoto({ social_tools: false , theme: 'light_square' , show_title: false , slideshow: false , default_width: 700 , default_height: 450, changepicturecallback: function(){
			if ( $('#pp_full_res').children('iframe').length > 0 ) {
				$('#pp_full_res').siblings('.pp_gallery').css('display','none');
			} else {
				$('#pp_full_res').siblings('.pp_gallery').css('display','block');
			}
		}});
		
		container.isotope({ filter: selector } , function() {
			if ( container.children('.isotope-item:not(.isotope-hidden)').length === 0 ) {
				container.find('#containerMsg').fadeOut().remove();
				container.css('height','100px');
				$('<h3 id="containerMsg">It seems that there is nothing here yet,<br/>Click on "show all" and scroll down to load more.</h3>').hide().appendTo(container).fadeIn();
			} else {
				container.find('#containerMsg').remove();
			}
		});
		
		return false;
		
	});

		
	/*------------------------------------------------------------------
		Backup Menu Bar for Mobile Devices
	------------------------------------------------------------------*/
	
	$(".top-filter-bar ul li a").click ( function() {
		$(this).parent().siblings('li').children('a').removeClass('top-filter-bar-selected');
		$(this).addClass('top-filter-bar-selected');
	});
	
	$(".top-filter-bar ul").tinyNav({active: 'selected-tinyNav'});
	
	$('.tinynav1').change(function(){
		var topFilterBarItems = $('.top-filter-bar ul li a'),
		selectedIndex = $(".tinynav1 option").index($(".tinynav1 option:selected")),
		dataFilter = topFilterBarItems.eq(selectedIndex).attr('data-filter');
		container.isotope({ filter: dataFilter });
	});
	
	$(".mobile-menu-button").click( function() {
		$(".top-nav ul.primary-nav-menu").slideToggle();
		return false;
	});
	
	$('.top-nav-search-button').click ( function() {
		$('.top-nav-search-input').fadeToggle( 200 );
		$('.field-pointer').fadeToggle( 200 );
	});
	

	/*------------------------------------------------------------------
		Providing Fall Back for Portfolio CSS3 Hover Effect
	------------------------------------------------------------------*/
	
	var cssTransSupport = $('html').hasClass('csstransitions');
	if ( !cssTransSupport ) {
		
		var animateSpeed = 200;
		var itemsContainer = $('.items-container-responsive');
		
		$('html.ie8 .folio-item-hover').css({ opacity : '0' });
		
		/* Check if it is 3 columns */
		if ( $('.folio-item').width() == 304) {
			
			itemsContainer.on({
			mouseenter: function () {
				$(this).find('.folio-item-hover').stop().animate({
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-hover').stop().animate({
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
			itemsContainer.on({
			mouseenter: function () {
				$(this).children('.folio-item-view').stop().animate({
					left : '70px',
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-view').stop().animate({
					left : '-70px',
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
			itemsContainer.on({
			mouseenter: function () {
				$(this).children('.folio-item-link').stop().animate({
					right : '70px',
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-link').stop().animate({
					right : '-70px',
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
			itemsContainer.on({
			mouseenter: function () {
				$(this).children('.folio-item-play').stop().animate({
					left : '70px',
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-play').stop().animate({
					left : '-70px',
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
		} else {	/* If it's not 3 columns so it's 4 columns */
			itemsContainer.on({
			mouseenter: function () {
				$(this).children('.folio-item-hover').stop().animate({
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-hover').stop().animate({
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
			itemsContainer.on({
			mouseenter: function () {
				$(this).children('.folio-item-view').stop().animate({
					left : '60px',
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-view').stop().animate({
					left : '-60px',
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
			itemsContainer.on({
			mouseenter: function () {
				$(this).children('.folio-item-link').stop().animate({
					right : '60px',
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-link').stop().animate({
					right : '-60px',
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
			itemsContainer.on({
			mouseenter: function () {
				$(this).children('.folio-item-play').stop().animate({
					left : '60px',
					opacity : '1'
				} , animateSpeed);
			} , mouseleave: function () {
				$(this).children('.folio-item-play').stop().animate({
					left : '-60px',
					opacity : '0'
				} , animateSpeed);
			}
			} , '.folio-item' );
			
		}
		
	}
	
	
	/*------------------------------------------------------------------
		Attach Icons for Navigation Menu
	------------------------------------------------------------------*/
	
	$('.left-header-nav ul li a').each( function() {
		$(this).css({ backgroundImage : 'url(' + $(this).children('img').attr('src') + ')' });
	});
	
	
	/*------------------------------------------------------------------
		Setting Up PrettyPhoto
	------------------------------------------------------------------*/
	
	$("a[rel^='prettyPhoto']").prettyPhoto({ social_tools: false , theme: 'light_square' , show_title: false , slideshow: false , default_width: 700 , default_height: 450 , changepicturecallback: function(){
		if ( $('#pp_full_res').children('iframe').length > 0 ) {
			$('#pp_full_res').siblings('.pp_gallery').css('display','none');
		} else {
			$('#pp_full_res').siblings('.pp_gallery').css('display','block');
		}
	}});
	
	/*------------------------------------------------------------------
		Some fixes to Make Thing More Pretty
	------------------------------------------------------------------*/
	
	$('.left-nav-feature .widget-title').filter(function() {
		return $.trim($(this).text()) === '' && $(this).children().length == 0;
	}).remove();
	
	$('.social-icons ul').on({
		mouseenter: function () {
			$(this).siblings().stop().animate({'opacity' : '0.44'} , 200);
			$(this).stop().animate({'opacity' : '0.9'} , 200);
		} , mouseleave: function () {
			$(this).siblings().stop().animate({'opacity' : '1'} , 200);
			$(this).stop().animate({'opacity' : '1'} , 200);
		}
	} , 'li' );
	
	function isotopeRelayout() {
		container.isotope('reLayout');
	};
	
	$(window).bind( 'orientationchange', function(e){
		setTimeout(isotopeRelayout, 1000);
	});
	
	var sumHeight = 0;
	$('.slidee').children().each( function() {
		sumHeight = sumHeight + $(this).outerHeight(true);
	});
	$('.slidee').css({
		height : sumHeight + 100
	});
	if ( sumHeight + 25 > $(window).height() ) {
		$('#scrollbar').show();
		$("#frame").sly({
			scrollBar : '#scrollbar',
			scrollBy: 100,
			dragHandle: 1,
			dynamicHandle: 1
		});
	}


	$('.left-header-nav > ul > li').hoverIntent( function() {
		$(this).children('ul').slideDown(200);
		$(this).children('ul').animate({opacity : '1'} , 200)
	}, function() {
		$(this).children('ul').animate({opacity : '0'} , 200)
		$(this).children('ul').slideUp(200 , function() {
			$(this).find('ul').hide();
		});
	});
	$('.left-header-nav > ul > li ul li').hoverIntent( function() {
		$(this).children('ul').slideDown(200);
		$(this).children('ul').animate({opacity : '1'} , 200)
	} , function() {} );
	
});