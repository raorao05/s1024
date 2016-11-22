jQuery( function ($) {

	/*------------------------------------------------------------------
		Setting up Isotope
	------------------------------------------------------------------*/
	
	var container = $('.items-container-responsive');
	container.isotope({
		itemSelector : '.item',
		layoutMode : 'masonry'
	}, function() {
		if ( !$('html').hasClass("ie")) {
			$('.blog-item > a > img').imagesLoaded({
				progress: function (isBroken, $images, $proper, $broken) {
					if( !isBroken ) {
						this.animate({opacity:'1'},350, function() {
							$(this).closest('.blog-item').addClass('thumbnailLoaded');
						});
					}
				}
			});
		}
	});
	
	$('.top-filter-bar ul li a').click(function(){
		var selector = $(this).attr('data-filter');
		container.find('#containerMsg').remove();
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
		Attach Icons for Navigation Menu
	------------------------------------------------------------------*/
	
	$('.left-header-nav ul li a').each( function() {
		$(this).css({ backgroundImage : 'url(' + $(this).children('img').attr('src') + ')' });
	});
	
	
	/*------------------------------------------------------------------
		Making Like Plugin Look Better
	------------------------------------------------------------------*/
	
	var $blogSingleLike = $('.blog-single-likes-num .zilla-likes-count'),
	$blogItemLikes = $('.blog-item-likes .zilla-likes-count');
	
	if ( $blogSingleLike.parent('a').length ) {
		$blogSingleLike.unwrap();
	}
	if ( $blogItemLikes.parent('a').length ) {
		$blogItemLikes.unwrap();
	}
	
	
	/*------------------------------------------------------------------
		Setting up Felexslider
	------------------------------------------------------------------*/
	
	$('.roya-flexslider').flexslider({
		animation: "slide",
		directionNav: false,
		smoothHeight: true
	});
	
	$('#roya-carousel-advanced').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		itemWidth: 170,
		itemMargin: 0,
		asNavFor: '#roya-flexslider-advanced'
	});

	$('#roya-flexslider-advanced').flexslider({
		animation: "slide",
		controlNav: false,
		animationLoop: false,
		slideshow: false,
		sync: "#roya-carousel-advanced"
	});
	
	
	/*------------------------------------------------------------------
		Some fixes to Make Thing More Pretty
	------------------------------------------------------------------*/
	
	$('.left-nav-feature .widget-title').filter(function() {
		return $.trim($(this).text()) === '' && $(this).children().length == 0;
	}).remove();
	
	function isotopeRelayout() {
		container.isotope('reLayout');
	};

	var resizeTimer;
	$(window).resize(function() {
		clearTimeout(resizeTimer);
		resizeTimer = setTimeout(isotopeRelayout, 100);
	});
	
	$(window).bind( 'orientationchange', function(e){
		setTimeout(isotopeRelayout, 1000);
	});
	
	$('.social-icons ul').on({
		mouseenter: function () {
			$(this).siblings().stop().animate({'opacity' : '0.44'} , 200);
			$(this).stop().animate({'opacity' : '0.9'} , 200);
		} , mouseleave: function () {
		
			$(this).siblings().stop().animate({'opacity' : '1'} , 200);
			$(this).stop().animate({'opacity' : '1'} , 200);

		}
	} , 'li' );
	
	$('.blog-single-para').fitVids();

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
		$(this).children('ul').animate({opacity : '0'} , 100)
		$(this).children('ul').slideUp(100 , function() {
			$(this).find('ul').hide();
		});
	});
	$('.left-header-nav > ul > li ul li').hoverIntent( function() {
		$(this).children('ul').slideDown(200);
		$(this).children('ul').animate({opacity : '1'} , 200)
	} , function() {} );
	
});