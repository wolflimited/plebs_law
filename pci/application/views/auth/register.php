<div class="row">
	<?php 
		echo $message;
		echo form_open('',array('class' => 'medium-12 columns','data-abide' => ''));
	?>
		<div class="row">
			<div class="medium-12 columns">
				<h4>Registration</h4>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label for="username">
					Username 
					<?php echo form_input($username); ?>
				</label>
			</div>
		</div>
		<!-- add bamtino image modifier. -->
		<div class="row">
			<div class="medium-12 columns">
				<label for="firstname">
					First Name
					<?php echo form_input($firstname); ?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label for="surname">
					Surname 
					<?php echo form_input($surname); ?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<div class="row">
					<div class="medium-12 columns">
						Date of Birth
					</div>
				</div>
				<div class="row">
					<div class="medium-4 columns">
						<label for="day">
							<small>Day</small>
							<?php
								echo form_dropdown('day',$days);
							?>
						</label>
					</div>
					<div class="medium-4 columns">
						<label for="month">
							Month
							<?php
								echo form_dropdown('month',$months);
							?>
						</label>
					</div>
					<div class="medium-4 columns">
						<label for="year">
							Year
							<?php
								echo form_dropdown('year',$years);
							?>
						</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label>
					Email 
					<?php echo form_input($email); ?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label>
					Password 
					<?php echo form_input($password); ?>
				</label>
			</div>
		</div>
		<div class="row">
			<div class="medium-12 columns">
				<label>
					Confirm Password 
					<?php echo form_input($confirm_password); ?>
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
