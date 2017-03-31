		<div class="panel panel-primary">
			<div class="panel-heading">User Profile</div>
			<div class="panel-body">
				<form method="post">
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
								<td>First Name</td>
								<td><input type="text" name="first_name" value="<?php echo $user['first_name']; ?>"></td>
							</tr>
							<tr>
								<td>Last Name</td>
								<td><input type="text" name="last_name" value="<?php echo $user['last_name']; ?>"></td>
							</tr>
							<tr>
								<td>Username</td>
								<td><input type="text" name="username" value="<?php echo $user['username']; ?>"></td>
							</tr>
							<tr>
								<td>Password</td>
								<td><input type="password" name="password" /> (Leave blank to not change.)</td>
							</tr>
							<tr>
								<td>Email</td>
								<td><input type="text" name="email" size="30" value="<?php echo $user['email']; ?>"></td>
							</tr>
							<tr>
								<td></td>
								<td>
									<button type="submit" name="update_user" class="btn btn-primary edit-item">Update</button>
									<a href="?controller=user&action=show&id=<?php echo $user['id']; ?>"  class="btn btn-danger remove-item">Cancel</a>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
			</div>
		</div>