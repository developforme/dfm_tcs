	<script>
	  function resizeIframe(obj) {
		obj.style.height = obj.contentWindow.document.body.scrollHeight + 'px';
	  }
	</script>

	<div class='alert alert-success'>
		<button class='close' data-dismiss='alert'>&times;</button>
		Hello, <strong><?php echo $user["first_name"] . ' ' . $user['last_name']; ?></strong>! Welcome to the admin home page.
	</div>

	<iframe src="calender/index.php/backend" frameborder="0" height="1000" width="100%" scrolling="no" onload="resizeIframe(this)" />Click <a href="calender/index.php/backend">here</a> to view calender.</iframe>
	
	<div style="margin-bottom: 50px"></div>