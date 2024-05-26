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
                        <h2 class="text-xl font-semibold mb-4">Add Plans</h2>
                        <?php
                        if (isset($_POST['addT'])) {
                            $questions = @$_POST['questions'];
                            $amount = @$_POST['amount'];
                                $sql = "INSERT INTO `config_plans`(`id`, `days`, `amount`) VALUES (null,'$questions','$amount')";
                                $query = mysqli_query($conn, $sql);
                                echo "<meta http-equiv=\"refresh\" content=\"0; url=plans.php\">";
                                exit();
                            }
                        ?>
                        <form action="plans.php" method="POST">
                            <div class="mb-4">
                                <label for="questions" class="block text-gray-700">Questions (Value)</label>
                                <input type="number" id="questions" name="questions"
                                    class="mt-1 p-2 w-full border rounded bg-gray-100" value="1" minlength="1" required>
                            </div>
                            <div class="mb-4">
                                <label for="amount" class="block text-gray-700">Amount (Value)</label>
                                <input type="number" id="amount" name="amount"
                                    class="mt-1 p-2 w-full border rounded bg-gray-100" value="100" minlength="100" required>
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
                    <h1 class="text-3xl font-semibold block mb-4 inline-block">Plans</h1>
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
                                Days</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Amount</th>
                            <th class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i=0;
                            $sql = "SELECT * FROM `config_plans`";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_assoc($query)) {
                                $planID = $rows['id'];
                                $days = $rows['days'];
                                $amount = $rows['amount'];
                                $i++;
                                ?>
                                <tr class="border-b border-gray-200">
                                <td class="px-4 py-4 whitespace-nowrap"><?=$i?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $days ?></td>
                                <td class="px-4 py-4 whitespace-nowrap"><?= $amount ?></td>
                                <td class="px-4 py-4 whitespace-nowrap">
                                    <!-- <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button> -->
                                        <a href="delete_plan.php?id=<?=$planID?>"
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