
/*--------------- Portfolio AJAX Loop ---------------*/

jQuery(function($){
	
	function checkScrollBarAjax() {
            var hContent = $(".items-container-responsive").height();
            var hWindow = $(window).height();
            if ( hContent < hWindow ) {
				loading = true;
				page++;
				load_posts();
			}
    }
	
    var page = 1;
	var post_per_page = $('#portfolio-post-per-page').val();
    var loading = false;
    var $window = $(window);
    var $content = $(".items-container-responsive");
	var siteUrl = $('#site-url').val();

    var load_posts = function() {
            $.ajax({
                type       : "GET",
                data       : {numPosts : post_per_page, pageNumber: page},
                dataType   : "html",
                url        : siteUrl + "/wp-content/themes/roya/portfolio-ajax-handler.php",
                beforeSend : function() {
                    if(page != 1){
                        $content.append('<div class="ajax-load"></div>');
                    }
                },
                success    : function(data){
                    $data = $(data);
                    if($data.length){
						$('.items-container-responsive').isotope( 'insert', $data , function() {
							$(".ajax-load").remove();
                            loading = false;
							if ( !$('html').hasClass("ie") ) {
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
							
							// Backuping rel attr for lightbox filtering
							$content.children('.item').children("a[rel^='prettyPhoto']").each( function() {
								$(this).attr('data-rel','prettyPhoto[portfolio-gallery]');
							});
							
							$("a[rel^='prettyPhoto']").prettyPhoto({ social_tools: false , theme: 'light_square' , show_title: false , slideshow: false , default_width: 700 , default_height: 450 , changepicturecallback: function(){
								if ( $('#pp_full_res').children('iframe').length > 0 ) {
									$('#pp_full_res').siblings('.pp_gallery').css('display','none');
								} else {
									$('#pp_full_res').siblings('.pp_gallery').css('display','block');
								}
							}});
							
							checkScrollBarAjax();
						}); 
						
                    } else {
                        $(".ajax-load").remove();
                    }
                },
                error     : function(jqXHR, textStatus, errorThrown) {
                    $(".ajax-load").remove();
                    console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
        });
    }
	
	
	$(window).scroll(function() {
		// Don't load item when filter is selected
		if ( $('.top-filter-bar li.selected-tinyNav a').is('.top-filter-bar-selected') ) {
			if (navigator.userAgent.toString().indexOf("Chrome")==-1) {
				height = document.documentElement.scrollHeight;
			} else { //If it’s google Chrome:
				height = document.body.scrollHeight;
			}
			if( !loading && height - $(this).scrollTop() - 500 <= $(this).height() ) {
					loading = true;
					page++;
					load_posts();
			}
		}
    });
	
	checkScrollBarAjax();
    
});