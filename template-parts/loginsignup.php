<!-- <div class="row combunity-login-modal">
	<div class="col-sm-6" style="text-align:center">
		<img src="http://www.combunity.com/wp-content/uploads/2016/05/1463055499_upvote-like-icon-tm-300x297.png" width="160">
		<br>
		<a href="<?php echo wp_registration_url(); ?>">Register</a>
	</div>
	<div class="col-sm-6">
		<?php 
			$args = array();
			wp_login_form( $args ); 
		?>
	</div>
</div> -->

    	<div id="combunity-login-div"  class="">
    		<div class="bootstrap-iso">
    			<div class="row combunity-light-form-bg combunity-login-form-bg">
    				<div class="col-md-1"></div>
    				<div class="col-md-10">
    					<h3 class="combunity-modal-title"><?php echo __("You must be logged in to use ", "combunity"); ?><?php echo get_bloginfo() ?></h3>
    				</div>
    				<div class="col-md-1"></div>
    			</div>
                <div class="row combunity-plugin-login-modal-social-login-container">
                    <div class="col-md-1">
                        
                    </div>
                    <div class="col-md-10">
                        <div class="text-center combunity-default-font">
                            <?php 
                            $social_plugin_enabled =false;
                            ob_start(); ?>
                            <?php echo do_shortcode ( '[wordpress_social_login]' ); ?>
                            <?php $social_html = ob_get_clean(); 
                                if ( !strpos($social_html,"[wordpress_social_login]")){
                                    $social_plugin_enabled = true;
                                    echo $social_html;
                                }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-1">
                        
                    </div>
                </div>
                <?php if ($social_plugin_enabled): ?>
                <div class="row combunity-plugin-login-modal-dialog-text">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                        <div class="text-center">
                            <span class="combunity-plugin-login-modal-show-email-form combunity-default-font" style="cursor:pointer">Or<br>
                            <a href="#" class="combunity-default-font combunity-default-color ">Click here to use your email address</a></span>
                            <span style="display:none" class="combunity-plugin-login-modal-show-email-form-back combunity-default-font combunity-default-color">Back to social login</span>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
                <?php endif; ?>
    			<div class="row combunity-plugin-login-modal-form-fields-container combunity-light-form-bg combunity-font combunity-login-form-bg" style="<?php if ($social_plugin_enabled) { echo "display:none;"; } ?>">
    				<div class="col-md-1"></div>
    				<div class="col-md-5 combunity-section-signup">
    					<?php
    					// $form_fields = "";
    					// $fields_container = $ref->users->get_fields();
    					// foreach ($fields_container as $field) {
	    				// 		$field_html = '<div class="field form-group '.$token.'-field-group">
	    				// 		<span class="signup-form-field">'.$field["title"].'</span><br>
	    				// 		<input type="'.$field["type"].'" name="'.$field["name"].'" class="'.$token.'-width-100 '.$token.'-input-control">
	    				// 	</div>';
	    				// 	$form_fields .= $field_html;
    					// }
    				?>
    				<form id="combunity-signup-form" class="combunity-signup-form" style="">
    					<h4 class='combunity-font combunity-dark-blue-color combunity-login-form-headings'>Signup</h4>
    					<div class="field form-group combunity-field-group">
                            <span class="login-form-field">Username</span><br>
                            <input type="text" name="signup_username" class="combunity-width-100 combunity-input-control">
                        </div>
                        <div class="field form-group combunity-field-group">
                            <span class="login-form-field">Email</span><br>
                            <input type="text" name="signup_email" class="combunity-width-100 combunity-input-control">
                        </div>
                        <div class="field form-group combunity-field-group">
                            <span class="login-form-field">Password</span><br>
                            <input type="password" name="signup_password" class="combunity-width-100 combunity-input-control">
                        </div>
    					<div class="field form-group combunity-field-group">
    						<input type="submit" value="<?php echo __("Sign Up")?>" class="combunity-btn combunity-forums-button combunity-btn-blue combunity-font">
    					</div>
    					<div class="combunity-validation-msg">
    					</div>
    				</form>
    			</div>

    			<div class="col-md-5 combunity-section-login">
    				<form id="combunity-login-form" class="combunity-login-form" style="">
    					<h4 class='combunity-login-form-headings combunity-font combunity-dark-blue-color'>Login</h4>
    					<div class="field form-group combunity-field-group">
    						<span class="login-form-field">Username</span><br>
    						<input type="text" name="user_login" class="combunity-width-100 combunity-input-control">
    					</div>
    					<div class="field form-group combunity-field-group">
    						<span class="login-form-field">Password</span><br>
    						<input type="password" name="user_password" class="combunity-width-100 combunity-input-control">
    					</div>
    					<div class="field form-group combunity-field-group">
    						<input type="submit" value="<?php echo __("Login")?>" class="combunity-btn combunity-btn-blue combunity-font combunity-forums-button">
    					</div>
    					<div class="combunity-validation-msg">
    					</div>
    				</form>
    			</div>
    			<div class="col-md-1"></div>
    		</div>
    	</div>
    </div>

