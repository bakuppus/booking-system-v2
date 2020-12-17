<?php

include('../php/database/connection.php');

$id = $_GET['id'];

$sql = "DELETE FROM bookings where id = '$id'";
$conn->query($sql);

echo "<script> window.location = 'bookings.php'; </script>";