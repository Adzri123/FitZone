<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Manage Admins - Fitzone</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-full flex-shrink-0">
        <div class="p-4 text-2xl font-bold border-b border-gray-200">
            FITZONE
        </div>
        <nav class="mt-4">
            <a href="/dashboard/admin" class="block py-2.5 px-4 hover:bg-gray-100">Dashboard</a>
            <a href="/admin/manage-admin" class="block py-2.5 px-4 bg-gray-100 font-semibold">Manage Admin</a>
            <a href="#" class="block py-2.5 px-4 hover:bg-gray-100">Manage Merchandise</a>
            <a href="#" class="block py-2.5 px-4 hover:bg-gray-100">Manage Stock</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Navbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="text-lg font-semibold">Manage Admin</div>
            <div class="relative">
                <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none">
                    <img src="https://via.placeholder.com/32" alt="Profile" class="rounded-full w-8 h-8">
                    <span>Admin</span>
                </button>
                <!-- Dropdown -->
                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-40 bg-white shadow rounded">
                    <a href="#" onclick="confirmLogout()" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </header>

        <!-- Admin Table Section -->
        <main class="p-6 flex-grow">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold">Admin Management</h1>
                <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"> Add Admin</a>
            </div>

            <div class="bg-white rounded shadow overflow-x-auto">
                <table class="min-w-full table-auto text-sm">
                    <thead class="bg-gray-200 text-left">
                        <tr>
                            <th class="px-6 py-3">Name</th>
                            <th class="px-6 py-3">Email</th>
                            <th class="px-6 py-3">Password</th>
                            <th class="px-6 py-3">Phone</th>
                            <th class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php foreach ($admins as $admin): ?>
                            <tr>
                                <td class="px-6 py-4"><?= esc($admin['name']) ?></td>
                                <td class="px-6 py-4"><?= esc($admin['email']) ?></td>
                                <td class="px-6 py-4"><?= esc($admin['password']) ?></td> <!-- Show actual password -->
                                <td class="px-6 py-4"><?= esc($admin['phone']) ?></td>
                                <td class="px-6 py-4">
                                    <a href="#" class="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-1 rounded"> Edit Admin</a>
                                    <a href="#" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded"> Delete Admin</a>
                                    
                                    
                                </td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                <div class="flex justify-between items-center mb-4">

                                    <span class="text-sm text-gray-600">Total Admins: <?= esc($adminCount) ?></span>

                                </div>
                            </td>
                        </tr>

                    </tbody>

                </table>
            </div>
        </main>
    </div>

    <!-- External JS -->
    <script src="<?= base_url('assets/js/manage_admin.js') ?>"></script>
</body>

</html>