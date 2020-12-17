<?php

include('../php/database/connection.php');

$booking_no = $_POST['booking_no'];
$email = $_POST['email'];

$sql = "SELECT * from bookings";
$result = $conn->query($sql);
$count_before = $result->num_rows;

$sql = "DELETE FROM bookings where booking_no = '$booking_no' and email = '$email'";
$conn->query($sql);

$sql = "SELECT * from bookings";
$result = $conn->query($sql);
$count_after = $result->num_rows;

if($count_before != $count_after) {
	echo "<script> alert('Booking canceled successfully.'); </script>";
} else {
	echo "<script> alert('Booking not found.'); </script>";
}

echo "<script> window.location = '../cancel.php'; </script>";