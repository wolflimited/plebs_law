<main>
	<div class="row">
		<div class="medium-12 columns">
			<?php if($this->session->flashdata('errors')){ ?>
				<div data-alert class="alert-box alert">
					<?php echo $this->session->flashdata('errors'); ?>
				</div>
			<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="medium-6 columns">
			<?php
				echo form_open('auth/register',array('autocomplete' => 'off','class' => 'medium-12 columns','data-abide' => ''));
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
						<?php echo form_input($rusername); ?>
					</label>
				</div>
			</div>
			<!-- add bamtino image modifier. -->
			<div class="row">
				<div class="medium-12 columns">
					<label for="firstname">
						First Name
						<?php echo form_input($rfirstname); ?>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<label for="surname">
						Surname 
						<?php echo form_input($rsurname); ?>
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
									echo form_dropdown('day',$rdays);
								?>
							</label>
						</div>
						<div class="medium-4 columns">
							<label for="month">
								Month
								<?php
									echo form_dropdown('month',$rmonths);
								?>
							</label>
						</div>
						<div class="medium-4 columns">
							<label for="year">
								Year
								<?php
									echo form_dropdown('year',$ryears);
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
						<?php echo form_input($remail); ?>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<label>
						Password 
						<?php echo form_input($rpassword); ?>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<label>
						Confirm Password 
						<?php echo form_input($rconfirm_password); ?>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<?php echo form_button($rsubmit); ?>
				</div>
			</div>
			<?php
				echo form_close();
			?>
		</div>
		<div class="medium-6 columns">
			<?php
				echo validation_errors();
				echo form_open('auth/login',array('autocomplete' => 'off','class' => 'medium-12 columns','data-abide' => ''));
			?>
			<div class="row">
				<div class="medium-12 columns">
					<h4>Login</h4>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<label for="username">
						Username 
						<?php echo form_input($lusername); ?>
					</label>
				</div>
			</div>
			<!-- add bamtino image modifier. -->
			<div class="row">
				<div class="medium-12 columns">
					<label for="firstname">
						Password
						<?php echo form_input($lpassword); ?>
					</label>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<?php echo form_button($lsubmit); ?>
				</div>
			</div>
			<?php
				echo form_close();
			?>
		</div>
	</div>
</main>