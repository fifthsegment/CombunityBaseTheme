<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package combunity-child
 */

?>
<article>
<?php

//print $current_page_type;
?>
	<div class="row row-eq-height cpost">
		<div class="col-md-12 col-sm-12 col-xs-12" style="">
			<div class="combunity-forum-table-row-background <?php combunity_is_first() ?>">
				<div class="row row-eq-height combunity-forum-table-row combunity-forum-post-single-row">
					<div class="col-md-10 col-sm-10 col-xs-12 combunity-forum-post-row-column combunity-forum-post-row-post-title-container">
						<div class="combunity-row">
							<?php get_template_part( 
								'template-parts/cpost/user-profile-section', 'none' ); 
							?>
							<div class="combunity-col combunity-forum-post-info-container">
								<?php
									get_template_part('template-parts/cpost/title', '');
								?>
								<div class="combunity-row">
									<div class="combunity-col">
										<?php get_template_part('template-parts/cpost/belowtitle', ''); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-2 col-sm-2  hidden-xs combunity-forum-post-row-column text-center">
						<div>
							<span class="combunity-forum-post-icon-block combunity-forum-icon-color"><i class="fa fa-comments-o combunity-forum-icon-2 combunity-forum-icon-color" aria-hidden="true"></i><?php echo get_comments_number(); ?></span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
