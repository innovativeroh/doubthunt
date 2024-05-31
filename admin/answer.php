<?php include_once ("./includes/connection.php"); ?>
<?php if (isset($_SESSION['username'])) {
} else {
    echo "<meta http-equiv=\" refresh\" content=\"0; url=index.php\">";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher</title>
</head>

<body>
    <div class="flex flex-col sm:flex-row h-screen">
        <?php include_once ("./includes/header.php"); ?>
        <div class="flex-1 overflow-y-auto">
            <div class="mt-5 m-auto max-w-[800px] shadow-lg border-[1px] rounded-lg">
                <div class="p-6 px-8">
                    <?php
                    $id = @$_GET['id'];
                    $sql = "SELECT * FROM `questions` WHERE `id`='$id'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    $question = $row['question'];
                    ?>
                    <a href="teacher.php" class="border-[1px] py-2 px-4 rounded-full font-semibold"><i class="bi bi-arrow-left"></i> Back To Dashboard</a>
                    <br /><br />
                    <label class="font-semibold text-sm block">Question</label>
                    <?= $question ?>
                    <?php
                    if(isset($_POST['submit'])) {
                        $date = date("y-m-d");
                        $answer = @$_POST['answer'];
                        $sql = "INSERT INTO `answers`(`id`, `adminID`, `qID`, `answer`, `categoryID`, `dateTime`) VALUES (null,'$global_id','$id','$answer','$global_master','$date')";
                        $query = mysqli_query($conn, $sql);
                        echo "<meta http-equiv=\"refresh\" content=\"0; url=teacher.php\">";
                        exit();
                    }
                    ?>
                    <form action="answer.php?id=<?=$id?>" method="POST">
                        <textarea name="answer" class="w-full p-2 border-[1px] rounded-md h-[120px] resize-x-none mt-4"
                            placeholder="Enter Your Answer!" required></textarea>
                        <button type="submit" name="submit" class="bg-orange-500 rounded-lg w-full py-2 px-4 text-white font-semibold mt-4">Complete <i class="bi bi-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>