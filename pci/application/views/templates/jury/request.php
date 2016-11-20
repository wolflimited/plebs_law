<article class="row">
	<header class="medium-12 columns">You have been invited to jury service for <?php echo $case->title; ?></header>
	<footer class="medium-12 columns">
		<div class="row">
			<div class="medium-12 columns">
				<button type="button" class="right button buttonAlt2 smallButton decline_form_button" style="margin-bottom: 0;">Decline</button>
				<?php echo anchor('jury?action=accept&id=' . $id,'Accept',array('class' => 'right button buttonAlt2 smallButton','style' => 'margin-bottom: 0;')); ?>
				<?php echo anchor('cases?id=' . $case->id,'View More',array('class' => 'right button buttonAlt2 smallButton','style' => 'margin-bottom: 0;','target' => '_blank')); ?>
			</div>
		</div>
		<div class="row">
				<?php 
					echo validation_errors();
					echo form_open('',array('class' => 'decline_form medium-12 columns','data-abide' => '','style' => 'display: none; margin-top: 20px;'));
						echo form_textarea(array('name' => 'reason','placeholder' => 'Reason for decline.'));
						echo form_input(array('type' => 'hidden','name' => 'id','value' => $id));
						echo form_button(array('type' => 'submit','class' => 'right button buttonAlt2 smallButton','style' => '','content' => 'Decline')); 
					echo form_close();
				?>
		</div>
	</footer>
</article>