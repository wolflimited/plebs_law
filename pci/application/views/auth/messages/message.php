<main class="row">
	<section class="medium-12 columns">
		<div data-alert class="alert-box <?php echo $status; ?>">
			<?php 
				if(is_array($message)){
					foreach($message as $item){
						echo $item;
					}
				}else{
					echo $message;
				}
			?>
		</div>
	</section>
</main>