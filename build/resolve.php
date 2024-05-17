<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        eCommerce Dashboard | TailAdmin - Tailwind CSS Admin Dashboard Template
    </title>
    <link rel="icon" href="favicon.ico">
    <link href="style.css" rel="stylesheet">
</head>

<body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}">
    <!-- ===== Preloader Start ===== -->
    <div x-show="loaded"
        x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
        class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
        <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent">
        </div>
    </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        <?php include_once ("sidebar.php"); ?>
        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <?php include_once ("header.php"); ?>
            <!-- ===== Main Content Start ===== -->
            <main>
                <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
                    <!-- Breadcrumb Start -->
                    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <h2 class="text-title-md2 font-bold text-black dark:text-white">
                            Answer
                        </h2>

                        <nav>
                            <ol class="flex items-center gap-2">
                                <li>
                                    <a class="font-medium" href="index.php">Dashboard /</a>
                                </li>
                                <li class="font-medium text-primary">Students</li>
                            </ol>
                        </nav>
                    </div>
                    <!-- Breadcrumb End -->
                    <div class="flex flex-col gap-9">
                        <!-- Textarea Fields -->
                        <div
                            class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
                            <div class="border-b border-stroke px-6.5 py-4 dark:border-strokedark">
                                <h3 class="font-medium text-black dark:text-white">
                                    <?php
                                    $quizID = @$_GET['id'];
                                    $sql = "SELECT * FROM `questions` WHERE `id`='$quizID'";
                                    $query = mysqli_query($conn, $sql);
                                    $rows = mysqli_fetch_assoc($query);
                                    echo $question = $rows['question'];

                                    if (isset($_POST['answerN'])) {
                                        $answerT = $_POST['answerT'];
                                        $config_cat = "";
                                        $date = date("Y-m-d");
                                        $sql = "INSERT INTO `answers`(`id`, `adminID`, `qID`, `answer`, `categoryID`, `dateTime`) VALUES (null,'1','$quizID','$answerT','$config_cat','$date')";
                                        $query = mysqli_query($conn, $sql);
                                        echo "<meta http-equiv=\"refresh\" content=\"0; url=questions.php\">";
                                        exit();
                                    }
                                    ?>
                                </h3>
                            </div>
                            <div class="flex flex-col gap-5.5 p-6.5">
                                <div>
                                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                                        Answer
                                    </label>
                                    <form action="resolve.php?id=<?= $quizID ?>" method="POST">
                                        <textarea name="answerT" rows="6" placeholder="Enter Your Answer"
                                            class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
                                            <button type="Submit" name="answerN"
                                            class="w-full p-4 bg-black rounded-xl text-white">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ====== Table Two End -->
                </div>
                <!-- ====== Table Section End -->
        </div>
        </main>
        <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
    <script defer src="bundle.js"></script>
</body>

</html>