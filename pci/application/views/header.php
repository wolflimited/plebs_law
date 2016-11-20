<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	?>
    	<body style="background: <?php echo $background; ?>; <?php echo $style; ?>">
			<?php
				if($this->uri->segment(1, 0) != 'login' && $this->uri->segment(1, 0) == 'dashboard'){
					if($this->input->get() && $this->input->get('tutorial') && $this->input->get('tutorial') == 'true'){
						?>
							<ol class="joyride-list" data-joyride>
								<li data-id="quick_tutorial_first" data-text="Next" data-options="prev_button: false">
									<p>Welcome to Plebslaw's quick tutorial.</p>
								</li>
								<li data-id="quick_tutorial_second" data-text="Next" data-prev-text="Prev">
									<h4>Your cases</h4>
									<p>Here you can view and manage your cases. You may view, prosecute or deleted cases.</p>
								</li>
								<li data-id="quick_tutorial_third" data-text="Next" data-prev-text="Prev">
									<h4>Creating a case.</h4>
									<p>Creating a case is easy, click this button.</p>
								</li>
								<li data-button="End" data-prev-text="Prev">
									<h4>Thank You</h4>
									<p>You've completed this tutorial, we hope you enjoy Plebslaw.</p>
									<p><a href="">More Tutorials</a></p>
								  </li>
								<script>
									$(document).ready(function(){
										$(document).foundation('joyride','start');
									});
								</script>
							</ol>
						<?php
					}elseif(($this->input->get() && $this->input->get('hide_getting_started') && $this->input->get('hide_getting_started') != 'true') || show_getting_started()){
						?>
							<div id="getting_started" class="reveal-modal" data-reveal aria-labelledby="Getting Started" aria-hidden="true" role="dialog">
								<div class="row">
									<div class="medium-12 columns">
										<h4>Welcome to PlebsLaw</h4>
										<p>My name is ultra rabbit AI here to assist you Spot something, big eyes, big eyes, crouch, shake butt, prepare to pounce. Stretch drink water out of the faucet purr while eating. Burrow under covers. </p>
									</div>
								</div>
								<div class="row">
									<div class="medium-4 columns">
										<a class="button large expand" href="<?php echo site_url('cases/create') . '?hide_getting_started=true'; ?>">Create Case</a>
									</div>
									<div class="medium-4 columns">
										<a class="button large expand"  href="<?php echo site_url('judge/application'); ?>">Become a Judge</a>
									</div>
									<div class="medium-4 columns">
										<a class="button large expand"  href="<?php echo site_url() . '?tutorial=true'; ?>">Quick Tutorial</a>
									</div>
								</div>
								<div class="row">
									<div class="medium-12 columns">
										<a class="right" href="<?php echo site_url('dashboard') . '?dont_show=true' ?>">Don't show again.</a>
									</div>
								</div>
								<a class="close-reveal-modal" aria-label="Close">&#215;</a>
								<script defer>
									$(document).ready(function(){
										$('#getting_started').foundation('reveal','open');
									});
								</script>
							</div>
						<?php
					}
				}
			?>
			<?php
				if($this->uri->segment(1,0) != 'auth'){
					?>
						<header>
							<nav class="top-bar" data-topbar role="navigation">
								<ul class="title-area">
									<li class="name">
										<h1 id="quick_tutorial_first"><a href="<?php echo site_url('dashboard'); ?>">Plebslaw</a></h1>
									</li>
									<li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
								</ul>
								<section class="top-bar-section">
									<ul class="left">
										<li><a href="<?php echo site_url('dashboard'); ?>">Dashboard</a></li>
										<li class="has-dropdown">
											<a>Cases</a>
											<ul class="dropdown">
                                                <li><a href="<?php echo site_url('cases/view'); ?>">Manage</a></li>
												<li><a href="<?php echo site_url('cases/create'); ?>">Create</a></li>
											</ul>
										</li>
										<li><a href="#">Prosecution</a></li>
										<li><a href="#">Defence</a></li>
										<li class="has-dropdown">
											<a>Jury</a>
											<ul class="dropdown">
												<li><a href="<?php echo site_url('jury'); ?>">Summons</a></li>
											</ul>
										</li>
										<?php
											if($this->ion_auth->is_admin() || true){
												?>
													<li class="has-dropdown">
														<a>Judge</a>
														<ul class="dropdown">
															<li><a href="<?php echo site_url('judge'); ?>">Moderate</a></li>
															<li><a href="<?php echo site_url('judge/application'); ?>">Apply</a></li>
															<li><a href="<?php echo site_url('dashboard'); ?>">Judgements</a></li>
															<li><a href="<?php echo site_url('judge/applications'); ?>">Applications</a></li>
														</ul>
													</li>
												<?php
											}
										?>
										<li class="has-dropdown">
											<a>Account</a>
											<ul class="dropdown">
												<li><a href="<?php echo site_url('dashboard/account'); ?>">Account</a></li>
												<li><a href="<?php echo site_url('dashboard/logout'); ?>">Logout</a></li>
											</ul>
										</li>
										<?php
											if($this->ion_auth->is_admin() || true){
												?>
													<li class="has-dropdown">
														<a>Admin</a>
														<ul class="dropdown">
															<li><a href="<?php echo site_url('admin/users'); ?>">Site Users</a></li>
															<li><a href="<?php echo site_url('migrate'); ?>">Upgrade</a></li>
														</ul>
													</li>
												<?php
											}
										?>
									</ul>
								</section>
							</nav>
						</header>
					<?php
					}
				?>
			<main>