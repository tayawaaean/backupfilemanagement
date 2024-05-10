<style>
	
</style>

<nav id="sidebar" class='mx-lt-5 bg-dark' >
		
		<div class="sidebar-list">
<<<<<<< Updated upstream
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
=======
			<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
>>>>>>> Stashed changes
				<a href="index.php?page=files" class="nav-item nav-files"><span class='icon-field'><i class="fa fa-file"></i></span> Files</a>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Users</a>
			<?php endif; ?>
			<?php if($_SESSION['login_type'] == 2): ?>
				<a href="index.php?page=employee" class="nav-item nav-home"><span class='icon-field'><i class="fa fa-home"></i></span> Home</a>
				<a href="index.php?page=files" class="nav-item nav-files"><span class='icon-field'><i class="fa fa-file"></i></span> Files</a>
				<a href="index.php?page=personal" class="nav-item nav-users"><span class='icon-field'><i class="fa fa-users"></i></span> Personal Information</a>
			<?php endif; ?>
			<a href="index.php?page=shared-files" class="nav-item nav-shared"><span class='icon-field'><i class="fa fa-file"></i></span>Shared Files</a>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>