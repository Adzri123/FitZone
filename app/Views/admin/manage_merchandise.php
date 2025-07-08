<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Merchandise - Fitzone</title>
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
                <a href="/admin/manage-merchandise" class="active"><i class="fas fa-box-open"></i> Manage Merchandise</a>
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
            <div class="text-xs text-gray-500 text-center mt-4">&copy; <?= date('Y') ?> Fitzzone Gym</div>
        </div>
    </aside>
    <!-- Main Content -->
    <div class="flex-1 flex flex-col">
        <main class="p-8 flex-grow">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-extrabold text-white flex items-center gap-2">
                    <i class="fas fa-box-open text-red-500"></i> Merchandise Management
                </h1>
                <button onclick="openAddMerchandiseModal()" class="btn-gym bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-lg flex items-center gap-2 transition-all duration-300">
                    <i class="fas fa-plus"></i> Add New Merchandise
                </button>
            </div>
            <!-- Merchandise Table -->
            <div class="card-gym rounded-xl shadow overflow-hidden">
                <div class="p-6 border-b border-gray-700">
                    <h2 class="text-xl font-bold text-white">Merchandise List</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Name</th>
                                <th class="px-6 py-4 text-left font-semibold">Category</th>
                                <th class="px-6 py-4 text-left font-semibold">Price</th>
                                <th class="px-6 py-4 text-left font-semibold">Stock</th>
                                <th class="px-6 py-4 text-left font-semibold">Point Cost</th>
                                <th class="px-6 py-4 text-left font-semibold">Redeemable?</th>
                                <th class="px-6 py-4 text-left font-semibold">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($merchandise) && is_array($merchandise) && count($merchandise) > 0): ?>
                            <?php foreach ($merchandise as $item): ?>
                                <tr class="hover:bg-gray-800 transition-colors" data-merchandise-id="<?= esc($item['merchandiseID']) ?>">
                                    <td class="px-6 py-4 text-white" data-field="name"><?= esc($item['name']) ?></td>
                                    <td class="px-6 py-4 text-gray-300" data-field="category"><?= esc($item['category']) ?></td>
                                    <td class="px-6 py-4 text-gray-300" data-field="price">RM<?= esc(number_format($item['price'], 2)) ?></td>
                                    <td class="px-6 py-4 text-gray-300" data-field="stock_quantity"><?= esc($item['stock_quantity']) ?></td>
                                    <td class="px-6 py-4 text-gray-300" data-field="point_cost"><?= esc($item['point_cost']) ?></td>
                                    <td class="px-6 py-4 text-gray-300" data-field="is_redeemable">
                                        <?= isset($item['is_redeemable']) && $item['is_redeemable'] ? 'Yes' : 'No' ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <button onclick="editMerchandise(<?= esc($item['merchandiseID']) ?>)" class="btn-action bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-sm transition-all duration-300">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </button>
                                            <button onclick="deleteMerchandise(<?= esc($item['merchandiseID']) ?>)" class="btn-action bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition-all duration-300">
                                                <i class="fas fa-trash mr-1"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="px-6 py-8 text-center text-gray-400">
                                    <i class="fas fa-box-open text-4xl mb-4"></i>
                                    <p class="text-lg">No merchandise found</p>
                                    <p class="text-sm">Add your first merchandise to get started</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
                    <div class="p-6 border-t border-gray-700">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-400">
                                Showing <?= $pager->getFirstPage() ?> to <?= $pager->getLastPage() ?> of <?= $pager->getTotal() ?> merchandise
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
                                            <a href="<?= current_url() ?>?page=<?= $i ?>" class="btn-gym bg-gray-600 hover:bg-gray-700 text-white px-3 py-2 rounded-lg text-sm transition-all duration-300">
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
    <!-- Add/Edit Merchandise Modal -->
    <div id="merchandiseModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
        <div class="card-gym rounded-xl shadow-lg w-full max-w-md mx-4">
            <div class="p-6 border-b border-gray-700">
                <h3 id="merchandiseModalTitle" class="text-xl font-bold text-white">Add New Merchandise</h3>
            </div>
            <div id="merchandiseModalMessage"></div>
            <form id="merchandiseForm" class="p-6">
                <input type="hidden" id="merchandiseId" name="merchandise_id">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Name</label>
                        <input type="text" id="merchandiseName" name="name" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Category</label>
                        <input type="text" id="merchandiseCategory" name="category" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Price</label>
                        <input type="number" step="0.01" id="merchandisePrice" name="price" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Stock</label>
                        <input type="number" id="merchandiseStock" name="stock_quantity" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Point Cost</label>
                        <input type="number" id="merchandisePointCost" name="point_cost" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-2">Is Redeemable?</label>
                        <select id="merchandiseIsRedeemable" name="is_redeemable" required class="w-full px-3 py-2 bg-gray-800 border border-gray-600 rounded-lg text-white focus:outline-none focus:border-red-500">
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                </div>
                <div class="flex gap-3 mt-6">
                    <button type="submit" class="btn-gym bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg flex-1 transition-all duration-300">
                        <i class="fas fa-save mr-2"></i> Save
                    </button>
                    <button type="button" onclick="closeMerchandiseModal()" class="btn-gym bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-all duration-300">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="<?= base_url('assets/js/manage_merchandise.js') ?>"></script>
</body>
</html> 