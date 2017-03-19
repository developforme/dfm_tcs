	<!-- PAGINATION -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>

	<!-- CRUD VALIDATOR -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

	<!-- ALERTS TOASTR CSS & JS -->
	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
	<link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">

	<!-- CRUD INITIALIZER -->
	<script type="text/javascript">
		// var url = "http://vps383780.ovh.net/dfm/tcs_project/";
		var url = "http://localhost/dfm_tcs-master/";
	</script>
	<style type="text/css">
		.modal-dialog, .modal-content{
		z-index:1051;
		}
	</style>

	<script src="js/crud/<?php echo $_GET['controller']; ?>.js"></script>

	<div class="container">

		<div class="row">
			<div class="col-lg-12 margin-tb">
				<div class="pull-left">
					<h2><?php echo dfm::page_title(); ?></h2>
				</div>
				<div class="pull-right">
				<button type="button" class="btn btn-success" data-toggle="modal" data-target="#create-item">
					  Create <?php echo dfm::page_title(); ?>
				</button>
				</div>
			</div>
		</div>
