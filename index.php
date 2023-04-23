<?php
include 'includes/functions/db.php';

$movie_showtimes = array();
$con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$sql = "SELECT * FROM movie_showtimes";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        array_push($movie_showtimes, $row);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Silver Screen Club</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "includes/styles.php"; ?>
    <link rel="stylesheet" href="/assignment/wwwroot/css/seats.css">
</head>

<body class="overflow-hidden">
    <?php include "includes/header.php"; ?>

    <main class="max-w-screen max-h-screen h-screen overflow-y-auto background scroll-smooth">
        <div class="container mx-auto pb-32 px-4">
            <div class="h-screen flex flex-col flex-wrap justify-center md:flex-row md:justify-start md:items-center">
                <div class="w-full md:w-5/6">
                    <h1 class="text-6xl md:text-8xl font-bold tracking-wide bg-gradient-to-r from-sky-500 to-indigo-500 inline-block text-transparent bg-clip-text">
                        Silver Screen Club
                    </h1>
                    <h3 class="mt-3 text-4xl md:text-5xl font-bold tracking-wide bg-gradient-to-r from-sky-500 to-indigo-500 inline-block text-transparent bg-clip-text">
                        The best place to watch movies
                    </h3>
                    <h5 class="mt-2 flex items-center text-xl md:text-2xl font-semibold tracking-wide bg-gradient-to-r from-sky-500 to-indigo-500 inline-block text-transparent bg-clip-text">
                        Tunku Abdul Rahman of University of Management and Technology
                    </h5>
                </div>

                <div class="w-full mt-5 md:w-1/6">
                    <a href="#volunteer_banner">
                        <button type="button" class="flex items-center text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                            MORE

                            <svg fill="white" class="ml-3" xmlns="http://www.w3.org/2000/svg" height="28" viewBox="0 96 960 960" width="28">
                                <path d="M480 856 240 616l42-42 198 198 198-198 42 42-240 240Zm0-253L240 363l42-42 198 198 198-198 42 42-240 240Z" />
                            </svg>
                        </button>
                    </a>
                </div>
            </div>

            <div id="volunteer_banner" class="w-full mt-5">
                <div class="p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <div class="flex items-center gap-2">
                        <svg class="w-10 h-10 mb-2 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.236A3 3 0 0114.83 6H16a2 2 0 110 4h-5V9a1 1 0 10-2 0v1H4a2 2 0 110-4h1.17C5.06 5.687 5 5.35 5 5zm4 1V5a1 1 0 10-1 1h1zm3 0a1 1 0 10-1-1v1h1z" clip-rule="evenodd"></path>
                            <path d="M9 11H3v5a2 2 0 002 2h4v-7zM11 18h4a2 2 0 002-2v-5h-6v7z"></path>
                        </svg>
                        <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Want to be apart of us?</h5>
                    </div>

                    <div>
                        <p class="mb-1 font-normal text-gray-500 dark:text-gray-400">
                            We are always looking for new members to join our team! If you are interested in joining us,
                        </p>
                        <p class="mb-3 font-normal text-gray-500 dark:text-gray-400">
                            go to this step by step guideline process on how to be apart of us!
                        </p>
                    </div>

                    <div class="flex justify-between">
                        <div></div>
                        <div class="flex gap-4">
                            <a href="/assignment/volunteer/guideline.php" class="inline-flex items-center text-blue-600 hover:underline">
                                See our guideline
                                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                                </svg>
                            </a>
                            <a href="/assignment/volunteer/signup.php" class="inline-flex items-center text-blue-600 hover:underline">
                                Join us
                                <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                                    <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="indicators-carousel" class="relative w-full mt-5" data-carousel="static">
                <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                    <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                        <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://flowbite.com/docs/images/carousel/carousel-2.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://flowbite.com/docs/images/carousel/carousel-3.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://flowbite.com/docs/images/carousel/carousel-4.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                    <div class="hidden duration-700 ease-in-out" data-carousel-item>
                        <img src="https://flowbite.com/docs/images/carousel/carousel-5.svg" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    </div>
                </div>
                <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                    <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
                </div>
                <button type="button" class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        <span class="sr-only">Previous</span>
                    </span>
                </button>
                <button type="button" class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                        <span class="sr-only">Next</span>
                    </span>
                </button>
            </div>

            <div class="mt-10 flex flex-col justify-center items-center md:flex-row gap-2 md:items-start">
                <?php
                foreach ($movie_showtimes as $movie_showtime) {
                    $id = $movie_showtime['id'];
                    $name = $movie_showtime['name'];
                    $formatted_final_price = number_format(($movie_showtime['discount_rate'] / 100) * $movie_showtime['price'], 2, ".", " ");
                    $description = empty($movie_showtime['description']) ? "No description" : $movie_showtime['description'];

                    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
                    if ($con->connect_error) {
                        die("Connection failed: " . $con->connect_error);
                    }

                    $movie_id = $movie_showtime['movie_id'];
                    $sql = "SELECT name, pic_url FROM movies WHERE id = $movie_id";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        $movie = $result->fetch_assoc();
                    }

                    $pic_url = $movie['pic_url'];
                    echo "<div class=\"max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700\">
                            <img class=\"rounded-t-lg\" src=\"/assignment/wwwroot/images/movies/$pic_url\" alt=\"\" />
                            <div class=\"p-5\">
                                <h5 class=\"mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white\">
                                    $name
                                </h5>
                                <p class=\"mb-3 font-normal text-gray-700 dark:text-gray-400\">
                                    $description
                                </p>
                                <div class=\"mb-3\">
                                    <span class=\"text-2xl font-bold text-gray-900 dark:text-white\">
                                        RM$formatted_final_price
                                    </span>
                                </div>
                                <div class=\"mt-10 flex justify-between\">
                                    <div></div>
                                    <button data-modal-target=\"modal_$id\" data-modal-toggle=\"modal_$id\" class=\"block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800\" type=\"button\">
                                        BUY NOW!
                                    </button>
                                </div>
                            </div>
                        </div>";
                }
                ?>

            </div>
        </div>

        <?php
        foreach ($movie_showtimes as $movie_showtime) {
            $id = $movie_showtime['id'];
            $name = $movie_showtime['name'];
            $final_price = ($movie_showtime['discount_rate'] / 100) * $movie_showtime['price'];
            $description = empty($movie_showtime['description']) ? "No description" : $movie_showtime['description'];

            $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
            if ($con->connect_error) {
                die("Connection failed: " . $con->connect_error);
            }

            echo "<div id=\"modal_$id\" tabindex=\"-1\" aria-hidden=\"true\" class=\"fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full\">
                    <div class=\"p-5 relative w-full h-full max-w-2xl md:h-auto\">
                        <form id=\"form_$id\">
                            <div class=\"relative bg-white rounded-lg shadow dark:bg-gray-700\">
                                <div class=\"flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600\">
                                    <h3 class=\"text-xl font-semibold text-gray-900 dark:text-white\">
                                        Seats for $name
                                    </h3>
                                    <button type=\"button\" class=\"text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white\" data-modal-hide=\"modal_$id\">
                                        <svg aria-hidden=\"true\" class=\"w-5 h-5\" fill=\"currentColor\" viewBox=\"0 0 20 20\" xmlns=\"http://www.w3.org/2000/svg\">
                                            <path fill-rule=\"evenodd\" d=\"M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z\" clip-rule=\"evenodd\"></path>
                                        </svg>
                                        <span class=\"sr-only\">Close modal</span>
                                    </button>
                                </div>

                                <div class=\"p-6 space-y-6\">
                                    <ul class=\"showcase\">
                                        <li>
                                            <div class=\"seat\"></div>
                                            <small>Available</small>
                                        </li>
                                        <li>
                                            <div class=\"seat selected\"></div>
                                            <small>Selected</small>

                                        </li>
                                        <li>
                                            <div class=\"seat sold\"></div>
                                            <small>Sold</small>

                                        </li>
                                    </ul>

                                    <form action=\"\" method=\"post\">
                                        <div class=\"flex justify-center\">
                                            <div>
                                                <div class=\"bg-black h-[20px] w-full my-8 rounded-lg\"></div>";

            $count = 1;

            for ($i = 0; $i < 40; $i++) {
                $seat_num = $i + 1;

                if ($count == 1) {
                    echo "<div class=\"flex\">";
                }

                if (in_array($seat_num, json_decode($movie_showtime["available_seat"])))
                    echo "<div class=\"seat $id $seat_num\" onclick=\"guest_select_seat($id, $seat_num, $final_price)\"></div>";
                else
                    echo "<div class=\"seat sold\"></div>";

                if ($count == 8) {
                    echo "</div>";
                    $count = 1;
                } else {
                    $count++;
                }
            }

            echo "                          </div>
                                        </div>

                                        <p class=\"mt-5 text\">You have selected <span id=\"count_$id\">0</span> seat for a price of RM <span id=\"price_$id\">0</span></p>

                                        <div class=\"mt-2 flex justify-between\">
                                            <div></div>
                                            <div>
                                                <button data-modal-hide=\"modal_$id\" type=\"button\" class=\"text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800\">No</button>
                                                <button type=\"submit\" class=\"text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600\">Yes</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>";
        }
        ?>

        <?php include "includes/footer.php"; ?>
    </main>

    <?php include "includes/scripts.php"; ?>
    <script>
        var selected_seats = {
            <?php
            foreach ($movie_showtimes as $movie_showtime) {
                $id = $movie_showtime['id'];
                echo "$id: [],";
            }
            ?>
        };

        var price = {
            <?php
            foreach ($movie_showtimes as $movie_showtime) {
                $id = $movie_showtime['id'];
                echo "$id: 0,";
            }
            ?>
        }

        function guest_select_seat(movie_id, seat_num, seat_price) {
            var seatElem = document.getElementsByClassName(`seat ${movie_id} ${seat_num}`)[0];
            var countElem = document.getElementById("count_" + movie_id);
            var priceElem = document.getElementById("price_" + movie_id);

            if (seatElem.classList.contains("selected")) {
                seatElem.classList.remove("selected");
                selected_seats[movie_id].splice(
                    selected_seats[movie_id].indexOf(seat_num),
                    1
                );
                price[movie_id] -= seat_price;

            } else {
                seatElem.classList.add("selected");
                selected_seats[movie_id].push(seat_num);
                price[movie_id] += seat_price;
            }

            countElem.innerHTML = selected_seats[movie_id].length;
            priceElem.innerHTML = price[movie_id];
        }

        <?php
        foreach ($movie_showtimes as $movie_showtime) {
            $id = $movie_showtime['id'];

            echo "
            document.getElementById('form_$id').addEventListener('submit', (event) => {
                event.preventDefault();

                fetch('/assignment/api/ticket-form.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            type: 'create',
                            id: $id,
                            selected_seats: selected_seats[$id]
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        window.location.href = `/assignment/ticket/checkout.php?id=$id&ticket_form_id=` + res.ticket_id;
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
                });
            ";
        }
        ?>
    </script>
</body>

</html>