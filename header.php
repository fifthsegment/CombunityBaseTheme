<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package themecombunity
 */

if (!function_exists('Combunity_Api')){
	print "The combunity plugin hasn't been activated yet. Please activate the plugin to be able to use this theme.";
	exit;
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php wp_title(); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
</head>
<body>
<div class="mobile-menu-container">
    <div class="mobile-menu-top">
        <span class="mobile-menu-close-btn">
            <i class="fa fa-close"></i>
        </span>
    </div>
    <?php
    echo wp_nav_menu( 
        array( 
            'theme_location' => 'banner-menu', 
            'menu_id' => 'banner-menu',
            'container_class' => 'mobile-menu-holder',
            'walker' => new Walker_Plain(array("li-classes"=>"banner-menu-item", "limit" => 5)) ,
            // 'fallback_cb' => 'menu_default'
        ) 
    ); 
    ?>
</div>
<div class="header dark-bg fixed">
    <div class="row header-row">
        <div class="col-md-5 col-sm-4 col-xs-2">
            <?php get_template_part( 'template-parts/header/categories', 'none' ); ?>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-8 text-center">
            <?php get_template_part( 'template-parts/header/logo', 'none' ); ?>
        </div>
        <div class="col-md-5 col-sm-4 col-xs-2">
            <?php get_template_part( 'template-parts/header/post', 'none' );; ?>
        </div>
    </div>
</div>
<?php if ( !is_user_logged_in() ) : ?>
<div id="loginmodal" style="">
    <?php

        get_template_part('template-parts/loginsignup', '');

    ?>
</div>
<?php endif ?>
<div id="submitpostform" style="">
    <?php

        get_template_part('template-parts/submitpost', '');

    ?>
</div>
<br>
<br>
<br>
<br>		
			
		