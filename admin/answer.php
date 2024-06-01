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
                    $media = $row['media'];
                    $question = $row['question'];
                    ?>
                    <a href="teacher.php" class="border-[1px] py-2 px-4 rounded-full font-semibold"><i
                            class="bi bi-arrow-left"></i> Back To Dashboard</a>
                    <br /><br />
                    <label class="font-semibold text-sm block">Question</label>
                    <img src="../uploads/<?= $media ?>" class="w-full mt-2 mb-2a">
                    <?= $question ?>

                    <?php
if(isset($_POST['submit'])) {
    $date = date("y-m-d");
    $answer = @$_POST['answer'];
    
    // Handle image upload
    $targetDirectory = "../answer_uploads/"; // Change this to your desired upload directory
    $targetFile = $targetDirectory . uniqid() . '.' . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["image"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
            $media = basename($targetFile);
            // Insert data into database
            $sql = "INSERT INTO `answers`(`id`, `adminID`, `qID`, `answer`, `categoryID`, `media`, `dateTime`) VALUES (null,'$global_id','$id','$answer', '$global_master', '$media','$date')";
            $query = mysqli_query($conn, $sql);
            echo "<meta http-equiv=\"refresh\" content=\"0; url=teacher.php\">";
            exit();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>


                    <form action="answer.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
                        <label for="image" class="font-semibold text-sm block">Upload Image</label>
                        <input type="file" name="image" id="image" accept="image/*" class="mt-2">
                        <textarea name="answer" class="w-full p-2 border-[1px] rounded-md h-[120px] resize-x-none mt-4"
                            placeholder="Enter Your Answer!" required></textarea>
                        <button type="submit" name="submit"
                            class="bg-orange-500 rounded-lg w-full py-2 px-4 text-white font-semibold mt-4">Complete <i
                                class="bi bi-arrow-right"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>