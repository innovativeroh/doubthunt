<?php include_once ('./includes/connection.php'); ?>
<link rel="icon" type="image/png" href="./core/img/favicon.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>
<div class="w-full p-4 bg-white shadow-lg fixed z-[10]">
    <div class="max-w-[1280px] m-auto">
        <div class="flex flex-wrap justify-center items-center">
            <div class="flex-[1]">
                <a href='index.php'><img src='./core/img/logoMain.png'></a>
            </div>
            <div class="flex-[1]">
                <nav class="justify-center gap-10 hidden lg:flex">
                    <a href="" class="font-semibold text-slate-950">Solve</a>
                    <a href="" class="font-semibold text-slate-950">Guides</a>
                    <a href="" class="font-semibold text-slate-950">About</a>
                    <a href="" class="font-semibold text-slate-950">Enroll</a>
                </nav>
            </div>
            <div class="flex-[1] justify-end flex">
                <button id="loginOTP"
                    class="text-white py-2 px-4 rounded-lg bg-orange-500 font-semibold hidden lg:block"><?=$user?>Get Started <i
                        class="bi bi-arrow-right"></i></button>
                <button class="block lg:hidden"><i class="bi bi-list"></i></button>
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
                        if(response == "success") {
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

</script>