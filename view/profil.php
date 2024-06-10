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

    <title>Profil</title>
</head>
<body>
    <?php include 'layouts/navbar.php' ?>
    <section class="bg-[#FFFAE6] min-h-screen">
        <div class="max-w-screen-xl px-4 pt-36 pb-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:pt-36">
            <h1 class="text-center font-bold mb-8 text-3xl lg:text-5xl">Profil</h1>
            <div class="bg-white shadow-md rounded-lg p-8 mx-auto w-full lg:w-full">
                <form action="<?= urlpath('profil')?>" method="post">
                    <div class="grid grid-cols-1 gap-8  mt-4 lg:grid-cols-2">
                        <div class="">
                            <label class="font-semibold">Nama</label>
                            <p class="text-gray-600" id="nama"><?php echo htmlspecialchars($user['nama']); ?></p>
                            <input type="text" class="hidden appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm" name="nama" id="nama" value="<?= htmlspecialchars($user['nama'])?>">
                        </div>
                        <?php if ($role !== 1) : ?>
                        <div class="">
                            <label class="font-semibold">NIK</label>
                            <p class="text-gray-600"><?php echo htmlspecialchars($user['NIK']); ?></p>
                        </div>
                        <?php endif ?>
                        <?php if($role == 2) :?>
                        <div class="">
                            <label class="font-semibold">Wilayah</label>
                            <p class="text-gray-600"><?php echo htmlspecialchars($user['wilayah']); ?></p>
                        </div>
                        <?php endif ?>
                        <div>
                            <label class="font-semibold">Nomor Telepon</label>
                            <p class="text-gray-600" id="no_telepon">
                                <?php 
                                    if($role == 1) {
                                        echo '0';
                                    }
                                    echo htmlspecialchars($user['no_telepon']); 
                                ?>
                            </p>
                            <input type="text" class="hidden appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm" name="no_telepon" id="no_telepon" value="<?= htmlspecialchars($user['no_telepon'])?>">
                            
                        </div>
                        <div>
                            <label class="font-semibold">Email</label>
                            <p class="text-gray-600" id="email"><?php echo htmlspecialchars($user['email']); ?></p>
                            <input type="text" class="hidden appearance-none relative block w-full px-3 py-3 border border-gray-300 bg-gray-100 rounded-md focus:outline-none focus:ring-[#FF5F00] focus:border-gray-500 focus:z-10 sm:text-sm" name="email" id="email"  value="<?= htmlspecialchars($user['email'])?>">

                        </div>
                        <div>
                            <label class="font-semibold">Password</label>
                            <p class="text-gray-600">********</p>
                        </div>
                    </div>
                    <div class="mt-4 flex justify-end gap-4">
                        <button id="edit-btn" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-8 rounded-full min-w-28" onclick="ubah()">Ubah</button>
                        <button id="cancel-btn" type="button" class="hidden bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-8 rounded-full min-w-28" onclick="cancel()" >Batal</button>
                        <button id="save-btn" type="submit" class="hidden bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-8 rounded-full min-w-28" onclick="">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include 'layouts/footer.php'; ?>
    
    <script>
        const editBtn = document.getElementById('edit-btn');
        const cancelBtn = document.getElementById('cancel-btn');
        const saveBtn = document.getElementById('save-btn');

        
        const nama = document.getElementById('nama');
        const telepon = document.getElementById('no_telepon');
        const email = document.getElementById('email');
        const inputFields = document.getElementsByTagName('input');

        function ubah() {
            editBtn.addEventListener('click', function() {
                Array.from(inputFields).forEach(function(inputField) {
                    inputField.classList.remove('hidden');
                });

                nama.classList.add('hidden');
                telepon.classList.add('hidden');
                email.classList.add('hidden');
                editBtn.classList.add('hidden');
                cancelBtn.classList.remove('hidden');
                saveBtn.classList.remove('hidden');
            });
        }

        cancelBtn.addEventListener('click', function() {
            Array.from(inputFields).forEach(function(inputField) {
                inputField.classList.add('hidden');
            });

            nama.classList.remove('hidden');
            telepon.classList.remove('hidden');
            email.classList.remove('hidden');
            editBtn.classList.remove('hidden');
            cancelBtn.classList.add('hidden');
            saveBtn.classList.add('hidden');
        });
    </script>

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
    </script>
    <script>
        var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: [
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            [{ 'align': [] }]
            ]
        },
        breakLine: false
        });
        
    </script>
    <script>
        document.getElementById('form').onsubmit = function() {
        document.getElementById('deskripsi').value = quill.root.innerHTML;
        };
    </script>
    
</body>
</html>
