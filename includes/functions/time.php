<?php
date_default_timezone_set('Asia/Kuala_Lumpur');

function get_current_datetime() {
    $now = new DateTime();
    return $now;
}