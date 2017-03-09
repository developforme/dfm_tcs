	<p>Here is a list of all users:</p>

	<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th>Full Name</th>
					<th>Email</th>
					<th>Last Login</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php foreach($users as $user) { ?>	
					<td><?php echo $user->fullname; ?></td>
					<td><?php echo $user->email; ?></td>
					<td><?php echo $user->last_login; ?></td>
					<td><a href='?controller=user&action=show&id=<?php echo $user->user_id; ?>'>See profile</a></td>
				<?php } ?>
				</tr>
			</tbody>
		</table>
	</div>