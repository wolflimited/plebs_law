<?php
    //template for moderation item
    ?>
    <article class="caseContainerAlt2 row collapse" style="margin-top: 20px;">
        <div class="medium-12 columns">
            <header class="row">
                <div class="medium-12 columns">
                    <h6><?php echo $case->title; ?> needs moderation.</h6>
                </div>
            </header>
            <section class="row">
                <div class="medium-12 columns content">
                    <p><?php echo $case->subject; ?></p>
                </div>
            </section>
            <footer class="row details collapse">
				<div class="medium-12 columns">
					<div class="row">
						<div class="medium-12 columns">
							Submitted on <time datetime="<?php echo $case->creation; ?>"><?php echo $case->creation; ?></time> by <?php echo nice_name($user_id); ?>
						</div>
					</div>
					<div class="row" style="margin-top: 20px;">
						<div class="medium-12 columns">
							<button type="button" class="right button buttonAlt2 smallButton decline_form_button" style="margin-bottom: 0;">Decline</button>
							<?php echo anchor('judge?action=approve&id=' . $case->id,'Approve',array('class' => 'right button buttonAlt2 smallButton','style' => 'margin-bottom: 0;')); ?>
							<?php echo anchor('cases?id=' . $case->id,'View More',array('class' => 'right button buttonAlt2 smallButton','style' => 'margin-bottom: 0;')); ?>
						</div>
					</div>
					<div class="row">
							<?php 
								echo validation_errors();
								echo form_open('',array('class' => 'decline_form medium-12 columns','data-abide' => '','style' => 'display: none; margin-top: 20px;'));
									echo form_textarea(array('name' => 'reason','placeholder' => 'Reason for decline.'));
									echo form_input(array('type' => 'hidden','name' => 'id','value' => $case->id));
									echo form_button(array('type' => 'submit','class' => 'right button buttonAlt2 smallButton','style' => '','content' => 'Decline')); 
								echo form_close();
							?>
					</div>
				</div>
            </footer>
        </div>
    </article>