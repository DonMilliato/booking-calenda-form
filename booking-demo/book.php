<?php
include 'db.php';

/* 1️⃣ Check prepare */
$stmt = $conn->prepare(
'INSERT INTO bookings 
(client_name,email,phone,service_id,staff_id,booking_date,booking_time) 
VALUES (?,?,?,?,?,?,?)'
);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

/* 2️⃣ Bind parameters */
$bind = $stmt->bind_param(
'sssiiss',
$_POST['name'],
$_POST['email'],
$_POST['phone'],
$_POST['service'],
$_POST['staff'],
$_POST['booking_date'],
$_POST['time']
);

if (!$bind) {
    die("Bind failed: " . $stmt->error);
}

/* 3️⃣ Execute */
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

/* 4️⃣ Success response */
echo "success";

$stmt->close();
$conn->close();
?>