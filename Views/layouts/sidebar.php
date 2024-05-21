    <aside class="lg:w-64 md:w-32 sm:w-16 bg-neutral-400 text-white h-screen text-left flex flex-col">
        <div class="p-3 md:p-5 border-b border-neutral-200">
            <h1 class="text-xl md:text-2xl font-bold text-right">
                <?php 
                    if ($user['role_id'] == 1) {
                        echo 'Admin';
                    } else if ($user['role_id'] == 2) {
                        echo 'Manager';
                    } else if ($user['role_id'] == 3) {
                        echo 'Staff';
                    } 
                ?>
            </h1>
        </div>
    
        <div class="flex-1 overflow-y-auto">
            <?php if ($user['role_id'] == 1): ?>
            <a href="<?=urlpath('dashboard')?>" class="flex items-center px-3 md:px-5 py-4 hover:bg-neutral-500 transition duration-150 ease-in-out cursor-pointer text-sm md:text-lg font-semibold">
                <span class="fi-rr-dashboard mr-2" style="display: inline-block;"></span>
                <span>Dashboard</span>
            </a>
            <a href="<?=urlpath('contact')?>" class="flex items-center px-3 md:px-5 py-4 hover:bg-neutral-500 transition duration-150 ease-in-out cursor-pointer text-sm md:text-lg font-semibold">
                <span class="fi-rr-dashboard mr-2" style="display: inline-block;"></span>
                <span>Contact</span>
            </a>
            <a href="<?=urlpath('account')?>" class="flex items-center px-3 md:px-5 py-4 hover:bg-neutral-500 transition duration-150 ease-in-out cursor-pointer text-sm md:text-lg font-semibold">
                <span class="fi-rr-dashboard mr-2" style="display: inline-block;"></span>
                <span>Account</span>
            </a>
            <?php endif; ?>
        </div>


        <div class="mt-auto p-3 md:p-5">
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                <a href="<?=urlpath('logout')?>" class="block w-full text-center text-sm md:text-base">Logout</a>
            </button>
        </div>
    </aside>