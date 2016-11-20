<?php
    //template for preview item
    ?>
	<tr>
		<td>
			<h6><?php echo $case->id; ?></h6>
		</td>
		<td>
			<h6><?php echo $case->title; ?></h6>
		</td>
		<td>
			<?php
				if($defense == '' || count($defense) == 0){
					?>
						<a class="button expand" href="<?php echo site_url('defense/apply') . '?defend=' . $case->id; ?>">Defend</a>
					<?php
				}else{
					?>
						<a class="button expand" href="<?php echo site_url('defense/apply') . '?defend=' . $case->id . '&type=witness'; ?>">Witness</a>
					<?php
				}
			?>
		</td>
		<td>
			<?php
				if($prosecutor == '' || count($prosecutor) == 0){
					?>
						<a class="button expand" href="<?php echo site_url('prosecution/apply') . '?prosecute=' . $case->id; ?>">Prosecute</a>
					<?php
				}else{
					?>
						<a class="button expand" href="<?php echo site_url('prosecution/apply') . '?prosecute=' . $case->id . '&type=witness'; ?>">Witness</a>
					<?php
				}
			?>
		</td>
		<td>
			<a class="button" href="<?php echo site_url('cases') . '?id=' . $case->id; ?>">View</a>
		</td>
	</tr>