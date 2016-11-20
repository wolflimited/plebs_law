<article class="row">
	<?php
		if($this->input->get() && $this->input->get('message') && $this->input->get('status')){
			?>
				<section class="medium-12">
					<div data-alert class="alert-box <?php echo $this->input->get('status'); ?>">
						<?php echo $this->input->get('message'); ?>
					</div>
				</section>
			<?php
		}
	?>
	<section class="medium-12">
		<section class="row">
			<section class="medium-8 columns">
				<article id="quick_tutorial_second" class="medium-12 columns item-container">
					<header class="row">
						<div class="medium-12 columns">
							<div class="row">
								<div class="medium-6 columns">
									<h4>Cases</h4>
								</div>
								<div class="medium-6 columns">
									<a id="quick_tutorial_third" class="button right" href="<?php echo site_url('cases/create'); ?>">Add Case</a>
								</div>
							</div>
						</div>
					</header>
					<section class="row">
						<div class="medium-12 columns">
							<?php
								echo $cases;
							?>
						</div>
					</section>
				</article>
				<article class="medium-12 columns item-container">
					<header class="row">
						<div class="medium-12 columns">
							<div class="row">
								<div class="medium-6 columns">
									<h4>Latest</h4>
								</div>
							</div>
						</div>
					</header>
					<section class="row">
						<div class="medium-12 columns">
							<?php
								echo $latest_cases;
							?>
						</div>
					</section>
				</article>
			</section>
			<section class="medium-4 columns">
				<article class="medium-12 columns item-container">
					<header class="row">
						<div class="medium-12 columns">
							<div class="row">
								<div class="medium-6 columns">
									<h4>Notifications</h4>
								</div>
							</div>
						</div>
					</header>
					<section class="row">
						<div class="medium-12 columns">
						</div>
					</section>
				</article>
			</section>
		</section>
	</section>
    <section class="row">
        <div class="medium-12 columns">
            <article class="addarticle">
                <div class="articleinner addinner">
                    <div class="articlecontent add">+</div>
                </div>
            </article>
            <?php 
                if(is_array($cases)){
                    foreach($cases as $case){
                        ?>
                            <article>
                                <div class="articleinner">
                                    <div class="articlecontent" ontouchstart="this.classList.toggle('hover');">
                                        <div class="flipper">
                                            <div class="front"  style="background: url('<?php echo $case->thumbnail; ?>') no-repeat; background-size: 100% 100%; ">
                                                <header>                            
                                                    <div class="banner yours">
                                                        <div class="fi-torso">Defending</div> 
                                                    </div>                            
                                                </header>
                                            </div>
                                            <div class="back">
                                                <section>
                                                    <h3><?php echo $case->title; ?></h3>
                                                </section>
                                                <footer>

                                                </footer>
                                            </div>
                                        </div>
                                    </div>
                                </div>	
                            </article>
                        <?php
                    }
                }
            ?>
        </div>
    </section>
</article>