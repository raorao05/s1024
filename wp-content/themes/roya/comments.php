<?php
/*-----------------------------------------------------------------------------------*/
/*  Begin processing our comments
/*-----------------------------------------------------------------------------------*/
?>

<!-- BEGIN #comments -->
<div id="comments">
<?php 
    /* Password protected? ----------------------------------------------------------*/
    if ( post_password_required() ) : 
?>
    	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'spnoy'); ?></p>
        </div><!-- #comments -->
<?php
	/* Stop processing comments.php, but don't kill the script entirely -------------*/
		return;
	endif;

/*-----------------------------------------------------------------------------------*/
/*	Display the Comments & Pings
/*-----------------------------------------------------------------------------------*/

	if ( have_comments() ) :
	
        /* Display Comments ---------------------------------------------------------*/    
        if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
	
			<span class="blog-single-comments-number"><?php comments_number( '0', '1', '%', '-' ); ?></span>
			<span class="blog-single-comments-title"><?php _e('comment', 'spnoy');?></span>
			
        	<ul class="commentlist">
            <?php wp_list_comments( 'type=comment&callback=theme_comment' ); ?>
            </ul>

        <?php endif; // end normal comments 
        
        /* Display Pings -------------------------------------------------------------*/
        if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
    		<h3 class="pings-title"><?php _e('Trackbacks for this post', 'spnoy') ?></h3>
		
    		<ol class="pinglist">
            <?php wp_list_comments( 'type=pings&callback=theme_pings' ); ?>
            </ol>

        <?php endif; // end pings 
		
		/* Display Comment Navigation -----------------------------------------------*/
		if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
    		<div class="comment-navigation">
    			<div class="nav-previous"><?php previous_comments_link(); ?></div>
    			<div class="nav-next"><?php next_comments_link(); ?></div>
    		</div>
		<?php endif; // end comment pagination check
		
		
/*-----------------------------------------------------------------------------------*/
/*	Deal with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
	elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		
		<p class="nocomments"><?php _e('Comments are closed.', 'spnoy') ?></p>
		
	<?php endif;

/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : 
	
	    $fields = array(
            'comment_field' => '<p class="comment-form-comment"><textarea id="comment" class="border-box" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
            'must_log_in' => '<p class="must-log-in">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'spnoy'), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'logged_in_as' => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'spnoy'), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
            'comment_notes_before' => '',
            'comment_notes_after' => '',
            'title_reply' => __('Leave a Comment', 'spnoy'),
            'title_reply_to' => __('Leave a Reply to %s', 'spnoy'),
            'cancel_reply_link' => __('Cancel Reply', 'spnoy'),
            'label_submit' => __('Post Comment', 'spnoy')
	    );
		    	
	    comment_form($fields);

	endif; // end if comments open check ?>
	
<!-- END #comments -->
</div>