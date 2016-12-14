<div class="combunity-forum-post-title">
	<?php if ( Combunity_Api()->is_sticky()) : ?>
		<i class="fa fa-thumb-tack" aria-hidden="true"></i>
	<?php endif; ?>


	<a href='<?php echo get_comments_link( get_the_ID() ) ?>' class=''>
		<?php echo get_the_title() ?>
	</a>

	<?php
		// Begin loading tags for this post
		$posttags = get_the_terms( get_post(), 'cforum' );
		if ( $posttags && sizeof($posttags) > 0 ) :
			$tag = $posttags[0];
			$tagcolor = '#' . Combunity_Api()->get_forum_meta( $tag , 'custom_color', 'FFFFFF' );;
			$taglink = get_term_link( $tag );
			// var_dump( $tag );
			$tagname = $tag->name;
			// var_dump( $posttags );
	?>
		<span class="pull-right"><span class="tag combunity-tag-color"><span class="combunity-widget-sub-color" style="background-color: <?php echo $tagcolor ?>"></span><span class="combunity-forum-post-tag-text"><a href="<?php echo $taglink ?>"><?php echo $tagname; ?></a></span></span></span>
	<?php endif; ?>
	
</div>