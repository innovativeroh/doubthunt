<?php include_once ('./includes/connection.php'); ?>
<link rel="icon" type="image/png" href="./core/img/favicon.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="./core/css/main.css" type="text/css">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<div class="w-full p-4 bg-white shadow-lg fixed z-[10]">
    <div class="max-w-[1280px] m-auto">
        <div class="flex flex-wrap justify-center items-center">
            <div class="flex-[1]">
                <div class="flex flex-start items-center">
                <a href='index.php'><img src='./core/img/logo.png' class="w-[15px]"></a>
                <p class="font-bold text-lg text-zinc-700">oubtHunt</p>
                </div>
            </div>
            <div class="flex-[1]">
                <nav class="justify-center gap-10 hidden lg:flex">
                    <a href="#" class="font-semibold text-slate-950">Solve</a>
                    <a href="#" class="font-semibold text-slate-950">Guides</a>
                </nav>
            </div>
            <div class="flex-[1] justify-end flex">
                <?php
                if (isset($_SESSION['username'])) {
                    $sql = "SELECT * FROM `active_plans` WHERE `userID`='$global_id' AND `expired`='0'";
                    $query = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($query);
                    if ($count == "1") {
                        $row = mysqli_fetch_assoc($query);
                        $limitUse = $row['limitUse'];
                        ?>
                        <button class="mr-[10px] border-[1px] py-2 px-4 rounded-3xl bg-gray-100"><i class="bi bi-wallet"></i>
                            <?= $limitUse ?></button>
                        <?php
                    } else {
                        ?>
                        <a href="plans.php"><button class="mr-[10px] border-[1px] text-orange-500 py-2 px-4 rounded-3xl" title="Subscribe"><i
                                class="bi bi-wallet"></i> 0</button></a>
                        <?php
                    }
                    ?>

                    <button class="text-white py-2 px-4 rounded-3xl bg-orange-500 font-semibold hidden lg:block"><i
                            class="bi bi-person-circle"></i> <?= $global_full_name ?></button>
                    <button onclick="sidebarMenu()"><i class="bi bi-list ml-4 text-2xl"></i></button>
                    <?php
                } else {
                    ?>
                    <button id="loginOTP" class="text-white py-2 px-4 rounded-3xl bg-orange-500 font-semibold">Login <i
                            class="bi bi-arrow-right"></i></button>
                    <button onclick="sidebarMenu()"><i class="bi bi-list ml-4 text-2xl"></i></button>
                    <?php
                }
                ?>

            </div>
        </div>
    </div>
</div>
<div class="w-full h-screen z-[11] fixed" id="overlay" style="display: none;">
    <div
        class="w-[400px] bg-white h-[400px] shadow-lg rounded-lg top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 absolute">
        <div class="h-full w-full items-center justify-center flex relative gap-4 flex-col">
            <div class="p-4 absolute top-[0] right-[0]">
                <button class="float-right" onclick="hideOverlay()"><i
                        class="bi bi-x text-xl text-zinc-600"></i></button>
            </div>

            <script>
                $(document).ready(function () {
                    $('#mobileForm').submit(function (event) {
                        event.preventDefault();
                        var formData1 = $(this).serialize();
                        $.ajax({
                            type: 'POST',
                            url: 'routes/mobileAuth.php',
                            data: formData1,
                            success: function (response) {
                                $('#authMobile').hide();
                                $('#authOTP').show();
                                var onlyNumber = $('#onlyNum').val();
                                var maskedNumber = onlyNumber.slice(0, 2) + "******" + onlyNumber.slice(-1);
                                $('#generatedOTP').val(maskedNumber);
                                $('#postMobile').val(onlyNumber);
                            },
                            error: function () {
                                alert("Server Error!");
                            }
                        });
                    });

                    $('#otpForm').submit(function (event) {
                        event.preventDefault();
                        var formData2 = $(this).serialize();
                        $.ajax({
                            type: 'POST',
                            url: 'routes/otpAuth.php',
                            data: formData2,
                            success: function (response) {
                                if (response == "success") {
                                    location.reload();
                                } else {
                                    $('#otpResp').html(response);
                                }
                            },
                            error: function () {
                                alert("Server Error!");
                            }
                        });
                    });
                });
            </script>

            <!-- MOBILE NUMBER AREA STARTS HERE -->

            <div id="authMobile" class="flex flex-col justify-center items-center gap-2">
                <i class="bi bi-phone text-4xl text-orange-500"></i>
                <h1 class="font-semibold text-xl inline-block">Get Started</h1>
                <center>
                    <p class="text-xs inline-block text-gray-500">Enter your mobile number to <br> sign up/
                        sign in to your account</p>
                </center>

                <form id="mobileForm" method="POST" class="w-[300px]">
                    <input type="text" id="onlyNum" maxlength="10" minlength="10" name="mobile"
                        placeholder="Enter Phone Number"
                        class="w-[300px] border-[1px] border-zinc-200 p-2 outline-none rounded-lg" required>
                    <button type="submit"
                        class="w-full bg-orange-500 p-2 rounded-lg font-semibold mt-4 text-white">Login <i
                            class="bi bi-arrow-right"></i></button>
                </form>
            </div>

            <!-- END OF MOBILE NUMBER AREA  -->

            <!-- OTP AREA STARTS HERE -->

            <div id="authOTP" style="display: none;">
                <div class="flex flex-col justify-center items-center gap-2">
                    <i class="bi bi-sim text-4xl text-orange-500"></i>
                    <h1 class="font-semibold text-xl inline-block">Enter OTP</h1>
                    <center>
                        <p class="text-xs inline-block text-gray-500">Please enter the verification code Sent to <span
                                id="generatedOTP"></span></p>
                    </center>
                    <form id="otpForm" method="POST" class="w-[300px]">
                        <input type="hidden" name='mobile' id='postMobile'>
                        <input type="text" id="onlyOTP" maxlength="4" minlength="4" name="otp" placeholder="4 Digit OTP"
                            class="w-[300px] tracking-widest text-center border-[1px] border-zinc-200 p-2 outline-none rounded-lg"
                            required>
                        <button type="submit"
                            class="w-full bg-orange-500 p-2 rounded-lg font-semibold mt-4 text-white">Verify <i
                                class="bi bi-arrow-right"></i></button>
                    </form>
                    <span id="otpResp" class="text-center text-red-400 text-sm font-semibold"></span>
                </div>

                <!-- OTP AREA ENDS HERE -->
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#profileForm').submit(function (e) {
            e.preventDefault();
            var formData3 = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: 'routes/profileAuth.php',
                data: formData3,
                success: function (response) {
                    if (response == "Success") {
                        location.reload();
                    } else {
                        $('#profileResp').html(response);
                    }
                },
                error: function () {
                    alert("Server Error!");
                }
            });
        });
    });
</script>

<?php
if ($global_full_name == "Student") {
    ?>
    <!-- First Time Login -->
    <div class="w-full h-screen fixed z-[19]" id="overlay">
        <div
            class="w-[400px] z-[20] bg-white h-auto shadow-lg rounded-lg top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 absolute">
            <div class="h-full w-full justify-center flex relative gap-4 flex-col p-4 p-8">
                <h1 class="font-semibold text-xl"><i class="bi bi-person-circle text-2xl text-orange-500"></i> Complete Your
                    Profile</h1>
                <form id="profileForm" method="POST">
                    <label for="name" class="text-xs mt-4 block"> First Name <span class="text-xs text-red-400">*</span>
                        <br />
                        <input type="text" name="name" placeholder="eg. Arpit Tiwari"
                            class="text-sm mt-2 p-2 border-[1px] border-zinc-200 w-full rounded-lg" required />
                    </label>
                    <label for="name" class="text-xs mt-4 block"> Email <br />
                        <input type="email" name="email" placeholder="eg. someone@something.com"
                            class="text-sm mt-2 p-2 border-[1px] border-zinc-200 w-full rounded-lg" required />
                    </label>
                    <label for="name" class="text-xs mt-4 block"> Standard <br />
                        <select name="standard" class="text-sm mt-2 p-2 border-[1px] border-zinc-200 w-full rounded-lg">
                            <?php
                            $sql = "SELECT * FROM `config_standards`";
                            $query = mysqli_query($conn, $sql);
                            while ($rows = mysqli_fetch_assoc($query)) {
                                $idValue = $rows['id'];
                                $value = $rows['value'];
                                ?>
                                <option value="<?= $idValue ?>"><?= $value ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </label>
                    <button type="submit"
                        class="transition w-full bg-orange-500 p-2 rounded-lg font-semibold mt-4 text-white hover:bg-orange-600">Complete
                        <i class="bi bi-arrow-right"></i></button>
                    <a href="logout.php"
                        class="transition w-full bg-zinc-200 p-2 rounded-lg text-zinc-800 font-semibold mt-4 text-white block text-center hover:bg-zinc-800 hover:text-white">Logout
                        <i class="bi bi-box-arrow-right"></i></a>
                    <center><span id="profileResp" class="text-center text-red-400 text-sm font-semibold mt-2 block"></span>
                    </center>
                </form>
            </div>
        </div>
    </div>
    <!-- End Of First Time Login -->
    <?php
} else {
}
?>
<div id="sidebarContainer" style="display: none;">
    <div class="w-full h-screen z-[11] fixed">
        <div class="h-screen w-[300px] bg-white fixed shadow-lg z-[25] top-[0] right-[0] p-4" style="translateX(-100%)">
            <button class="absolute top-4 left-4" onclick="sidebarMenuClose()"><i
                    class="bi bi-arrow-left text-2xl text-gray-500"></i></button>
            <br />
            <?php
            if (isset($_SESSION['username'])) {
                ?>
                <div class="mt-4 w-full p-2 flex flex-col gap-1">
                    <h1 class="text-xl font-semibold">Welcome,</h1>
                    <p class="text-md"><?= $global_full_name; ?></p>
                    <hr class="h-[1px] bg-zinc-100 border-none w-full mt-2 mb-2" />
                    <span class="text-zinc-400 text-xs tracking-widest">Menus</span>
                    <div class="flex flex-col gap-2 mt-2">
                        <button
                            class="transition flex flex-start flex-row gap-2 items-center text-md bg-gray-100 p-2 rounded-lg pl-4 hover:bg-gray-200"><i
                                class="bi bi-app-indicator text-orange-500"></i>
                            <p class="text-md inline-block font-semibold text-zinc-800">Dashboard</p>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <button
                            class="transition flex flex-start flex-row gap-2 items-center text-md bg-gray-100 p-2 rounded-lg pl-4 hover:bg-gray-200"><i
                                class="bi bi-puzzle text-orange-500"></i>
                            <p class="text-md inline-block font-semibold text-zinc-800">Solve</p>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <button
                            class="transition flex flex-start flex-row gap-2 items-center text-md bg-gray-100 p-2 rounded-lg pl-4 hover:bg-gray-200"><i
                                class="bi bi-journal text-orange-500"></i>
                            <p class="text-md inline-block font-semibold text-zinc-800">Guides</p>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <a href='logout.php' class="w-full"><button
                                class="transition block w-full flex flex-start flex-row gap-2 items-center text-md bg-gray-100 p-2 rounded-lg pl-4 hover:bg-gray-200"><i
                                    class="bi bi-box-arrow-left text-orange-500"></i>
                                <p class="text-md inline-block font-semibold text-zinc-800">Logout</p>
                            </button></a>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="mt-4 w-full p-2 flex flex-col gap-1">
                    <h1 class="text-xl font-semibold">Welcome,</h1>
                    <p class="text-md">Guest</p>
                    <hr class="h-[1px] bg-zinc-100 border-none w-full mt-2 mb-2" />
                    <span class="text-zinc-400 text-xs tracking-widest">Menus</span>
                    <div class="flex flex-col gap-2 mt-2">
                        <button
                            class="transition flex flex-start flex-row gap-2 items-center text-md bg-gray-100 p-2 rounded-lg pl-4 hover:bg-gray-200"><i
                                class="bi bi-house text-orange-500"></i>
                            <p class="text-md inline-block font-semibold text-zinc-800">Home</p>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <button
                            class="transition flex flex-start flex-row gap-2 items-center text-md bg-gray-100 p-2 rounded-lg pl-4 hover:bg-gray-200"><i
                                class="bi bi-puzzle text-orange-500"></i>
                            <p class="text-md inline-block font-semibold text-zinc-800">Solve</p>
                        </button>
                    </div>
                    <div class="flex flex-col gap-2 mt-2">
                        <button
                            class="transition flex flex-start flex-row gap-2 items-center text-md bg-gray-100 p-2 rounded-lg pl-4 hover:bg-gray-200"><i
                                class="bi bi-journal text-orange-500"></i>
                            <p class="text-md inline-block font-semibold text-zinc-800">Guides</p>
                        </button>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<script>
    // Get references to the button and overlay elements
    const loginOTPButton = document.getElementById('loginOTP');
    const overlay = document.getElementById('overlay');
    // Add click event listener to the loginOTP button
    loginOTPButton.addEventListener('click', function () {
        // Toggle the display of the overlay
        overlay.style.display = (overlay.style.display === 'block') ? 'none' : 'block';
    });

    function hideOverlay() {
        overlay.style.display = 'none';
    }

    //Sidebar Menu Contents
    function sidebarMenu() {
        const sidebarContainer = document.getElementById('sidebarContainer');
        sidebarContainer.style.display = 'block';
    }
    function sidebarMenuClose() {
        const sidebarContainer = document.getElementById('sidebarContainer');
        sidebarContainer.style.display = 'none';
    }
</script>