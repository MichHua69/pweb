<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>J-Layer</title>
</head>
<body>
    <section class="bg-[#FFFAE6] h-screen my-auto">
        <div class=" max-w-screen-xl px-4 pt-28 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-28">
        <div class="form-container mt-4">
                <div class="form-content form--1">
                    <div class="bg-[#FFBB70] rounded-lg shadow-xl overflow-hidden mb-24">
                        <div class="p-8">
                            <h2 class="text-center text-3xl font-extrabold text-white mb-4">Masuk</h2>
                            <?php if(isset($_SESSION['error'])):?>
                            <div class="mx-auto mt-4 w-2/3 text-sm lg:text-base lg:flex lg:justify-center " id="alert">
                                <div class="p-2 bg-red-500 items-center text-indigo-100 leading-none rounded-full flex lg:inline-flex relative" role="alert" >
                                    <span class="flex rounded-full bg-red-800 uppercase px-2 py-1 text-xs font-bold mr-3">Gagal</span>
                                    <span class="font-semibold mr-2 text-left flex-auto"><?= $_SESSION['error'] ?></span>
                                    <span class="" id="close-btn">
                                        <svg class="fill-current h-6 w-6 text-white-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                    </span>
                                </div>
                            </div>
                            <?php elseif(isset($_SESSION['success'])):?>
                            <div class="mx-auto mt-4 w-2/3 text-sm lg:text-base lg:flex lg:justify-center " id="alert">
                                <div class="p-2 bg-green-500 items-center text-indigo-100 leading-none rounded-full flex lg:inline-flex relative" role="alert" >
                                    <span class="flex rounded-full bg-green-800 uppercase px-2 py-1 text-xs font-bold mr-3">Berhasil</span>
                                    <span class="font-semibold mr-2 text-left flex-auto"><?= $_SESSION['success'] ?></span>
                                    <span class="" id="close-btn">
                                        <svg class="fill-current h-6 w-6 text-white-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                                    </span>
                                </div>
                            </div>
                            <?php unset($_SESSION['error']); unset($_SESSION['success']); endif; ?>
                            <form method="POST" action="<?= urlpath('login') ?>" class="space-y-6">
                                <div class="rounded-md shadow-sm">
                                    <div class="flex flex-col">
                                        <label class="text-white" for="email">Email</label>
                                        <input
                                            placeholder="Masukkan Email"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            type="text  "
                                            name="email"
                                            id="email"
                                        />
                                    </div>
                                    <div class="flex flex-col mt-4 relative">
                                        <label class="text-white" for="password">Password</label>
                                        <div class="relative">
                                            <input
                                                placeholder="Masukkan Password"
                                                class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                                type="password"
                                                name="password"
                                                id="password"
                                            />
                                            <div class="absolute right-0 mr-4 top-1/2 transform -translate-y-1/2">
                                                <input type="checkbox" id="toggle-password" class="hidden"/>
                                                <label for="toggle-password" class="cursor-pointer">
                                                    <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                                                </label>
                                            </div>
                                        </div>
                                    </div>                              
                                </div>
                                
                                <div>
                                    <button
                                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF5F00] hover:bg-[#FFFAE6] hover:text-[#FF5F00]"
                                        type="submit"
                                    >
                                        Masuk
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="px-8 py-4 bg-[#ffc100] text-center font-semibold">
                            <span class="">Belum Punya Akun?</span>
                            <a class="font-medium text-[#FF5F00] hover:text-[#FFFAE6]" href="<?= urlpath('register')?>">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        </section>
    <?php include 'layouts/footer.php'; ?>
    <script>
        const togglePassword = document.querySelector('#toggle-password');
        const password = document.querySelector('#password');
        const togglePasswordConfirm = document.querySelector('#toggle-password-confirm');
        const passwordConfirm = document.querySelector('#password_confirmation');

        togglePassword.addEventListener('change', function() {
            password.type = this.checked ? 'text' : 'password';
            passwordConfirm.type = this.checked ? 'text' : 'password';
        });
    </script>
    <script>
        const closeBtn = document.getElementById('close-btn');
        const alert = document.getElementById('alert');
        closeBtn.addEventListener('click', function() {
            alert.classList.add('hidden');
            alert.classList.add('lg:hidden');
        });
    </script>
</body>
</html>
<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
