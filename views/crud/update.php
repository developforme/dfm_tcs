		<!-- Edit Item Modal -->
		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
		        <h4 class="modal-title" id="myModalLabel">Edit <?php echo dfm::page_title(); ?></h4>
		      </div>

		      <div class="modal-body">
		      		<form data-toggle="validator" action="controllers/crud_controller.php?controller=<?php echo $_GET['controller']; ?>&action=update&type=<?php echo $controller_type; ?>" method="put">
		      			<input type="hidden" name="id" class="edit-id">

						<?php
							for($i = 0; $i < count($edit_attributes); $i++) 
							{
								$show = $edit_attributes[$i]["type"] == 'hidden' ? 'none' : 'block';			
						?>
								<div class="form-group" style="display: <?php echo $show; ?>">
									<label class="control-label" for="<?php echo $edit_attributes[$i]["name"]; ?>"><?php echo $edit_attributes[$i]["text"]; ?></label>
									<input type="text" name="<?php echo $edit_attributes[$i]["name"]; ?>" class="form-control" data-error="<?php echo $edit_attributes[$i]["data-error"]; ?>" <?php echo $edit_attributes[$i]["required"]; ?> />
									<div class="help-block with-errors"></div>
								</div>
						<?php } ?>
						
						<div class="form-group">
							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>
						</div>
		      		</form>
		      </div>
		    </div>
		  </div>
		</div>