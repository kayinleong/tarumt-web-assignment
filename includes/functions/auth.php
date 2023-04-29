<?php
include_once 'db.php';
include_once 'jwt.php';

function user_logged_in(): bool
{
    $token = $_COOKIE['token'] ?? "";

    if (!empty($token))
        return verify_jwt($_COOKIE['token'] ?? "");

    return false;
}

function redirect_if_logged_in(): void
{
    if (user_logged_in()) {
        header("Location: /assignment/index.php");
        die();
    }
}

function redirect_if_not_logged_in(): void
{
    if (!user_logged_in()) {
        echo 123;
        header("Location: /assignment/account/login.php");
        die();
    }
}

function redirect_if_not_logged_in_and_not_admin(): void
{
    if (!user_logged_in()) {
        header("Location: /assignment/account/login.php");
        die();
    }

    $payload = get_jwt_payload($_COOKIE['token']);

    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username = '$payload->name'";
    $result = $con->query($sql);
    $row = $result->fetch_assoc();

    $is_admin = $row['is_admin'] == '0' ? true : false;
    if (!$is_admin) {
        header("Location: /assignment/index.php");
        die();
    }
}
