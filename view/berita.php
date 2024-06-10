<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.4.1/dist/flowbite.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/dashboard.css">
    <title><?= $berita['judul'] ?></title>
</head>
<body>
    <?php include 'layouts/navbar.php' ?>
    <section class="bg-[#FFFAE6] min-h-screen">
        <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
            <div class="bg-white shadow-md rounded-lg p-8 mx-auto w-full lg:w-full">
                <h1 class="text-center font-bold mb-4 text-2xl"><?= $berita['judul'] ?></h1>
                <p class="text-end text-gray-500 text-sm mb-4"><?= date('d F Y', strtotime($berita['tanggal'])) ?></p>
                <div class="flex justify-center mb-4 h-72">
                    <img src="assets/berita/<?= $berita['thumbnail'] ?>" alt="Thumbnail" class="w-full object-cover object-top" />
                </div>
                <p class="text-center"><?= $berita['deskripsi'] ?></p>
                
            </div>
    </section>      

    <?php include 'layouts/footer.php'; ?>


    <script>
        function previewImage(input) {
            const file = input.files[0];
            const Usahapreview = document.getElementById('foto_peternakan-preview');
            const Usahacontainer = document.getElementById('foto_peternakan-container');
            const reader = new FileReader();
            reader.onload = function () {
                Usahapreview.classList.remove('hidden');
                Usahacontainer.classList.remove('hidden');
                Usahapreview.src = reader.result;
            };
            if (file) {
                reader.readAsDataURL(file);
            } else {
                Usahapreview.classList.add('hidden');
                Usahacontainer.classList.add('hidden');
                Usahapreview.src = "";
            }
        }
        function previewImageUsaha(input) {
            const file = input.files[0];
            const preview = document.getElementById('foto_usaha-preview');
            const container = document.getElementById('foto_usaha-container');
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
