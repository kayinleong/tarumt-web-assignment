<nav class="z-50 bg-white/75 backdrop-opacity-10 px-2 sm:px-4 py-2.5 dark:bg-gray-900 fixed w-full z-20 top-0 left-0">
    <div class="container flex flex-wrap items-center justify-between mx-auto">
        <a href="/assignment" class="flex items-center">
            <img src="/assignment/wwwroot/images/Logo_Transparent.png" class="h-12 mr-3 sm:h-9" alt="Website Logo" />
        </a>
        <div class="flex md:order-2">
            <div class="flex items-center md:ml-4">
                <button type="button" class="flex mr-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-3.jpg" alt="user photo">
                </button>
            </div>
            <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600" id="user-dropdown">
                <?php
                include_once "functions/auth.php";
                include_once "functions/db.php";

                $payload = get_jwt_payload($_COOKIE['token']);

                $con = new mysqli(DOMAIN, USERNAME, PASSWORD, DATABASE);
                if ($con->connect_error) {
                    die("Connection failed: " . $con->connect_error);
                }

                $sql = "SELECT * FROM users WHERE username = '$payload->name'";
                $result = mysqli_query($con, $sql);
                $row = $result->fetch_assoc();

                $username = $row['username'];
                $email = $row['email'];
                $is_admin = $row['is_admin'] == '0' ? true: false;

                echo "
                <div class='px-4 py-3'>
                    <span class='block text-sm text-gray-900 dark:text-white'>$username</span>
                    <span class='block text-sm font-medium text-gray-500 truncate dark:text-gray-400'>$email</span>
                </div>
                <ul class='py-2' aria-labelledby='user-menu-button'>
                    <li>
                        <a href='/assignment/admin' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>Admin Dashboard</a>
                    </li>
                    <li>
                        <a href='/assignment/account/sign_out.php' class='block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white'>Sign out</a>
                    </li>
                </ul>
                ";
                ?>
            </div>
        </div>
    </div>
</nav>
