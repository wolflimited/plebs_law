<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <body>
		<style>
			main{
				max-width: 100%; position: relative; z-index: 1000;
			}
			article.row{
				max-width: 100%;
			}
		</style>
		<div class="header-container">
			<header>
				<nav class="top-bar" data-topbar role="navigation">
					<ul class="title-area">
						<li class="name">
							<h1>
								<a href="<?php echo site_url(); ?>">Plebslaw</a>
							</h1>
						</li>
						<li class="toggle-topbar menu-icon">
							<a href="#">
									<span>Menu</span>
							</a>
						</li>
					</ul>
					<section class="top-bar-section">
						<ul class="left">
                            <?php if(!$this->ion_auth->logged_in()){ ?>
                                <li>
                                    <a href="<?php echo site_url('auth'); ?>">Register</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('auth'); ?>">Login</a>
                                </li>
                            <?php }else{ ?>
                                <li>
                                    <a href="<?php echo site_url('dashboard'); ?>">Dashboard</a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="<?php echo site_url('about'); ?>">About</a>
                            </li>
						</ul>
					</section>
				</nav>
			</header>
			<div class="slick">
				<div style="position: relative;">
					<img style="width: 100%;" src="<?php echo site_url('img/Huberty_Stock.jpg'); ?>">
					<div style="position: absolute; top: 0; left: 0; width: 100%; padding-top: 100px; z-index: 1;">
						<h1 style="margin: 0 auto; width: 60%; color: #fff; font-family: 'Oswald', sans-serif; text-align: center;">Participate in public discussion over current and historic cases.</h1>
						<h4 style="margin: 0 auto; width: 60%; color: #fff; font-family: 'Oswald', sans-serif; text-align: center;">Join the debate now!</h4>
						<div style="background: #fff; width: 50px; height: 50px; border-radius: 50px; margin: 20px auto;     padding: 0;">
							<div class="fi-arrow-down" style="font-size: 35px; text-align: center;"></div>
						</div> 
					</div>
				</div>
			</div>
		</div>