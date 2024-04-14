<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "doubthunt";
$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName) or die;
date_default_timezone_set("Asia/Calcutta");
if (!$conn == true) {
    echo "Database Error!";
}
session_start();
if (isset($_SESSION['username'])) {
    $user = $_SESSION["username"];
}
else {
    $user = "No User!";
}