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
    <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent"></div>
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
              Students
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

          <!-- ====== Table Section Start -->
          <div class="flex flex-col gap-10">

            <!-- ====== Table Two Start -->
            <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
              <div class="px-4 py-6 md:px-6 xl:px-7.5">
                <h4 class="text-xl font-bold text-black dark:text-white">List Of Students</h4>
              </div>

              <div
                class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                <div class="col-span-3 flex items-center">
                  <p class="font-medium">Full Name</p>
                </div>
                <div class="col-span-2 hidden items-center sm:flex">
                  <p class="font-medium">Mobile</p>
                </div>
                <div class="col-span-1 flex items-center">
                  <p class="font-medium">Sign Up Date</p>
                </div>
                <div class="col-span-1 flex items-center">
                  <p class="font-medium">IP Address</p>
                </div>
                <div class="col-span-1 flex items-center">
                  <p class="font-medium">Action</p>
                </div>
              </div>

              <?php
              $sql = "SELECT * FROM `users`";
              $query = mysqli_query($conn, $sql);
              while ($rows = mysqli_fetch_assoc($query)) {
                $full_name = $rows['full_name'];
                $mobile = $rows['mobile'];
                $date = $rows['sign_up_date'];
                $ip_address = $rows['ip_address'];
                ?>

                <div
                  class="grid grid-cols-6 border-t border-stroke px-4 py-4.5 dark:border-strokedark sm:grid-cols-8 md:px-6 2xl:px-7.5">
                  <div class="col-span-3 flex items-center">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                      <p class="text-sm font-medium text-black dark:text-white">
                        <?= $full_name ?>
                      </p>
                    </div>
                  </div>
                  <div class="col-span-2 hidden items-center sm:flex">
                    <p class="text-sm font-medium text-black dark:text-white"><?=$mobile?></p>
                  </div>
                  <div class="col-span-1 flex items-center">
                    <p class="text-sm font-medium text-black dark:text-white"><?=$date?></p>
                  </div>
                  <div class="col-span-1 flex items-center">
                    <p class="text-sm font-medium text-black dark:text-white"><?=$ip_address?></p>
                  </div>
                  <div class="col-span-1 flex items-center">
                    <p class="text-sm font-medium text-meta-3">-</p>
                  </div>
                </div>
                <?php
              }
              ?>
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