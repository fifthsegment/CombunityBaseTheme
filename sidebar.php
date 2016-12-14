<?php if ( combunity_sidebar_enabled() ) : ?>
<div class="<?php combunity_sidebar_class_for_sidebar() ?>">
	<div class="combunity-forum-sidebar">
		<?php dynamic_sidebar( 'forum-sidebar' ) ?>
	</div>
	

</div>
<?php endif; ?>