<div class="logo-div" >
    <?php $site_logo = get_theme_mod( 'site-logo', '' );?>
    <?php
    if ( strlen($site_logo) == 0 ) : ?>
        <a class="combunity-header-link-color" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
    <?php else : ?>
        <a class="combunity-header-link-color" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img src="<?php echo $site_logo ?>" class="logo-img"></a>
    <?php
    endif;
    ?>
</div>