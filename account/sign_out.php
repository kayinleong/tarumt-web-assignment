<?php
include "../includes/enum.php";

setcookie('token', '', time() - 2 * 24 * 60 * 60, "/");
header("Location: /assignment/index.php?from=". FromUrl::get_array()['LOGOUT_SUCCESS']);