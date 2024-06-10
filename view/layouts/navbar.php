<nav class="bg-[#FFC100] px-4 py-2 fixed w-full z-40">
    <div class="container mx-auto grid grid-cols-3 gap-4 relative items-center">
        <img src="assets/images/logo.png" class="h-16" alt="">
        <div class="flex items-center lg:hidden">
        </div>
        <div class="flex items-center justify-end lg:hidden">
            <button class="text-white focus:outline-none" onclick="toggleSidebar('sidebar-menu')">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <div class="hidden lg:flex lg:gap-4 space-x-4 lg:justify-center" id="navbar-menu">
            <a href="<?= urlpath('dashboard')?>" class="button-navbar text-white text-lg hover:text-white">Dashboard</a>
            <a href="<?= urlpath('pengajuan')?>" class="button-navbar text-white text-lg hover:text-white">Pengajuan</a>
        </div>
        <div class="hidden lg:flex lg:items-center lg:gap-4 lg:justify-end">
            <button onclick="window.location.href='<?= urlpath('profil')?>';">
                <i data-feather="user" class="stroke-white w-10 h-10 rounded-full border-[3px] border-white"></i>
            </button>
            <button id='logout-btn' class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="window.location.href='<?= urlpath('logout')?>'">Logout</button>
        </div>
    </div>
</nav>

<!-- Sidebar -->
<div id="sidebar-menu" class="fixed top-0 right-0 w-64 h-full bg-[#FFC100] transform translate-x-full transition-transform lg:hidden z-50">
    <div class="p-4 h-full relative">
        <button class="text-white focus:outline-none mb-4" onclick="toggleSidebar('sidebar-menu')">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        <div class="flex flex-col justify-between h-full">
            <div class="flex flex-col gap-3">
                <a href="<?= urlpath('dashboard')?>" class="block text-white text-lg hover:text-white">Dashboard</a>
                <a href="<?= urlpath('pengajuan')?>" class="block text-white text-lg hover:text-white">Pengajuan</a>
            </div>
            <button onclick="window.location.href='<?= urlpath('profil')?>';" class="absolute bottom-20 right-4 left-4 flex items-center  gap-4 border-[3px] border-white p-2 rounded-full">
                <i data-feather="user" class="stroke-white w-10 h-10 rounded-full border-[3px] border-white "></i>
                <p class=" right-4 left-4 text-white font-semibold">Profil</p>
            </button>
            <button id='logout-btn' class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded absolute bottom-4 right-4 left-4" onclick="window.location.href='<?= urlpath('logout')?>'">Logout</button>
            <!-- <div class="absolute bottom-4">
            </div> -->
        </div>
        
    </div>
</div>
<div id="modalLogout" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center z-50 hidden">
    <div class="bg-white p-8 rounded shadow-lg w-1/3">
        <h3 class="text-lg mb-4 font-bold text-center">Logout</h3>
        <p class="text-center">Apakah anda yakin untuk logout?</p>
        <div class="flex items-center justify-center mt-4">
            <button type="button" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-700 mr-4 w-1/3" id="batalLogout" onclick="closeModal()">Tidak</button>
            <button type="button" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700 w-1/3" onclick="document.getElementById('formLogout').submit()">Ya</button>
        </div>
        <!-- <form id="formLogout" action="{{ route('logout') }}" method="POST" class="hidden">
            
        </form> -->
    </div>
</div>
<script>
    function toggleSidebar(id) {
        const element = document.getElementById(id);
        if (element.classList.contains('translate-x-full')) {
            element.classList.remove('translate-x-full');
        } else {
            element.classList.add('translate-x-full');
        }
    }
</script>
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace(); // Ganti elemen dengan ikon Feather
</script>

