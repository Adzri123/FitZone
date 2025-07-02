window.addEventListener("DOMContentLoaded", function () {
    // Chart setup (unchanged)
    const ctx = document.getElementById('myChart');
    if (ctx) {
        const { userCount, merchCount, stockCount } = window.dashboardData;
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Users', 'Merchandise', 'Stock'],
                datasets: [{
                    label: 'Statistics',
                    data: [userCount, merchCount, stockCount],
                    backgroundColor: [
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(234, 179, 8, 0.7)',
                        'rgba(34, 197, 94, 0.7)'
                    ],
                    borderColor: [
                        'rgba(59, 130, 246, 1)',
                        'rgba(234, 179, 8, 1)',
                        'rgba(34, 197, 94, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    }

    // Dropdown toggle
    const profileBtn = document.getElementById('profileBtn');
    const dropdown = document.getElementById('profileDropdown');

    if (profileBtn && dropdown) {
        profileBtn.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });
    }
});

function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.href = "logout.php";
    }
}