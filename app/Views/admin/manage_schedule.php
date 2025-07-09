<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Schedule Management - Fitzzone</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/home.css') ?>">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex overflow-hidden">
    <!-- Sidebar -->
    <aside class="w-64 sidebar-gym h-screen flex flex-col justify-between shadow-md flex-shrink-0">
        <div>
            <div class="p-6 text-3xl font-extrabold tracking-widest flex items-center gap-2 border-b border-gray-800">
                <i class="fas fa-dumbbell text-2xl text-red-500"></i> FITZONE
            </div>
            <nav class="mt-6 flex flex-col gap-1">
                <a href="/admin/dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                <a href="/admin/manage-admin"><i class="fas fa-user-cog"></i> Manage Admin</a>
                <a href="/admin/manage-merchandise"><i class="fas fa-box-open"></i> Manage Merchandise</a>
                <a href="/admin/manage-membership"><i class="fas fa-id-card"></i> Manage Membership</a>
                <a href="/admin/manage-trainer"><i class="fas fa-user-tie"></i> Manage Trainer</a>
                <a href="/admin/manage-class"><i class="fas fa-chalkboard-teacher"></i> Manage Class</a>
                <a href="/admin/manage-schedule" class="active"><i class="fas fa-calendar-alt"></i> Manage Schedule</a>
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
            <div class="text-xs text-gray-500 text-center mt-4">&copy; <?= date('Y') ?> Fitzzone Gym</div>
        </div>
    </aside>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <main class="p-8 flex-grow">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-calendar-alt text-red-500"></i> Schedule Management
                </h1>
                <button onclick="openAddScheduleModal()" class="btn-gym bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg flex items-center gap-2 transition-all duration-300">
                    <i class="fas fa-plus"></i> Add New Schedule
                </button>
            </div>
            <div class="card-gym rounded-xl shadow-lg border-l-8 border-red-500 overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <h2 class="text-xl font-bold text-white">Schedule List</h2>
                    <!-- Filter Form -->
                    <form method="get" class="flex flex-wrap gap-4 mt-4 items-end">
                        <div>
                            <label for="trainerID" class="block text-sm font-medium text-gray-300 mb-1">Trainer</label>
                            <select name="trainerID" id="trainerID" class="w-48 px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                                <option value="">All Trainers</option>
                                <?php if (!empty($trainers)): ?>
                                    <?php foreach ($trainers as $trainer): ?>
                                        <option value="<?= esc($trainer['trainerID']) ?>" <?= isset($filterTrainerID) && $filterTrainerID == $trainer['trainerID'] ? 'selected' : '' ?>><?= esc($trainer['name']) ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div>
                            <label for="classID" class="block text-sm font-medium text-gray-300 mb-1">Class</label>
                            <select name="classID" id="classID" class="w-48 px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                                <option value="">All Classes</option>
                                <?php if (!empty($classes)): ?>
                                    <?php foreach ($classes as $class): ?>
                                        <option value="<?= esc($class['classID']) ?>" <?= isset($filterClassID) && $filterClassID == $class['classID'] ? 'selected' : '' ?>><?= esc($class['class_name']) ?> (<?= esc($class['trainer_name']) ?>)</option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div>
                            <button type="submit" class="btn-gym bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-all duration-300 flex items-center gap-2">
                                <i class="fas fa-filter"></i> Filter
                            </button>
                            <?php if (!empty($filterTrainerID) || !empty($filterClassID)): ?>
                                <a href="<?= current_url() ?>" class="ml-2 text-sm text-gray-300 underline">Reset</a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-900 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Class Name</th>
                                <th class="px-6 py-4 text-left font-semibold">Trainer Name</th>
                                <th class="px-6 py-4 text-left font-semibold">Date</th>
                                <th class="px-6 py-4 text-left font-semibold">Start Time</th>
                                <th class="px-6 py-4 text-left font-semibold">End Time</th>
                                <th class="px-6 py-4 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (empty($schedules)): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-400">
                                    <i class="fas fa-calendar-alt text-4xl mb-4"></i>
                                    <p class="text-lg">No schedules found</p>
                                    <p class="text-sm">Add your first schedule to get started</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($schedules as $schedule): ?>
                                <tr class="hover:bg-gray-800 transition-colors">
                                    <td class="px-6 py-4 text-white"><?= esc($schedule['class_name']) ?></td>
                                    <td class="px-6 py-4 text-white"><?= esc($schedule['trainer_name']) ?></td>
                                    <td class="px-6 py-4 text-white"><?= esc($schedule['schedule_date']) ?></td>
                                    <td class="px-6 py-4 text-white"><?= esc($schedule['start_time']) ?></td>
                                    <td class="px-6 py-4 text-white"><?= esc($schedule['end_time']) ?></td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <button onclick="editSchedule(<?= esc($schedule['scheduleID']) ?>)" class="btn-action bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition-all duration-300">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </button>
                                            <button onclick="deleteSchedule(<?= esc($schedule['scheduleID']) ?>)" class="btn-action bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition-all duration-300">
                                                <i class="fas fa-trash mr-1"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <?php if (isset(
                    $pager) && $pager->getPageCount() > 1): ?>
                    <div class="p-6 border-t border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-400">
                                Showing <?= $pager->getFirstPage() ?> to <?= $pager->getLastPage() ?> of <?= $pager->getTotal() ?> schedules
                            </div>
                            <div class="flex items-center gap-2">
                                <?php if ($pager->getCurrentPage() > 1): ?>
                                    <a href="<?= current_url() ?>?page=<?= $pager->getCurrentPage() - 1 ?>" class="btn-gym bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm transition-all duration-300">
                                        <i class="fas fa-chevron-left mr-1"></i> Previous
                                    </a>
                                <?php endif; ?>
                                <div class="flex items-center gap-1">
                                    <?php for ($i = 1; $i <= $pager->getPageCount(); $i++): ?>
                                        <?php if ($i == $pager->getCurrentPage()): ?>
                                            <span class="bg-red-500 text-white px-3 py-2 rounded-lg text-sm font-medium">
                                                <?= $i ?>
                                            </span>
                                        <?php else: ?>
                                            <a href="<?= current_url() ?>?page=<?= $i ?>" class="bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm transition-all duration-300">
                                                <?= $i ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </div>
                                <?php if ($pager->getCurrentPage() < $pager->getPageCount()): ?>
                                    <a href="<?= current_url() ?>?page=<?= $pager->getCurrentPage() + 1 ?>" class="btn-gym bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm transition-all duration-300">
                                        Next <i class="fas fa-chevron-right ml-1"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>
    <!-- Add/Edit Schedule Modal -->
    <div id="scheduleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="card-gym rounded-xl shadow-lg w-full max-w-md mx-4">
            <div class="p-6 border-b border-gray-700">
                <h3 id="scheduleModalTitle" class="text-xl font-bold text-white">Add New Schedule</h3>
            </div>
            <div id="scheduleModalMessage"></div>
            <form id="scheduleForm" class="p-6">
                <input type="hidden" id="scheduleId" name="schedule_id">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Class</label>
                        <select id="classId" name="classID" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500" <?= empty($classes) ? 'disabled' : '' ?>>
                            <?php if (empty($classes)): ?>
                                <option value="">No classes available. Please add a class first.</option>
                            <?php else: ?>
                                <option value="">Select Class</option>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= esc($class['classID']) ?>">
                                        <?= esc($class['class_name']) ?> (<?= esc($class['trainer_name']) ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Date</label>
                        <input type="date" id="scheduleDate" name="schedule_date" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">Start Time</label>
                            <input type="time" id="startTime" name="start_time" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-2">End Time</label>
                            <input type="time" id="endTime" name="end_time" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                        </div>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="submit" id="saveScheduleBtn" class="btn-gym bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex-1 transition-all duration-300" <?= empty($classes) ? 'disabled' : '' ?>>
                        <i class="fas fa-save mr-2"></i> Save
                    </button>
                    <button type="button" onclick="closeScheduleModal()" class="btn-gym bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-all duration-300">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= base_url('assets/js/manage_schedule.js') ?>"></script>
</body>
</html> 