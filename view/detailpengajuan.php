<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <title>Detail Pengajuan</title>
</head>
<body>
    <?php include 'layouts/navbar.php' ?>
    <section class="bg-[#FFFAE6] min-h-screen">
        <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
            <h1 class="text-center font-bold mb-8 text-3xl lg:text-5xl">Detail Pengajuan</h1>
            <div class="bg-white shadow-md rounded-lg p-8 mx-auto w-full lg:w-full">
                <form method="POST" action="<?= urlpath('detailpengajuan') ?>?id=<?= $pengajuan['id'] ?>" class=" space-y-6">
                    <div class="rounded-md">
                        <div class="mt-4">
                            <label class="font-semibold" for="alamat">Alamat</label>
                            <p class="mt-4"><?= $pengajuan['alamat'] ?></p>
                        </div>
                        <div class="mt-4">
                            <label class="font-semibold" for="jumlah_pakan">Jumlah Populasi Ayam</label>
                            <p class="mt-4"><?= $pengajuan['id_jumlah_populasi_ayam'] ?></p>
                        </div>
                        <div class="mt-4">
                            <label class="font-semibold" for="foto_peternakan">Foto Peternakan</label>
                            <div class="h-full w-full lg:w-2/3 lg:h-72 overflow-y-scroll rounded-md preview mb-2" id="foto_peternakan-container" style="scrollbar-width: none;">
                                <img id="foto_peternakan-preview" src="<?= 'assets/pengajuan/foto_peternakan/'.$pengajuan['foto_peternakan'] ?>" alt="Foto Peternakan" class="w-full object-cover object-top" />
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="font-semibold" for="foto_usaha">Foto Surat Usaha</label>
                            <div class=" h-full w-full lg:w-2/3 lg:h-72 overflow-y-scroll rounded-md preview mb-2" id="foto_usaha-container" style="scrollbar-width: none;">
                                <img id="foto_usaha-preview" src="<?= 'assets/pengajuan/foto_usaha/'.$pengajuan['foto_surat_usaha'] ?>" alt="Foto Surat Usaha" class=" w-full object-cover object-top" />
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="font-semibold" for="jumlah_pakan">Jumlah Pakan Yang Diajukan (Kg)</label>
                            <p class="mt-4"><?= $pengajuan['jumlah_pakan'] ?></p>
                        </div>                             
                    </div>
                    <div class="hidden" id="hiddenform">
                        <div class="mt-4">
                            <label class="font-semibold" for="jumlah_pakan">Jumlah Pakan Yang Divalidasi (Kg)</label>
                            <input
                                placeholder="Masukkan Jumlah Pakan (Kg)"
                                class="appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm"
                                autocomplete="jumlah_pakan"
                                type="number"
                                name="jumlah_pakan"
                                id="jumlah_pakan"
                                min="1"
                            />
                        </div>
                        <div class="mt-4">
                            <label class="font-semibold" for="tempat_pengambilan">Tempat Pengambilan</label>
                            <select name="tempat_pengambilan" id="tempat_pengambilan" class="block w-full px-3 py-2 rounded-md border border-gray-300 bg-gray-100 focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm">
                                <option value="" hidden>Pilih Tempat Pengambilan</option>
                                <?php foreach ($tempat_pengambilan as $item) : ?>
                                    <option value="<?= $item['id'] ?>"><?= $item['nama'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mt-4">
                            <label class="font-semibold" for="tanggal_pengambilan">Tanggal Pengambilan</label>
                            <input
                                placeholder="Masukkan Tanggal Pengambilan"
                                class="appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm"
                                autocomplete="tanggal_pengambilan"
                                type="date"
                                name="tanggal_pengambilan"
                                id="tanggal_pengambilan"
                            />
                        </div>
                    </div>                             
                    <input type="hidden" name="action" id="action">
                    <div class="flex justify-center items-center gap-2">
                        <button
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-[#FF5F00] hover:bg-[#FFFAE6] hover:text-[#FF5F00] hidden"
                            type="submit" id="submit-btn"
                        >
                            Validasi
                        </button>
                        <button
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-[#FF5F00] hover:bg-[#FFFAE6] hover:text-[#FF5F00]"
                            type="button" onclick="validasi()" id="validasi-btn"
                        >
                            Validasi
                        </button>
                        <button
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-red-500 hover:bg-red-700 hover:text-white"
                            type="submit" onclick="" id="tolak-btn"
                        >
                            Tolak
                        </button>
                    </div>
                    

                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'layouts/footer.php'; ?>



    <script>
        function validasi() {
            document.getElementById('hiddenform').classList.remove('hidden');
            document.getElementById('validasi-btn').classList.add('hidden');
            document.getElementById('tolak-btn').classList.add('hidden');
            document.getElementById('submit-btn').classList.remove('hidden');
            document.getElementById('action').value = 'validasi';
        }
    </script>
    
</body>
</html>
