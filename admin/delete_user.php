<?php include_once("includes/connection.php");
$delete_id = @$_GET['id'];
$sql = "DELETE FROM `users` WHERE `id`='$delete_id'";
$query = mysqli_query($conn, $sql);
echo "<meta http-equiv=\"refresh\" content=\"0; url=users.php\">";
exit();
