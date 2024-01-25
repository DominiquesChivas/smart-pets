<?php
include "functions/function.php.php";

session_start();
$_SESSION = [];
session_unset();
session_destroy();

header("Location: login.php");
exit;
?>