<?php include_once("includes/connection.php");
$delete_id = @$_GET['id'];
$sql = "DELETE FROM `config_standards` WHERE `id`='$delete_id'";
$query = mysqli_query($conn, $sql);
echo "<meta http-equiv=\"refresh\" content=\"0; url=grades.php\">";
exit();
