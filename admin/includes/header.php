<?php include_once ("./includes/connection.php"); ?>
<script src="https://cdn.tailwindcss.com"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="./core/css/main.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<div id="sidebar"
    class="bg-gray-950 text-white w-[300px] flex-shrink-0 sm:static fixed inset-y-0 left-0 z-50 overflow-y-auto sm:overflow-y-visible">
    <!-- Sidebar content -->
    <div class="p-4">
        <div class="flex flex-warp justify-between p-2 items-center">
            <img src="./core/img/logoMain.png" />
            <div class="sm:hidden">
                <button id="hideSidebarBtn" class="text-white text-2xl"><i class="bi bi-list"></i></button>
            </div>
        </div>
        <div class="mt-8 w-full flex flex-wrap items-center gap-2 justify-between">
            <div class="flex-[2]">
                <img src="./core/img/profilePic.jpg" class="w-[45px] rounded-full m-auto h-[45px]" />
            </div>
            <div class="flex-[8]">
                <p class="text-sm text-gray-400"><?=$power?></p>
                <span class="text-sm text-gray-400">Online <i
                        class="bi bi-circle-fill text-green-400 text-xs pl-1"></i></span>
            </div>
        </div>
        <div class="mt-10">
            <span class="block mt-4 mb-4 font-bold text-sm text-gray-500">General</span>
            <a href="dashboard.php" class="transition block w-full text-left rounded-xl py-2 px-4 hover:bg-gray-900 text-white-500 mb-4"> <i
                    class="bi bi-speedometer pr-2"></i> Dashboard</a>

            <a href="users.php" class="transition w-full block text-left rounded-xl py-2 px-4 hover:bg-gray-900 text-white-500 mb-4"> <i
                    class="bi bi-people-fill pr-2"></i> Users</a>

            <a href="teachers.php" class="transition w-full text-left block rounded-xl py-2 px-4 hover:bg-gray-900 text-white-500 mb-4"> <i
                    class="bi bi-award-fill pr-2"></i> Teachers</a>

            <a href="plans.php" class="transition w-full text-left block rounded-xl py-2 px-4 hover:bg-gray-900 text-white-500 mb-4"> <i
                    class="bi bi-bank pr-2"></i> Plans</a>

            <a class="transition w-full text-left block rounded-xl py-2 px-4 hover:bg-gray-900 text-white-500 mb-4"> <i
                    class="bi bi-box-arrow-left pr-2"></i> Logout</a>
        </div>
    </div>
    <!-- Hide Button Container -->
</div>

<!-- Main Content Area -->
<div class="flex flex-col flex-1">
    <!-- Header -->
    <div class="bg-white shadow-lg text-white p-4">
        <!-- Header content -->
        <button id="toggleSidebarBtn" class="text-gray-950 text-2xl"><i class="bi bi-list"></i></button>

    </div>
    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
        const hideSidebarBtn = document.getElementById('hideSidebarBtn');

        toggleSidebarBtn.addEventListener('click', function () {
            sidebar.classList.toggle('hidden');
        });

        hideSidebarBtn.addEventListener('click', function () {
            sidebar.classList.add('hidden');
        });
    </script>