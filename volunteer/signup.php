<?php
include '../includes/functions/db.php';
include '../includes/functions/auth.php';

redirect_if_not_logged_in();

if (isset($_POST['sub']) && $_POST['sub'] === "Join Us") {
    $reason = $_POST['reason'] ?? "";
    $campus = $_POST['campus'] ?? "";
    $personal_details_check = $_POST['personal_details_check'] ?? "";
    $tnc_check = $_POST['tnc_check'] ?? "";
    $guideline_check = $_POST['guideline_check'] ?? "";

    $errors = array();

    if (empty($reason)) {
        array_push($errors, "Reason is required.");
    }

    if (empty($campus)) {
        array_push($errors, "Campus is required.");
    }

    if (empty($reason) || empty($personal_details_check) || empty($tnc_check) || empty($guideline_check)) {
        array_push($errors, "Please check required conditions.");
    }

    if (empty($errors)) {
        $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
        if ($con->connect_error) {
            die("Connection failed: " . $con->connect_error);
        }

        $payload = get_jwt_payload($_COOKIE['token']);
        $sql = "SELECT * FROM users WHERE username = '$payload->name'";
        $result = $con->query($sql);
        $user = $result->fetch_assoc();

        $user_id = $user['id'];

        $sql = "INSERT INTO volunteers (user_id, campus, reason, status) VALUES ('$user_id', '$campus', '$reason', 'P')";
        if ($con->query($sql) === TRUE) {
            header("Location: /assignment/volunteer/waitlist.php");
            die();
        } else {
            $error = "Error: " . $sql . "<br>" . $con->error;
        }
    }
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

if (!empty($volunteer)) {
    header("Location: /assignment/volunteer/waitlist.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up as Volunteer - Silver Screen Club</title>
    <title>Silver Screen Club</title>
    <link rel="icon" type="image/x-icon" href="/assignment/wwwroot/images/favicon.ico">
    <?php include "../includes/styles.php"; ?>
</head>

<body scroll="overflow-hidden">
    <?php include "../includes/header.php"; ?>

    <main class="max-w-screen max-h-screen h-screen overflow-y-auto scroll-smooth">
        <div class="container mx-auto py-32 px-10 md:px-20 lg:px-40">
            <h1 class="font-bold text-4xl">
                Sign up as Volunteer
            </h1>

            <hr class="my-4" />

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
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Applicant Username</label>
                    <input type="text" id="username" value="<?php echo $username; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 hover:cursor-not-allowed" placeholder="Username" disabled>
                </div>

                <div class="mt-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Applicant Email</label>
                    <input type="email" id="email" value="<?php echo $email; ?>" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 hover:cursor-not-allowed" placeholder="Email" disabled>
                    <i class="text-sm">
                        <span class="text-red-600">***</span>

                        Please ensure the personal details above is correct. We will use this to contact you.

                        <span class="text-red-600">***</span>
                    </i>
                </div>

                <div class="mt-2">
                    <label for="campus" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Campus</label>
                    <select id="campus" name="campus" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="KL" <?php if (!empty($_POST['sub']) && $campus === 'KL') echo 'Selected'; ?>>Kuala Lumpur Main Campus</option>
                        <option value="PG" <?php if (!empty($_POST['sub']) && $campus === 'PG') echo 'Selected'; ?>>Penang Branch Campus</option>
                        <option value="PK" <?php if (!empty($_POST['sub']) && $campus === 'PK') echo 'Selected'; ?>>Perak Branch Campus</option>
                        <option value="JH" <?php if (!empty($_POST['sub']) && $campus === 'JH') echo 'Selected'; ?>>Johor Branch Campus</option>
                        <option value="PH" <?php if (!empty($_POST['sub']) && $campus === 'PH') echo 'Selected'; ?>>Pahang Branch Campus</option>
                        <option value="SB" <?php if (!empty($_POST['sub']) && $campus === 'SB') echo 'Selected'; ?>>Sabah Branch Campus</option>
                    </select>
                </div>

                <hr class="mx-5 my-4" />

                <div class="mt-3">
                    <label for="reason" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Application Reason</label>
                    <textarea id="reason" rows="4" name="reason" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your reason here..."><?php if (!empty($_POST['sub'])) echo $reason; ?></textarea>
                </div>

                <div class="mt-5 flex items-center">
                    <input id="personal_details_check" type="checkbox" name="personal_details_check" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="personal_details_check" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        The personal details above is correct.
                    </label>
                </div>

                <div class="mt-1 flex items-center">
                    <input id="tnc_check" type="checkbox" name="tnc_check" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="tnc_check" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        I agree with the
                        <a href="/assignment/terms_and_conditions.php" class="text-blue-600 dark:text-blue-500 hover:underline">terms and conditions</a>.
                    </label>
                </div>

                <div class="mt-1 flex items-center">
                    <input id="guideline_check" type="checkbox" name="guideline_check" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="guideline_check" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        I agree with the
                        <a href="/assignment/volunteer/guideline.php" class="text-blue-600 dark:text-blue-500 hover:underline">guideline</a>.
                    </label>
                </div>

                <div class="flex justify-between">
                    <div></div>
                    <div>
                        <input type="submit" name="sub" value="Join Us" class="flex items-center text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2" />
                    </div>
                </div>
            </form>
        </div>

        <?php include "../includes/footer.php"; ?>
    </main>

    <?php include "../includes/scripts.php"; ?>
</body>

</html>