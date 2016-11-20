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
        	</main>
