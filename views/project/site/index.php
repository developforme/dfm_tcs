	<p>List of Sites:</p>

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
					<th>Client</th>
					<th>Details</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<?php foreach($sites as $site) { ?>	
					<td><?php echo $site->name; ?></td>
					<!--
					<td><?php echo $site->address; ?></td>
					<td><?php echo $site->telephone; ?></td>
					<td><?php echo $site->email; ?></td>
					-->
					<td><?php echo $site->client; ?></td>
					<td><a href='?controller=site&action=show&id=<?php echo $site->siteID; ?>'>See info</a></td>
				<?php } ?>
				</tr>
			</tbody>
		</table>
	</div>