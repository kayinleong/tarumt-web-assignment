<?php
include '../../includes/functions/auth.php';

redirect_if_not_logged_in_and_not_admin();

if (isset($_POST['sub']) && $_POST['sub'] === 'Delete') {
    $id = $_POST['id'] ?? "";
    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "DELETE FROM movie_showtimes WHERE id = $id";
    if ($con->query($sql) === TRUE) {
        header("Location: /assignment/admin/movie_showtimes");
        die();
    }
}

$movie_showtime;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT * FROM movie_showtimes WHERE id = $id";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $movie_showtime = $result->fetch_assoc();
    }
} else {
    header("Location: /assignment/admin/movie_showtimes");
    die();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Showtime Details - Dashboard</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "../../includes/styles.php"; ?>
    <link rel="stylesheet" href="/assignment/wwwroot/css/seats.css">
</head>

<body class="overflow-hidden">
    <?php include "../../includes/header_admin.php"; ?>

    <main class="max-w-screen max-h-screen h-screen overflow-y-auto scroll-smooth">
        <div class="container mx-auto mt-24 px-4">
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
                    <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <a href="#">
                            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                <?php echo $movie_showtime['name'] ?>'s Details
                            </h5>
                        </a>
                        <div class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                            <form id="update_form" action="" method="post">
                                <div>
                                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                    <input type="text" id="name" value="<?php echo $movie_showtime['name'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event Name" required>
                                </div>

                                <div class="mt-3">
                                    <label for="movie" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select a Movie</label>
                                    <select id="movie" name="movie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <?php
                                        $sql = "SELECT id, name FROM movies";
                                        $result = $con->query($sql);
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $id = $row['id'];
                                                $name = $row['name'];

                                                if ($movie_showtime['movie_id'] == $id) {
                                                    echo "<option value='$id' selected>$name</option>";
                                                } else {
                                                    echo "<option value='$id'>$name</option>";
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="mt-3">
                                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                                    <textarea id="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Movie Showtime Description"><?php echo $movie_showtime['description'] ?></textarea>
                                </div>

                                <div class="mt-3">
                                    <label for="price" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket Price</label>
                                    <input type="number" id="price" value="<?php echo $movie_showtime['price'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event Start Time" required>
                                </div>

                                <div class="mt-3">
                                    <label for="discount_rate" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ticket Discount Rate</label>
                                    <input type="number" id="discount_rate" value="<?php echo $movie_showtime['discount_rate'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event Start Time" required>
                                </div>

                                <div class="mt-3">
                                    <label for="start_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start Date & Time</label>
                                    <input type="datetime-local" id="start_datetime" value="<?php echo $movie_showtime['start_datetime'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event Start Time" required>
                                </div>

                                <div class="mt-3">
                                    <label for="end_datetime" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End Date & Time</label>
                                    <input type="datetime-local" id="end_datetime" value="<?php echo $movie_showtime['end_datetime'] ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Event End Time" required>
                                </div>

                                <div class="mt-3">
                                    <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Event Status</label>
                                    <select id="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option value="N" <?php if ($movie_showtime['status'] == "N") echo "selected"; ?>>On-going</option>
                                        <option value="S" <?php if ($movie_showtime['status'] == "S") echo "selected"; ?>>Finished</option>
                                    </select>
                                </div>

                                <hr class="my-5" />

                                <div class="mt-8">
                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Seat Availability</label>
                                    <div class="flex justify-center">
                                        <div>
                                            <div class="bg-black h-[20px] w-full my-8 rounded-lg"></div>

                                            <?php
                                            $count = 1;

                                            for ($i = 0; $i < 40; $i++) {
                                                $seat_num = $i + 1;

                                                if ($count == 1) {
                                                    echo "<div class=\"flex\">";
                                                }

                                                if (in_array($seat_num, json_decode($movie_showtime["available_seat"])))
                                                    echo "<div class=\"seat\" onclick=\"select_seat($seat_num)\"></div>";
                                                else
                                                    echo "<div class=\"seat sold\" onclick=\"select_seat($seat_num)\"></div>";

                                                if ($count == 8) {
                                                    echo "</div>";
                                                    $count = 1;
                                                } else {
                                                    $count++;
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-5 flex flex-row justify-between">
                                    <div></div>
                                    <div>
                                        <button data-modal-target="staticDeleteModal" data-modal-toggle="staticDeleteModal" type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                                            Delete
                                        </button>
                                        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="staticDeleteModal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
            <div class="relative w-full h-full max-w-2xl md:h-auto">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Delete Movie Showtime Confirmation
                        </h3>
                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticDeleteModal">
                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <div class="p-6 space-y-6">
                        <form action="" method="post">
                            Are you sure you want to delete this movie showtime?

                            <div class="mt-5 flex justify-between">
                                <input name="id" type="hidden" value="<?php echo $_GET['id']; ?>" />
                                <div></div>
                                <div>
                                    <button data-modal-hide="staticDeleteModal" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                                        Cancel
                                    </button>
                                    <input type="submit" name="sub" value="Delete" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" />
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
    <script src="/assignment/wwwroot/js/seats.js"></script>
    <script>
        available_seat = <?php echo $movie_showtime['available_seat'] ?>;

        document.getElementById("update_form").addEventListener("submit", function update_form(event) {
            event.preventDefault();

            var name = document.getElementById("name").value;
            var movie = document.getElementById("movie").value;
            var description = document.getElementById("description").value;
            var price = document.getElementById("price").value;
            var discount_rate = document.getElementById("discount_rate").value;
            var start_datetime = document.getElementById("start_datetime").value;
            var end_datetime = document.getElementById("end_datetime").value;
            var status = document.getElementById("status").value;

            fetch('/assignment/api/admin/details.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        type: 'update',
                        id: <?php echo $movie_showtime['id'] ?>,
                        name: name,
                        movie: movie,
                        description: description,
                        price: price,
                        discount_rate: discount_rate,
                        start_datetime: start_datetime,
                        end_datetime: end_datetime,
                        status: status,
                        available_seat: available_seat
                    })
                })
                .then(response => response.json())
                .then(data => {
                    window.location.href = "/assignment/admin/movie_showtimes";
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
        });
    </script>
</body>

</html>

<?php
$con->close();
?>