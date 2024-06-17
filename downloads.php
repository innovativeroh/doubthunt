<?php
include_once ("./includes/header.php");

// Assuming these variables are set somewhere before this code.
$global_name = htmlspecialchars(@$global_full_name);
$global_email = htmlspecialchars(@$global_email);
$global_mobile = htmlspecialchars(@$global_mobile);

$search_g = @$_GET['q'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoubtHunt - Answer For Every Doubt</title>
    <link rel="stylesheet" href="path_to_your_css_file.css">
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        $(document).ready(function () {
            $('body').on('click', '.buy_now', function (e) {
                e.preventDefault();

                var totalAmount = $(this).data("amount");
                var productId = $(this).data("id");
                var packageName = $(this).data("name");
                var packageDownload = $(this).data("download");

                var options = {
                    "key": "rzp_test_qjpoTtbLdr7So6", // Replace with your Razorpay key ID
                    "amount": totalAmount * 100, // Amount in paise
                    "name": packageName,
                    "description": packageName,
                    "image": "https://doubthunt.com/core/img/favicon.png",
                    "prefill": {
                        "name": "<?php echo $global_name; ?>",
                        "email": "<?php echo $global_email; ?>",
                        "contact": "<?php echo $global_mobile; ?>"
                    },
                    "handler": function (response) {
                        $.ajax({
                            url: 'paymentD.php',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                razorpay_payment_id: response.razorpay_payment_id,
                                totalAmount: totalAmount,
                                product_id: productId
                            },
                            success: function (response) {
                                console.log("success", response);

                                var downloadLink = document.createElement('a');
                                downloadLink.href = './downloads/' + packageDownload;
                                downloadLink.download = packageDownload;
                                document.body.appendChild(downloadLink);
                                downloadLink.click();
                                document.body.removeChild(downloadLink);

                                window.location.href = 'index.php';
                            },
                            error: function (xhr, status, error) {
                                console.error("Payment failed:", status, error);
                            }
                        });
                    },
                    "theme": {
                        "color": "#528FF0"
                    }
                };

                var rzp1 = new Razorpay(options);
                rzp1.open();
            });
        });
    </script>
    <div>
        <div class="max-w-[800px] m-auto">
            <div class="w-full h-auto lg:h-screen">
                <br />
                <div class="mt-[100px] p-4">
                    <h1 class="font-semibold text-orange-500 text-5xl text-center">Shop</h1>
                    <p class="font-semibold text-xl text-zinc-800 text-center mt-5 mb-10">
                        Learn quickly and profoundly with impressive illustrations and graphics. <br />
                        Excellent Question Bank, Worksheets, and Modules
                    </p>
                    <form action="#" method="GET" class="relative">
                        <input type="text" name="q" placeholder="Search..."
                            class="transition w-full pl-12 p-4 rounded-xl shadow-none focus:shadow-xl border-[1px]" />
                        <i class="bi bi-search absolute left-5 top-5 text-zinc-600"></i>
                    </form>
                    <?php
                    if ($search_g == "") {
                        $sql = "SELECT * FROM `config_downloads`";
                    } else {
                        $sql = "SELECT * FROM `config_downloads` WHERE `name` LIKE '%$search_g%'";
                    }
                    $query = mysqli_query($conn, $sql);
                    while ($rows = mysqli_fetch_assoc($query)) {
                        $id = htmlspecialchars($rows['id']);
                        $name = htmlspecialchars($rows['name']);
                        $content = htmlspecialchars($rows['content']);
                        $amount = htmlspecialchars($rows['price']);
                        $value = htmlspecialchars($rows['value']);
                        ?>
                        <div class="w-full bg-white shadow-none hover:shadow-xl rounded-lg border-[1px] mb-4">
                            <div class="p-4 lg:items-center gap-4 justify-between flex flex-col lg:flex-row">
                                <div class="flex-[0.5]">
                                    <img src="./core/img/extension.png" class="lg:w-full">
                                </div>
                                <div class="flex-[7]">
                                    <h1 class="text-xl font-semibold leading-10"><?= $name ?></h1>
                                    <p class="text-zinc-600 text-sm"><?= $content ?></p>
                                </div>
                                <div class="flex-[2]">
                                    <button
                                        class="bg-orange-500 rounded-lg text-white font-semibold text-center w-full py-2 px-4 mt-5 buy_now"
                                        data-amount="<?= $amount ?>" data-id="<?= $id ?>" data-name="<?= $name ?>"
                                        data-download="<?= $value ?>">
                                        Rs. <?= $amount ?> <i class="bi bi-download"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>