<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="">
    <div class="h-screen w-screen overflow-hidden">
        <img src="assets/images/background.png" alt="" class="absolute bg-cover bg-center bg-no-repeat bg-fixed object-cover w-full h-full" style="filter:blur(2px)">
        <div class="min-h-screen flex justify-center items-center">
            <div class="bg-white bg-opacity-70 backdrop-filter backdrop-blur-lg rounded rounded-2xl shadow-2xl">
                <div class="grid grid-cols-2 gap-0">
                    <div class="bg-gray-200 p-8 rounded-l-2xl">
                        <div class="text-center w-full">
                            <div class="text-2xl font-bold mb-2">Contact App Manager</div>
                            <img src="assets/images/logo.png" alt="Logo" class="mx-auto mb-4 rounded-full w-4/5">
                            <p class="text-gray-700">Easy and Efficient Contact Management System</p>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-r-2xl flex items-center justify-center">
                        <div class="text-center mb-8 w-full">
                            <?php 
                            $registration = false;
                            if (isset($_SESSION['register_success'])) {
                                $registration = $_SESSION['register_success'];
                                unset($_SESSION['register_success']);
                            } 
                            ?>

                            <?php if ($registration == true) : ?>
                            <div class="flex justify-center w-full mb-4">
                                <div id="toast-success" class="flex items-center w-full p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray dark:bg-gray-800"
                                    role="alert">
                                    <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                            viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                        </svg>
                                        <span class="sr-only">Check icon</span>
                                    </div>
                                    <div class="ml-3 text-sm font-normal">Registrasi Berhasil.</div>
                                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" data-dismiss-target="#toast-success" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                </button>
                                </div>
                            </div>
                            <?php endif; ?>
                            <form action="<?=urlpath('login')?>" method="POST">
                                <div class="text-2xl font-bold mb-4">Login</div>
                                <input class="border border-gray-300 rounded-lg px-3 py-2 mb-4 w-full" type="text"
                                    placeholder="Username" name="username">
                                <div class="relative">
                                    <input class="border border-gray-300 rounded-lg px-3 py-2 mb-4 w-full" type="password"
                                        placeholder="Password" name="password">
                                </div>
                                <div class="flex justify-between items-center">
                                    <div>Don't have an account? <a href="<?=urlpath('register')?>" class="font-bold text-neutral-600 hover:text-neutral-400">Register</a></div>
                                    <!-- <div><p>Lupa Password?</p></div> -->
                                </div>
                                <button class="bg-neutral-400 hover:bg-neutral-500 text-white font-bold py-2 px-4 rounded-full w-full mt-4"
                                    type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
