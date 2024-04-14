<?php
include_once ('../includes/connection.php');
// Assuming you have a database connection established
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $otp = isset($_POST['otp']) ? $_POST['otp'] : '';

    $sql = "SELECT * FROM `users` WHERE `mobile`='$mobile'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $id = $row['id'];

    $sql2 = "SELECT * FROM `otps` WHERE `userID`='$id' AND `otp`='$otp'";
    $query2 = mysqli_query($conn, $sql2);
    $count = mysqli_num_rows($query2);

    if($count == 0) {
        echo "Invalid OTP";
    } else {
        $_SESSION['username'] = $mobile;
        echo "success";
    }
}