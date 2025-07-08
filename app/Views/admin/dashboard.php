<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fitzone Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="min-h-screen flex overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 sidebar-gym h-screen flex flex-col justify-between shadow-md flex-shrink-0">
        <div>
            <div class="p-6 text-3xl font-extrabold tracking-widest flex items-center gap-2 border-b border-gray-800">
                <i class="fas fa-dumbbell text-2xl text-red-500"></i> FITZONE
            </div>
            <nav class="mt-6 flex flex-col gap-1">
                <a href="/admin/dashboard" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="/admin/manage-admin"><i class="fas fa-user-cog"></i> Manage Admin</a>
                <a href="/admin/manage-merchandise"><i class="fas fa-box-open"></i> Manage Merchandise</a>
                <a href="/admin/manage-membership"><i class="fas fa-id-card"></i> Manage Membership</a>
                <a href="/admin/manage-trainer"><i class="fas fa-user-tie"></i> Manage Trainer</a>
                <a href="/admin/manage-class"><i class="fas fa-chalkboard-teacher"></i> Manage Class</a>
                <a href="/admin/manage-schedule"><i class="fas fa-calendar-alt"></i> Manage Schedule</a>
            </nav>
        </div>
        <div class="mb-6 px-6">
            <div class="relative">
                <button id="profileBtn" class="profile-btn-gym focus:outline-none flex items-center justify-between">
                    <span>Welcome, <?= esc(isset($adminName) ? $adminName : 'Admin') ?></span>
                    <i class="fas fa-chevron-down ml-2"></i>
                </button>
                <!-- Dropdown -->
                <div id="profileDropdown" class="dropdown-gym hidden absolute left-0 mt-2 w-44 shadow-lg rounded-lg z-10">
                    <a href="<?= site_url('/logout') ?>" class="block px-4 py-2 hover:bg-red-500 hover:text-white rounded-t-lg" onclick="return confirm('Are you sure you want to log out?')">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </a>
                </div>
            </div>
            <div class="text-xs text-gray-500 text-center mt-4">&copy; <?= date('Y') ?> Fitzone Gym</div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <main class="p-8 flex-grow">
            <h1 class="text-3xl font-extrabold text-white mb-8 flex items-center gap-2">
                <i class="fas fa-fire text-red-500"></i> Statistics Overview
            </h1>
            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-10">
                <div class="card-gym rounded-xl shadow flex items-center justify-between p-6">
                    <div>
                        <div class="value text-4xl font-extrabold"><?= esc($adminCount) ?></div>
                        <div class="label text-base mt-1">Total Admin</div>
                    </div>
                    <i class="fas fa-user-shield icon text-4xl"></i>
                </div>
                <div class="card-gym rounded-xl shadow flex items-center justify-between p-6">
                    <div>
                        <div class="value text-4xl font-extrabold"><?= esc($classCount) ?></div>
                        <div class="label text-base mt-1">Total Class</div>
                    </div>
                    <i class="fas fa-users icon text-4xl"></i>
                </div>
                <div class="card-gym rounded-xl shadow flex items-center justify-between p-6">
                    <div>
                        <div class="value text-4xl font-extrabold"><?= esc($membershipCount) ?></div>
                        <div class="label text-base mt-1">Membership Subscription</div>
                    </div>
                    <i class="fas fa-id-card-alt icon text-4xl"></i>
                </div>
                <div class="card-gym rounded-xl shadow flex items-center justify-between p-6">
                    <div>
                        <div class="value text-4xl font-extrabold"><?= esc($merchandiseCount) ?></div>
                        <div class="label text-base mt-1">Total Merchandise</div>
                    </div>
                    <i class="fas fa-dumbbell icon text-4xl"></i>
                </div>
            </div>
            <div class="flex flex-col md:flex-row justify-center gap-8">
                <div class="chart-container-gym p-8 rounded-xl shadow" style="max-width:500px; width:100%;">
                    <canvas id="planNameBarChart" width="500" height="400"></canvas>
                </div>
                <div class="chart-container-gym p-8 rounded-xl shadow" style="max-width:400px; width:100%;">
                    <canvas id="merchandisePieChart" width="400" height="400"></canvas>
                </div>
            </div>
        </main>
    </div>

    <!-- Pass PHP data to JS (example, replace with real data as needed) -->
    <script>
        window.planNameClassLimit = <?= json_encode($planNameClassLimit) ?>;
        window.merchandiseStockPie = <?= json_encode($merchandiseStockPie) ?>;
    </script>
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
    
</body>

</html>