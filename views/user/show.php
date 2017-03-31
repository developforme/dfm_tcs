		<div class="panel panel-primary">
			<div class="panel-heading">User Profile</div>
			<div class="panel-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th colspan="2"><?php echo $user['first_name']; ?>'s Profile</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>User ID</td>
							<td><?php echo $user['id']; ?></td>
						</tr>
						<tr>
							<td>Name</td>
							<td><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></td>
						</tr>
						<tr>
							<td>Username</td>
							<td><?php echo $user['username']; ?></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><?php echo $user['email']; ?></td>
						</tr>
						<tr>
							<td>Join Date</td>
							<td><?php echo date("d/m/Y : H:i", $user['join_date']); ?></td>
						</tr>
						<tr>
							<td>Last Login</td>
							<td><?php echo date("d/m/Y : H:i", $user['last_login']); ?></td>
						</tr>
						<tr>
							<td></td>
							<td>
								<button onclick="window.location.href='?controller=user&action=edit&id=<?php echo $user['id']; ?>'"  class="btn btn-primary edit-item">Edit</button>
								<button onclick="window.location.href='?controller=user&action=delete&id=<?php echo $user['id']; ?>'"  class="btn btn-danger remove-item">Delete</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
	  </div>