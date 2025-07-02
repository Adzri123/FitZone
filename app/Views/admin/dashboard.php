<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fitzone Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Chart.js CDN MUST come before your JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 h-screen flex overflow-hidden">

    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md h-full flex-shrink-0">
        <div class="p-4 text-2xl font-bold border-b border-gray-200">FITZONE</div>
        <nav class="mt-4">
            <a href="/dashboard/admin" class="block py-2.5 px-4 bg-gray-100 font-semibold">Dashboard</a>
            <a href="/admin/manage-admin" class="block py-2.5 px-4 hover:bg-gray-100">Manage Admin</a>
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
            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-cyan-500 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">150</h2>
                        <p class="text-sm">Total Admin</p>
                    </div>
                    <i class="fas fa-shopping-cart text-3xl"></i>
                </div>

                <div class="bg-green-500 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">53%</h2>
                        <p class="text-sm">Total User</p>
                    </div>
                    <i class="fas fa-chart-bar text-3xl"></i>
                </div>

                <div class="bg-yellow-400 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">44</h2>
                        <p class="text-sm">Membership Subscription</p>
                    </div>
                    <i class="fas fa-user-plus text-3xl"></i>
                </div>

                <div class="bg-red-500 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">65</h2>
                        <p class="text-sm">Total Merchandise</p>
                    </div>
                    <i class="fas fa-chart-pie text-3xl"></i>
                </div>
            </div>

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