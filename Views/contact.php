<?php
include '../Models/db.php';

// Handle POST requests
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'delete') {
        // Assuming the contact_id directly relates to a user_id or can be used to obtain it
        // Start transaction to ensure data integrity
        $conn->begin_transaction();

        try {
            // Optional: Check if user exists and get user_id if there's a relationship
            $userCheckStmt = $conn->prepare("SELECT user_id FROM contacts WHERE contact_id = ?");
            $userCheckStmt->bind_param("i", $_POST['contact_id']);
            $userCheckStmt->execute();
            $userResult = $userCheckStmt->get_result();
            $user = $userResult->fetch_assoc();
            $userCheckStmt->close();

            if ($user && $user['user_id']) {
                // Delete the user entry
                $deleteUserStmt = $conn->prepare("DELETE FROM users WHERE user_id = ?");
                $deleteUserStmt->bind_param("i", $user['user_id']);
                $deleteUserStmt->execute();
                $deleteUserStmt->close();
            }

            // Delete the contact entry
            $deleteStmt = $conn->prepare("DELETE FROM contacts WHERE contact_id = ?");
            $deleteStmt->bind_param("i", $_POST['contact_id']);
            $deleteStmt->execute();
            $deleteStmt->close();

            // Commit the transaction
            $conn->commit();
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $conn->rollback();
            error_log('Error: ' . $e->getMessage());  // Log error
        }

        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } 
    elseif (isset($_POST['contact_id']) && !empty($_POST['contact_id'])) {
        $stmt = $conn->prepare("UPDATE contacts SET name = ?, email = ?, address = ?, phone_number = ? WHERE contact_id = ?");
        $stmt->bind_param("ssssi", $_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone_number'], $_POST['contact_id']);
        $stmt->execute();
        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } 
    elseif (isset($_POST['action']) && $_POST['action'] === 'create') {
        $stmt = $conn->prepare("INSERT INTO contacts (name, email, address, phone_number) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $_POST['name'], $_POST['email'], $_POST['address'], $_POST['phone_number']);
        $stmt->execute();
        $stmt->close();
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Pagination and Data Fetch Logic
$rowsPerPage = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $rowsPerPage;

$query = "SELECT contact_id, name, email, phone_number, address FROM contacts LIMIT ? OFFSET ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $rowsPerPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

$totalQuery = "SELECT COUNT(contact_id) AS total FROM contacts";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalPages = ceil($totalRow['total'] / $rowsPerPage);
?>


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
            <a href="./dashboard.php" class="flex items-center px-3 md:px-5 py-4 hover:bg-neutral-500 transition duration-150 ease-in-out cursor-pointer text-sm md:text-lg font-semibold">
                <span class="fi-rr-dashboard mr-2" style="display: inline-block;"></span>
                <span>Dashboard</span>
            </a>
            <a href="./contact.php" class="flex items-center px-3 md:px-5 py-4 hover:bg-neutral-500 transition duration-150 ease-in-out cursor-pointer text-sm md:text-lg font-semibold">
                <span class="fi-rr-dashboard mr-2" style="display: inline-block;"></span>
                <span>Contact</span>
            </a>
            <a href="./account.php" class="flex items-center px-3 md:px-5 py-4 hover:bg-neutral-500 transition duration-150 ease-in-out cursor-pointer text-sm md:text-lg font-semibold">
                <span class="fi-rr-dashboard mr-2" style="display: inline-block;"></span>
                <span>Account</span>
            </a>
        </div>


        <div class="mt-auto p-3 md:p-5">
            <button class="w-full bg-red-600 hover:bg-red-700 text-white py-2 px-4 rounded">
                <a href="logout.php" class="block w-full text-center text-sm md:text-base">Logout</a>
            </button>
        </div>
    </aside>
    
    <!-- Main content area -->
    <div class="flex-1 flex flex-col">
        <header class="bg-white shadow py-3 md:py-5 px-4 md:px-6 text-center">
            <h2 class="text-gray-800 text-lg md:text-2xl font-bold">CONTACT APP MANAGER</h2>
        </header>

        <main class="flex-grow relative">
            <div class="text-gray-800 text-lg md:text-2xl font-semibold mt-1     md:mt-4 pl-3 md:pl-5 bg-white py-3 md:py-4 w-full">Account</div>
            <div class="bg-white p-4 md:p-6 rounded shadow m-4 md:m-8">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg md:text-xl font-semibold">Account Table</h3>
                    <button class="bg-blue-500 text-white px-3 md:px-4 py-2 rounded hover:bg-blue-600 text-sm md:text-base" onclick="openModal()">
                        Create Data
                    </button>

                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm md:text-base text-left">
                        <thead class="text-xs md:text-sm bg-neutral-200 uppercase bg-gray-100 text-center">
                            <tr>
                                <th class="py-2 md:py-3 px-3 md:px-6">ID</th>
                                <th class="py-2 md:py-3 px-3 md:px-6">Name</th>
                                <th class="py-2 md:py-3 px-3 md:px-6">Email</th>
                                <th class="py-2 md:py-3 px-3 md:px-6">Address</th>
                                <th class="py-2 md:py-3 px-3 md:px-6">Phone Number</th>
                                <th class="py-2 md:py-3 px-3 md:px-6">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php while ($row = $result->fetch_assoc()): ?>
                            <tr class="bg-white border-b hover:bg-gray-50" id="row-<?php echo $row['contact_id']; ?>">
                                <form action="contact.php" method="POST">
                                    <td class="py-2 md:py-3 px-3 md:px-6">
                                        <span class=""><?php echo htmlspecialchars($row['contact_id']); ?></span>
                                        <input type="hidden" name="contact_id" value="<?php echo htmlspecialchars($row['contact_id']); ?>">
                                    </td>
                                    <td class="py-2 md:py-3 px-3 md:px-6">
                                        <span class="value"><?php echo htmlspecialchars($row['name']); ?></span>
                                        <input type="text" name="name" class="edit-input hidden border border-neutral-400 p-1 rounded focus:border-neutral-500 focus:ring-2 focus:ring-neutral-300 w-full text-gray-700" value="<?php echo htmlspecialchars($row['name']); ?>">
                                    </td>
                                    <td class="py-2 md:py-3 px-3 md:px-6">
                                        <span class="value"><?php echo htmlspecialchars($row['email']); ?></span>
                                        <input type="email" name="email" class="edit-input hidden border border-neutral-400 p-1 rounded focus:border-neutral-500 focus:ring-2 focus:ring-neutral-300 w-full text-gray-700" value="<?php echo htmlspecialchars($row['email']); ?>">
                                    </td>
                                    <td class="py-2 md:py-3 px-3 md:px-6">
                                        <span class="value"><?php echo htmlspecialchars($row['address']); ?></span>
                                        <input type="text" name="address" class="edit-input hidden border border-neutral-400 p-1 rounded focus:border-neutral-500 focus:ring-2 focus:ring-neutral-300 w-full text-gray-700" value="<?php echo htmlspecialchars($row['address']); ?>">
                                    </td>
                                    <td class="py-2 md:py-3 px:3 md:px-6">
                                        <span class="value"><?php echo htmlspecialchars($row['phone_number']); ?></span>
                                        <input type="text" name="phone_number" class="edit-input hidden border border-neutral-400 p-1 rounded focus:border-neutral-500 focus:ring-2 focus:ring-neutral-300 w-full text-gray-700" value="<?php echo htmlspecialchars($row['phone_number']); ?>">
                                    </td>
                                    <td class="flex justify-center gap-5 py-2 md:py-3 px-3 md:px-6">
                                        <button type="button" class="edit-btn bg-blue-500 text-white hover:bg-blue-700 py-2 px-5 rounded">Edit</button>
                                        <button type="submit" class="save-btn bg-green-500 text-white hover:bg-green-700 py-2 px-5 rounded hidden">Save</button>
                                        <button type="button" class="cancel-btn bg-red-500 text-white hover:bg-red-700 py-2 px-5 rounded hidden">Cancel</button>
                                        <button type="submit" name="action" value="delete" class="delete-btn bg-red-500 text-white hover:bg-red-700 py-2 px-5 rounded">Delete</button>
                                    </td>
                                </form>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>

                    </table>
                </div>
            </div>
            <div class="flex justify-center mt-4">
                <div class="flex border-t border-gray-300 text-gray-700">
                    <?php if ($page > 1): ?>
                    <a href="?page=<?php echo $page - 1; ?>" class="block py-2 px-4 leading-tight text-neutral-500 bg-white rounded-l hover:bg-neutral-100 hover:text-neutral-700">
                        Previous
                    </a>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=<?php echo $i; ?>" class="block py-2 px-4 leading-tight <?= ($i == $page) ? 'bg-neutral-500 text-white' : 'text-neutral-500 bg-white hover:bg-neutral-100 hover:text-neutral-700'; ?>">
                        <?php echo $i; ?>
                    </a>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                    <a href="?page=<?php echo $page + 1; ?>" class="block py-2 px-4 leading-tight text-neutral-500 bg-white rounded-r hover:bg-neutral-100 hover:text-neutral-700">
                        Next
                    </a>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>

<div id="modalTambahData" class="fixed inset-0 bg-gray-500 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-white p-8 rounded shadow-lg w-1/2">
        <h3 class="text-lg mb-4 font-bold text-center">Create Data</h3>
        <form id="formTambah" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="action" value="create">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" id="phone_number" name="phone_number" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <input type="text" id="address" name="address" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
            </div>
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="mt-1 p-2 block w-full border border-gray-300 rounded-md shadow-sm">
                    <?php
                    // Fetch roles from the database
                    $rolesQuery = "SELECT role_id, role_name FROM roles";
                    $rolesResult = $conn->query($rolesQuery);
                    while ($role = $rolesResult->fetch_assoc()) {
                        echo "<option value='{$role['role_id']}'>{$role['role_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="flex items-center justify-end">
                <button type="button" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 mr-4" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Create</button>
            </div>
        </form>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
document.querySelectorAll('.edit-btn').forEach(button => {
    button.addEventListener('click', function() {
        let tr = this.closest('tr');
        tr.querySelectorAll('.value').forEach(span => span.style.display = 'none');
        tr.querySelectorAll('.edit-input').forEach(input => input.classList.remove('hidden'));
        tr.querySelector('.save-btn').classList.remove('hidden');
        tr.querySelector('.cancel-btn').classList.remove('hidden');
        tr.querySelector('.delete-btn').classList.add('hidden');
        this.classList.add('hidden');
    });
});
document.querySelectorAll('.cancel-btn').forEach(button => {
    button.addEventListener('click', function() {
        let tr = this.closest('tr');
        tr.querySelectorAll('.value').forEach(span => span.style.display = '');
        tr.querySelectorAll('.edit-input').forEach(input => input.classList.add('hidden'));
        tr.querySelector('.edit-btn').classList.remove('hidden');
        tr.querySelector('.save-btn').classList.add('hidden');
        tr.querySelector('.delete-btn').classList.remove('hidden');
        this.classList.add('hidden');
    });
});

document.querySelectorAll('.save-btn').forEach(button => {
    button.addEventListener('click', function() {
        this.form.submit();
    });
});

function openModal() {
    document.getElementById('modalTambahData').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modalTambahData').classList.add('hidden');
}

document.querySelector('.bg-blue-500').addEventListener('click', function() {
    openModal();
});

function openModal() {
    document.getElementById('modalTambahData').classList.remove('hidden');
    // Clear previous form data
    document.getElementById('formTambah').reset();
}

function closeModal() {
    document.getElementById('modalTambahData').classList.add('hidden');
}

document.querySelector('.bg-blue-500').addEventListener('click', function() {
    openModal();
});

</script>


</body>
</html>