<?php get_header(); ?>
<div class="container-fluid main-container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="<?php combunity_sidebar_class_for_body() ?>">
					<?php
					if ( have_posts() ) :

						/* Start the Loop */
						while ( have_posts() ) : the_post();

							get_template_part( 'template-parts/cpost/cpost', 'special' );

							get_template_part( 'template-parts/cpost/cpost', 'body' );
						

				 			comments_template();

						endwhile;

					else :
						
						get_template_part( 'template-parts/empty', 'post' );

					endif; ?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>
<?php get_footer(); ?>