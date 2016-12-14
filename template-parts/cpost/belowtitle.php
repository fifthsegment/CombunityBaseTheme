<span class="combunity-forum-post-author-post-info combunity-forum-icon-color">
	<?php 
		$comment = Combunity_Api()->the_last_comment();
		$ago = "";
		if (  $comment  ) : 
			// This means the last action on this thread was someone's reply

			$author = get_comment_author( $comment->ID );

			$ago = Combunity_Api()->get_comment_time( $comment );

			$ago = human_time_diff( $ago, current_time( 'timestamp' ) );

			$curauth = get_user_by('slug', $author);

			$profile_link =get_author_posts_url($curauth->ID);
			
			?>
			<a href="<?php echo $profile_link ?>"><i class="fa fa-reply combunity-forum-icon" aria-hidden="true"></i><?php echo $author ?></a> <?php echo __('replied') ?> 
	<?php else : ?>
	<?php 
		$ago = human_time_diff( get_the_time('U'), current_time('timestamp') );
		$profile_link = Combunity_Api()->the_userprofile_link();
		$author = get_the_author();
	?>
		<a href="<?php echo $profile_link ?>" class="combunity-forum-post-author-link"><?php echo $author ?></a> <?php echo __('created') ?>
	<?php endif; ?>
	<?php echo $ago ?> <?php echo __('ago'); ?> 
	<?php  ?>
</span>