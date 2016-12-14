<?php get_header(); ?>
<div class="container-fluid main-container">
	<div class="row">
		<div class="col-md-1">
		</div>
		<div class="col-md-10">
			<div class="row">
				<div class="<?php combunity_sidebar_class_for_body() ?>">
					<?php

					?>
					<div class="combunity-404-page combunity-box">
						<h1>404 </h1>
						<h2>Oops, the page you're looking for does not exist.</h2>
						<p>
				          You may want to head back to the homepage.
				          <br>
				            If you think something is broken, report a problem.
				          <br>
				        </p>
				        <br>
				        <div class="row">
				        	<div class="col-xs-6">
				        		<a href="<?php echo site_url() ?>"><span class="btn btn-primary">Return Home</span></a>
				        	</div>
				        	<div class="col-xs-6">
				        		<a href="<?php echo site_url('contact') ?>"><span class="btn btn-warning">Report Problem</span></a>
				        	</div>
				        	
				        	
				        </div>
				        
					</div>
					
				</div>
				<?php get_sidebar(); ?>
			</div>
		</div>
		<div class="col-md-1">
		</div>
	</div>
</div>
<?php get_footer(); ?>