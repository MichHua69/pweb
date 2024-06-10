<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/main.css"> -->
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <title>J-Layer</title>
</head>
<body>
    <?php include 'layouts/navbar.php' ?>
    <?php if ($role === 1): ?>
    <main id='dinas-dashboard' class="">
        <section class="bg-[#FFFAE6] w-full min-h-screen">
            <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
                <h1 class="text-center font-bold mb-8 text-3xl lg:text-5xl">Data Pengajuan</h1>
                <div class="bg-white shadow-md rounded-lg p-4 mx-auto w-full lg:w-full">
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Nama Peternak</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Pengajuan Pakan</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Status Validasi</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Status Konfirmasi</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center w-full">
                            <?php foreach ($pengajuan as $item): ?>
                            <tr>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['peternak'] ?></td>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['jumlah_pakan'] ?> kg</td>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['status_validasi'] ?></td>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['status_konfirmasi'] ?></td>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">
                                    <div class="flex gap-2 justify-center">
                                    <?php if ($item['id_status_validasi'] == 1):?>
                                        <button class="font-semibold items-center gap-2 bg-red-500 text-white hover:bg-red-600 py-3 px-4 rounded-lg flex justify-center items-center w-full text-center" id="detail-btn" onclick="window.location.href='<?= urlpath('detailpengajuan')?>?id=<?= $item['id'] ?>'">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 10" id="Information-Circle--Streamline-Micro" height="20" width="20"><desc>Information Circle Streamline Icon: https://streamlinehq.com</desc><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M5 9.5a4.5 4.5 0 1 0 0 -9 4.5 4.5 0 0 0 0 9Z" stroke-width="1"></path><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M5 7.5v-2" stroke-width="1"></path><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M5 3.53a0.25 0.25 0 0 1 0 -0.5" stroke-width="1"></path><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M5 3.53a0.25 0.25 0 0 0 0 -0.5" stroke-width="1"></path></svg>
                                            <span class="hidden lg:block">Lihat Detail</span>
                                        </button>
                                    <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($total_pages > 1): ?>
                    <div class="mt-6">
                        <ul class="flex gap-2 justify-center">
                            <?php if ($current_page > 1): ?>
                                <?php if ($current_page > 3): ?>
                                    <li><a href="?page=<?= 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">1</a></li>
                                    <li><span class="px-3 py-2 bg-gray-200 rounded-lg">...</span></li>
                                <?php endif; ?>
                                <li><a href="?page=<?= $current_page - 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">Previous</a></li>
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
    <?php elseif ($role === 2): ?>
    <main id='kepalaternak-dashboard' class="">
        <section class="bg-[#FFFAE6] w-full min-h-screen">
            <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
                <h1 class="text-center font-bold mb-8 text-3xl lg:text-5xl">Data Pengajuan</h1>
                <div class="bg-white shadow-md rounded-lg p-4 mx-auto w-full lg:w-full">
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Tanggal Pengambilan</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Jumlah Pakan yang Divalidasi</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Status Validasi</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Status Konfirmasi</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center w-full">
                            <?php foreach ($validasi as $item): 
                                ?>
                                <tr>
                                    <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= date('d-m-Y', strtotime($item['tanggal_pengambilan'])) ?></td>
                                    <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['jumlah_pakan'] ?> kg</td>
                                    <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['status_validasi'] ?></td>
                                    <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['status_konfirmasi'] ?></td>
                                    <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">
                                        <?php if($item['pengajuan']['id_status_konfirmasi'] == 1):?>
                                            <button class="font-semibold items-center gap-2 bg-green-500 text-white hover:bg-green-600 py-3 px-4 rounded-lg flex justify-center w-full text-center" onclick="window.location.href='<?= urlpath('konfirmasi') . '?id=' . $item['id'] ?>'"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" id="Upload-Simple--Streamline-Phosphor" height="16" width="16"><desc>Upload Simple Streamline Icon: https://streamlinehq.com</desc><path d="M15.83974375 9.96019375v5.22649375c0 0.3608125 -0.2925 0.6533125 -0.6533125 0.6533125H0.81356875c-0.3608125 0 -0.6533125 -0.2925 -0.6533125 -0.6533125v-5.22649375c0 -0.50291875 0.544425 -0.81724375 0.97996875 -0.5657875 0.2021375 0.11670625 0.32665625 0.33238125 0.32665625 0.5657875v4.57318125h13.0662375v-4.57318125c0 -0.50291875 0.544425 -0.81724375 0.97996875 -0.5657875 0.20213125 0.11670625 0.32665625 0.33238125 0.32665625 0.5657875ZM5.19565625 4.54260625l2.15103125 -2.15185v7.5694375c0 0.50291875 0.544425 0.81724375 0.97996875 0.56578125 0.2021375 -0.1167 0.32665625 -0.332375 0.32665625 -0.56578125V2.39075625l2.15103125 2.15185c0.3558125 0.3558125 0.96338125 0.19301875 1.09361875 -0.2930375 0.06044375 -0.225575 -0.00405 -0.46626875 -0.1691875 -0.6314l-3.26655625 -3.2665625c-0.25519375 -0.255475 -0.66924375 -0.255475 -0.9244375 0l-3.26655625 3.2665625c-0.35581875 0.3558125 -0.19301875 0.96338125 0.29303125 1.09361875 0.22558125 0.06044375 0.46626875 -0.00405 0.6314 -0.16918125Z" stroke-width=""></path></svg>
                                            <span class="hidden lg:block">Upload Konfirmasi</span>
                                            </button>
                                        <?php endif;?>

                                    </td>

                            <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <?php if ($total_pages > 1): ?>
                    <div class="mt-6">
                        <ul class="flex gap-2 justify-center">
                            <?php if ($current_page > 1): ?>
                                <?php if ($current_page > 3): ?>
                                    <li><a href="?page=<?= 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">1</a></li>
                                    <li><span class="px-3 py-2 bg-gray-200 rounded-lg">...</span></li>
                                <?php endif; ?>
                                <li><a href="?page=<?= $current_page - 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">Previous</a></li>
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
    <?php elseif ($role === 3): ?>
    <main id='peternak-dashboard' class="">
        <section class="bg-[#FFFAE6] w-full min-h-screen">
            <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
                <h1 class="text-center font-bold mb-8 text-3xl lg:text-5xl">Data Pengajuan</h1>
                <div class="flex justify-end lg:w-full">
                    <button type="button" class="inline-block rounded rounded-lg text-center py-2 text-xl font-bold uppercase leading-normal text-white shadow-dark-3 transition duration-150 ease-in-out bg-[#FFC100] hover:bg-[#FFC100] min-w-32 shadow-lg w-full"
                    onclick="window.location='<?= urlpath('tambahpengajuan') ?>'">
                    Tambah
                    </button>
                </div>
                <div class="bg-white shadow-md rounded-lg p-4 mx-auto w-full lg:w-full mt-4">
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">No Pengajuan</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Status Validasi</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Status Konfirmasi</th>
                                <th class="p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-center w-full">
                        <?php foreach ($pengajuan as $item): ?>
                            <tr>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['id'] ?></td>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['status_validasi'] ?></td>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg"><?= $item['status_konfirmasi'] ?></td>
                                <td class=" p-1 lg:px-4 lg:py-3 text-sm lg:text-lg">
                                <div class="flex gap-2">
                                <?php if ($item['id_status_validasi'] == 1): ?>
                                    <button class="font-semibold items-center gap-2 bg-green-500 text-white hover:bg-green-600 py-3 px-4 rounded-lg flex justify-center w-full text-center" onclick="window.location.href='<?= urlpath('editpengajuan') . '?id=' . $item['id'] ?>'"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" id="Hand-Held-Tablet-Writing--Streamline-Core" height="16" width="14"><desc>Hand Held Tablet Writing Streamline Icon: https://streamlinehq.com</desc><g id="hand-held-tablet-writing--tablet-kindle-device-electronics-ipad-writing-digital-paper-notepad"><path id="Vector" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M8 0.5H1.5c-0.552285 0 -1 0.447715 -1 1v11c0 0.5523 0.447715 1 1 1h9c0.5523 0 1 -0.4477 1 -1V8" stroke-width="1"></path><path id="Vector_2" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M0.5 10.5h11" stroke-width="1"></path><path id="Vector_3" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M3.5 3h2" stroke-width="1"></path><path id="Vector_4" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M3.5 5.5h1" stroke-width="1"></path><path id="Vector_5" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="m8.99414 7.5058 -3 0.54 0.5 -3.04L10.7241 0.795798c0.093 -0.093728 0.2036 -0.168122 0.3255 -0.218891C11.1714 0.526138 11.3021 0.5 11.4341 0.5c0.1321 0 0.2628 0.026138 0.3846 0.076907 0.1219 0.050769 0.2325 0.125163 0.3254 0.218891l1.06 1.060002c0.0938 0.09296 0.1682 0.20356 0.2189 0.32542 0.0508 0.12186 0.0769 0.25257 0.0769 0.38458 0 0.13201 -0.0261 0.26272 -0.0769 0.38457 -0.0507 0.12186 -0.1251 0.23247 -0.2189 0.32543l-4.20996 4.23Z" stroke-width="1"></path></g></svg>
                                    <span class="hidden lg:block">Ubah Pengajuan</span>
                                    </button>
                                    <button class="font-semibold items-center gap-2 bg-red-500 text-white hover:bg-red-600 py-3 px-4 rounded-lg flex justify-center w-full text-center items-center" onclick="window.location.href='<?= urlpath('editpengajuan') . '?id=' . $item['id'] ?>'"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" id="Recycle-Bin-2--Streamline-Core" height="16" width="16"><desc>Recycle Bin 2 Streamline Icon: https://streamlinehq.com</desc><g id="recycle-bin-2--remove-delete-empty-bin-trash-garbage"><path id="Vector" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M1 3.5h12" stroke-width="1"></path><path id="Vector_2" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M2.5 3.5h9v9c0 0.2652 -0.1054 0.5196 -0.2929 0.7071s-0.4419 0.2929 -0.7071 0.2929h-7c-0.26522 0 -0.51957 -0.1054 -0.70711 -0.2929C2.60536 13.0196 2.5 12.7652 2.5 12.5v-9Z" stroke-width="1"></path><path id="Vector_3" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M4.5 3.5V3c0 -0.66304 0.26339 -1.29893 0.73223 -1.76777C5.70107 0.763392 6.33696 0.5 7 0.5c0.66304 0 1.29893 0.263392 1.76777 0.73223C9.23661 1.70107 9.5 2.33696 9.5 3v0.5" stroke-width="1"></path><path id="Vector_4" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M5.5 6.50146V10.503" stroke-width="1"></path><path id="Vector_5" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M8.5 6.50146V10.503" stroke-width="1"></path></g></svg></svg>
                                    <span class="hidden lg:block">Hapus Pengajuan</span>
                                    </button>
                                    
                                <?php elseif ($item['id_status_validasi'] == 2): ?>
                                    <button class="font-semibold items-center gap-2 bg-red-500 text-white hover:bg-red-600 py-3 px-4 rounded-lg flex justify-center w-full text-center" onclick="window.open('<?= urlpath('validasi') . '?id=' . $item['id'] ?>', '_blank')">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14" id="Download-File--Streamline-Core" height="16" width="16">
                                            <desc>Download File Streamline Icon: https://streamlinehq.com</desc>
                                            <g id="download-file">
                                                <path id="Vector" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="M12.5 12.5c0 0.2652 -0.1054 0.5196 -0.2929 0.7071s-0.4419 0.2929 -0.7071 0.2929h-9c-0.26522 0 -0.51957 -0.1054 -0.70711 -0.2929C1.60536 13.0196 1.5 12.7652 1.5 12.5v-11c0 -0.26522 0.10536 -0.51957 0.29289 -0.707107C1.98043 0.605357 2.23478 0.5 2.5 0.5H9L12.5 4v8.5Z" stroke-width="1"></path>
                                                <path id="vector 377" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="m9 8 -2 2 -2 -2" stroke-width="1"></path>
                                                <path id="vector 378" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" d="m7 10 0 -5.5" stroke-width="1"></path>
                                            </g>
                                        </svg>
                                        <span class="hidden lg:block">Unduh Surat</span>
                                    </button>
                                </div>       
                                <?php else: ?>
                                    <!-- <span class="text-red-600">Ditolak</span> -->
                                <?php endif; ?>
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if ($total_pages > 1): ?>
                    <div class="mt-6">
                        <ul class="flex gap-2 justify-center">
                            <?php if ($current_page > 1): ?>
                                <?php if ($current_page > 3): ?>
                                    <li><a href="?page=<?= 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">1</a></li>
                                    <li><span class="px-3 py-2 bg-gray-200 rounded-lg">...</span></li>
                                <?php endif; ?>
                                <li><a href="?page=<?= $current_page - 1 ?>" class="px-3 py-2 bg-gray-200 rounded-lg">Previous</a></li>
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
                <!-- <div id="modalLogout" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50">
                    <div class="bg-white p-8 rounded shadow-lg w-1/3">
                        <h3 class="text-lg mb-4 font-bold text-center">Hapus Pengajuan</h3>
                        <p class="text-center">Apakah anda yakin menghapus pengajuan?</p>
                        <div class="flex items-center justify-center mt-4">
                            <button type="button" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 mr-4 w-1/3" id="batalLogout" onclick="closeModal()">Tidak</button>
                            <button type="button" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 w-1/3" onclick="document.getElementById('formLogout').submit()">Ya</button>
                        </div>
                        <form id="formLogout" action="{{ route('logout') }}" method="POST" class="hidden">
                            
                        </form>
                    </div>
                </div> -->
            </div>
        </section>
    </main>
    <?php endif; ?>

    <!-- Footer -->
    <?php include 'layouts/footer.php'; ?>


    <script>
        const detailBtn = document.getElementById('detail-btn');
        const validasiBtn = document.getElementById('validasi-btn');
        const setujuBtn = document.getElementById('setuju-btn');
        const tolakBtn = document.getElementById('tolak-btn');
        
        validasiBtn.addEventListener('click', () => {
            detailBtn.classList.add('hidden');
            validasiBtn.classList.add('hidden');
            setujuBtn.classList.remove('hidden');
            tolakBtn.classList.remove('hidden');
        });

    </script>
</body>
</html>
