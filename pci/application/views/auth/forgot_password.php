<div class="row">
	<?php 
		echo validation_errors();
		echo form_open('',array('class' => 'medium-12 columns','data-abide' => ''));
	?>
		<div class="row">
			<div class="medium-12 columns">
				<h4>Forgot Password</h4>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label for="email">
					Email
					<?php echo form_input($email); ?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<?php echo form_button($submit); ?>
				<a class="right button" href="<?php echo site_url('auth/login'); ?>">Login</a>
			</div>
		</div>
	<?php
		echo form_close();
	?>
</div>
