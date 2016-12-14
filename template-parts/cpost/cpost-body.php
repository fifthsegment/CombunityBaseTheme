<div class="post-body">
	<div class="post-container">
		<?php 
	
			the_content();

		?>
	</div>
	<div class="combunity-thread-actions">
		<span><?php
			echo Combunity_Api()->get_edit_thread_link( );		
		?>
		</span>
		<span><?php
			echo Combunity_Api()->get_delete_thread_link( );
		?></span>		
	</div>

</div>
