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

						$args = Combunity_Api()->get_query_args_for_front_page();

						$args['paged'] = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

						$query = new WP_Query( $args );

						if ( $query->have_posts() ) :

							/* Start the Loop */
							while ( $query->have_posts() ) : $query->the_post();

								get_template_part( 'template-parts/cpost', get_post_format() );

							endwhile;

						else :

							get_template_part( 'template-parts/empty', 'none' );

						endif; ?>

					</div>
					<div class="combunity-pagination">

						<?php 

							$pagination = array(
								'total' => $query->max_num_pages,
								'current' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
							);	

							echo paginate_links( $pagination ); 

						?>
						
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
