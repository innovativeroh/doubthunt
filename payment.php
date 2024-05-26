<?php
include_once ('./includes/connection.php');
$package_qty = $_POST['package_qty'];
$package_days = $_POST['package_days'];
$product_id = $_POST['product_id'];
$sql = "INSERT INTO `active_plans`(`id`, `userID`, `packageID`, `limitUse`, `daysLimit`, `expired`) VALUES (null,'$global_id','$product_id','$package_qty','$package_days','0')";
$query = mysqli_query($conn, $sql);

