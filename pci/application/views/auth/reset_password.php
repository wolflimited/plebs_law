<div class="row">
	<?php 
		echo validation_errors();
		echo form_open('',array('class' => 'medium-12 columns','data-abide' => ''));
	?>
		<div class="row">
			<div class="medium-12 columns">
				<h4>Reset Password</h4>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label for="password">
					Password
					<?php echo form_input($password); ?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label for="confirm_password">
					Confirm Password
					<?php echo form_input($confirm_password); ?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label>
					<?php 
						echo form_hidden($csrf);
						echo form_hidden($user_id);
						echo form_button(array('type' => 'submit','class' => 'right','style' => '','content' => 'Reset Password')); ?>
				</label>
			</div>
		</div>
	<?php
		echo form_close();
	?>
</div>
