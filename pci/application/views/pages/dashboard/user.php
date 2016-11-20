<main class="dashboard">
	<div class="row">
		<div class="medium-12 columns">
			Hi <?php echo $niceName; ?>, heres your dashboard. <a href="<?php echo site_url('login/logout'); ?>">Logout</a>
		</div>
	</div>
	<div class="row">
		<div class="medium-4 columns">
			<h4 class="columnTitle">Your Cases</h4>
			<?php
				if(isset($action) && $action == 'defending'){
					?>
						<div data-alert class="alert-box success">
							You are now defending <?php echo $defenceCaseTitle; ?>
						</div>
					<?php
				}
				foreach($cases as $case)
				{
					echo buildCase($case);
				}
			?>
		</div>
		<div class="medium-4 columns">
			<h4 class="columnTitle">New Cases</h4>
			<?php 
				foreach($newCases as $case)
				{
					echo buildCase($case);
				}
			?>
		</div>
	</div>
</main>