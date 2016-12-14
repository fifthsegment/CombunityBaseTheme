<?php

get_template_part('template-parts/comment-single');

$link = get_post_permalink( $GLOBALS['comment']->comment_post_ID );

?>
<div class="view-thread-btn" onclick="location.href='<?php echo $link ?>';">View Thread</div>
