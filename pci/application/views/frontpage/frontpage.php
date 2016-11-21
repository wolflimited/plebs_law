<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
			<main>
				<article class="row">
					<section class="medium-12 columns teaser" style="padding: 0;">
						<div class="medium-12 columns">
							<?php 
								if(is_array($cases)){
									foreach($cases as $case){
										?>
											<article class="medium-3 columns">
												<div class="articleinner">
													<header>
														<div class="banner yours">
															<div class="fi-torso">Defending</div>
														</div>
													</header>
													<section>
														<h3><?php echo $case->title; ?></h3>
													</section>
													<footer>

													</footer>
												</div>	
											</article>
										<?php
									}
								}
							?>
						</div>
					</section>
				</article>    
        	</main>
