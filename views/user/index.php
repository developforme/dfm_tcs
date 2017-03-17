
<!--
		<div class="panel panel-primary">
			  <div class="panel-heading">Manage Users</div>
			  <div class="panel-body">
				<table class="table table-bordered">
					<thead>
					    <tr>
						
						<?php foreach(User::table_attributes() as $att) { ?>
							<th><?php echo $att; ?></th>
						<?php } ?>
						
						<th width="200px">Action</th>
					    </tr>
					</thead>
					<tbody>
					</tbody>
				</table>

		<ul id="pagination" class="pagination-sm"></ul>
			  </div>
	  </div>

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
				<?php foreach($users as $user) { ?>	
				<tr>
					<td><?php echo $user->fullname; ?></td>
					<td><?php echo $user->email; ?></td>
					<td><?php echo $user->last_login; ?></td>
					<td><a href='?controller=user&action=show&id=<?php echo $user->user_id; ?>'>See profile</a></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	
-->