<?php
include "../includes/enum.php";
include '../includes/functions/auth.php';

redirect_if_logged_in();

$username = '';
$email = '';
$dob = '';
$password = '';
$password_retype = '';

if (isset($_POST["sub"])) {
    include "../includes/enum.php";
    include "../includes/functions/db.php";

    $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    $username = $_POST["username"] ?? "";
    $email = $_POST["email"] ?? "";
    $dob = $_POST["dob"] ?? "";
    $password = $_POST["password"] ?? "";
    $password_retype = $_POST["password_retype"] ?? "";

    $insert_success = false;
    $errors = Array();

    if (empty($username))
        array_push($errors, "Username is required!");
    else {
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            array_push($errors, "Username already exists! Please pick another one!");
        }
    }

    if (empty($email))
        array_push($errors, "Email is required!");
    else {
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $con->query($sql);
        if ($result->num_rows > 0) {
            array_push($errors, "Email already exists! Please pick another one!");
        }
    }

    if (empty($dob))
        array_push($errors, "Date of Birth is required!");

    if (empty($password))
        array_push($errors, "Password is required!");
    else if (strlen($password) < 7)
        array_push($errors, "Password must be at least 8 characters!");
    else if (!preg_match('~[0-9]+~', $password))
        array_push($errors, "Password must contain at least one number!");
    else if (!preg_match('~[A-Za-z]+~', $password))
        array_push($errors, "Password must contain at least one letter!");

    if (empty($password_retype))
        array_push($errors, "Retype Password is required!");
    else if ($password != $password_retype)
        array_push($errors, "Password does not match!");

    if (empty($errors)) {
        $password_hashed = password_hash($password, PASSWORD_DEFAULT);
        $dob_formated = date("Y-m-d", strtotime(str_replace('-', '/', $dob)));
        $sql = "INSERT INTO users (username, password, email, dob) VALUES ('$username', '$password_hashed', '$email', '$dob_formated')";

        if ($con->query($sql) && $con->affected_rows > 0) {
            header("Location: /assignment/account/login.php?from=" . FromUrl::get_array()['REGISTER_SUCCESS']);
            die();
        } else {
            array_push($errors, "Something went wrong! Please try again later!");
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
    <title>Register - Silver Screen Club</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "../includes/styles.php"; ?>
</head>
<body class="overflow-hidden">
    <?php include "../includes/header.php"; ?>

    <main class="max-w-screen max-h-screen h-screen overflow-y-auto background scroll-smooth">
        <div class="flex flex-row flex-wrap container mx-auto pt-20 pb-32 px-4">
            <div class="w-full md:w-3/6 md:mt-20">
            </div>

            <div class="w-full px-5 md:w-3/6 md:mt-20 md:pr-20">
                <div class="w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
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

                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Register Portal
                    </h5>
                    <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                        Please register an account in order to access to our services.
                    </p>

                    <form action="" method="post">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Username <span class="text-red-600">*</span>
                            </label>
                            <input type="text" name="username" id="username" value="<?php echo $username ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Username">
                        </div>

                        <div class="mt-5">
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Email <span class="text-red-600">*</span>
                            </label>
                            <input type="email" name="email" id="email" value="<?php echo $email ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Email">
                        </div>

                        <div class="mt-5">
                            <label for="dob" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Date of Birth <span class="text-red-600">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                                </div>
                                <input datepicker name="dob" id="dob" type="text" value="<?php echo $dob ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select a Date of Birth">
                            </div>
                        </div>

                        <hr class="my-3 mx-4" />
                        <div class="p-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300" role="alert">
                            <span class="font-medium">Password Rules</span>
                            <br />
                            <ul class="pl-5 list-disc">
                                <li>Password must be longer than 7 characters.</li>
                                <li>Password must contains at least one character.</li>
                                <li>Password must contains at least one digit.</li>
                                <li>Password must match with Password Retype field.</li>
                            </ul>
                        </div>

                        <div class="mt-5">
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password <span class="text-red-600">*</span>
                            </label>
                            <input type="password" name="password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password">
                        </div>

                        <div class="mt-5">
                            <label for="password_retype" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Password Retype <span class="text-red-600">*</span>
                            </label>
                            <input type="password" name="password_retype" id="password_retype" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Password Retype">
                        </div>

                        <div class="mt-5 flex flex-row justify-between">
                            <div></div>
                            <div>
                                <button type="submit" name="sub" value="register" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    Register
                                    <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="w-full flex mt-5 justify-center p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <a href="/assignment/account/login.php" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Sign-In
                        <svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>
            </div>
        </div>

        <?php include "../includes/footer.php"; ?>
    </main>

    <?php include "../includes/scripts.php"; ?>
</body>
</html>