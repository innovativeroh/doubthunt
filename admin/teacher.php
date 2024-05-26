<?php include_once ("./includes/connection.php"); ?>
<?php
if (isset($_SESSION['username'])) {
} else {
    echo "<meta http-equiv=\"refresh\" content=\"0; url=index.php\">";
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
            <div class="w-full bg-black p-4 relative h-[200px]"
                style="background: url('https://images.unsplash.com/photo-1518180013386-746fb077171b?q=80&w=2069&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover;">
                <img src="./core/img/profilePic.jpg"
                    class="absolute top-[180px] shadow-lg left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-[148px] h-[148px] rounded-full">
            </div>
            <div class="flex flex-col lg:flex-row">
            <div class="flex-[3]">
                Profile
            </div>
            <div class="flex-[7]">
                <div class="mt-20 m-auto max-w-[600px] bg-white border-[1px] rounded-xl p-4">
                <div class="flex flex-col lg:flex-row">
                    <div class="flex-[1] text-center">
                        <span class="font-semibold">Questions</span>
                        <p>0</p>
                    </div>
                    <div class="flex-[1] text-center">
                        <span class="font-semibold">Answers</span>
                        <p>0</p>
                    </div>
                    <div class="flex-[1] text-center">
                        <span class="font-semibold">Skipped</span>
                        <p>0</p>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</body>

</html>