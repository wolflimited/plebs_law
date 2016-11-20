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
			<?php echo $case->status; ?>
		</td>
		<td>
			-
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
		<td>
			<?php
				if(is_author($case->author)){
					?>
						<a class="alert button" href="<?php echo site_url('cases') . '?id=' . $case->id . '&action=delete'; ?>">Delete</a>
					<?php	
				}
			?>
		</td>
	</tr>