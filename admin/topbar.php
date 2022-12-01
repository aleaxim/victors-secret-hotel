<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 5px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
  }
  .Title{
    font-family: 'Vollkorn', serif;
    font-size: 24px;
  }
</style>

<nav class="navbar fixed-top " style="padding:0; background-color: #ff5224;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  			<div class="logo">
  				<!-- <i class="fa fa-building"></i> -->
				<!-- added logo -->
				<img src="assets/img/VS_logo.png" alt="Victor's Secret Logo" style="width:28px;height:28px;">
  			</div>
  		</div>
      <div class="col-md-4 float-left text-white">
        <!-- <large><b><?php //echo $_SESSION['setting_hotel_name']; ?></b></large> -->
        <large class="Title"><b>Victor's Secret Hotel Management System</b></large>
      </div>
	  	<div class="col-md-2 float-right text-white">
	  		<a href="ajax.php?action=logout" class="text-white"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
	    </div>
    </div>
  </div>
  
</nav>