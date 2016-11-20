<main class="users">
	<article class="row">
		<table>
			<tr>
				<th>Email</th>
				<th></th>			
			</tr>
			<?php
				foreach($users as $user){
			?>
				<tr>
					<td><?php echo $user->email; ?></td><td><a href="<?php echo site_url('admin/users') . '?id=' . $user->id . '&action=loginas'; ?>">Login as User</a></td>
				</tr>
			<?php
				}
			?>
		</table>
	</article>
</main>