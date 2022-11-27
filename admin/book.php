<?php 
include('db_connect.php');
	$rid = '';

$calc_days = abs(strtotime($_GET['out']) - strtotime($_GET['in'])) ; 
$calc_days =floor($calc_days / (60*60*24)  );


$cid = isset($_GET['cid']) ? $_GET['cid']: '';


// ROOM TYPE
$cat = $conn->query("SELECT name, price FROM room_categories WHERE id = $cid");
while($row = $cat->fetch_assoc()){
	$room_cat = $row['name'];
	$price = $row['price'];
}
$roomType = strtoupper(substr($room_cat, 0, 3));

// COUNT 
$query  = $conn->query("select count(1) FROM reserved");
$result = $query->fetch_array();
$count = sprintf("%05d", $result[0]+1);


$_GET['roomType'] = $roomType;
$_GET['count'] = $count;


?>
<div class="container-fluid">
	
	<form method="" action="" id="manage-check">
		<input type="hidden" name="cid" value="<?php echo isset($_GET['cid']) ? $_GET['cid']: '' ?>">
		<input type="hidden" name="rid" value="<?php echo isset($_GET['rid']) ? $_GET['rid']: '' ?>">
		<input type="hidden" name="gid" value="<?php echo isset($_GET['gid']) ? $_GET['gid']: '' ?>">
		<!-- <input type="hidden" name="gname" value="<?php //echo isset($_GET['name']) ? $_GET['name']: '' ?>"> <- dinagdag ko din ito  -->
		<input type="hidden" name="roomType" value="<?php echo isset($_GET['roomType']) ? $_GET['roomType']: '' ?>">
		<input type="hidden" name="count" value="<?php echo isset($_GET['count']) ? $_GET['count']: '' ?>">

		<div class="form-group">
			<label for="name"><font face="Vollkorn" size="4px" color="#0D0D0D"><b>Name</b></label></font>
			<!-- <input type="text" name="name" id="name" class="form-control" value="<?php //echo isset($meta['name']) ? $meta['name']: '' ?>" required> -->
			<input type="text" name="name" id="name" class="form-control" value="<?php  echo isset($_GET['name']) ? $_GET['name']: '' ?>" required readonly>
	
		</div>
		<div class="form-group">
			<label for="date_in"><font face="Vollkorn" size="4px" color="#0D0D0D"><b>Check-in Date</b></label></font>
			<input type="date" name="date_in" id="date_in" class="form-control" value="<?php echo isset($_GET['in']) ? date("Y-m-d",strtotime($_GET['in'])): date("Y-m-d") ?>" required readonly>

			<!-- Testing -->
			<!-- <input type="date" name="date_in" id="date_in" class="form-control" value="<?php //echo isset($_GET['in']) ? date("Y-m-d",strtotime($_GET['in'])): date('Y-m-d', strtotime("+2 day")) ?>" required readonly> -->
			
		</div>
		<div class="form-group">
			<label for="date_in_time"><font face="Vollkorn" size="4px" color="#0D0D0D"><b>Check-in Time</b></label></font>
			<input type="time" name="date_in_time" id="date_in_time" class="form-control" value="<?php echo isset($_GET['date_in']) ? date("H:i",strtotime($_GET['date_in'])): date("H:i") ?>" required>
		</div>
		<div class="form-group">
			<label for="days"><font face="Vollkorn" size="4px" color="#0D0D0D"><b>Days of Stay</b></label></font>
			<input type="number" min ="1" name="days" id="days" class="form-control" value="<?php echo isset($_GET['in']) ? $calc_days: 1 ?>" required readonly>
		</div>


		<!-- PAYMENT -->
		<hr>
		<label><font face="Vollkorn" size="4px" color="#0D0D0D"><b>Payment Form</b></label></font><br>
		<span id="card-header">Credit Card Information</span>
        <div class="form-group">
        <input type="text" class="form-control" placeholder="Card holder name" required> 
        </div>
		<div class="form-group">
		<input type="text" placeholder="Card number" class="form-control" required> </div>	
		<div class="form-group">	
		<input type="text" placeholder="Exp. date" class="form-control" required> </div>
		<div class="form-group">
		<input type="text" placeholder="CVV" class="form-control" required> </div>
		<span id="card-header"><p><b>Room: </b><?php echo '₱'.number_format($price, 2) ?></p></span>
		<span id="card-header">	<p><b>Total Amount: </b><?php echo '₱'.number_format($price * $calc_days ,2) ?></p></span>

				
	
	</form>
</div>
<script>
	// to save booking user side
	$('#manage-check').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'admin/ajax.php?action=save_book',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp > 0){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
					end_load()
					$('.modal').modal('hide')
					},1500)
				}
			}
		})
	})
</script>