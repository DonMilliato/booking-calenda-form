<?php
include '../db.php';

$sql = "
SELECT 
    b.client_name,
    b.email,
    b.phone,
    s.name AS service,
    st.full_name AS staff,
    b.booking_date,
    b.booking_time
FROM bookings b
JOIN services s ON b.service_id = s.id
JOIN staff st ON b.staff_id = st.id
";

$result = $conn->query($sql);

if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<h2>Admin Dashboard</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>Client</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Service</th>
        <th>Staff</th>
        <th>Date</th>
        <th>Time</th>
    </tr>

   <?php while ($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= htmlspecialchars($row['client_name']) ?></td>
    <td><?= htmlspecialchars($row['email']) ?></td>
    <td><?= htmlspecialchars($row['phone']) ?></td>
    <td><?= htmlspecialchars($row['service']) ?></td>
    <td><?= htmlspecialchars($row['staff']) ?></td>
    <td><?= date("d M Y", strtotime($row['booking_date'])) ?></td>
    <td><?= htmlspecialchars($row['booking_time']) ?></td>
</tr>
<?php endwhile; ?>
</table>
