<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include("../php/database/connection.php");

$sql = "SELECT * from pubs";
$result = $conn->query($sql);
$num = $result->num_rows;

if ($num > 0) {

    http_response_code(200);
    $data_arr = [];
    
    while ($row = $result->fetch_assoc()) {
        
        $timing = [];
        $table = [];
        $booking = [];
        $id = $row['id'];

        $sql = "SELECT * from opening_hours where pub_id = '$id'";
        $timings = $conn->query($sql);
        while ($key = $timings->fetch_assoc()) {
            array_push($timing, $key);
        }

        $sql = "SELECT * from tables_list where pub_id = '$id'";
        $tables = $conn->query($sql);
        while ($key = $tables->fetch_assoc()) {
            array_push($table, $key);
        }

        $sql = "SELECT * from bookings where pub_id = '$id'";
        $bookings = $conn->query($sql);
        while ($key = $bookings->fetch_assoc()) {
            array_push($booking, $key);
        }

        $data = array(
            'pub_details' =>  $row,
            'opening_hours' => $timing,
            'tables_list' => $table,
            'bookings' => $booking 
        );

        array_push($data_arr, $data);
    }
    echo json_encode($data_arr);
    
} else {

    http_response_code(404);
    echo json_encode(
        array("message" => "No Pubs found.")
    );
}
