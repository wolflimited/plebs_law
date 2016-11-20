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
                    <?php echo $form; ?>
                </div>
                <div class="loginButtonContainer">
                	<?php echo form_button(array('type' => 'submit','class' => 'loginButton','style' => 'margin-left: 10px;','content' => '<div class="fi-arrow-right"></div>')); ?>
                </div>
            </div>
		<?php
			echo form_close();
		?>
		<div class="row">
			<div class="medium-12 columns">
				<div style="padding: 10px; overflow: hidden;">
					<a class="right" href="<?php echo site_url('auth/register'); ?>">Register</a>
				</div>
			</div>
		</div>
        <div class="medium-12 columns loginFooter">
        	<h3 style="color: #fff; text-align: center; font-family: Cambria, 'Hoefler Text', 'Liberation Serif', Times, 'Times New Roman', serif;">NOS POPUIUS</h3>
        </div>
	</div>
</main>