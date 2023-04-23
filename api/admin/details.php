<?php
include '../../includes/enum.php';
include '../../includes/functions/db.php';
include '../../includes/functions/auth.php';

redirect_if_not_logged_in_and_not_admin();

$data = json_decode(file_get_contents('php://input'), true);
$type = $data['type'];

if (isset($data['id']) && $type === "update") {
    $id = $data['id'];
    $name = $data['name'];
    $movie = $data['movie'];
    $description = $data['description'];
    $price = $data['price'];
    $discount_rate = $data['discount_rate'];
    $start_datetime = $data['start_datetime'];
    $end_datetime = $data['end_datetime'];
    $status = $data['status'];
    $available_seat = json_encode($data['available_seat']);

    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        echo json_encode("Error updating record: " . $con->error);
        http_response_code(400);
        die();
    }

    $sql = "UPDATE movie_showtimes SET 
                name = '$name', 
                movie_id = $movie, 
                description = '$description', 
                price = $price, 
                discount_rate = $discount_rate, 
                start_datetime = '$start_datetime', 
                end_datetime = '$end_datetime', 
                status = '$status', 
                available_seat = '$available_seat' 
            WHERE id = '$id'";

    try {
        if ($con->query($sql) === TRUE) {
            echo json_encode($data);
            http_response_code(200);
        }
    } catch (Exception $e) {
        echo json_encode("Error: " . $con->error);
        http_response_code(400);
    }

    $con->close();
    die();
} else {
    echo json_encode("Error: " . $con->error);
}
