<?php

?>
<div class='combunity-voting-bar combunity-voting-bar-comment' data-postId='<?php comment_ID() ?>'>
	<div class='combunity-vote-bar-container'>
		<div class='combunity-voting-bar-vote-comment combunity-vote-up <?php Co_the_comment_voted_class('up')?> $additional_class_up combunity-login-required' data-posttype='up'>
		</div>
	</div>

	<div class='combunity-vertical-spacer'></div>

	<div class='combunity-vote-bar-container'>
		<div class='combunity-voting-bar-vote-comment combunity-vote-down <?php Co_the_comment_voted_class('down')?> $additional_class_down combunity-login-required' data-posttype='down'></div>
	</div>
</div>