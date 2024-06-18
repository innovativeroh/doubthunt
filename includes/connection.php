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
$global_full_name = "";
if (isset($_SESSION['username'])) {
    $user = $_SESSION["username"];
    $sql = "SELECT * FROM `users` WHERE `mobile`='$user'";
    $query = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($query)) {
        $global_id = $row["id"];
        $global_full_name = $row["full_name"];
        if($global_full_name == "") {
            $global_full_name = "Student";
        } else {
            $global_full_name;
        }
        $global_mobile = $row["mobile"];
        $global_email = $row["email"];
        if($global_email == "") {
            $global_email = "info@doubthunt.com";
        } else {
            $global_email;
        }
    }
}
else {
    $user = "No User!";
}

$sql = "SELECT * FROM `download_folder`";
$query = mysqli_query($conn, $sql);
$folder = mysqli_fetch_assoc($query);
$global_folder_name = $folder['folder'];