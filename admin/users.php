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
                <h1 class="text-3xl font-semibold block mb-4">Students</h1>
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
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM `users` WHERE `permissions`='0'";
                        $query = mysqli_query($conn, $sql);
                        while ($rows = mysqli_fetch_assoc($query)) {
                            $userID = $rows['id'];
                            $full_name = $rows['full_name'];
                            $email = $rows['email'];
                            $mobile = $rows['mobile'];
                            $date = $rows['sign_up_date'];
                            $ip_address = $rows['ip_address'];
                            ?>
                            <tr class="border-b border-gray-200">
                                <td class="px-4 py-4 whitespace-nowrap">1</td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $full_name ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $email ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $mobile ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $date ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $ip_address ?></td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                    <a href="delete_user.php?id=<?= $userID ?>"
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