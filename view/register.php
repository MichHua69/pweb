<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <title>Register</title>
</head>
<body>
    <section class="bg-[#FFFAE6] lg:h-full">
        <div class="max-w-screen-xl flex flex-col justify center px-4 pt-12 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-28">
            <div class="tab-container mb-4 h-full py-2 lg:py-4">
                <button class="tab tab--1 h-full mx-auto my-auto lg:text-lg active" onclick="changeTab(1)">Peternak</button>
                <button class="tab tab--2 h-full mx-auto my-auto lg:text-lg" onclick="changeTab(2)">Kepala Kelompok Ternak</button>
                <div class="indicator h-full"></div>
            </div>
            <?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'kepala'): ?>
                <script>
                window.onload = function() {
                    changeTab(2);
                };
                </script>
            <?php endif; ?>
            <div class="form-container mt-4">
                <!-- Peternak Form -->
                <div class="form-content form--1">
                    <div class="bg-[#FFBB70] rounded-lg shadow-xl overflow-hidden mb-24">
                        <div class="p-8">
                            <h2 class="text-center text-3xl font-extrabold text-white">Register Peternak</h2>
                            <form method="POST" action="<?=urlpath('register')?>" class="mt-8 space-y-6">
                                <input type="hidden" value="peternak" name="register">
                                <div class="rounded-md shadow-sm">
                                    <div class="mt-4">
                                        <label class="font-semibold" for="name">Nama</label>
                                        <input
                                            placeholder="Masukkan Nama"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="name"
                                            type="text"
                                            name="name"
                                            id="name"
                                            value = "<?= isset($_SESSION['name']) ? $_SESSION['name'] : ''?>"
                                            required
                                        />
                                        <?php if (isset($_SESSION['error']['name'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['name'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="mt-4">
                                        <label class="font-semibold" for="email">Email</label>
                                        <input
                                            placeholder="Masukkan Email"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="email"
                                            type="email"
                                            name="email"
                                            id="email"
                                            value = "<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''?>"
                                            required
                                        />
                                        <?php if (isset($_SESSION['error']['email'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['email'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="mt-4">
                                        <label class="font-semibold" for="nik">NIK</label>
                                        <input
                                            placeholder="Masukkan NIK"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="nik"
                                            type="text"
                                            name="nik"
                                            id="nik"
                                            value = "<?= isset($_SESSION['nik']) ? $_SESSION['nik'] : ''?>"
                                            required
                                        />
                                        <?php if (isset($_SESSION['error']['nik'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['nik'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="mt-4">
                                        <label class="font-semibold" for="telepon">No Telepon</label>
                                        <input
                                            placeholder="Masukkan No Telepon"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="telepon"
                                            type="text"
                                            name="telepon"
                                            id="telepon"
                                            value = "<?= isset($_SESSION['telepon']) ? $_SESSION['telepon'] : ''?>"
                                            required
                                        />
                                        <p class="text-gray-600 italic text-sm">Contoh : 6285xxxxxxxx</p>
                                        <?php if (isset($_SESSION['error']['telepon'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['telepon'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="flex flex-col relative mt-4">
                                        <label class="font-semibold" for="password">Password</label>
                                            <div class="relative w-full">
                                            <input
                                                placeholder="Masukkan Password"
                                                class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                                autocomplete="current-password"
                                                type="password"
                                                name="password"
                                                id="password"
                                                required
                                            />
                                            <div class="absolute right-0 mr-4 top-1/2 transform -translate-y-1/2">
                                                <input type="checkbox" id="toggle-password" class="hidden"/>
                                                <label for="toggle-password" class="cursor-pointer">
                                                    <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                                                </label>
                                            </div>
                                        </div>
                                        <?php if (isset($_SESSION['error']['password'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['password'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="flex flex-col relative mt-4">
                                        <label class="font-semibold" for="password_confirmation">Konfirmasi Password</label>
                                        <div class="relative w-full">
                                            <input
                                                placeholder="Masukkan Konfirmasi Password"
                                                class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                                autocomplete="current-password"
                                                type="password"
                                                name="password_confirmation"
                                                id="password_confirmation"
                                                required
                                            />
                                            <div class="absolute right-0 mr-4 top-1/2 transform -translate-y-1/2">
                                                <input type="checkbox" id="toggle-password" class="hidden"/>
                                                <label for="toggle-password" class="cursor-pointer">
                                                    <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                                                </label>
                                            </div>
                                        </div>
                                        <?php if (isset($_SESSION['error']['password_confirmation'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['password_confirmation'] ?></p>
                                        <?php endif ?>
                                    </div>                                    
                                </div>
                                
                                <div>
                                    <button
                                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF5F00] hover:bg-[#FFFAE6] hover:text-[#FF5F00]"
                                        type="submit"
                                    >
                                        Daftar
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="px-8 py-4 bg-[#ffc100] text-center font-semibold">
                            <span class="">Sudah Punya Akun?</span>
                            <a class="font-medium text-[#FF5F00] hover:text-[#FFFAE6]" href="<?= urlpath('login')?>">Masuk</a>
                        </div>
                    </div>
                </div>

                <!-- Kepala Kelompok Ternak Form -->
                <div class="form-content form--2 hidden">
                    <div class="bg-[#FFBB70] rounded-lg shadow-xl overflow-hidden">
                        <div class="p-8">
                            <h2 class="text-center text-3xl font-extrabold text-white">Register Kepala Kelompok Ternak</h2>
                            <form method="POST" action="<?=urlpath('register')?>" class="mt-8 space-y-6">
                                <input type="hidden" value="kepala" name="register">
                                <div class="rounded-md shadow-sm">
                                    <div class="mt-4">
                                        <label class="font-semibold" for="name">Nama</label>
                                        <input
                                            placeholder="Masukkan Nama"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="name"
                                            type="text"
                                            name="name"
                                            id="name"
                                            required
                                        />
                                        <?php if (isset($_SESSION['error']['name'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['name'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="mt-4">
                                        <label class="font-semibold" for="email">Email</label>
                                        <input
                                            placeholder="Masukkan Email"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="email"
                                            type="email"
                                            name="email"
                                            id="email"
                                            required
                                        />
                                    </div>
                                    <div class="mt-4">
                                        <label class="font-semibold" for="nik">NIK</label>
                                        <input
                                            placeholder="Masukkan NIK"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="nik"
                                            type="text"
                                            name="nik"
                                            id="nik"
                                            required
                                        />
                                        <?php if (isset($_SESSION['error']['nik'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['nik'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="mt-4">
                                        <label class="font-semibold" for="noSurat">Nomor Surat</label>
                                        <input
                                            placeholder="Masukkan Nomor Surat"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="noSurat"
                                            type="text"
                                            name="noSurat"
                                            id="noSurat"
                                            required
                                        />
                                        <?php if (isset($_SESSION['error']['noSurat'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['noSurat'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    
                                    <div class="mt-4">
                                        <label class="font-semibold" for="wilayah">Nama Wilayah</label>
                                        <select
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            name="wilayah"
                                            id="wilayah"
                                            required>
                                            <option value="" hidden>Pilih Wilayah</option>
                                            <option value="1">1 (Balung, Wuluhan, Jombang, Kencong, Rambipuji)</option>
                                            <option value="2">2 (Mumbulsari, Ambulu, Tempurejo, Jenggawah Ajung)</option>
                                            <option value="3">3 (Tanggul, Bangsalsari, Sumberbaru)</option>
                                            <option value="4">4 (Sukowono, Jelbuk, Kalisat, Ledokombo,, Sumberjambe, Arjasa, Silo)</option>
                                            <option value="5">5 (Puger)</option>
                                            <option value="6">6 (Patrang, Sukorambi, Mangli, Kaliwates, Arjasa)</option>
                                            <option value="7">7 (Sumbersari, Mayang, Pakusari, Tempurejo, Mumbulsari)</option>
                                        </select>
                                        <?php if (isset($_SESSION['error']['wilayah'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['wilayah'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="mt-4">
                                        <label class="font-semibold" for="telepon">No Telepon</label>
                                        <input
                                            placeholder="Masukkan No Telepon"
                                            class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                            autocomplete="telepon"
                                            type="text"
                                            name="telepon"
                                            id="telepon"
                                            required
                                        />
                                        <p class="text-gray-600 italic text-sm">Contoh : 6285xxxxxxxx</p>
                                        <?php if (isset($_SESSION['error']['telepon'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['telepon'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="flex flex-col relative mt-4">
                                        <label class="font-semibold" for= "password">Password</label>
                                        <div class="relative w-full">
                                            <input
                                                placeholder="Masukkan Password"
                                                class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                                autocomplete="current-password"
                                                type="password"
                                                name="password"
                                                id="password_kepala"
                                                required
                                            />
                                            <div class="absolute right-0 mr-4 top-1/2 transform -translate-y-1/2">
                                                <input type="checkbox" id="toggle-password" class="hidden"/>
                                                <label for="toggle-password" class="cursor-pointer">
                                                    <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                                                </label>
                                            </div>
                                        </div>
                                        <?php if (isset($_SESSION['error']['password'])):?>
                                            <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['password'] ?></p>
                                        <?php endif ?>
                                    </div>
                                    <div class="flex flex-col relative mt-4">
                                        <label class="font-semibold" for="password_confirmation">Konfirmasi Password</label>
                                        <div class="relative w-full">
                                            <input
                                                placeholder="Masukkan Konfirmasi Password"
                                                class="appearance-none relative block w-full px-3 py-3 border border-[#FFC100] bg-[#ebebec] rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-[#FF5F00] focus:z-10 sm:text-sm"
                                                autocomplete="current-password"
                                                type="password"
                                                name="password_confirmation"
                                                id="password_confirmation_kepala"
                                                required
                                            />
                                            <div class="absolute right-0 mr-4 top-1/2 transform -translate-y-1/2">
                                                <input type="checkbox" id="toggle-password" class="hidden"/>
                                                <label for="toggle-password" class="cursor-pointer">
                                                    <svg viewBox="0 0 576 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"></path></svg>
                                                </label>
                                            </div>
                                            <?php if (isset($_SESSION['error']['password_confirmation'])):?>
                                                <p class="text-[#FF5F00] italic text-sm"><?= $_SESSION['error']['password_confirmation'] ?></p>
                                            <?php endif ?>
                                        </div>
                                    </div>                                    
                                </div>
                                
                                <div>
                                    <button
                                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-[#FF5F00] hover:bg-[#FFFAE6] hover:text-[#FF5F00]"
                                        type="submit"
                                    >
                                        Daftar
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="px-8 py-4 bg-[#ffc100] text-center font-semibold">
                            <span class="">Sudah Punya Akun?</span>
                            <a class="font-medium text-[#FF5F00] hover:text-[#FFFAE6]" href="<?= urlpath('login')?>">Masuk</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        unset($_SESSION['error']['name']);
        unset($_SESSION['error']['email']);
        unset($_SESSION['error']['nik']);
        unset($_SESSION['error']['telepon']);
        unset($_SESSION['error']['password']);
        unset($_SESSION['error']['password_confirmation']);
        unset($_SESSION['error']['password_kepala']);
        unset($_SESSION['error']['password_confirmation_kepala']);

        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['nik']);
        unset($_SESSION['telepon']);
        unset($_SESSION['password']);
        unset($_SESSION['password_confirmation']);
        unset($_SESSION['password_kepala']);
        unset($_SESSION['password_confirmation_kepala']);
        unset($_SESSION['error']);

        unset($_SESSION['register']);
    ?>
    <?php include 'layouts/footer.php'; ?>

    <script>
        let tab1 = document.querySelector('.tab--1');
        let tab2 = document.querySelector('.tab--2');
        let indicator = document.querySelector('.indicator');
        let form1 = document.querySelector('.form--1');
        let form2 = document.querySelector('.form--2');

        function changeTab(tab) {
            if (tab == 1) {
                tab1.classList.add('active');
                tab2.classList.remove('active');
                form1.classList.remove('hidden');
                form2.classList.add('hidden');
                indicator.style.left = '2px';
            } else {
                tab1.classList.remove('active');
                tab2.classList.add('active');
                form1.classList.add('hidden');
                form2.classList.remove('hidden');
                indicator.style.left = 'calc(50% - 2px)';
            }
        }
    </script>
    <script>
        const togglePassword = document.querySelector('#toggle-password');
        const password = document.querySelector('#password');
        const passwordKepala = document.querySelector('#password_kepala');
        const togglePasswordConfirm = document.querySelector('#toggle-password-confirm');
        const passwordConfirm = document.querySelector('#password_confirmation');
        const passwordConfirmKepala = document.querySelector('#password_confirmation_kepala');

        togglePassword.addEventListener('change', function() {
            password.type = this.checked ? 'text' : 'password';
            passwordConfirm.type = this.checked ? 'text' : 'password';
            passwordKepala.type = this.checked? 'text' : 'password';
            passwordConfirmKepala.type = this.checked? 'text' : 'password';
        });
    </script>
    <style>
        
    </style>
</body>
</html>
