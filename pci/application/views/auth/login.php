<main class="loginBody">
	<div class="row" style="background: #4f6773;">
		<?php
			echo validation_errors();
			echo form_open('',array('autocomplete' => 'off','class' => 'medium-12 columns','data-abide' => ''));
		?>
			<div class="row">
				<div class="medium-12 columns">
					<img style="width: 100%;" src="<?php echo site_url('img/plebs.png'); ?>">
				</div>
			</div>
            <div class="row loginContainer">
            	<div class="medium-12 columns">
                    <label class="row userEmail">
                        <div class="small-1 medium-1 columns">
                            <div class="fi-torso"></div>
                        </div>
                        <div class="small-10 medium-10 columns">
                            <?php echo form_input($username); ?>
                        </div>
                    </label>
                    <label class="row userPassword">
                        <div class="small-1 medium-1 columns">
                            <div class="fi-lock"></div>
                        </div>
                        <div class="small-10 medium-10 columns">
                            <?php echo form_input($password); ?>
                        </div>
                    </label>
                </div>
                <div class="loginButtonContainer">
                	<?php echo form_button($submit); ?>
                </div>
            </div>
		<?php
			echo form_close();
		?>
		<div class="row">
			<div class="medium-12 columns">
				<div style="padding: 10px; overflow: hidden;">
					<a class="right button" href="<?php echo site_url('auth/reset_password'); ?>">Forgot Password?</a>
					<a class="right button" href="<?php echo site_url('auth/register'); ?>">Register</a>
				</div>
			</div>
		</div>
        <div class="medium-12 columns loginFooter">
        	<h3 style="color: #fff; text-align: center; font-family: Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">NOS POPUIUS</h3>
        </div>
	</div>
</main>