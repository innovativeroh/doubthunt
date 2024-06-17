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
        <div class="transition px-4 py-1 lg:p-4 lg:py-2 flex items-center justify-between hover:bg-zinc-100">
            <div class="flex-[1]">
                <a href='question.php?id=<?= $qID ?>' class="font-semibold text-zinc-600 text-xs"><?= $question ?></a>
            </div>
            <i class="hidden lg:block bi bi-box-arrow-up-right text-xs text-zinc-500"></i>
        </div>
        <?php
    } else {
    }
}
?>


<form action="send.php" method="GET" class="p-2">
    <input type="hidden" name="quiz" value="<?=$query?>" />
    <button type="submit" class="w-full p-2 bg-orange-400 text-white font-semibold rounded-xl text-sm">Cannot Find?
        Submit Now!</form>
</div>
<script src="https://cdn.tailwindcss.com"></script>