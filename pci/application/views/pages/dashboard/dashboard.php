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
	<section class="medium-12 columns">
        <section class="row teaser">
            <div class="medium-12 columns">
                <article class="addarticle">
                    <a href="<?php echo site_url('cases/create'); ?>">
                        <div class="articleinner addinner">
                            <div class="articlecontent"><div class="fi-plus"></div></div>
                        </div>
                    </a>    
                </article>
                <?php 
                    if(is_array($cases)){
                        foreach($cases as $case){
                            ?>
                                <article>
                                    <a href="<?php echo site_url('cases') . '?id=' . $case->id; ?>">
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
                                    </a>    
                                </article>
                            <?php
                        }
                    }
                ?>
            </div>
        </section>
    </section>    
</article>