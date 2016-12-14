<div class="combunity-forum-post-avatar-container combunity-col">
	<div class="">
		<?php 
			// Get avatar of user with most recent comment
			$comment = ( Combunity_Api()->the_last_comment() );
			if ( $comment ) : 
				$avatar = Combunity_Api()->get_avatar( $comment );
				echo $avatar;
		?>
		<?php else : ?>
			<?php
				// Get avatar of post author
				$avatar = Combunity_Api()->get_avatar( get_post() );
				echo $avatar;
			?>
		<?php endif ?>
	</div>						
</div>