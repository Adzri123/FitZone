window.addEventListener("DOMContentLoaded", function () {
    // Bar chart for planName vs classLimit
    const ctx = document.getElementById('planNameBarChart');
    if (ctx) {
        const planNameClassLimit = window.planNameClassLimit || {};
        const labels = Object.keys(planNameClassLimit);
        const data = Object.values(planNameClassLimit);
        const backgroundColors = [
            'rgba(59, 130, 246, 0.7)',
            'rgba(234, 179, 8, 0.7)',
            'rgba(34, 197, 94, 0.7)',
            'rgba(239, 68, 68, 0.7)',
            'rgba(168, 85, 247, 0.7)',
            'rgba(16, 185, 129, 0.7)',
            'rgba(251, 191, 36, 0.7)'
        ];
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Class Limit',
                    data: data,
                    backgroundColor: backgroundColors.slice(0, labels.length),
                    borderColor: 'rgba(31, 41, 55, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Plan Name',
                            font: { weight: 'bold', size: 16 }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Class Limit',
                            font: { weight: 'bold', size: 16 }
                        }
                    }
                }
            }
        });
    }

    // Pie chart for merchandise stock
    const pieCtx = document.getElementById('merchandisePieChart');
    if (pieCtx) {
        const merchandiseStockPie = window.merchandiseStockPie || {};
        const pieLabels = Object.keys(merchandiseStockPie);
        const pieData = Object.values(merchandiseStockPie);
        const pieColors = [
            'rgba(59, 130, 246, 0.7)',
            'rgba(234, 179, 8, 0.7)',
            'rgba(34, 197, 94, 0.7)',
            'rgba(239, 68, 68, 0.7)',
            'rgba(168, 85, 247, 0.7)',
            'rgba(16, 185, 129, 0.7)',
            'rgba(251, 191, 36, 0.7)',
            'rgba(244, 63, 94, 0.7)',
            'rgba(52, 211, 153, 0.7)',
            'rgba(139, 92, 246, 0.7)'
        ];
        new Chart(pieCtx, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    label: 'Stock',
                    data: pieData,
                    backgroundColor: pieColors.slice(0, pieLabels.length),
                    borderColor: 'rgba(31, 41, 55, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
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