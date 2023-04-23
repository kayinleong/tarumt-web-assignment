<?php
define('ENC_ALGO_TYPE', 'sha256');
define('ENC_SECRET', '757bad4d-565f-454d-b902-b410c0306fe5_0fc1f336-6e33-4591-a270-b43b99bf4cd9');

function calc_hash_hmac($message) {
    return hash_hmac(ENC_ALGO_TYPE, $message, ENC_SECRET);
}

function verify_hash_hmac($message, $message_hashed) {
    return calc_hash_hmac($message) === $message_hashed;
}