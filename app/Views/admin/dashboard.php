<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fitzone Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- TailwindCSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/user.css') ?>">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-gray-100 h-screen flex flex-col">

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">🏋️ Admin Fitness Dashboard</a>
            <div class="d-flex">
                <span class="text-white me-3">Welcome, <?= session('role') ?></span>
                <a class="btn btn-outline-light btn-sm" href="<?= site_url('/logout') ?>">Logout</a>
            </div>
        </div>
    </nav>

    <!-- Sidebar + Content Wrapper -->
    <div class="flex flex-grow overflow-hidden">
        <!-- Sidebar -->
        <div class="w-64 bg-dark text-white flex-shrink-0 p-4 space-y-4">
            <a class="block py-2 px-4 hover:bg-secondary rounded" href="<?= site_url('admin/admin_manage') ?>">Manage Admin</a>
            <a class="block py-2 px-4 hover:bg-secondary rounded" href="<?= site_url('/admin_merchandise') ?>">Manage Merchandise</a>
            <a class="block py-2 px-4 hover:bg-secondary rounded" href="<?= site_url('/stock') ?>">Manage Stock</a>
        </div>

        <!-- Main Content -->
        <main class="flex-1 p-6 overflow-y-auto">
            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                <div class="bg-cyan-500 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">150</h2>
                        <p class="text-sm">Total Admin</p>
                    </div>
                    <i class="fas fa-user-shield text-3xl"></i>
                </div>

                <div class="bg-green-500 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">53%</h2>
                        <p class="text-sm">Total User</p>
                    </div>
                    <i class="fas fa-users text-3xl"></i>
                </div>

                <div class="bg-yellow-400 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">44</h2>
                        <p class="text-sm">Membership Subscription</p>
                    </div>
                    <i class="fas fa-id-card-alt text-3xl"></i>
                </div>

                <div class="bg-red-500 text-white p-6 rounded shadow flex items-center justify-between">
                    <div>
                        <h2 class="text-3xl font-bold">65</h2>
                        <p class="text-sm">Total Merchandise</p>
                    </div>
                    <i class="fas fa-dumbbell text-3xl"></i>
                </div>
            </div>

            <!-- Chart Section -->
            <h1 class="text-2xl font-bold mb-4 text-gray-800">Statistics Overview</h1>
            <div class="bg-white p-6 rounded shadow">
                <canvas id="myChart" width="400" height="200"></canvas>
            </div>
        </main>
    </div>

    <!-- Chart Script -->
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Admin', 'Users', 'Membership', 'Merchandise'],
                datasets: [{
                    label: 'Overview',
                    data: [150, 53, 44, 65],
                    backgroundColor: ['#06b6d4', '#22c55e', '#eab308', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Dashboard Statistics'
                    }
                }
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
