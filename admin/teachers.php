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
        <div class="p-10 flex-1 overflow-y-auto">
            <!-- Content goes here -->
            <div class="overflow-x-auto">
                <!-- Popup -->
                <div id="popup" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
                    <div class="bg-white rounded-lg p-6 w-96 shadow-lg">
                        <h2 class="text-xl font-semibold mb-4">Add Teacher</h2>
                        <?php
                        if (isset($_POST['addT'])) {
                            $fullName = @$_POST['fullName'];
                            $email = @$_POST['email'];
                            $password = @$_POST['password'];
                            $subject = @$_POST['subject'];
                            $date = date("Y-m-d");
                            $password_hased = password_hash($password, PASSWORD_DEFAULT);
                            $preSQl = "SELECT * FROM `users` WHERE `email`='$email'";
                            $preQuery = mysqli_query($conn, $preSQl);
                            echo $countEmail = mysqli_num_rows($preQuery);
                            if ($countEmail > 0) {
                                echo "<meta http-equiv=\"refresh\" content=\"0; url=teachers.php?errorCode=1\">";
                                exit();
                            } else {
                                $sql = "INSERT INTO `users`(`id`, `full_name`, `email`, `mobile`, `password`, `sign_up_date`, `ip_address`, `permissions`, `master`) VALUES (null,'$fullName','$email','','$password_hased','$date','','2','$subject')";
                                $query = mysqli_query($conn, $sql);
                                echo "<meta http-equiv=\"refresh\" content=\"0; url=teachers.php\">";
                                exit();
                            }
                        }
                        ?>
                        <form action="teachers.php" method="POST">
                            <div class="mb-4">
                                <label for="fullName" class="block text-gray-700">Full Name</label>
                                <input type="text" id="fullName" name="fullName"
                                    class="mt-1 p-2 w-full border rounded bg-gray-100" required>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="block text-gray-700">Email</label>
                                <input type="email" id="email" name="email"
                                    class="mt-1 p-2 w-full border rounded bg-gray-100" required>
                            </div>
                            <div class="mb-4">
                                <label for="password" class="block text-gray-700">Password</label>
                                <input type="password" id="password" name="password"
                                    class="mt-1 p-2 w-full border rounded bg-gray-100" required>
                            </div>
                            <div class="mb-4">
                                <label for="subject" class="block text-gray-700">Subject</label>
                                <select name="subject" class="mt-1 p-2 w-full border rounded bg-gray-100" required>
                                    <?php
                                    $sql = "SELECT * FROM `config_subject`";
                                    $query = mysqli_query($conn, $sql);
                                    while ($rows = mysqli_fetch_assoc($query)) {
                                        $id = $rows['id'];
                                        $value = $rows['value'];
                                        ?>
                                        <option value="<?= $id ?>"><?= $value ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="flex justify-end">
                                <button type="button" id="closePopupBtn"
                                    class="px-4 py-2 mr-2 bg-red-500 text-white rounded hover:bg-red-700">
                                    Close
                                </button>
                                <button type="submit" name="addT"
                                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700">
                                    Add Teacher
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
                    if(@$_GET['errorCode'] == "1") {
                        ?>
                    <div class="mb-4 block px-4 p-2 bg-red-50 rounded-lg border-red-200 border-[1px]">
                        <span class="font-semibold text-sm text-red-600">Tearcher! Already Exist</span>
                    </div>
                        <?php
                    }
                ?>
                <div class="flex justify-between mb-4">
                    <h1 class="text-3xl font-semibold block mb-4 inline-block">Teachers</h1>
                    <button id="openPopupBtn" class="px-4 py-0 bg-blue-500 text-white rounded hover:bg-blue-700">
                        Add +
                    </button>
                </div>
                <table class="table-auto w-full bg-white shadow-xl">
                    <thead>
                        <tr class="bg-gray-950">
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">ID
                            </th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Full Name</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Email</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Mobile</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Sign Up Date</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">IP
                                Address</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Master</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            $sql = "SELECT * FROM `users` WHERE `permissions`='2'";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_assoc($query)) {
                                $userID = $rows['id'];
                                $full_name = $rows['full_name'];
                                $email = $rows['email'];
                                $mobile = $rows['mobile'];
                                $date = $rows['sign_up_date'];
                                $master = $rows['master'];
                                $sql2 = "SELECT * FROM `config_subject` WHERE `id`='$master'";
                                $query2 = mysqli_query($conn, $sql2);
                                $row = mysqli_fetch_assoc($query2);
                                $master_subject = $row['value'];
                                $ip_address = $rows['ip_address'];
                                $i++;
                                ?>
                                <tr class="border-b border-gray-200">
                                <td class="px-4 py-4 whitespace-nowrap"><?=$i?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $full_name ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $email ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $mobile ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $date ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $ip_address ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $master_subject ?></td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <!-- <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button> -->
                                        <a href="teacher.php?id=<?=$userID?>"
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2"><i class="bi bi-eye"></i></a>
                                        <a href="delete_teacher.php?id=<?=$userID?>"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2">Delete</a>
                                </td>
                                </tr>
                                <?php
                            }
                            ?>
                        <!-- More rows can be added here -->
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    </div>
    <?php include_once ("./includes/footer.php"); ?>
</body>

</html>
<script>
    document.getElementById('openPopupBtn').addEventListener('click', function () {
        document.getElementById('popup').classList.remove('hidden');
    });

    document.getElementById('closePopupBtn').addEventListener('click', function () {
        document.getElementById('popup').classList.add('hidden');
    });
</script>