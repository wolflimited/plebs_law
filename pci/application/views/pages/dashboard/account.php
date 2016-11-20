<main class="dashboard">
	<div class="row" style="padding-top: 20px;">
        <div class="medium-12 columns">
            <div class="row">
                <?php 
                    echo validation_errors();
                    echo form_open('',array('class' => 'medium-12 columns','data-abide' => ''));
                ?>
                    <div class="row">
                        <div class="medium-12 columns">
                            <h4>Account</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            Username: <?php echo $username; ?>
							<br>
							<br>
                        </div>
                    </div>
                    <!-- add bamtino image modifier. -->
                    <div class="row">
                        <div class="medium-12 columns">
                            <label>
                                First Name
                                <?php echo form_input(array('name' => 'firstname','type' => 'text','placeholder' => 'First Name', 'value' => $firstname)); ?>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            <label>
                                Surname 
                                <?php echo form_input(array('name' => 'surname','type' => 'text','placeholder' => 'Surname','value' => $surname)); ?>
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
                                <?php echo form_input(array('name' => 'email','type' => 'email','placeholder' => 'Email','value' => $email)); ?>
                            </label>
                        </div>
                    </div>
					<div class="row">
                        <div class="medium-12 columns">
                            <h4>Settings</h4>
                        </div>
                    </div>
					<div class="row">
                        <div class="medium-6 columns">
							<div class="row">
								<div class="medium-12 columns">
									In Jury Pool
									<div class="switch small">
									  <input id="jury" type="checkbox" name="jury" <?php echo $jury; ?>>
									  <label for="jury"></label>
									</div> 
								</div>
							</div>
                        </div>
						<div class="medium-6 columns">
                        </div>
                    </div>
					<div class="row">
                        <div class="medium-12 columns">
                            <h4>Roles</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            <h4>Reset Password</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            <label>
                                Password 
                                <?php echo form_input(array('name' => 'password','type' => 'password','placeholder' => 'Password')); ?>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            <label>
                                Confirm Password 
                                <?php echo form_input(array('name' => 'cpassword','type' => 'password','placeholder' => 'Confirm Password')); ?>
                            </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="medium-12 columns">
                            <label>
                                <?php echo form_button(array('type' => 'submit','class' => 'right buttonAlt2','style' => '','name' => 'update','content' => 'Update')); ?>
                            </label>
                        </div>
                    </div>
                <?php
                    echo form_close();
                ?>
            </div>
        </div>
    </div>
</main>