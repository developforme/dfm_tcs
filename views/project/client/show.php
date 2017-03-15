	<div class="table-responsive">          
		<table class="table">
			<thead>
				<tr>
					<th colspan="2"><?php echo $client->name; ?>'s Info</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>Client ID</td>
					<td><?php echo $client->siteID; ?></td>
				</tr>
				<tr>
					<td>Name</td>
					<td><?php echo $client->name; ?></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><?php echo $client->address; ?></td>
				</tr>
				<tr>
					<td>Telephne</td>
					<td><?php echo $client->telephone; ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?php echo $client->email; ?></td>
				</tr>
			</tbody>
		</table>
	</div>