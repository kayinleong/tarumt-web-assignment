<?php
include '../includes/functions/db.php';
include '../includes/functions/auth.php';

redirect_if_not_logged_in();

if (isset($_POST['sub']) && $_POST['sub'] === 'Delete Data') {
    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $payload = get_jwt_payload($_COOKIE['token']);
    $sql = "SELECT * FROM users WHERE username = '$payload->name'";
    $result = $con->query($sql);
    $user = $result->fetch_assoc();
    $user_id = $user['id'];

    $sql = "DELETE FROM volunteers WHERE user_id = '$user_id'";
    $result = $con->query($sql);

    header("Location: /assignment/volunteer/signup.php");
    die();
}

$con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

$payload = get_jwt_payload($_COOKIE['token']);
$sql = "SELECT * FROM users WHERE username = '$payload->name'";
$result = $con->query($sql);
$user = $result->fetch_assoc();

$user_id = $user['id'];
$username = $user['username'];
$email = $user['email'];

$sql = "SELECT * FROM volunteers WHERE user_id = '$user_id'";
$result = $con->query($sql);
$volunteer = $result->fetch_assoc();

if (empty($volunteer)) {
    header("Location: /assignment/volunteer/signup.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Waitlist - Silver Screen Club</title>
    <title>Silver Screen Club</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "../includes/styles.php"; ?>
</head>

<body scroll="overflow-hidden">
    <?php include "../includes/header.php"; ?>

    <main class="max-w-screen max-h-screen h-screen overflow-y-auto scroll-smooth">
        <div class="container mx-auto py-32 px-10 md:px-20 lg:px-40">
            <?php
            if ($volunteer['status'] === 'P') {
            ?>
                <h1 class="font-bold text-4xl">
                    Waitlist
                </h1>

                <hr class="my-4" />

                <div>
                    <p class="text-gray-900 dark:text-white">
                        Thank you for your interest in volunteering with us! We will review your application as soon as possible. Please check back later.
                    </p>
                </div>
            <?php
            } else if ($volunteer['status'] === 'N') {
            ?>
                <h1 class="font-bold text-4xl">
                    Hooray! You are now a volunteer!
                </h1>

                <hr class="my-4" />

                <div>
                    <p class="text-gray-900 dark:text-white">
                        You are not able to help out at our physical events.
                    </p>
                </div>
            <?php
            } else if ($volunteer['status'] === 'F') {
            ?>
                <h1 class="font-bold text-4xl">
                    Awwwwww! Your application has been declined.
                </h1>

                <hr class="my-4" />

                <div>
                    <p class="text-gray-900 dark:text-white">
                        Thanks for your interest in the volunteer program. Unfortunately, we can't accept your application at this time.
                        If you would like to apply again using the same account. you will need to delete your existing application before you are able to submit a new
                        application.
                    </p>
                </div>

                <div class="mt-5 flex justify-between">
                    <div></div>
                    <div>
                        <form action="" method="post">
                            <input type="submit" name="sub" value="Delete Data" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900" />
                        </form>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>

        <?php include "../includes/footer.php"; ?>
    </main>

    <?php include "../includes/scripts.php"; ?>
</body>

</html>