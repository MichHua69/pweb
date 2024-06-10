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
    <section class="bg-[#FFFAE6]">
        <div class="grid max-w-screen-xl px-4 pt-28 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 relative">
            <div class="flex justify-between absolute top-8 items-center w-full px-4" id="navbar-menu">
                <div class="bg-[#FFC100] rounded-full h-full">
                    <img src="assets/images/logo.png" class="h-20" alt="">
                </div>
                <div class="space-x-2">
                    <button id='login-btn' onclick="window.location.href='<?= urlpath('login')?>'">Login</button>
                    <button id='register-btn' onclick="window.location.href='<?= urlpath('register')?>'">Register</button>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-[#FFFAE6]">
        <div class="grid max-w-screen-xl px-4 pt-28 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12 lg:py-28 lg:relative">
        
            <div class="mr-auto place-self-center lg:col-span-8">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl">Solusi Mudah untuk Pengajuan Pakan Peternak</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-700 lg:mb-8 md:text-lg lg:text-xl">Mempermudah peternak dalam mendapatkan pakan berkualitas dengan cepat dan efisien.</p>
                <button id='ajukan-btn' onclick="window.location.href='<?php echo urlpath('login') ?>'">Ajukan Pakan</button>

            </div>
            <img src="assets/images/mains.png" alt="main image" class="hidden border-4 border-[#FFC100] right-0 lg:mt-0 lg:col-span-4 lg:flex lg:justify-center object-cover rounded-full w-96 h-96">
        </div>
    </section>

    <!-- Blog/News Section -->
    <section class="">
        <main id='peternak-dashboard' class="">
            <section class="bg-white w-full min-h-screen">
                <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
                <h2 class="text-5xl font-bold text-center mb-8">Berita</h2>
                    <!-- Search Bar -->
                    <div class="flex flex-col-reverse lg:flex-row items-center gap-4 mb-8 justify-between">
                        <div class="flex w-full items-center gap-4">
                                <!-- <form action="" method="post"> -->
                                <button type="submit"
                                    class="shadow-md flex items-center justify-center gap-2 p-2.5 text-sm font-medium h-full text-white bg-[#FFC100] rounded-lg shadow-lg">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                    </svg>
                                    <span class="text-lg">Search</span>
                                </button>
                                <input type="search" id="search-dropdown" class="block p-2.5 text-md bg-gray-100 rounded-e-lg border-gray-300 border-3 rounded-lg shadow-lg w-full" placeholder="Cari Berita"/>
                                <!-- </form> -->
                            </div>
                    </div>
                    <div class="grid md:grid-cols-3 gap-6">
                        <?php foreach ($berita as $data) : ?>
                        <div class="bg-gray-100 p-6 rounded-lg shadow-lg">
                            <?php if(isset($data['thumbnail'])):?>
                                <img src="assets/berita/<?= $data['thumbnail'] ?>" alt="blog image" class="mb-4 max-h-40 w-full object-cover object-top">
                            <?php endif; ?>
                            <h3 class="text-xl font-bold mb-4"><?= $data['judul'] ?></h3>
                            <p class="mb-4"><?= substr($data['deskripsi'], 0, 100) ?>...</p>
                            <a href="<?=urlpath('berita?id='.$data['id'])?>" class="text-blue-600 hover:underline">Baca Selengkapnya</a>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <?php if ($total_pages > 1): ?>
                        <div class="mt-6">
                            <ul class="flex gap-2 justify-center">
                                <?php if ($current_page > 1): ?>
                                    <li><a href="?page=<?= $current_page - 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">Previous</a></li>
                                    <?php if ($current_page > 3): ?>
                                        <li><a href="?page=<?= 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">1</a></li>
                                        <li><span class="px-3 py-2 bg-gray-200 rounded-lg">...</span></li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php
                                // Menampilkan tombol navigasi untuk halaman
                                for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++): ?>
                                    <?php if ($i == $current_page): ?>
                                        <li><a href="?page=<?= $i ?>" class="px-3 py-2 bg-gray-300 text-gray-700 rounded-lg"><?= $i ?></a></li>
                                    <?php else: ?>
                                        <li><a href="?page=<?= $i ?>" class="px-3 py-2 bg-gray-200 rounded-lg"><?= $i ?></a></li>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                <?php if ($current_page < $total_pages): ?>
                                    <?php if ($current_page < $total_pages - 2): ?>
                                        <li><span class="px-3 py-2 bg-gray-200 rounded-lg">...</span></li>
                                        <li><a href="?page=<?= $total_pages ?>" class="px-3 py-2 bg-gray-200 rounded-lg"><?= $total_pages ?></a></li>
                                    <?php endif; ?>
                                    <li><a href="?page=<?= $current_page + 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">Next</a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                </div>
            </section>
        </main>
    </section>

    <!-- Footer -->
    <?php include 'layouts/footer.php'; ?>


    
</body>
</html>
<script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
