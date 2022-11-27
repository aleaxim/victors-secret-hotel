<?php 
?>

<div class="container-fluid">
<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Email</th>  
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            include 'db_connect.php';
                            $guest = $conn->query("SELECT * FROM guests order by name asc");
                            $i = 1;
                            while($row= $guest->fetch_assoc()):
                        ?>
                        <tr>
                            <td class="text-center" style="padding: 0.4rem"> 
                                <?php echo $i++ ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row['name'] ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row['g_uname'] ?>
                            </td>
                            <td class="text-center">
                                <?php echo $row['email'] ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
			</div>
		</div>
	</div>
</div>
