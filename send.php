<!DOCTYPE html>
<html lang="en">
<?php
$quiz = @$_GET['quiz'];
$code = @$_GET['success'];
?>

<head>
    <meta charset="UTF-8">
    <?php include_once ("./includes/header.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <br />
        <div class="mt-20 mb-10 max-w-[1280px] m-auto h-[600px] p-10">
            <div class="max-w-[650px] m-auto bg-white rounded-xl shadow-xl p-10">
                <?php
                $date = date("Y-m-d");
                if (isset($_POST['ask'])) {
                    $question = @$_POST['question'];
                    $sql = "INSERT INTO `questions`(`id`, `userID`, `question`, `media`, `dateTime`) VALUES (null,'$global_id','$question','','$date')";
                    $query = mysqli_query($conn, $sql);
                    echo "<meta http-equiv=\"refresh\" content=\"0; url=send.php?success=1\">";
                }
                if ($code == "1") {
                    ?>
                        <center>
                            <img src='./core/img/tick.gif' class="max-w-[300px]">
                            <h1 class="font-bold text-orange-500 text-3xl">Submitted!</h1>
                            <h1 class="font-light font-xl">Will be resolved soon!!</h1>
                            <a href='#' class="mt-4 py-2 px-4 text-white bg-orange-400 rounded-xl inline-">Back To Home</a>
                        </center>
                    <?php
                } else {
                    ?>
                    <?php
                    if (isset($_SESSION['username'])) {
                        ?>
                        <form action="send.php" method="POST">
                            <label for="question" class="font-semibold text-xl">Question
                                <textarea name="question"
                                    class="w-full border-[1px] p-2 text-sm h-[100px] resize-none rounded-xl mt-5"
                                    required="required"><?= $quiz ?></textarea>
                            </label>
                            <input type="submit" name="ask" value="Get Answer!" method="POST"
                                class="mt-5 w-full p-2 bg-orange-400 text-white font-semibold rounded-xl text-sm" />
                        </form>
                        <?php
                    } else {
                        ?>
                        <center>
                            <img src='./core/img/login.gif' class="max-w-[300px]">
                            <h1 class="font-bold text-orange-500 text-3xl">Opps!</h1>
                            <h1 class="font-light font-xl">You must be logged in!</h1>
                        </center>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
</body>
<?php include_once ("./includes/footer.php"); ?>

</html>