<?php
include 'db.php';
if($_GET['type']=='services'){echo json_encode($conn->query('SELECT * FROM services')->fetch_all(MYSQLI_ASSOC));}
if($_GET['type']=='staff'){echo json_encode($conn->query('SELECT * FROM staff')->fetch_all(MYSQLI_ASSOC));}
if($_GET['type']=='times'){
$d=$_GET['date'];$slots=['09:00','10:00','11:00','13:00','14:00','15:00'];
$b=$conn->query("SELECT booking_time FROM bookings WHERE booking_date='$d'");
$bk=array_column($b->fetch_all(),0);
echo json_encode(array_values(array_diff($slots,$bk)));
}?>