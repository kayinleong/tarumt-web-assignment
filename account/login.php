<?php
include "../includes/functions/db.php";
include '../includes/functions/jwt.php';
include '../includes/functions/auth.php';

redirect_if_logged_in();

$username = '';
$password = '';

if (isset($_POST['sub'])) {
    $username = $_POST['username'] ?? "";
    $password = $_POST['password'] ?? "";

    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($con, $sql);

    $errors = array();
    if (empty($username))
        array_push($errors, "Username is required.");

    if (empty($password))
        array_push($errors, "Password is required.");

    if (empty($errors)) {
        if (mysqli_num_rows($result) > 0) {
            $row = $result->fetch_assoc();
            $password_hash = $row['password'];

            $jwt = create_jwt($row['id'], $row['username']);
            setcookie('token', $jwt, time() + 2 * 24 * 60 * 60, "/");

            if (password_verify($password, $password_hash)) {
                header("Location: /assignment/index.php?from=");
                die();
            }
        } else {
            array_push($errors, "Username or password is incorrect.");
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Silver Screen Club</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "../includes/styles.php"; ?>
</head>

<body class="overflow-hidden">
    <?php include "../includes/header.php"; ?>

    <main class="max-w-screen max-h-screen h-screen overflow-y-auto background scroll-smooth">
        <div class="flex flex-row flex-wrap container mx-auto py-32 px-4">
            <div class="w-full md:w-3/6 md:mt-20">
            </div>

            <div class="w-full px-5 md:w-3/6 md:mt-20 md:pr-20">
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <?php
                    if (isset($_GET['from'])) {
                        $from = $_GET['from'];

                        if (in_array($from, FromUrl::values()) && $from == FromUrl::get_array()['REGISTER_SUCCESS']) {
                            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>";
                            echo "<strong class='font-bold'>Success!</strong>";
                            echo "<span class='block sm:inline'> Your account has been created successfully!</span>";
                            echo "</div>";
                        }
                    }

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
                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Sign-In Portal
                    </h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Please sign-in in order to access to our services.
                    </p>

                    <form action="" method="post">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Username <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="username" id="username" value="<?php echo $username ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username">
                        </div>

                        <div class="mt-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password <span class="text-red-600">*</span>
                            </label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password">
                        </div>

                        <div class="mt-5 flex flex-row justify-between">
                            <div></div>
                            <div>
                                <button type="submit" name="sub" value="login" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Sign-In
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="w-full flex justify-center mt-5 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="/assignment/account/register.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Register
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <?php include "../includes/footer.php"; ?>
    </main>

    <?php include "../includes/scripts.php"; ?>
</body>

</html>