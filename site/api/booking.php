<?php

include("../php/database/connection.php");

$id = isset($_POST['pub_id']) ? $_POST['pub_id'] : die();

$sql = "SELECT * from bookings where pub_id = '$id'";
$result = $conn->query($sql);

$bookings = array(
 	'Mon' => 0,
 	'Tue' => 0,
 	'Wed' => 0,
 	'Thu' => 0,
 	'Fri' => 0,
 	'Sat' => 0,
 	'Sun' => 0, 
);

while ($row = $result->fetch_assoc()) {
	
	$timestamp = strtotime($row['date']);
    $day = date('D', $timestamp);
    if($day == 'Mon') {
    	$bookings['Mon']++;
    } elseif ($day == 'Tue') {
    	$bookings['Tue']++;
    } elseif ($day == 'Wed') {
    	$bookings['Wed']++;
    } elseif ($day == 'Thu') {
    	$bookings['Thu']++;
    } elseif ($day == 'Fri') {
    	$bookings['Fri']++;
    } elseif ($day == 'Sat') {
    	$bookings['Sat']++;
    } elseif ($day == 'Sun') {
    	$bookings['Sun']++;
    }

}

echo json_encode($bookings);