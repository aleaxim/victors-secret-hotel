<?php
$date_in = isset($_POST['date_in']) ? $_POST['date_in'] : date('Y-m-d');
$date_out = isset($_POST['date_out']) ? $_POST['date_out'] : date('Y-m-d',strtotime(date('Y-m-d').' + 3 days'));

$gid = isset($_SESSION['guest_id']) ? $_SESSION['guest_id'] : '';
$gname = isset($_SESSION['name']) ? $_SESSION['name'] : '';

?>

<div class="hero-image">
  <div class="hero-text">
<div class="">
  <hr class="my-4">
  <p><font size="6px" color="#C9AF98"> <br><br><br><br>Designed for your comfort and well-being. <br></p>
</div>
  </div>
</div>
		
		<div class="page-header">
		<font face="Vollkorn" size="20px" color="#C9AF98"><h1 style="text-align:center;"><b><br>BOOK A ROOM</h1></font>
		</div>
	
				<div class="col d-flex justify-content-center"><div class="card"></card></div>
				<div class="container">		
				<div class="card-body">	
						<form action="index.php?page=list" id="filter" method="POST">
			        			<div class="row align-items-center justify-content-center">
								<div class="col-md-">
								<div class="card text-center" style="max-width: 202px;">
								<div class="card-body">
			        					<label for="">
											<font face="Vollkorn" size="5px" color="#676767">Check-in Date</label>
			        							<!-- <input type="text" class="form-control datepicker" name="date_in" autocomplete="off" value="<?php //echo isset($date_in) ? date("Y-m-d",strtotime($date_in)) : "" ?>"> -->

												<input type="date" class="form-control" name="date_in" autocomplete="off" value="<?php echo isset($date_in) ? date('Y-m-d', strtotime("+2 day")) : "" ?>" min="<?php echo date('Y-m-d', strtotime("+2 day")); ?>">
								</div>
			        			<div class="col-md-12">
										<label for="">
											<font face="Vollkorn" size="5px" color="#676767">Check-out Date</label>
			        							<!-- <input type="text" class="form-control datepicker" name="date_out" autocomplete="off" value="<?php //echo isset($date_out) ? date("Y-m-d",strtotime($date_out)) : "" ?>">&nbsp; -->

												<input type="date" class="form-control" name="date_out" autocomplete="off" value="<?php echo isset($date_out) ? date('Y-m-d', strtotime("+3 day")) : "" ?>" min="<?php echo date('Y-m-d', strtotime("+3 day")); ?>">
			        			</div>
			        			<div class="col-md-39">
										<br><button class="btn btn-block btn-primary mt-0" ><font face="Vollkorn" size="5px" color="#FFFFFF"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;>CHECK AVAILABILITY</font></button><br><br>

       						</div></div>

			        					</div>
			        				</form>
							</div>
						</div>	

						<hr>				
						<?php 
						
						 $cat = $conn->query("SELECT * FROM room_categories");
						$cat_arr = array();
						while($row = $cat->fetch_assoc()){
							$cat_arr[$row['id']] = $row;
						}
						$qry = $conn->query("SELECT distinct(category_id),category_id from rooms where id not in (SELECT room_id from reserved where '$date_in' BETWEEN date(date_in) and date(date_out) and '$date_out' BETWEEN date(date_in) and date(date_out)  )");
						while($row= $qry->fetch_assoc()):
						?>
						
						<div class="card item-rooms mb-3">
							<div class="card">
								<div class="col-md-30"><br>
									<img src="assets/img/<?php echo $cat_arr[$row['category_id']]['cover_img'] ?>"  class="rounded mx-auto d-block" alt="">
								</div>
						<div class="card-body text-center">
							<h5 class="card-title"></h5>
							<h3><p class="card-text"><b><?php echo '<font face="Vollkorn" size="4px" color="#0D0D0D">
									₱ '.number_format($cat_arr[$row['category_id']]['price'],2) ?></b><span><font face="Vollkorn" size="4px" color="#0D0D0D">&nbsp;per day</font></p></h3>
									<h4><b>
										<font face="Vollkorn" size="4px" color="#0D0D0D"><?php echo $cat_arr[$row['category_id']]['name'] ?> 
									</b></h4>
									<h4>
										<font face="Vollkorn" size="4px" color="#0D0D0D"><?php echo $cat_arr[$row['category_id']]['description'] ?> 
									</h4>
									<h4>
										<font face="Vollkorn" size="4px" color="#0D0D0D"><?php echo $cat_arr[$row['category_id']]['guestCount']; echo " persons" ?> 
									</h4>
									
										<div class="align-self-end mt-10">

										<!-- ORIGINAL CODE -->
											<button class="btn btn-primary  float-right book_now" type="button" data-id="<?php echo $row['category_id'] ?>">
											&nbsp;&nbsp;&nbsp;<font face="Impact" size="5px" color="#FFFFF">BOOK &nbsp;</font></button>

										<!-- REFERENCE for trial 1
											<input type="button" onclick="window.location='http://google.com'" class="Redirect" value="Click Here To Redirect"/> -->

										<!-- TRIAL 1 worked but wrong logic lagi magreredirect sa login to-->
											<!-- <input class="btn btn-primary float-right book_now" type="button" onclick="window.location='index.php?page=login'" value="Book Now"> -->

										<!-- TRIAL 2 -->
										<!-- <form method="POST">
											<input class="btn btn-primary float-right book_now" type="submit" value="book_now" name="book_now"
											<?php
												// for login before booking code
												// if (isset($_POST['book_now'])) {
												//     if (isset($_SESSION['loggedIn'])){
												//         echo "
												// 		<script>
												// 		// orig code
												// 		$('.book_now').click(function(){
												// 			uni_modal('Book','admin/book.php?in=<?php echo $date_in ?>&out=<?php //echo $date_out ?>&cid='+$(this).attr('data-id'))
												// 		})
												// 		</script>
												// 		";
												//     } else {
												//         header("location: index.php?page=login");
												//         exit();
												//     }
												// }
											?>
											>
										</form> -->
										<br>
										</div>
										<br>
				</div>
				</div>
				</div>
				<?php endwhile; ?>
				</div>
		</div>
		
</section>


<style type="text/css">
	.item-rooms img {
    width:40vw;
}
</style>
<script>
	$(".book_now").click(function(){
		<?php 
			if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){} else {
				echo "alert('You are not logged in');";
				echo "window.location.href = 'index.php?page=login';";
			}
		?>
	uni_modal('Book','admin/book.php?in=<?php echo $date_in ?>&out=<?php echo $date_out ?>&name=<?php echo $gname ?>&gid=<?php echo $gid ?>&cid='+$(this).attr('data-id'))
	})

	// // orig code
	// $('.book_now').click(function(){
	// 	uni_modal('Book','admin/book.php?in=<?php //echo $date_in ?>&out=<?php //echo $date_out ?>&cid='+$(this).attr('data-id'))
	// })

</script>