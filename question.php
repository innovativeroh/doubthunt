<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <?php include_once ("./includes/header.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
    $qID = @$_GET['id'];
    //Getting The Question
    $sql = "SELECT * FROM `questions` WHERE `id`='$qID'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
    $id = $row['id'];
    $question = $row['question'];
    //End Of Getting The Question
    
    //Getting The Answer
    $sql2 = "SELECT * FROM `answers` WHERE `qID`='$id'";
    $query2 = mysqli_query($conn, $sql2);
    $rows = mysqli_fetch_assoc($query2);
    $answer = $rows['answer'];
    $categoryID = $rows['categoryID'];
    //End Of Getting The Answer

    //Getting The Category
    $sql3 = "SELECT * FROM `configcategory` WHERE id='$categoryID'";
    $query3 = mysqli_query($conn, $sql3);
    $rowss = mysqli_fetch_assoc($query3);
    $name = $rowss['name'];
    //End Of Getting The Category
?>
<body>
    <div>
        <br /><br />
        <div class="max-w-[1280px] m-auto mt-10">
            <div class="p-4">
                <div class="m-auto max-w-[600px] bg-white p-5">
                    <span class="font-regular text-xs text-gray-400">Home <i class="bi bi-chevron-right"></i> <?=$name?></span>
                    <h3 class="mt-4 font-bold text-xl">Question</h3>
                    <div class="w-full mt-2">
                        <?=$question?>
                    </div>
                    <div class="mt-4 bg-green-100 rounded-sm p-2 border-[1px] border-green-200">
                        <?=$answer?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once ("./includes/footer.php"); ?>
</body>
</html>