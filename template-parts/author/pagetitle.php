<?php

$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

?>
<div class="top-section top-section-sub-nospace text-center">

	<div class="text-center">
		<?php echo Combunity_Api()->get_avatar( $curauth->ID ); ?>
	</div>
	
	<h3><?php echo $curauth->user_login ?></h3>

	<div style="font-size:12px;"> 

		<a href="<?php echo remove_query_arg( 'combunity_user_comments', add_query_arg('','') ); ?>"><?php echo __("Threads") ?></a>

		|

		<a href="<?php echo add_query_arg( 'combunity_user_comments', '' ); ?>"><?php echo __("Replies") ?></a> 



	</div>

</div>