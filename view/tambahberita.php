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
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <title>J-Layer</title>
</head>
<body>
    <?php include 'layouts/navbar.php' ?>
    <section class="bg-[#FFFAE6] min-h-screen">
        <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
            <h1 class="text-center font-bold mb-8 text-3xl lg:text-5xl">Tambah Berita</h1>
            <div class="bg-white shadow-md rounded-lg p-8 mx-auto w-full lg:w-full">
                <form method="POST" action="<?php urlpath('tambahpengajuan')?>" class="space-y-6" enctype="multipart/form-data" id="form">
                    <div class="rounded-md shadow-sm">
                        <div class="mt-4">
                            <label class="font-semibold" for="judul">Judul</label>
                            <input
                                placeholder="Masukkan Judul"
                                class="appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm"
                                autocomplete="judul"
                                type="text"
                                name="judul"
                                id="judul"
                                value="<?= isset($_SESSION['judul']) ? htmlspecialchars($_SESSION['judul']) : '' ?>"
                            />
                            <?php if (isset($_SESSION['error']['judul'])): ?>
                            <p class="text-red-500 text-xs italic"><?= $_SESSION['error']['judul'] ?></p>
                            <?php endif ?>
                        </div>
                        
                        <div class="mt-4">
                            <label class="font-semibold" for="gambar">Gambar</label>
                            <div class="hidden h-full w-full lg:w-2/3 lg:h-72 overflow-y-scroll rounded-md preview mb-2" id="gambar-container" style="scrollbar-width: none;">
                                <img id="gambar-preview" src="#" alt="gambar" class="hidden w-full object-cover object-top" />
                            </div>
                            <div class="relative w-full mb-4 mt-1">
                                <input
                                    id="gambar"
                                    name="gambar"
                                    type="file"
                                    class="appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm"
                                    onchange="previewImage(this)"
                                />
                                <?php if (isset($_SESSION['error']['file'])): ?>
                                <p class="text-red-500 text-xs italic"><?= $_SESSION['error']['file']?></p>
                                <?php endif; ?>
                                <p class="text-gray-500 text-xs italic">Unggah gambar dalam format .jpg, .jpeg, atau .png</p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="font-semibold" for="deskripsi">Deskripsi</label>
                            <input type="hidden" name="deskripsi" id="deskripsi">
                            <div id="editor" class="h-72"><?= isset($_SESSION['deskripsi']) ? htmlspecialchars($_SESSION['deskripsi']) : '' ?></div>
                            <?php if (isset($_SESSION['error']['deskripsi'])): ?>
                            <p class="text-red-500 text-xs italic"><?= $_SESSION['error']['deskripsi'] ?></p>
                            <?php endif; ?>
                        </div>
                    
                        <div class="mt-4">
                            <button
                                class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-lg font-medium rounded-md text-white bg-[#FF5F00] hover:bg-[#FFFAE6] hover:text-[#FF5F00]"
                                type="submit"
                            >
                                Tambah
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <?php unset($_SESSION['error']['judul']); ?>
    <?php unset($_SESSION['error']['file']); ?>
    <?php unset($_SESSION['error']['deskripsi']); ?>
    <?php unset($_SESSION['judul']); ?>
    <?php unset($_SESSION['deskripsi']); ?>

    <!-- Footer -->
    <?php include 'layouts/footer.php'; ?>

    <script>
        function previewImage(input) {
            const file = input.files[0];
            const Usahapreview = document.getElementById('gambar-preview');
            const Usahacontainer = document.getElementById('gambar-container');
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

        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }]
                ]
            }
        });

        document.getElementById('form').onsubmit = function() {
            var quillContent = quill.root.innerHTML.trim();
            if (quillContent === '<p><br></p>' || quillContent === '') {
                quillContent = null;
            }
            document.getElementById('deskripsi').value = quillContent;
        };
    </script>
    
</body>
</html>
