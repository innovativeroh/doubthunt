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
    <title>Dashboard</title>
</head>

<body>
    <div class="flex flex-col sm:flex-row h-screen">
        <?php include_once ("./includes/header.php"); ?>
        <div class="p-4 flex-1 overflow-y-auto">
            <!-- Content goes here -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
                <?php
                if ($global_permissions == "1") {
                    ?>
                    <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="font-semibold text-3xl"><?php
                                $sql = "SELECT * FROM `users` WHERE `permissions`='0'";
                                $query = mysqli_query($conn, $sql);
                                echo $num_rows = mysqli_num_rows($query);
                                ?></h1>
                                <span class="block mt-4 font-semibold">Total Students</span>
                            </div>
                            <div>
                                <i class="bi bi-people-fill text-4xl text-gray-950"></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="font-semibold text-3xl"><?php
                                $sql = "SELECT * FROM `users` WHERE `permissions`='2'";
                                $query = mysqli_query($conn, $sql);
                                echo $num_rows = mysqli_num_rows($query);
                                ?></h1>
                                <span class="block mt-4 font-semibold">Total Teachers</span>
                            </div>
                            <div>
                                <i class="bi bi-award-fill text-4xl text-gray-950"></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="font-semibold text-3xl"><?php
                                $sql = "SELECT * FROM `questions`";
                                $query = mysqli_query($conn, $sql);
                                echo $num_rows = mysqli_num_rows($query);
                                ?></h1>
                                <span class="block mt-4 font-semibold">Total Questions</span>
                            </div>
                            <div>
                                <i class="bi bi-bezier text-4xl text-gray-950"></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="font-semibold text-3xl"><?php
                                $sql = "SELECT * FROM `answers`";
                                $query = mysqli_query($conn, $sql);
                                echo $num_rows = mysqli_num_rows($query);
                                ?></h1>
                                <span class="block mt-4 font-semibold">Total Answered</span>
                            </div>
                            <div>
                                <i class="bi bi-people-fill text-4xl text-gray-950"></i>
                            </div>
                        </div>
                    </div>
                    <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                        <div class="flex justify-between items-center">
                            <div>
                                <h1 class="font-semibold text-3xl"><?php
                                $sql = "SELECT * FROM `config_plans`";
                                $query = mysqli_query($conn, $sql);
                                echo $num_rows = mysqli_num_rows($query);
                                ?></h1>
                                <span class="block mt-4 font-semibold">Plans</span>
                            </div>
                            <div>
                                <i class="bi bi-backpack2-fill text-4xl text-gray-950"></i>
                            </div>
                        </div>
                    </div>
                    <?php
                } else if ($global_permissions == "2") {
                    $today = date("Y-m-d");  // Correct format should be 'Y-m-d' for MySQL
                    $startOfWeek = date("Y-m-d", strtotime("last Sunday"));
                    $startOfMonth = date("Y-m-01");
                    ?>
                        <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h1 class="font-semibold text-3xl">
                                        <?php
                                        $sql = "SELECT * FROM `answers` WHERE DATE(`dateTime`)='$today' AND `adminID`='$global_id'";
                                        $query = mysqli_query($conn, $sql);
                                        echo $num_rows = mysqli_num_rows($query);
                                        ?>
                                    </h1>
                                    <span class="block mt-4 font-semibold">Today</span>
                                </div>
                                <div>
                                    <i class="bi bi-graph-up-arrow text-4xl text-gray-950"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h1 class="font-semibold text-3xl">
                                        <?php
                                        $sql = "SELECT * FROM `answers` WHERE DATE(`dateTime`) BETWEEN '$startOfWeek' AND '$today' AND `adminID`='$global_id'";
                                        $query = mysqli_query($conn, $sql);
                                        echo $num_rows = mysqli_num_rows($query);
                                        ?>
                                    </h1>
                                    <span class="block mt-4 font-semibold">Weekly</span>
                                </div>
                                <div>
                                    <i class="bi bi-graph-up-arrow text-4xl text-gray-950"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h1 class="font-semibold text-3xl">
                                        <?php
                                        $sql = "SELECT * FROM `answers` WHERE DATE(`dateTime`) BETWEEN '$startOfMonth' AND '$today' AND `adminID`='$global_id'";
                                        $query = mysqli_query($conn, $sql);
                                        echo $num_rows = mysqli_num_rows($query);
                                        ?>
                                    </h1>
                                    <span class="block mt-4 font-semibold">Monthly</span>
                                </div>
                                <div>
                                    <i class="bi bi-graph-up-arrow text-4xl text-gray-950"></i>
                                </div>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 border-[1px] rounded-xl p-8">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h1 class="font-semibold text-3xl">
                                        <?php
                                        $sql = "SELECT * FROM `answers` WHERE `adminID`='$global_id'";
                                        $query = mysqli_query($conn, $sql);
                                        echo $num_rows = mysqli_num_rows($query);
                                        ?>
                                    </h1>
                                    <span class="block mt-4 font-semibold">Total</span>
                                </div>
                                <div>
                                    <i class="bi bi-arrow-90deg-down text-4xl text-gray-950"></i>
                                </div>
                            </div>
                        </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
    <?php include_once ("./includes/footer.php"); ?>
</body>

</html>