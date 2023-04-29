<?php
include '../includes/functions/db.php';
include '../includes/functions/auth.php';

redirect_if_not_logged_in();

$data = json_decode(file_get_contents('php://input'), true);
$type = $data['type'];

if (isset($data['id']) && $type === "create") {
    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        echo json_encode("Error updating record: " . $con->error);
        http_response_code(400);
        die();
    }

    $payload = get_jwt_payload($_COOKIE['token']);
    $sql = "SELECT * FROM users WHERE username = '$payload->name'";
    $result = $con->query($sql);
    $user = $result->fetch_assoc();
    $user_id = $user['id'];

    $id = $data['id'];
    $selected_seats = json_encode($data['selected_seats']);

    $sql = "INSERT INTO ticket_forms (user_id, movie_showtime_id, seat_number) VALUES ('$user_id', '$id', '$selected_seats')";

    try {
        if ($con->query($sql) === TRUE) {
            http_response_code(200);
            $data['ticket_id'] = $con->insert_id;
        }
    } catch (Exception $e) {
        echo json_encode("Error: " . $con->error);
        http_response_code(400);
        die();
    }

    $sql = "SELECT * FROM movie_showtimes WHERE id = '$id'";
    $result = $con->query($sql);
    $movie_showtime = $result->fetch_assoc();

    $available_seats = array_diff(json_decode($movie_showtime['available_seat']), json_decode($selected_seats));
    $string_available_seats = implode(",", $available_seats);

    $sql = "UPDATE movie_showtimes SET available_seat = '[$string_available_seats]' WHERE id = '$id'";
    if ($con->query($sql) === TRUE) {
        http_response_code(200);
    } else {
        echo json_encode("Error: " . $con->error);
        http_response_code(400);
        die();
    }

    $con->close();

    echo json_encode($data);
    die();
} else {
    echo json_encode("Error: " . $con->error);
}
