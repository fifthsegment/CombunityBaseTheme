<?php get_header(); ?>
<div class="container-fluid main-container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="<?php combunity_sidebar_class_for_body() ?>">
					<?php

					get_template_part( 'template-parts/author/pagetitle', '' );

					$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

					if ( !isset( $_GET['combunity_user_comments'] ) ):

						$args = array( 
							'author' => $curauth->ID, 
							'post_type' => 'cpost',
							'offset' => Co_get_pagination_offset(), 
							'paged' => get_query_var( 'page' ) ? get_query_var( 'page' ) : 1,
	 					);

						$the_query = new WP_Query( $args );

						if ( $the_query->have_posts() ) :

							/* Start the Loop */
							while ( $the_query->have_posts() ) : $the_query->the_post();

								get_template_part( 'template-parts/cpost', get_post_format() );


							endwhile;

							$pagination_args = array();

							?>

							<div class="combunity-pagination">

								<?php echo paginate_links( $args ); ?>

							</div>	
							

							<?php

							wp_reset_postdata();

						else :

							get_template_part( 'template-parts/empty', 'user' );

						endif; 

					endif;

					if ( isset( $_GET['combunity_user_comments'] ) ):

						?>

						<ul class="comment-list" style="overflow:auto;">
						
						<?php

						$total_comments = get_comments( 
							array(
								"count" => true, 
								'user_id' => $curauth->ID
								) 
						);
						// print "<h1>Total Comments</h1>";
						// var_dump( $comments_per_page );
						// var_dump( $total_comments );
						// $total_comments = intval(ceil($total_comments/$comments_per_page));
						// $total_comments = 
						// $this->total_user_comments = $total_comments;
						$comment_args = array(
							// 'number' => $comments_per_page,
							// 'offset' => $commentoffset,
							'orderby' => 'comment_date',
							'order' => 'DESC',
							'user_id' => $curauth->ID,
							'count' => false,
							'post_type' => 'cpost',
							'offset' => Co_get_pagination_offset()
						);

						$user_comments = get_comments( $comment_args );

						foreach ($user_comments as $comment ) {
							# code...
							$GLOBALS['comment'] = $comment;

							get_template_part( 'template-parts/comment-single', 'authorpage' );

						}

						?>

						</ul>

						<?php
						// var_dump(sizeof($user_comments));
						// $this->current_user_comments = $user_comments;

					endif;




					?>
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>
<?php get_footer(); ?>

