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
            <?php
            if ($global_permissions == "2") {
                $teacherID = $global_id;
            } else {
                $teacherID = @$_GET['id'];
            }
            $sql = "SELECT * FROM `users` WHERE `id`='$teacherID'";
            $query = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($query);
            $teacher_name = $row['full_name'];
            $teacher_email = $row['email'];
            $teacher_mobile = $row['mobile'];
            if ($teacher_mobile == "") {
                $teacher_mobile = "Not Available";
            } else {
                $teacher_mobile;
            }
            $teacher_date = $row['sign_up_date'];
            $teacher_master = $row['master'];
            $sql2 = "SELECT * FROM `config_subject` WHERE `id`='$teacher_master'";
            $query2 = mysqli_query($conn, $sql2);
            $rows = mysqli_fetch_array($query2);
            $teacher_grade = $rows['value'];
            ?>
            <br />
            <div class="max-w-[1200px] m-auto p-10">
                <div class="flex flex-wrap gap-10 flex-col lg:flex-row">
                    <div class="flex-[3]">
                        <div class="bg-white shadow-xl border-[1px] p-4">
                            <div class="relative w-full rounded-b-[60px] h-[120px] bg-yellow-300 mb-14">
                                <img src="./core/img/profilePic.jpg"
                                    class="shadow-lg w-[80px] border-[4px] border-white h-[80px] rounded-full object-cover absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 mt-[60px] absolute">
                            </div>
                            <p class="text-center text-xl font-semibold"><?= $teacher_name ?> <span
                                    class="text-zinc-400 font-regular">#<?= $teacherID ?></span></p>
                            <p class="bg-blue-100 rounded-full py-2 px-4 block text-center mt-4 mb-4">
                                <?= $teacher_grade ?>
                            </p>
                            <div class="flex flex-wrap justify-center">
                                <div class="flex-[1] p-2">
                                    <p class="text-sm font-semibold text-center"><span
                                            class="font-bold text-xl font-regular"><i class="bi bi-graph-up-arrow"></i>
                                            <?php
                                            $sql = "SELECT q.id, q.question
                                                FROM questions q
                                                LEFT JOIN answers a ON q.id = a.qID
                                                WHERE a.qID IS NOT NULL AND a.adminID = '$teacherID';";
                                            $query = mysqli_query($conn, $sql);
                                            echo $count = mysqli_num_rows($query);
                                            ?></span> Resolved</p>
                                </div>
                                <!-- <div class="flex-[1] p-2">
                                        <p class="text-sm font-semibold text-center"><span
                                                class="font-bold text-xl font-regular"><i
                                                    class="bi bi-arrow-90deg-down"></i> 0</span> Skipped</p>
                                    </div> -->
                            </div>
                            <hr class="mt-2 mb-2" />
                            <div class="p-4 flex flex-col gap-2">
                                <p class="text-sm"><i class="bi bi-envelope"></i> <?= $teacher_email ?></p>
                                <p class="text-sm"><i class="bi bi-telephone"></i> <?= $teacher_mobile ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="flex-[7]">
                        <?php
                        if($global_permissions == "") {
                        ?>
                        <div class="bg-white shadow-xl p-6 border-[1px]">
                            <div class="flex flex-wrap justify-between items-center">
                                <h1 class="text-xl font-semibold">Questions</h1>
                                <div class="timer text-center text-sm font-bold">
                                    <i class="bi bi-clock"></i> <span id="countdown">30</span> seconds
                                </div>
                            </div>
                            <table class="table-auto mt-4 w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-950">
                                        <th
                                            class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            ID</th>
                                        <th
                                            class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Question</th>
                                        <th
                                            class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody id="questions-table">
                                    <!-- Rows will be loaded here -->
                                </tbody>
                            </table>

                            <script>
                                let countdownTimer;

                                function loadQuestions() {
                                    const xhr = new XMLHttpRequest();
                                    xhr.open('GET', 'load_questions.php?master=<?= $teacher_master ?>', true);
                                    xhr.onload = function () {
                                        if (this.status === 200) {
                                            document.getElementById('questions-table').innerHTML = this.responseText;
                                        }
                                    }
                                    xhr.send();
                                    startCountdown(); // Restart the countdown after loading questions
                                }

                                function startCountdown() {
                                    let countdown = 30;
                                    document.getElementById('countdown').textContent = countdown;
                                    clearInterval(countdownTimer); // Clear any existing interval
                                    countdownTimer = setInterval(() => {
                                        countdown--;
                                        document.getElementById('countdown').textContent = countdown;
                                        if (countdown === 0) {
                                            clearInterval(countdownTimer);
                                            loadQuestions();
                                        }
                                    }, 1000);
                                }

                                // Load questions initially
                                loadQuestions();
                            </script>
                        </div>
                        <?php
                        }
                        ?>
                        <div class="bg-white shadow-xl p-6 border-[1px] mt-4">
                            <h1 class="text-xl font-semibold">Solved</h1>
                            <table class="table-auto mt-4 w-full bg-white">
                                <thead>
                                    <tr class="bg-gray-950">
                                        <th
                                            class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            ID
                                        </th>
                                        <th
                                            class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Question</th>
                                        <th
                                            class="px-4 py-4 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 0;
                                    $sql = "SELECT q.id, q.question
                                        FROM questions q
                                        LEFT JOIN answers a ON q.id = a.qID
                                        WHERE a.qID IS NOT NULL AND a.adminID = '$teacherID'
                                        ";
                                    $query = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($query)) {
                                        $id = $row['id'];
                                        $question = $row['question'];
                                        $i++;
                                        ?>
                                        <tr class="border-b border-gray-200">
                                            <td class="px-4 py-4 whitespace-nowrap"><?= $i ?></td>
                                            <td class="px-4 py-4 whitespace-nowrap"><?= $question ?></td>
                                            <td class="px-4 py-4 whitespace-nowrap">
                                                <!-- <button
                                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button> -->
                                                <a href="view.php?id=<?=$id?>"
                                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2">View</a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>