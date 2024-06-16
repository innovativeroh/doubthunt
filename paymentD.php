<?php
include_once ('./includes/connection.php');
$productId = $_POST['product_id'];

$sql = "INSERT INTO `downloads`(`id`, `userID`, `downloadID`) VALUES (null,'$global_id','$productId')";
$query = mysqli_query($conn, $sql);