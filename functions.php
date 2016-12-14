<?php
$theme_version = '1.0.0';
$COD = array(
    "enable-post-page-sidebar" => true
);
if (!isset($content_width))
{
    $content_width = 900;
}



///////////////////////////////////////////////
//
//  Include everything !!!
//
////////////////////////////////////////////////
include_once("includes/plain-walker.php");
include_once("includes/walker.php");
if (is_admin()) { // note the use of is_admin() to double check that this is happening in the admin
    include_once('includes/class-updater.php');
    $config = array(
        'slug' => plugin_basename(__FILE__), // this is the slug of your plugin
        'proper_folder_name' => 'combunity-latest', // this is the name of the folder your plugin lives in
        'api_url' => 'https://api.github.com/repos/fifthsegment/CombunityBaseTheme', // the GitHub API url of your GitHub repo
        'raw_url' => 'https://raw.github.com/fifthsegment/CombunityBaseTheme/master', // the GitHub raw url of your GitHub repo
        'github_url' => 'https://github.com/fifthsegment/CombunityBaseTheme', // the GitHub url of your GitHub repo
        'zip_url' => 'https://github.com/fifthsegment/CombunityBaseTheme/zipball/master', // the zip url of the GitHub repoCombunityBaseTheme
        'sslverify' => false, // whether WP should check the validity of the SSL cert when getting an update, see https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/2 and https://github.com/jkudish/WordPress-GitHub-Plugin-Updater/issues/4 for details
        'requires' => '3.0', // which version of WordPress does your plugin require?
        'tested' => '3.3', // which version of WordPress is your plugin tested up to?
        'readme' => 'README.md', // which file to use as the readme for the version number
        'access_token' => '', // Access private repositories by authorizing under Appearance > GitHub Updates when this example plugin is installed
    );
    new WP_GitHub_Updater($config);
}
////////////////////////////////////////////////


register_sidebar( array(
    'id'          => 'forum-sidebar',
    'name'        => __( 'Forum Sidebar', 'combunity' ),
    'description' => __( 'This sidebar is located to the left of the forum.', 'combunity' ),
) );

include_once( 'widgets/allsubs.widget.php' );
include_once( 'widgets/recent-comments.widget.php' );
include_once( 'widgets/recent-posts.widget.php' );

// Register all widgets
add_action( 'widgets_init', function(){
    register_widget( 'Combunity_AllSubs' );
});

add_action( 'widgets_init', function(){
    register_widget( 'Combunity_Widget_Recent_Posts' );
});

add_action( 'widgets_init', function(){
    register_widget( 'Combunity_Widget_Recent_Comments' );
});

// End register all widgets

function remove_head_scripts() {
   remove_action('wp_head', 'wp_print_scripts');
   remove_action('wp_head', 'wp_print_head_scripts', 9);
   remove_action('wp_head', 'wp_enqueue_scripts', 1);

   // remove_action('wp_head', 'wp_print_style');
   // remove_action('wp_head', 'wp_print_head_style', 9);
   // remove_action('wp_head', 'wp_enqueue_style', 1);
 
   add_action('wp_footer', 'wp_print_scripts', 5);
   add_action('wp_footer', 'wp_enqueue_scripts', 5);
   add_action('wp_footer', 'wp_print_head_scripts', 5);

   // add_action('wp_footer', 'wp_print_style', 5);
   // add_action('wp_footer', 'wp_enqueue_style', 5);
   // add_action('wp_footer', 'wp_print_head_style', 5);
}
add_action( 'wp_enqueue_scripts', 'remove_head_scripts' );


//Making jQuery to load from Google Library
function replace_jquery() {
    if (!is_admin()) {
        // comment out the next two lines to load the local copy of jQuery
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js', false, '1.12.4');
        wp_enqueue_script('jquery');
    }
}
add_action('init', 'replace_jquery');



function my_minify_html() {

    // Use html_compress($html) function to minify html codes.
    ob_start('sanitize_output');
}

function sanitize_output($buffer) {

    $search = array(
        '/\>[^\S ]+/s',  // strip whitespaces after tags, except space
        '/[^\S ]+\</s',  // strip whitespaces before tags, except space
        '/(\s)+/s'       // shorten multiple whitespace sequences
    );

    $replace = array(
        '>',
        '<',
        '\\1'
    );

    $buffer = preg_replace($search, $replace, $buffer);

    return $buffer;
}

add_action( 'wp_loaded','my_minify_html' );


function Co_the_asset_url( $file ) {
    $base = get_template_directory_uri() .'/assets/' ;
    echo $base . $file;
}

function Co_get_pagination_offset( ){
    $number = get_option( 'posts_per_page' );
    $page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

    return 1 == $page ? ( $page - 1 ) : ( ( $page - 1 ) * $number );

}

function combunity_forums_header_scripts()
{
    $base = get_template_directory_uri() .'/assets/' ;

    wp_register_script('combunity-theme',  $base . 'combunity-theme.js', array('jquery'), '1.0' );
    
    wp_enqueue_script('combunity-theme');

    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        
        wp_enqueue_script( 'comment-reply' );
    }
    if ( is_user_logged_in() )   {
       
        wp_register_script('tinymce_secondary',  '//cdnjs.cloudflare.com/ajax/libs/tinymce/4.5.0/tinymce.min.js', array(), '1.0' );
        wp_enqueue_script('tinymce_secondary');
    }
}

function combunity_forums_header_styles()
{
	global $theme_version;
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {
    	wp_register_style(
    		'combunity_forums', 
    		get_template_directory_uri() . '/style.css', 
    		array(), 
    		$theme_version, 
    		'all'
    	);
    	wp_enqueue_style('combunity_forums'); // Enqueue it!
    }
    if ( is_user_logged_in() )   {
        $base = get_template_directory_uri() .'/assets/' ;
       
    }
}

/**
 * Prints a first class if the current post is first in its loop
 */
function combunity_is_first(){

}

function combunity_sidebar_enabled(){
    global $COD;
    return get_theme_mod( "enable-post-page-sidebar", $COD["enable-post-page-sidebar"] );
}

function combunity_sidebar_class_for_body(){
    $section_a_class = "col-sm-push-4 col-sm-8 col-md-8 col-lg-8 col-xs-12";
    $section_b_class = "col-md-12"; 
    if ( combunity_sidebar_enabled() ){
        echo $section_a_class;
    }else{
        echo $section_b_class;
    }
}

function combunity_sidebar_class_for_sidebar(){
    global $COD;
    $sidebarclass = "col-sm-pull-8 col-sm-4 col-md-4 col-lg-4 col-xs-12";
    echo $sidebarclass;
}

function Co_the_fp_meta( $key, $default ){
    return Combunity_Api()->the_fp_meta( $key, $default );
}

function Co_edit_comment_link(){
    $author_email = get_comment_author_email( get_comment_ID() );
    $comment_status = wp_get_comment_status( get_comment_ID() );
    $link = sprintf('<a href="%1$s" data-id="%3$s" class="edit-comment">%2$s</a>', '#', __('Edit'), get_comment_ID() );
    if ( current_user_can( 'edit_comment', get_comment_ID() ) ){
        echo $link;
    }else{
        if ( wp_get_current_user()->user_email == $author_email ){
            if ( $comment_status == "approved" ){
                echo $link;
            }
        }
    }
}

function Combunity_get_avatar( $object ){
    return Combunity_Api()->get_avatar( $object );
}

function Co_the_comment_voted_class( $asked ){
    $already_voted = Combunity_Api()->check_and_get_user_vote( get_comment_ID() );

    if ($already_voted != false){
        $current_class = "";
        $vote_type = $already_voted;
        if ($vote_type=="up"){
            // if ( $asked == $post_type ){
                $current_class =  " combunity-vote-$vote_type-highlight ";
            // }
        }else if ($vote_type=="down"){
            // if ( $asked == $post_type ){
                $current_class =  " combunity-vote-$vote_type-highlight ";
            // }
        }
        if ( $vote_type == $asked ){
            echo $current_class;
        }
    }
}

function Co_the_current_forum_slug(){
    if ( is_archive() ){
        echo get_query_var('cforum', '');
    }
    if ( is_single() && 'cpost' === get_post_type() ){
        $t =  wp_get_post_terms( get_the_ID() , 'cforum' );
        // var_dump( $t );
        if ( is_array( $t ) && sizeof( $t ) > 0 ){
            echo $t[0]->slug;
        }
       
    }
}

function Co_increment_the_thread_views(){
    $id = get_the_ID();
    Combunity_Api()->increment_thread_views( $id );
}

function Co_get_post_thread_link(){
    $value = get_option( 'combunity_adminpage_postthread' );
    if ( $value ){  
        echo get_post_permalink( intval( $value ) );
    }else{
        echo '#';
    }
}



// Add Actions
add_action('wp_enqueue_scripts', 'combunity_forums_header_scripts');
add_action('wp_enqueue_scripts', 'combunity_forums_header_styles');