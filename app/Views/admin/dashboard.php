<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fitzone Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Chart.js CDN MUST come before your JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-full flex-shrink-0">
        <div class="p-4 text-2xl font-bold border-b border-gray-200">FITZONE</div>
        <nav class="mt-4">
            <a href="dashboard.php" class="block py-2.5 px-4 bg-gray-100 font-semibold">Dashboard</a>
            <a href="manage_admin.php" class="block py-2.5 px-4 hover:bg-gray-100">Manage Admin</a>
            <a href="#" class="block py-2.5 px-4 hover:bg-gray-100">Manage Merchandise</a>
            <a href="#" class="block py-2.5 px-4 hover:bg-gray-100">Manage Stock</a>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <!-- Navbar -->
        <header class="bg-white shadow p-4 flex justify-between items-center">
            <div class="text-lg font-semibold">Dashboard</div>
            <div class="relative">
                <button id="profileBtn" class="flex items-center space-x-2 focus:outline-none">
                    <img src="https://via.placeholder.com/32" alt="Profile" class="rounded-full w-8 h-8">
                    <span>Admin</span>
                </button>
                <!-- Dropdown -->
                <div id="profileDropdown" class="hidden absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg z-10">
                    <a href="index.php" onclick="confirmLogout()" class="block px-4 py-2 hover:bg-gray-100">Logout</a>
                </div>
            </div>
        </header>

        <!-- Dashboard Chart -->
        <main class="p-6 flex-grow">
            <h1 class="text-2xl font-bold mb-4">Statistics Overview</h1>
            <div class="bg-white p-6 rounded shadow">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </main>
    </div>

    <!-- JS at bottom -->
    <script src="js/dashboard.js"></script>
</body>

</html>