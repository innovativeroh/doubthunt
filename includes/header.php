<link rel="icon" type="image/png" href="./core/img/favicon.png">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                    class="text-white py-2 px-4 rounded-lg bg-orange-500 font-semibold hidden lg:block">Get Started <i
                        class="bi bi-arrow-right"></i></button>
                <button class="block lg:hidden"><i class="bi bi-list"></i></button>
            </div>
        </div>
    </div>
</div>
<div class="w-full h-screen z-[11] fixed" id="overlay" style="display: none;">
    <div
        class="w-[400px] bg-white h-[400px] shadow-lg rounded-lg top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 absolute">
        <div class="">
            <button onclick="hideOverlay()">Close</button>
        </div>
    </div>
</div>
<script>
// Get references to the button and overlay elements
const loginOTPButton = document.getElementById('loginOTP');
const overlay = document.getElementById('overlay');
// Add click event listener to the loginOTP button
loginOTPButton.addEventListener('click', function() {
  // Toggle the display of the overlay
  overlay.style.display = (overlay.style.display === 'block') ? 'none' : 'block';
});

function hideOverlay() {
  overlay.style.display = 'none';
}

</script>