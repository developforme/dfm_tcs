	<p>List of Clients:</p>

	<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th>Name</th>
					<!--
					<th>Address</th>
					<th>Telephone</th>
					<th>Email</th>
					-->
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php foreach($clients as $client) { ?>	
					<td><?php echo $client->name; ?></td>
					<!--
					<td><?php echo $client->address; ?></td>
					<td><?php echo $client->telephone; ?></td>
					<td><?php echo $client->email; ?></td>
					-->
					<td><a href='?controller=client&action=show&id=<?php echo $client->clientID; ?>'>See info</a></td>
				<?php } ?>
				</tr>
			</tbody>
		</table>
	</div>
	
	