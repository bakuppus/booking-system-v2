<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

include("../php/database/connection.php");

$id = isset($_GET['id']) ? $_GET['id'] : die();

$sql = "SELECT * from pubs where id = '$id'";
$result = $conn->query($sql);
$num = $result->num_rows;

if ($id != null && $num > 0) {

    $timing = [];
    $table = [];
    $booking = [];

    $row = $result->fetch_assoc();
    $pub_id = $row['id'];

    $sql = "SELECT * from opening_hours where pub_id = '$pub_id'";
    $timings = $conn->query($sql);
    while ($key = $timings->fetch_assoc()) {
        array_push($timing, $key);
    }

    $sql = "SELECT * from tables_list where pub_id = '$pub_id'";
    $tables = $conn->query($sql);
    while ($key = $tables->fetch_assoc()) {
        array_push($table, $key);
    }

    $sql = "SELECT * from bookings where pub_id = '$pub_id'";
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

    http_response_code(200);
    echo json_encode($data);

} else {

    http_response_code(404);
    echo json_encode(array("message" => "Pub does not exist."));
}