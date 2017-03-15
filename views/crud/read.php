		<div class="panel panel-primary">
			  <div class="panel-heading"><?php echo $title; ?></div>
			  <div class="panel-body">
				<table class="table table-bordered">
					<thead>
					    <tr>
						
						<?php foreach($this->table_attributes("index") as $att) { ?>
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