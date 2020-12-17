<?php

$dbname = "booking_system";
$servername = "booking-system-db-service.default.svc.cluster.local";
$username = "root";
$password = "password";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
