<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once ("./includes/header.php"); ?>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./core/css/main.css" type="text/css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DoubtHunt - Answer For Every Doubt</title>
</head>

<body>
    <div id="backgroundEffect">
        <div class="max-w-[1280px] m-auto">
            <br>
            <div class="flex-wrap p-[40px] flex-col flex items-center h-auto lg:h-screen lg:flex-row gap-20 mt-20 lg:mt-0">
                <div class="flex-[1.5]">
                    <h1 class="text-5xl font-bold leading-[60px] text-gray-800"><span
                            class="text-orange-500">DoubtHunt</span>
                        helps with homework, doubts and <span class="text-orange-400">solutions</span> to all the <span
                            class="text-orange-600">questions.</span></h1>
                    <div class="rounded-sm shadow-lg w-full p-4 bg-white rounded-sm border-gray-200 rounded-xl mt-8">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-[10] bg-white">
                                <input type="text"
                                    class="w-full pl-4 p-2 outline-none border-[1px] border-gray-200 rounded-l-lg"
                                    name="query" placeholder="Search..." />
                            </div>
                            <div class="flex-[3]">
                                <button type="button"
                                    class="py-2 px-8 bg-orange-500 rounded-r-lg text-white font-semibold border-[1px] border-orange-500"><i
                                        class="bi bi-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 flex flex-wrap gap-4">
                        <a href="#" class="bg-white border-[1px] border-gray-300 rounded-full py-2 px-4 font-semibold">Hindi</a>
                        <a href="#" class="bg-white border-[1px] border-gray-300 rounded-full py-2 px-4 font-semibold">English</a>
                        <a href="#" class="bg-white border-[1px] border-gray-300 rounded-full py-2 px-4 font-semibold">Maths</a>
                        <a href="#" class="bg-white border-[1px] border-gray-300 rounded-full py-2 px-4 font-semibold">Science</a>
                    </div>
                </div>
                <div class="flex-[1]">
                    <img src='./core/img/animation2.gif' class='w-full'>
                </div>
            </div>
        </div>
    </div>
    <?php include_once ("./includes/footer.php"); ?>
</body>

</html>