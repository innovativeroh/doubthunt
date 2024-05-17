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
            <br>
            <div
                class="flex-wrap p-[40px] flex-col flex items-center h-auto lg:h-screen lg:flex-row gap-20 mt-20 lg:mt-0">
                <div class="flex-[1.5]">
                    <h1 class="text-4xl leading-[40px] lg:text-5xl lg:leading-[60px] font-bold text-gray-800">Get
                        <span class="text-orange-400">Best Solutions</span> For Doubts & <span
                            class="text-orange-600">Questions.</span>
                    </h1>
                    <div class="rounded-sm shadow-lg w-full p-4 bg-white rounded-sm border-gray-200 rounded-xl mt-8">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-[10] bg-white relative">
                                <i class="bi bi-keyboard absolute text-gray-400 left-[10px] absolute top-[0px]"
                                    style="font-size: 26px;"></i>
                                <input type="text"
                                    class="w-full pl-12 py-2 outline-none border-[1px] border-gray-200 rounded-l-lg"
                                    name="query" id="searchInput" placeholder="Search..." />
                                <div id="searchResults"
                                    class="absolute w-full bg-white rounded-b-xl shadow-xl hidden">
                                </div>
                            </div>
                            <div class="flex-1">
                                <button type="button"
                                    class="py-2 px-8 bg-orange-500 rounded-r-lg text-white font-semibold border-[1px] border-orange-500">
                                    <i class="bi bi-camera"></i></button>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div class="flex flex-wrap flex-row gap-2 items-center">
                        <i class="bi bi-chat-dots-fill text-2xl text-orange-600"></i>
                        <p class="text-xl font-semibold text-zinc-800">50 Thousand Doubts Solved</p>
                    </div>
                    <br />
                    <div class="flex flex-wrap flex-row gap-2 items-center">
                        <i class="bi bi-stars text-2xl text-orange-600"></i>
                        <p class="text-xl font-semibold text-zinc-800">Solutions by verified experts</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function liveSearch() {
            var query = document.getElementById('searchInput').value.trim(); // Get the query from the input field
            var searchResults = document.getElementById('searchResults'); // Get the container for search results

            // Hide the search results container if the query is empty
            if (query === "") {
                searchResults.style.display = "none";
                return; // Exit the function early if the query is empty
            }

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the search results container with the response
                    searchResults.innerHTML = this.responseText;
                    // Show or hide the search results container based on the response
                    if (this.responseText.trim() !== "") {
                        searchResults.style.display = "block";
                    } else {
                        searchResults.style.display = "none";
                    }
                }
            };
            xhttp.open("GET", "routes/searchRes.php?q=" + query, true); // Send GET request with the query
            xhttp.send();
            console.log(query);
        }

        // Attach event listener to input field to trigger live search
        document.getElementById('searchInput').addEventListener('input', liveSearch);
    </script>
    <?php include_once ("./includes/footer.php"); ?>
</body>

</html>