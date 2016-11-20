<main class="dashboard">
	<div class="row">
		<?php 
			
			echo form_open_multipart('',array('class' => 'medium-12 columns','data-abide' => ''));
		?>
			<div class="row">
				<div class="medium-12 columns">
					<h4>Create Case</h4>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<label for="title">
						Title
						<?php echo form_input(array('name' => 'title','type' => 'text','placeholder' => 'Title')); ?>
					</label>
				</div>
			</div>
			<div class="row">
                <div class="medium-12 columns">
                    <label>
                        Thumbnail
						<?php echo form_input(array('name' => 'thumbnail','type' => 'file')); ?>
                    </label>
                </div>
                <div id="uploader" class="medium-12 columns">
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    Evidence Files
                </div>
                <div id="uploader" class="medium-12 columns">
                </div>
            </div>
            <div class="row">
                <div class="medium-12 columns">
                    <label>
                        Evidence Links
                        <div class="repeater">
                            <div data-repeater-list="urls">
                                <div data-repeater-item>
                                    <div class="medium-10 columns" style="padding-left: 0;">
                                        <?php echo form_input(array('name' => 'urls[0][text]','type' => 'text','placeholder' => 'URL')) ?>
                                    </div>
                                    <div class="medium-2 columns" style="padding-right: 0; padding-top: 10px;">
                                        <?php echo form_input(array('class' => 'right button alert','data-repeater-delete' => '','type' => 'button','value' => 'x')); ?>
                                    </div> 
                                </div>
                            </div>
                            <?php echo form_input(array('class' => 'right button','data-repeater-create' => '','type' => 'button','style' => 'margin-right: 0px;','value' => 'Add Another URL')); ?>
                        </div>
                    </label>
                </div>
            </div>
			<div class="row">
				<div class="medium-12 columns">
					<label for="subject">
						Subject Matter
						<?php echo form_textarea(array('class' => 'maxlength','name' => 'subject','type' => 'text','placeholder' => 'Subject','data-maxlength' => '600')); ?>
					</label>
					<br>
				</div>
			</div>
            <div class="row">
				<div class="medium-12 columns">
					<label for="reason">
						Reason for case submission
						<?php echo form_textarea(array('class' => 'maxlength','name' => 'reason','type' => 'text','placeholder' => 'Reason','data-maxlength' => '600')); ?>
					</label>
					<br>
				</div>
			</div>
            <div class="row">
				<div class="medium-12 columns">
					<label for="claim">
						Prosecutors claim
						<?php echo form_textarea(array('class' => 'maxlength','name' => 'claim','type' => 'text','placeholder' => 'Claim','data-maxlength' => '600')); ?>
					</label>
					<br>
				</div>
			</div>
            <div class="row">
				<div class="medium-12 columns">
					<label for="grounds">
						Legal grounds
						<?php echo form_textarea(array('class' => 'maxlength','name' => 'grounds','type' => 'text','placeholder' => 'Legal grounds','data-maxlength' => '600')); ?>
					</label>
					<br>
				</div>
			</div>
            <div class="row">
				<div class="medium-12 columns">
					<label for="precedence">
						Legal precedence
						<?php echo form_textarea(array('class' => 'maxlength','name' => 'precendence','type' => 'text','placeholder' => 'Legal precedence','data-maxlength' => '600')); ?>
					</label>
					<br>
					<br>
				</div>
			</div>
            <div class="row">
				<div class="medium-12 columns">
					<div class="row">
						<div class="medium-6 columns">
							<label for="start_of_incident">
								Date of incident
								<?php echo form_input(array('name' => 'start_of_incident','class' => 'datepickerinput','type' => 'text','placeholder' => 'Start Date')); ?>
							</label>
						</div>
						<div class="medium-6 columns">
							<label for="end_of_incident">
								Date of incident
								<?php echo form_input(array('name' => 'end_of_incident','class' => 'datepickerinput','type' => 'text','placeholder' => 'End Date')); ?>
							</label>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					Prosecuting for case
					<div class="switch small">
					  <input id="prosecuting" type="checkbox" name="prosecuting">
					  <label for="prosecuting"></label>
					</div> 
				</div>
			</div>
			<div class="row">
				<div class="medium-12 columns">
					<?php echo form_button(array('type' => 'submit','class' => 'right buttonAlt2','content' => 'Submit Case For Moderation')); ?>
				</div>
			</div>
		<?php
			echo form_close();
		?>
	</div>
</main>