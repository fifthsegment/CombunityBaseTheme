<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
 
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if ( post_password_required() )
    return;

function Co_comment_template(){
    get_template_part( 'template-parts/comment', 'single' );
}
?>
 
<div id="comments" class="comments-area">
 
    <?php if ( have_comments() ) : ?>
        <br>
        <p class="comments-title">
            <?php
                printf( _nx( __('One reply'), __('%1$s replies'), get_comments_number(), 'comments title', 'combunity' ),
                    number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
            ?>
        </p>
 
        <ul class="comment-list">
            <?php
                $comments = get_comments(array(
                    'post_id' => get_the_ID(),
                    // 'status' => 'approve' //Change this to the type of comments to be displayed
                ));
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 74,
                    'callback'    => 'Co_comment_template',
                ), $comments );
            ?>
        </ul><!-- .comment-list -->
 
        <?php
            // Are there comments to navigate through?
            if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
        ?>
        <nav class="navigation comment-navigation" role="navigation">
            <h1 class="screen-reader-text section-heading"><?php _e( 'Comment navigation', 'twentythirteen' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'twentythirteen' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'twentythirteen' ) ); ?></div>
        </nav><!-- .comment-navigation -->
        <?php endif; // Check for comment navigation ?>
 
        <?php if ( ! comments_open() && get_comments_number() ) : ?>
        <p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
        <?php endif; ?>
 
    <?php endif; // have_comments() ?>
    
    <br>

    <?php 

        comment_form(array(
            'title_reply' => __('Submit a reply'),
            'label_submit' => __('Submit'),
            'class_submit' => 'submit btn btn-primary ',
            'fields' => array(),
            'comment_notes_before'  => '',
            'class_form' => 'comment-form combunity-comment-form'
        )); 

    ?>
 
</div><!-- #comments -->