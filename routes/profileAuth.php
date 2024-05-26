<?php
include_once ('../includes/connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $standard = isset($_POST['standard']) ? $_POST['standard'] : '';
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $passwordRpt = isset($_POST['passwordRpt']) ? $_POST['passwordRpt'] : '';
    if(!$password == $passwordRpt) {
        echo "Both passwords doent's match!";
    } else {
        $sql = "SELECT * FROM `users` WHERE `email`='$email' AND NOT `mobile`='$user'";
        $query = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($query);
        if($count == 0) {
            $sql = "UPDATE `users` SET `full_name`='$name', `email`='$email', `standard`='$standard' WHERE `mobile`='$user'";
            $query = mysqli_query($conn, $sql);
            echo "Success";
        } else {
            echo "Email already exists!";
        }
    }
}