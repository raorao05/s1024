
/*--------------- Blog AJAX Loop ---------------*/

jQuery(function($){
	
	function checkScrollBarAjax() {
            var hContent = $(".items-container-responsive").height();
            var hWindow = $(window).height();
            if ( hContent < hWindow ) {
				loading = true;
				page++;
				load_posts();
			} else {
				//$('.blog-item > a > img').css('height','auto');
			}
    }
	
    var page = 1;
	var post_per_page = $('#blog-post-per-page').val();
    var loading = false;
    var $window = $(window);
    var $content = $(".items-container-responsive");
	var siteUrl = $('#site-url').val();

    var load_posts = function(){
            $.ajax({
                type       : "GET",
                data       : {numPosts : post_per_page, pageNumber: page},
                dataType   : "html",
                url        : siteUrl + "/wp-content/themes/roya/blog-ajax-handler.php",
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
								$('.blog-item > a > img').imagesLoaded({
									progress: function (isBroken, $images, $proper, $broken) {
										if( !isBroken ) {
											this.css('height','auto');
											this.animate({opacity:'1'},350, function() {
												$(this).closest('.blog-item').addClass('thumbnailLoaded');
												$content.isotope('reLayout');
											});
										}
									}
								});
							}
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
		if (navigator.userAgent.toString().indexOf("Chrome")==-1) {
			height = document.documentElement.scrollHeight;
		} else { //If it’s google Chrome:
			height = document.body.scrollHeight;
		}
        if( !loading && height - $(this).scrollTop() - 500  <= $(this).height() ) {
                loading = true;
				page++;
                load_posts();
        }
    });
	
	checkScrollBarAjax();
    
});