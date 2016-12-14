<?php get_header(); ?>
<div class="container-fluid main-container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="<?php combunity_sidebar_class_for_body() ?>">
					<div class="single-post">
						<?php
						if ( have_posts() ) :

							/* Start the Loop */

							while ( have_posts() ) : the_post();
							
								Co_increment_the_thread_views();

								get_template_part( 'template-parts/cpost', get_post_format() );

								get_template_part( 'template-parts/cpost/cpost', 'body' );

								

					 			comments_template();

							endwhile;

						else :

							get_template_part( 'template-parts/empty', 'none' );

						endif; ?>
					</div>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>
<?php get_footer(); ?>