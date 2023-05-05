<?php
include 'includes/functions/db.php';

$movie_showtimes  = array();
$con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET['search'])) {
    $search = $_GET['search'];

    $sql = "SELECT * FROM movie_showtimes WHERE name LIKE '%$search%' ORDER BY id";
} else {
    $sql = "SELECT * FROM movie_showtimes ORDER BY id";
}

if (isset($_GET['desc']) && $_GET['desc'] === "on") {
    $sql .= " DESC";
}

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
    <title>Movie Showtimes - Silver Screen Club</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "includes/styles.php"; ?>
    <style>
        .seat {
            background-color: #444451;
            height: 26px;
            width: 32px;
            margin: 3px;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        .seat.selected {
            background-color: green;
        }

        .seat.sold {
            background-color: #fff;
        }

        .seat:nth-of-type(2) {
            margin-right: 18px;
        }

        .seat:nth-last-of-type(2) {
            margin-left: 18px;
        }

        .seat:not(.sold):hover {
            cursor: pointer;
            transform: scale(1.2);
        }

        .showcase .seat:not(.sold):hover {
            cursor: default;
            transform: scale(1);
        }

        .showcase {
            background: rgba(0, 0, 0, 0.1);
            padding: 5px 10px;
            border-radius: 5px;
            color: #777;
            list-style-type: none;
            display: flex;
            justify-content: space-between;
        }

        .showcase li {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 10px;
        }

        .showcase li small {
            margin-left: 2px;
        }
    </style>
</head>

<body class="overflow-hidden">
    <?php include "includes/header.php"; ?>

    <main class="max-w-screen max-h-screen h-screen overflow-y-auto background scroll-smooth">
        <div class="container mx-auto py-32 px-4">
            <div id="accordion-collapse" data-accordion="collapse">
                <h2 id="accordion-collapse-heading-1">
                    <button type="button" class="bg-white flex items-center justify-between w-full p-5 font-medium text-left text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800" data-accordion-target="#accordion-collapse-body-1" aria-expanded="false" aria-controls="accordion-collapse-body-1">
                        <span>Advance Search</span>
                        <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </h2>
                <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-5 bg-white border border-b-lg border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">
                        <form action="" method="get">
                            <div>
                                <label for="search" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Search...</label>
                                <input name="search" type="text" id="search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search" required>
                            </div>

                            <div class="mt-3 flex items-center mb-4">
                                <input name="desc" id="desc" type="checkbox" value="on" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="desc" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Descending?</label>
                            </div>

                            <div class="flex justify-between">
                                <div></div>
                                <div>
                                    <button type="submit" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </form>
                        </p>
                    </div>
                </div>
            </div>

            <h1 class="mt-10 text-4xl font-bold tracking-wide">
                Movie Showtime
            </h1>

            <div class="mt-10 flex flex-col flex-wrap justify-center items-center md:flex-row gap-2 md:items-start">
                <?php
                foreach ($movie_showtimes as $movie_showtime) {
                    $id = $movie_showtime['id'];
                    $name = $movie_showtime['name'];
                    $formatted_final_price = number_format($movie_showtime['price'] - (($movie_showtime['discount_rate'] / 100) * $movie_showtime['price']), 2, ".", " ");
                    $description = $movie_showtime['description'] ?? "";
                    $movie_id = $movie_showtime['movie_id'];

                    $sql = "SELECT name, description, pic_url FROM movies WHERE id = $movie_id";
                    $result = $con->query($sql);
                    if ($result->num_rows > 0) {
                        $movie = $result->fetch_assoc();
                    }

                    $movie_name = $movie['name'];
                    $pic_url = $movie['pic_url'];
                    $movie_description = $movie['description'] ?? "";
                    echo "<div class=\"max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700\">
                            <img class=\"rounded-t-lg\" src=\"/assignment/wwwroot/images/movies/$pic_url\" alt=\"\" />
                            <div class=\"p-5\">
                                <h5 class=\"mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white\">
                                    $name
                                </h5>
                                <span class=\"text-lg text-gray-700 dark:text-gray-400\">
                                    $movie_name
                                </span>

                                <p class=\"my-3 font-normal text-gray-700 dark:text-gray-400\">
                                    $movie_description

                                    <br />

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
        };

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