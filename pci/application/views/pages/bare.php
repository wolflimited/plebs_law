<article class="row">
	<?php 
		if(isset($title) && $title != ''){
			?>
				<header class="medium-12 columns">
					<h4><?php echo $title; ?></h4>
				</header>
			<?php
		}
	?>
	<section class="medium-12 columns">
		<?php
			echo $content;
		?>
	</section>
</article>