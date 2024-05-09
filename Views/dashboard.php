<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact App Manager</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex">

    <!-- Sidebar -->
    <aside class="lg:w-64 md:w-32 sm:w-16 bg-neutral-400 text-white h-screen text-left flex flex-col">
        <div class="p-3 md:p-5 border-b border-neutral-200">
            <h1 class="text-xl md:text-2xl font-bold text-right">Admin</h1>
        </div>
    
        <div class="flex-1 overflow-y-auto">
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
        </div>


        <div class="mt-auto p-3 md:p-5">
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                <a href="<?=urlpath('logout')?>" class="block w-full text-center text-sm md:text-base">Logout</a>
            </button>
        </div>
    </aside>
    
    <!-- Main content area -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow py-3 md:py-5 px-4 md:px-6 text-center">
            <h2 class="text-gray-800 text-lg md:text-2xl font-bold">CONTACT APP MANAGER</h2>
        </header>

        <main class="flex-grow relative">
            <div class="text-gray-800 text-lg md:text-2xl font-semibold mt-1     md:mt-4 pl-3 md:pl-5 bg-white py-3 md:py-4 w-full">Dashboard</div>
            <div class="bg-white p-4 md:p-6 rounded shadow m-4 md:m-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg md:text-xl font-semibold"></h3>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm md:text-base text-left">
                        <thead class="text-xs md:text-sm bg-neutral-200 uppercase bg-gray-100">
                            <tr>
                                <th class="py-2 md:py-3 px-3 md:px-6">ID</th>
                                <th class="py-2 md:py-3 px-3 md:px-6">Username</th>
                                <th class="py-2 md:py-3 px-3 md:px-6">Password</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="w-32 py-2 md:py-3 px-3 md:px-6"><?php echo htmlspecialchars($row['user_id']); ?></td>
                                <td class="w-64 py-2 md:py-3 px-3 md:px-6"><?php echo htmlspecialchars($row['username']); ?></td>
                                <td class="w-96 py-2 md:py-3 px-3 md:px-6"><?php echo str_repeat('*',strlen($row['password'])); ?></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Pagination -->
            <div class="flex justify-center">
                <div class="absolute justify-center mx-auto bg-white z-50 shadow">
                    <div class="flex justify-center">
                        <div class="flex w-full max-w-lg justify-between items-center">
                            <!-- Previous Button -->
                            <div>
                                <?php if ($halaman > 1): ?>
                                <a href="?page=<?php echo $halaman - 1; ?>" class="py-2 px-3 md:px-4 text-gray-500 bg-white rounded-l hover:bg-gray-100 min-w-[100px]">&laquo; Previous</a>
                                <?php endif; ?>
                            </div>
    
                            <!-- Page Numbers -->
                            <div class="flex grow justify-center">
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?page=<?php echo $i; ?>" class="py-2 px-3 md:px-4 text-gray-700 bg-white <?= ($i == $halaman) ? 'text-blue-500' : 'border-x border-gray-300'; ?> hover:bg-gray-100"><?php echo $i; ?></a>
                                <?php endfor; ?>
                            </div>
    
                            <!-- Next Button -->
                            <div>
                                <?php if ($halaman < $totalPages): ?>
                                <a href="?page=<?php echo $halaman + 1; ?>" class="py-2 px-3 md:px-4 text-gray-700 bg-white rounded-r hover:bg-gray-100">Next &raquo;</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>
</html>
