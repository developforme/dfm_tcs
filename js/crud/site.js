$( document ).ready(function() {

	var page = 1;
	var current_page = 1;
	var total_page = 0;
	var is_ajax_fire = 0;
	var controller = "site";
	var controller_type = "project";

	manageData();

	/* manage data list */
	function manageData() {
		$.ajax({
			dataType: 'json',
			url: url+'controllers/crud_controller.php?controller='+controller+'&action=index&type=' + controller_type,
			data: {page:page}
		}).done(function(data){
			total_page = Math.ceil(data.total/10);
			current_page = page;

			$('#pagination').twbsPagination({
				totalPages: total_page,
				visiblePages: current_page,
				onPageClick: function (event, pageL) {
					page = pageL;
					if(is_ajax_fire != 0){
					  getPageData();
					}
				}
			});
			
			manageRow(data.data);
			is_ajax_fire = 1;

		});

	}

	/* Get Page Data*/
	function getPageData() {
		$.ajax({
			dataType: 'json',
			url: url+'controllers/crud_controller.php?controller='+controller+'&action=index&type=' + controller_type,
			data: {page:page}
		}).done(function(data){
			
			manageRow(data.data);
		});
	}


	/* Add new Item table row */	
	function manageRow(data) {
		var	rows = '';
		
		$.each( data, function( key, value ) {
			rows = rows + '<tr>';
			
			$.each(data[0], function( key2, value2 ) {
				if(key2 != "id")
				rows = rows + '<td>'+value[key2]+'</td>';
			});

			rows = rows + '<td data-id="'+value.id+'">';
			rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
			rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
			rows = rows + '</td>';
			rows = rows + '</tr>';
		});

		$("tbody").html(rows);
	}

	/* Remove Item */
	$("body").on("click",".remove-item",function(){
		var id = $(this).parent("td").data('id');
		var c_obj = $(this).parents("tr");

		$.ajax({
			dataType: 'json',
			type:'POST',
			url: url + 'controllers/crud_controller.php?controller='+controller+'&action=delete&type=' + controller_type,
			data:{id:id}
		}).done(function(data){
			c_obj.remove();
			toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
			getPageData();
		});

	});
	
	/* CHANGE BELOW CODE TO PREVENT REPEATING */

	/* Add Item */
	$(".crud-submit").click(function(e){
		e.preventDefault();
		
		var form_action = $("#create-item").find("form").attr("action");
		
		var first_name = $("#create-item").find("input[name='first_name']").val();
		var address = $("#create-item").find("input[name='address']").val();
		var email = $("#create-item").find("input[name='email']").val();
		var phone_number = $("#create-item").find("input[name='phone_number']").val();
		var clientID = $("#create-item").find("select[name='clientID']").val();

		if(first_name != '' && address != '' && email != '' && phone_number != '' && clientID != ''){
			$.ajax({
				dataType: 'json',
				type:'POST',
				url: url + form_action,
				data:{first_name:first_name, address:address, email:email, phone_number:phone_number, clientID:clientID}
			}).done(function(data){
				first_name;
				address;
				email;
				phone_number;
				clientID;
				getPageData();
				$(".modal").modal('hide');
				toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
			});
		}else{
			alert('You are missing name or email.')
		}

	});


	/* Edit Item */
	$("body").on("click",".edit-item",function(){

		var id = $(this).parent("td").data('id');

		var first_name = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").prev("td").text();
		var address = $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
		var email =    $(this).parent("td").prev("td").prev("td").prev("td").text();
		var phone_number = $(this).parent("td").prev("td").prev("td").text();
		var clientID = $(this).parent("td").prev("td").text();
		
		$("#edit-item").find("input[name='first_name']").val(first_name);
		$("#edit-item").find("input[name='address']").val(address);
		$("#edit-item").find("input[name='email']").val(email);
		$("#edit-item").find("input[name='phone_number']").val(phone_number);
		$("#edit-item").find("select[name='clientID']").val(clientID);
		$("#edit-item").find(".edit-id").val(id);

	});

 
	/* Updated new Item */
	$(".crud-submit-edit").click(function(e){

		e.preventDefault();
		var form_action = $("#edit-item").find("form").attr("action");
		
		var first_name = $("#edit-item").find("input[name='first_name']").val();
		var address = $("#edit-item").find("input[name='address']").val();
		var email = $("#edit-item").find("input[name='email']").val();
		var phone_number = $("#edit-item").find("input[name='phone_number']").val();
		var clientID = $("#edit-item").find("select[name='clientID']").val();
		
		var id = $("#edit-item").find(".edit-id").val();

		if(first_name != '' && address != '' && email != '' && phone_number != '' && clientID != ''){
			$.ajax({
				dataType: 'json',
				type:'POST',
				url: url + form_action,
				data:{first_name:first_name, address:address, email:email, phone_number:phone_number, clientID:clientID, id:id}
			}).done(function(data){
				getPageData();
				$(".modal").modal('hide');
				toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});
			});
		}else{
			alert('You are missing name or email.')
		}

	});

});