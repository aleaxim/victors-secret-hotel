<style>
	nav#sidebar {
	background: url(assets/img/fernando-alvarez-rodriguez-M7GddPqJowg-unsplash.jpg);
    background-repeat: no-repeat;
    background-size: cover;
</style>
<nav id="sidebar" class='mx-lt-5' >
		
		<div class="sidebar-list">

				<a href="index.php?page=home" class="nav-item nav-home"><span class='icon-field'></span> Home</a>
				<a href="index.php?page=booked" class="nav-item nav-booked"><span class='icon-field'></span> Booked </a>
				<a href="index.php?page=check_out" class="nav-item nav-check_out"><span class='icon-field'></span> Check Out </a>
				<a href="index.php?page=categories" class="nav-item nav-categories"><span class='icon-field'></span> Room Category List</a>
				<a href="index.php?page=rooms" class="nav-item nav-rooms"><span class='icon-field'></span> Rooms </a>
				<?php if($_SESSION['login_type'] == 1): ?>
				<a href="index.php?page=guests" class="nav-item nav-guests"><span class='icon-field'></span> Guests</a>
				<a href="index.php?page=users" class="nav-item nav-users"><span class='icon-field'></span> Users</a>
			<?php endif; ?>
		</div>

</nav>
<script>
	$('.nav-<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>').addClass('active')
</script>