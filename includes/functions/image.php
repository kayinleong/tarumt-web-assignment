<?php
include 'guid.php';

function get_new_image_name($name): string
{
    $nameArray = explode('.', $name);
    return $nameArray[0] . "_" . guid() . '.' . $nameArray[1];
}
