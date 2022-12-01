<?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    }else{
        header("location: index.php?page=login"); 
        exit;
    }


    // Fetch room_categories table 
    $cat = $conn->query("SELECT * FROM room_categories");
    $cat_arr = array();
        while($row = $cat->fetch_assoc()){
            $cat_arr[$row['id']] = $row;
    }
?>
 

<!-- header bg -->
<div class="b-image">
  <div class="hero-text">
  <hr class="my-10">
        <div class="container h-100"><br><br>
            <div class="row h-100 align-items-center justify-content-center text-center">
                <h1 class="text-uppercase text-white font-weight-bold">My Bookings</h1>
				<hr class="divider my-4" />                 
            </div>
        </div>
    </div>
</div> 
 
 <!-- Masthead-->
 <header class="masthead">
            <!-- <div class="container h-100">
                <div class="row h-50 align-items-center justify-content-center text-center">
                    <div class="col-lg-10 align-self-end mb-4" style="background: #0000002e;">
                    	 <h1 class="text-uppercase text-white font-weight-bold">My Bookings</h1>
                        <hr class="divider my-4" />
                    </div>
                    
                </div>
            </div>
        </header> -->

    <section class="page-section" style="margin-top: 8rem; margin-bottom: 8rem;">
        <div class="container">
           <div class="row">
               <div class="col">
                <h4 class="mb-4">Hi, <b><?php echo htmlspecialchars($_SESSION["g_uname"]); ?></b>!</h4>
                <p><b>Name: </b><?php echo htmlspecialchars($_SESSION["name"]); ?> </p>
                <p><b>Email: </b> <?php echo htmlspecialchars($_SESSION["email"]); ?> </p>
               </div>
           </div>
           <div class="row">
            <table class="table table-hover text-center">
            <thead>
            <tr bgcolor="#999999">
                <th width="120">Reference No.</th>
                <th width="120">Room Type</th>
                <th width="120">Check In</th>
                <th width="120">Check Out</th> 
                <th width="120">Time In</th>
                <th width="90">Amount</th>
                <th width="90">Status</th> 
            </tr> 
            </thead>
            <tbody>
                <?php 
                $gid = isset($_SESSION['guest_id']) ? $_SESSION['guest_id'] : '';
                $i = 1;

                // Fetch guest's records from reserved table 
                $checked = $conn->query("SELECT * FROM reserved where guest_id = $gid order by status desc, id asc");
                while($row=$checked->fetch_assoc()):
                ?>
                <tr>
                    <td ><?php echo $row['ref_no'] ?></td>
                    <td ><?php echo $cat_arr[$row['booked_cid']]['name'] ?></td>
                    <td ><?php echo date("M d, Y", strtotime($row['date_in'])) ?></td>
                    <td ><?php echo date("M d, Y", strtotime($row['date_out'])) ?></td>
                    <td ><?php echo date("H:i", strtotime($row['date_in'])) ?></td>
                    <td ><?php echo '₱'.number_format($cat_arr[$row['booked_cid']]['price'],2) ?></td>
                    <?php if($row['status'] == 0): ?>
                        <td ><span class="badge badge-warning">Booked</span></td>
                        <?php elseif($row['status'] == 1): ?>
                        <td ><span class="badge badge-danger">Checked-In</span></td>
                        <?php else: ?>
                        <td ><span class="badge badge-success">Checked-Out</span></td>
						<?php endif; ?>                
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table> 
            </div> 
            <a href="logout.php" class="btn btn-success m-5">Logout</a>   
            </div>
            </section>

            <script> // TEST
                $("#loginUI").hide();
            </script>
                
            