<?php
include '../../includes/enum.php';
include "../../includes/functions/db.php";
include '../../includes/functions/auth.php';

redirect_if_not_logged_in_and_not_admin();

if (isset($_POST['sub'])) {
    $name = $_POST['name'];
    $movie = $_POST['movie'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $discount_rate = $_POST['discount_rate'];
    $start_datetime = $_POST['start_datetime'];
    $end_datetime = $_POST['end_datetime'];
    $errors = array();

    if (empty($name)) {
        array_push($errors, "Name is required!");
    }

    if (empty($movie)) {
        array_push($errors, "Movie is required!");
    }

    if (empty($price)) {
        array_push($errors, "Price is required!");
    }

    if (empty($start_datetime)) {
        array_push($errors, "Start datetime is required!");
    }

    if (empty($end_datetime)) {
        array_push($errors, "End datetime is required!");
    }

    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    if (empty($errors)) {
        $sql = "INSERT INTO movie_showtimes 
                    (name, description, price, discount_rate, start_datetime, end_datetime, movie_id) 
                    VALUES 
                    ('$name', '$description', '$price', '$discount_rate', '$start_datetime', '$end_datetime', $movie)";

        $con->query($sql);
    }
}

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
    <title>Movie Showtime - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "../../includes/styles.php"; ?>
</head>

<body class="overflow-hidden">
    <?php include "../../includes/header_admin.php"; ?>

    <main class="container mx-auto mt-24 px-4 scroll-smooth">
        <div class="w-full flex flex-col lg:flex-row">
            <div class="w-full mt-5 lg:w-1/6">
                <div class="hidden lg:block w-48 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <a href="/assignment/admin" class="block w-full px-4 py-2 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                        Dashboard
                    </a>
                    <a href="/assignment/admin/movies" class="block w-full px-4 py-2 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                        Movies
                    </a>
                    <a href="/assignment/admin/movie_showtimes" aria-current="true" class="block w-full px-4 py-2 text-white bg-blue-700 border-b border-gray-200 cursor-pointer dark:bg-gray-800 dark:border-gray-600">
                        Movie Showtimes
                    </a>
                    <a href="/assignment/admin/users" class="block w-full px-4 py-2 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                        Users
                    </a>
                    <a href="/assignment/admin/volunteers" class="block w-full px-4 py-2 rounded-b-lg cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                        Volunteers
                    </a>
                </div>

                <div class="lg:hidden border-b border-gray-200 dark:border-gray-700">
                    <ul class="flex flex-wrap justify-center -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                        <li class="mr-2">
                            <a href="/assignment/admin" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 bi bi-speedometer" viewBox="0 0 16 16">
                                    <path d="M8 2a.5.5 0 0 1 .5.5V4a.5.5 0 0 1-1 0V2.5A.5.5 0 0 1 8 2zM3.732 3.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 8a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 8zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 7.31A.91.91 0 1 0 8.85 8.569l3.434-4.297a.389.389 0 0 0-.029-.518z" />
                                    <path fill-rule="evenodd" d="M6.664 15.889A8 8 0 1 1 9.336.11a8 8 0 0 1-2.672 15.78zm-4.665-4.283A11.945 11.945 0 0 1 8 10c2.186 0 4.236.585 6.001 1.606a7 7 0 1 0-12.002 0z" />
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="/assignment/admin/movies" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 bi bi-film" viewBox="0 0 16 16">
                                    <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm4 0v6h8V1H4zm8 8H4v6h8V9zM1 1v2h2V1H1zm2 3H1v2h2V4zM1 7v2h2V7H1zm2 3H1v2h2v-2zm-2 3v2h2v-2H1zM15 1h-2v2h2V1zm-2 3v2h2V4h-2zm2 3h-2v2h2V7zm-2 3v2h2v-2h-2zm2 3h-2v2h2v-2z" />
                                </svg>
                                Movies
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="/assignment/admin/movie_showtimes" class="inline-flex items-center p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 bi bi-calendar-event" viewBox="0 0 16 16">
                                    <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                                Movie Showtimes
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="/assignment/admin/users" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                Users
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="/assignment/admin/volunteers" class="inline-flex items-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 bi bi-people" viewBox="0 0 16 16">
                                    <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8Zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022ZM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816ZM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0Zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                                </svg>
                                Volunteers
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="w-full mt-5 lg:w-5/6">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <caption class="p-5 text-lg font-semibold text-left text-gray-900 bg-white dark:text-white dark:bg-gray-800">
                            Movie Showtime Table

                            <p class="mt-1 text-sm font-normal text-gray-500 dark:text-gray-400">
                                Browse a list of Movie Showtime.
                            </p>

                            <div class="mt-3 flex flex-row justify-between">
                                <div></div>

                                <div>
                                    <button data-modal-target="staticNewEventModal" data-modal-toggle="staticNewEventModal" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                        New Movie Showtime
                                    </button>
                                </div>
                            </div>
                        </caption>
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Movie Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Final Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Start Date & Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    End Date & Time
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($movie_showtimes as $movie_showtime) {
                                $id = $movie_showtime['id'];
                                $name = $movie_showtime['name'];
                                $final_price = number_format(($movie_showtime['discount_rate'] / 100) * $movie_showtime['price'], 2, ".", " ");
                                $start_datetime = date("m/d/Y H:i:s", strtotime(str_replace('-', '/', $movie_showtime['start_datetime'])));
                                $end_datetime = $movie_showtime['end_datetime'];
                                $status = $movie_showtime['status'] == 'N' ? "On-Going" : "Ended";

                                $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
                                if ($con->connect_error) {
                                    die("Connection failed: " . $con->connect_error);
                                }

                                $sql = "SELECT name FROM movies WHERE id = " . $movie_showtime['movie_id'] . "";
                                $result = $con->query($sql);
                                if ($result->num_rows > 0) {
                                    $movie_name = $result->fetch_assoc()['name'];
                                }

                                echo "<tr class='bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600'>
                                        <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                            $name
                                        </th>
                                        <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                            $movie_name
                                        </th>
                                        <th scope='row' class='px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white'>
                                            $final_price
                                        </th>
                                        <td class='px-6 py-4'>
                                            $start_datetime
                                        </td>
                                        <td class='px-6 py-4'>
                                            $end_datetime
                                        </td>
                                        <td class='px-6 py-4'>
                                            $status
                                        </td>
                                        <td class='px-6 py-4 text-right'>
                                            <a href='/assignment/admin/movie_showtimes/details.php?id=$id' class='font-medium text-blue-600 dark:text-blue-500 hover:underline'>Details</a>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div id="staticNewEventModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Create new Movie Showtime
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticNewEventModal">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <?php
                        if (isset($_POST["sub"]) && count($errors) > 0) {
                            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>";
                            echo "<strong class='font-bold'>Error!</strong>";
                            echo "<span class='block sm:inline'> Please fix the following errors:</span>";
                            echo "<ul class='list-disc list-inside'>";
                            foreach ($errors as $error) {
                                echo "<li>$error</li>";
                            }
                            echo "</ul>";
                            echo "</div>";
                        }
                        ?>

                        <form action="" method="post">
                            <div>
                                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                <input type="text" id="name" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Movie Showtime Name">
                            </div>

                            <div class="mt-3">
                                <label for="movie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a Movie</label>
                                <select id="movie" name="movie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <?php
                                    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
                                    if ($con->connect_error) {
                                        die("Connection failed: " . $con->connect_error);
                                    }

                                    $sql = "SELECT id, name FROM movies";
                                    $result = $con->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $id = $row['id'];
                                            $name = $row['name'];
                                            echo "<option value='$id'>$name</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="mt-3">
                                <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Movie Showtime Description"></textarea>
                            </div>

                            <div class="mt-3">
                                <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket Price</label>
                                <input type="number" id="price" name="price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Movie Showtime Ticket Price">
                            </div>

                            <div class="mt-3">
                                <label for="discount_rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket Discount Rate</label>
                                <input type="number" id="discount_rate" name="discount_rate" min="0" max="100" step="0.01" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Movie Showtime Ticket Discount Rate">
                            </div>

                            <div class="mt-3">
                                <label for="start_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date & Time</label>
                                <input type="datetime-local" id="start_datetime" name="start_datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Movie Showtime Start Time">
                            </div>

                            <div class="mt-3">
                                <label for="end_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date & Time</label>
                                <input type="datetime-local" id="end_datetime" name="end_datetime" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Movie Showtime End Time">
                            </div>

                            <div class="mt-5 flex flex-row justify-between">
                                <div></div>
                                <div>
                                    <button data-modal-hide="staticNewEventModal" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Cancel</button>
                                    <button type="submit" name="sub" value="create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php include "../../includes/footer.php"; ?>
    </main>


    <?php include "../../includes/scripts.php"; ?>
</body>

</html>