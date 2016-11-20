<article class="row">
	<header class="medium-12 columns">
		<div class="row">
			<div class="medium-12 columns">
				<h4>Application to Judge</h4>
			</div>
		</div>
	</header>
	<section class="medium-12 columns">
		<?php
			if($message != ''){
				?>
					<div data-alert class="alert-box <?php echo $level; ?>">
						<?php echo $message; ?>
					</div>
				<?php
			}
		?>
		<div class="row">
			<?php
				echo form_open('',array('class' => 'medium-12 columns','data-abide' => ''));
					echo form_textarea(array('name' => 'message','placeholder' => 'Application Letter.'));
					echo form_button(array('type' => 'submit','class' => 'right button','style' => 'margin-right: 0;','content' => 'Apply')); 
				echo form_close();
			?>
		</div>
	</section>
</article>