<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package combunity-child
 */

?>

<article id="post-<?php the_ID(); ?>" class="post-body" >
	<?php 
		$title = get_the_title(); 
		if ( strlen( $title ) > 0 ){
	?>
		<h2><?php echo $title ?></h2>
	<?php } ?>
	<div class="entry-content">
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'shit' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'shit' ),
				'after'  => '</div>',
			) );
		?>
	<!-- .entry-c0ntent -->
</article><!-- #post-## -->
