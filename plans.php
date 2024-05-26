<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php include_once ("./includes/header.php"); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoubtHunt - Answer For Every Doubt</title>
</head>
<body>
    <div>
        <div class="max-w-[1280px] m-auto">
            <div class="w-full h-screen">
                <br />
                <div class="mt-[200px]">
                    <h1 class="font-semibold text-orange-500 text-5xl text-center">Plans</h1>
                    <p class="font-semibold text-xl text-zinc-800 text-center mt-5 mb-10">Our pricing plans are designed
                        to
                        be affordable, flexible, and tailored to your unique needs.</p>
                    <div class="grid grid-cols-4 gap-10 mb-10">
                        <?php
                            $sql = "SELECT * FROM `config_plans`";
                            $query = mysqli_query($conn, $sql);
                            while($rows = mysqli_fetch_assoc($query)) {
                                $name = $rows['package_name'];
                                $days = $rows['days'];
                                $qty = $rows['qty'];
                                $amount = $rows['amount'];
                                ?>
                        <div class="p-10 bg-white rounded-lg w-full shadow-xl">
                            <h3 class="text-xl font-semibold"><?=$name?></h3>
                            <h1 class="text-3xl mt-2 font-bold text-orange-500"><span
                                    class="mr-2 text-lg text-zinc-700 font-regular">Rs.</span><?=$amount?><span
                                    class="text-sm text-zinc-700 font-light">/ <?=$days?> days</span></h1>
                            <hr class="mt-5 mb-5" />
                            <p class="text-center text-sm font-semibold">Resolve <?=$qty?> Questions Per Day.</p>
                            <button class="bg-orange-500 rounded-lg text-white font-semibold text-center w-full py-2 px-4 mt-5">Buy Now!</button>
                        </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include_once ("./includes/footer.php"); ?>
</body>

</html>