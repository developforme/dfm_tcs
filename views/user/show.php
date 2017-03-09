	<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th colspan="2"><?php echo $user->fullname; ?>'s Profile</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>User ID</td>
					<td><?php echo $user->user_id; ?></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><?php echo $user->username; ?></td>
				</tr>
				<tr>
					<td>Full Name</td>
					<td><?php echo $user->fullname; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $user->email; ?></td>
				</tr>
				<tr>
					<td>Join Date</td>
					<td><?php echo $user->join_date; ?></td>
				</tr>
				<tr>
					<td>Last Login</td>
					<td><?php echo $user->last_login; ?></td>
				</tr>
			</tbody>
		</table>
	</div>