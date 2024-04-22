<?php
include_once ('../includes/connection.php');
$query = isset($_GET['q']) ? $_GET['q'] : '';

$sql = "SELECT * FROM `questions` WHERE `question` LIKE '%$query%' LIMIT 10";
$result = mysqli_query($conn, $sql);
while ($row = mysqli_fetch_assoc($result)) {
    $qID = $row["id"];
    $question = $row['question'];
    $sql2 = "SELECT * FROM `answers` WHERE `qID`='$qID'";
    $result2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($result2);
    if ($count2 > 0) {
        ?>
        <div class="transition p-4 py-2 flex items-center justify-between hover:bg-zinc-100">
            <div class="flex-[1] p-2">
                <p class="font-semibold text-zinc-600"><?=$question?></p>
            </div>
            <i class="bi bi-box-arrow-up-right text-xs text-zinc-500"></i>
        </div>
    <?php
    } else {}
}
?>
<script src="https://cdn.tailwindcss.com"></script>