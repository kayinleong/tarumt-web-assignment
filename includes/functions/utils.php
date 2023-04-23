<?php

function base64_url_encode($text):String{
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($text));
}

function base64_url_decode($text):String{
    return base64_decode(str_replace(['-', '_'], ['+', '/'], $text));
}