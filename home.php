 <!-- Masthead-->
        <!-- <header class="masthead"> -->
        <header>
 		<!-- Carousel -->
		<div class="carousel-container">
			<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
					<li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
				</ol>
				<div class="carousel-inner">
					<div class="carousel-item active">
						<img src="assets/img/fernando-alvarez-rodriguez-M7GddPqJowg-unsplash.jpg" class="d-block w-100" alt="0">
						<div class="carousel-caption d-none d-md-block">
							<h5>A Secret Escapade</h5>
							<p>A hidden gem where you can relax.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="assets/img/eunice-stahl-CxiJt88QJdQ-unsplash.jpg" class="d-block w-100" alt="1">
						<div class="carousel-caption d-none d-md-block">
							<h5>Away from the Metro</h5>
							<p>Seperate yourself from the bustling city.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="assets/img/valeriia-bugaiova-_pPHgeHz1uk-unsplash.jpg" class="d-block w-100" alt="2">
						<div class="carousel-caption d-none d-md-block">
							<h5>Enjoy your Stay</h5>
							<p>Our hotel offers a variety of ammenities and excellent service.</p>
						</div>
					</div>
					<div class="carousel-item">
						<img src="assets/img/visualsofdana-T5pL6ciEn-I-unsplash.jpg" class="d-block w-100" alt="3">
						<div class="carousel-caption d-none d-md-block">
							<h5>Get Cozy</h5>
							<p>Our rooms are well sanitized, which brings not only comfort but also peace of mind.</p>
						</div>
					</div>
				</div>
				<a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
		<!-- end of Carousel -->
        </header>
	<!-- <section class="page-section"> -->
			<!-- <div class="container h-100"> -->
			<!-- <div class="container">
                <div class="row align-items-center justify-content-center text-center"> -->
                <!-- <div class="row h-100 align-items-center justify-content-center text-center"> -->
                    <!-- <div class="col-lg-10 align-self-end mb-4"> -->
                    <!-- <div class="col-lg-10 align-self-end">
                    	<div class="card" id="filter-book"> 
                    		 <div class="card-body"> -->
                    			<div class="container-fluid py-5 booking">
                    				<form action="index.php?page=list" id="filter" method="POST">
                    					<div class="row align-items-center justify-content-center">
                    						<div class="col-md-3 col-lg-2">
                    							<label for="">Check-in</label>
                    							<!-- <input type="text" class="form-control datepicker" name="date_in" autocomplete="off"> -->
												<input type="date" class="form-control " name="date_in" autocomplete="off" value="<?php echo isset($date_in) ? date("Y-m-d",strtotime($date_in)) : "" ?>" min="<?php echo date('Y-m-d', strtotime("+2 day")); ?>">

                    						</div>
                    						<div class="col-md-3 col-lg-2">
                    							<label for="">Check-out</label>
                    							<!-- <input type="text" class="form-control datepicker" name="date_out" autocomplete="off"> -->
												<input type="date" class="form-control " name="date_out" autocomplete="off" value="<?php echo isset($date_out) ? date("Y-m-d",strtotime($date_out)) : "" ?>" min="<?php echo date('Y-m-d', strtotime("+3 day")); ?>">

                    						</div>
                    						<div class="col-md-3 col-lg-2">
                    							<!-- <br> -->
                    							<button class="btn btn-block btn-primary" style="margin-top: 28px;">Check Availability</button>
                    						</div>

                    					</div>
                    				</form>
                    			</div>
                    		<!-- </div>
                    	</div>
                    </div>
                    
                </div>
            </div> -->
    <!-- </section> -->

	<!-- Rooms Offered -->
	<div id="portfolio">
            <div class="container-fluid p-0">
                <div class="row no-gutters">
                	<?php 
                	include'admin/db_connect.php';
                	$qry = $conn->query("SELECT * FROM  room_categories order by rand() ");
                	while($row = $qry->fetch_assoc()):
                	?>
                    <div class="col-lg-4 col-sm-6">
                        <a class="portfolio-box" href="#">
                            <img class="img-fluid" src="assets/img/<?php echo $row['cover_img'] ?>" alt="" />
                            <div class="portfolio-box-caption">
                                <div class="project-category text-white-30"><?php echo "₱ ".number_format($row['price'],2) ?> per day</div>
                                <div class="project-name"><?php echo $row['name'] ?></div>
                            </div>
                        </a>
                    </div>
                	<?php endwhile; ?>

                </div>
            </div>
        </div>