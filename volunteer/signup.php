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
        <div class="container mx-auto py-32 px-4">
            <h1 class="font-bold text-4xl">
                Sign up as Volunteer
            </h1>

            <hr class="my-4" />

            <form action="" method="post">
                <div>
                    <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                    <input type="text" id="username" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 hover:cursor-not-allowed" placeholder="Username" disabled>
                </div>

                <div class="mt-3">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 hover:cursor-not-allowed" placeholder="Email" disabled>
                </div>

                <div class="mt-1 text-sm">
                    <p>
                        <i>
                            Please ensure the personal details above is correct. We will use this to contact you.
                        </i>
                    </p>
                </div>

                <div class="mt-3 flex items-center">
                    <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        The personal details above is correct.
                    </label>
                </div>

                <div class="mt-1 flex items-center">
                    <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        I agree with the 
                        <a href="/assignment/terms_and_conditions.php" class="text-blue-600 dark:text-blue-500 hover:underline">terms and conditions</a>.
                    </label>
                </div>

                <div class="mt-1 flex items-center">
                    <input id="link-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="link-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                        I agree with the 
                        <a href="/assignment/volunteer/guideline.php" class="text-blue-600 dark:text-blue-500 hover:underline">guideline</a>.
                    </label>
                </div>

                <div class="flex justify-between">
                    <div></div>
                    <div>
                        <a href="/assignment/volunteer/waitlist.php">
                            <button type="button" class="flex items-center text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mb-2">
                                Join us!
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <?php include "../includes/footer.php"; ?>
    </main>

    <?php include "../includes/scripts.php"; ?>
</body>
</html>