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
            <h1 class="text-center font-bold mb-8 text-3xl lg:text-5xl">Konfirmasi Pengajuan</h1>
            <div class="bg-white shadow-md rounded-lg p-8 mx-auto w-full lg:w-full">
                <form method="POST" action="<?= urlpath('konfirmasi') ?>?id=<?= $validasi['id'] ?>" class=" space-y-6" enctype="multipart/form-data">
                    <div class="rounded-md">
                        
                        <div class="mt-4">
                            <label class="font-semibold" for="jumlah_pakan">Jumlah Pakan Yang Divalidasi (kg)</label>
                            <p class="mt-4"><?= $validasi['jumlah_pakan'] ?> kg</p>
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
                        <div class="mt-4">
                            <label class="font-semibold" for="foto_bukti">Bukti Pengambilan</label>
                            <div class="hidden h-full w-full lg:w-2/3 lg:h-72 overflow-y-scroll rounded-md preview mb-2" id="foto_bukti-container" style="scrollbar-width: none;">
                                <img id="foto_bukti-preview" src="#" alt="Foto Peternakan" class="hidden w-full object-cover object-top" />
                            </div>
                            <div class="relative w-full mb-4 mt-1">
                                <input
                                    id="foto_bukti"
                                    name="foto_bukti"
                                    type="file"
                                    class="appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm"
                                    onchange="previewImage(this)"
                                />
                            </div>
                        </div>
                    </div>                            
                    <div class="flex justify-center items-center gap-2">
                        <button
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-[#FF5F00] hover:bg-[#FFFAE6] hover:text-[#FF5F00]"
                            type="submit" id="submit-btn"
                        >
                            Validasi
                        </button>
                    </div>
                    

                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'layouts/footer.php'; ?>



    <script>
        function previewImage(input) {
            const file = input.files[0];
            const preview = document.getElementById('foto_bukti-preview');
            const container = document.getElementById('foto_bukti-container');
            const reader = new FileReader();
            reader.onload = function () {
                preview.classList.remove('hidden');
                container.classList.remove('hidden');
                preview.src = reader.result;
            };
            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.classList.add('hidden');
                container.classList.add('hidden');
                preview.src = "";
            }
        }
    </script>
    
</body>
</html>
