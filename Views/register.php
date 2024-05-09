<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
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
                            <div class="text-2xl font-bold mb-4">Register</div>
                                <form action="<?=urlpath('register')?>" method="POST">
                                    <input class="border border-gray-300 rounded-lg px-3 py-2 mb-4 w-full" type="text"
                                        placeholder="Username" >
                                    <input class="border border-gray-300 rounded-lg px-3 py-2 mb-4 w-full" type="text"
                                        placeholder="E-mail" >
                                    <div class="relative">
                                        <input class="border border-gray-300 rounded-lg px-3 py-2 mb-4 w-full" type="password"
                                            placeholder="Password" >
                                    </div>
                                    <div class="relative">
                                        <input class="border border-gray-300 rounded-lg px-3 py-2 mb-4 w-full" type="password"
                                            placeholder="Re-type Password" >
                                    </div>
                                    <div class="flex items-center mb-4">
                                        <input type="checkbox" class="form-checkbox h-4 w-4 text-neutral-600 rounded mr-2">
                                        <label for="agree" class="text-sm text-gray-700">I Agree to <a href="#" class="font-bold text-neutral-600 hover:text-neutral-400">Term & Condition</a></label>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div>Already have an account? <a href="<?=urlpath('login')?>" class="font-bold text-neutral-600 hover:text-neutral-400">Log In</a></div>
                                    </div>
                                    <button class="bg-neutral-400 hover:bg-neutral-500 text-white font-bold py-2 px-4 rounded-full w-full mt-4"
                                        type="submit">Register</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
