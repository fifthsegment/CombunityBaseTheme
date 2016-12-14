<?php get_header(); ?>
<div class="container-fluid main-container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="<?php combunity_sidebar_class_for_body() ?>">
				
					<div class="combunity-box combunity-front-page">

						<?php
						if ( have_posts() ) :

							/* Start the Loop */
							while ( have_posts() ) : the_post();

								get_template_part( 'template-parts/cpost', get_post_format() );

							endwhile;

						else :

							get_template_part( 'template-parts/empty', 'none' );

						endif; ?>

					</div>

					<div class="combunity-pagination">

						<?php echo paginate_links( ); ?>
						
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
