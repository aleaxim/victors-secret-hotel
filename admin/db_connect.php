<?php 

$conn= new mysqli('localhost','root','','hotel_db')or die("Could not connect to mysql".mysqli_error($con));
// $conn= new mysqli('localhost','id18674189_vs_hotel','8aNmOiWqJE6Ulh*!','id18674189_hotel_db')or die("Could not connect to mysql".mysqli_error($con));

date_default_timezone_set('Etc/GMT-8');