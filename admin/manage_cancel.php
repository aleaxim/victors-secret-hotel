<?php 
include('db_connect.php');
if($_GET['id']){
	$id = $_GET['id'];
	$qry = $conn->query("SELECT * FROM reserved where id =".$id);
	if($qry->num_rows > 0){
		foreach($qry->fetch_array() as $k => $v){
			$$k=$v;
		}
	}
	if($room_id > 0){
	$room = $conn->query("SELECT * FROM rooms where id =".$room_id)->fetch_array();
	$cat = $conn->query("SELECT * FROM room_categories where id =".$room['category_id'])->fetch_array();
}else{
	$cat = $conn->query("SELECT * FROM room_categories where id =".$booked_cid)->fetch_array();

}
 $calc_days = abs(strtotime($date_out) - strtotime($date_in)) ; 
 $calc_days =floor($calc_days / (60*60*24)  );

 $currdate = date("Y-m-d");
 $calc_days_cancel =  abs(strtotime($date_in) - strtotime($currdate));
 if ($calc_days_cancel >= 5  ){
	$penalty_price = $cat['price'] * $calc_days * 0.1;
 } elseif($calc_days_cancel == 4  ) {
	$penalty_price = $cat['price'] * $calc_days * 0.15;
 } else {
	$penalty_price = $cat['price'] * $calc_days * 0.2;
 }


}
?>
<style>
	.container-fluid p{
		margin: unset
	}
	#uni_modal .modal-footer{
		display: none;
	}
</style>
<div class="container-fluid">
	<label><b>Payment Form</b></label><br>
	<p><b>Room : </b><?php echo isset($room['room']) ? $room['room'] : 'NA' ?></p>
	<p><b>Room Category : </b><?php echo $cat['name'] ?></p>
	<p><b>Room Price : </b><?php echo '₱'.number_format($cat['price'],2) ?></p>
	<p><b>Reference no : </b><?php echo $ref_no ?></p>
	<p><b>Checked In : </b><?php echo $name ?></p>
	<p><b>Check-in Date/Time : </b><?php echo date("M d, Y h:i A",strtotime($date_in)) ?></p>
	<p><b>Check-out Date/Time : </b><?php echo date("M d, Y h:i A",strtotime($date_out)) ?></p>
	<p><b>Days : </b><?php echo $calc_days ?></p>
	<p><b>Total Amount (Price * Days) : </b><?php echo '₱'.number_format($cat['price'] * $calc_days ,2) ?></p>

	<p><b>Penalty Total Amount : </b><?php echo '₱'.number_format($penalty_price ,2) ?></p>
	
	<div class="row m-2">
		<p><strong><br><p style="color:Tomato;">NOTE: PENALTY FOR CANCELLING ROOM</h1></strong></p>
		<p><em>20% - 2 days from scheduled booking<br>
		15% - 4 days<br>
		10% - 5 days or more<br>
		</em></p>
		</em></p>
	</div>

		<hr>
		<label><b>Credit Card Information</b></label><br>
		<!-- <span id="card-header">Credit Card Information</span> -->
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Card holder name"> 
        </div>
		<div class="form-group">
		<input type="text" placeholder="Card number" class="form-control"> </div>	
		<div class="form-group">	
		<input type="text" placeholder="Exp. date" class="form-control"> </div>
		<div class="form-group">
		<input type="text" placeholder="CVV" class="form-control"> </div>
	
				
		<div class="row">
			<!-- Original Code -->
			<!-- <?php //if(isset($_GET['checkout']) && $status != 2): ?>
				<div class="col-md-3">
					<button type="button" class="btn btn-primary" id="checkout">Checkout</button>
				</div> -->

			<!-- Cancel -->
			<?php
				if(isset($_GET['checkout']) && $status != 2):
					echo '
					<div class="col-md-3">
					<button type="button" class="btn btn-primary" id="checkout">Checkout</button>
					</div>';
				elseif(isset($_GET['cancel']) && $status == 0):
					echo '
					<div class="col-md-3">
						<button type="button" class="btn btn-danger" id="cancel">Cancel</button>
					</div>';
				endif;
			?>
				<div class="col-md-3">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				</div>
		
		</div><br>
	
</div>
<script>
	$(document).ready(function(){
		
	})
	$('#edit_checkin').click(function(){
		uni_modal("Edit Check In","manage_check_in.php?id=<?php //echo $id ?>&rid=<?php //echo $room_id ?>")
	})

	$('#cancel').click(function(){
		start_load()
		$.ajax({
			url:'ajax.php?action=save_cancel',
			method:'POST',
			data:{id:'<?php echo $id ?>'},
			success:function(resp){
				if(resp == 1){
					alert_toast("Booking has been cancelled",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}
			}
		})
	})


	// $('.delete_cat').click(function(){
	// 	_conf("Are you sure to delete this room?","delete_cat",[$(this).attr('data-id')])
	// })
	// function delete_cat($id){
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=delete_room',
	// 		method:'POST',
	// 		data:{id:$id},
	// 		success:function(resp){
	// 			if(resp==1){
	// 				alert_toast("Data successfully deleted",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)

	// 			}
	// 		}
	// 	})
	// }



	// $('#checkout').click(function(){
	// 	start_load()
	// 	$.ajax({
	// 		url:'ajax.php?action=save_cancel',
	// 		method:'POST',
	// 		data:{id:'<?php //echo $id ?>'},
	// 		success:function(resp){
	// 			if(resp ==1){
	// 				alert_toast("Data successfully saved",'success')
	// 				setTimeout(function(){
	// 					location.reload()
	// 				},1500)
	// 			}
	// 		}
	// 	})
	// })
</script>



