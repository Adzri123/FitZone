// Modal logic
const merchandiseModal = document.getElementById('merchandiseModal');
const merchandiseModalTitle = document.getElementById('merchandiseModalTitle');
const merchandiseForm = document.getElementById('merchandiseForm');
const merchandiseModalMessage = document.getElementById('merchandiseModalMessage');
const merchandiseIdInput = document.getElementById('merchandiseId');
const merchandiseNameInput = document.getElementById('merchandiseName');
const merchandisePriceInput = document.getElementById('merchandisePrice');
const merchandiseStockInput = document.getElementById('merchandiseStock');
const merchandiseCategoryInput = document.getElementById('merchandiseCategory');
const merchandisePointCostInput = document.getElementById('merchandisePointCost');
const merchandiseIsRedeemableInput = document.getElementById('merchandiseIsRedeemable');

function openAddMerchandiseModal() {
    merchandiseModalTitle.textContent = 'Add New Merchandise';
    merchandiseForm.reset();
    merchandiseIdInput.value = '';
    merchandiseModalMessage.innerHTML = '';
    merchandiseModal.classList.remove('hidden');
}

function closeMerchandiseModal() {
    merchandiseModal.classList.add('hidden');
    merchandiseModalMessage.innerHTML = '';
}

function editMerchandise(id) {
    const row = document.querySelector(`tr[data-merchandise-id='${id}']`);
    if (!row) return;
    merchandiseModalTitle.textContent = 'Edit Merchandise';
    merchandiseIdInput.value = id;
    merchandiseNameInput.value = row.querySelector('[data-field="name"]').textContent.trim();
    merchandiseCategoryInput.value = row.querySelector('[data-field="category"]').textContent.trim();
    merchandisePriceInput.value = row.querySelector('[data-field="price"]').textContent.replace('$','').trim();
    merchandiseStockInput.value = row.querySelector('[data-field="stock_quantity"]').textContent.trim();
    merchandisePointCostInput.value = row.querySelector('[data-field="point_cost"]').textContent.trim();
    const isRedeemableText = row.querySelector('[data-field="is_redeemable"]').textContent.trim();
    merchandiseIsRedeemableInput.value = (isRedeemableText === 'Yes') ? '1' : '0';
    merchandiseModalMessage.innerHTML = '';
    merchandiseModal.classList.remove('hidden');
}

merchandiseForm.onsubmit = function(e) {
    e.preventDefault();
    merchandiseModalMessage.innerHTML = '';
    const isEdit = !!merchandiseIdInput.value;
    const url = isEdit ? '/admin/update-merchandise' : '/admin/create-merchandise';
    const formData = new FormData(merchandiseForm);
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            merchandiseModalMessage.innerHTML = `<div class='text-green-500 mb-2'>${data.message}</div>`;
            setTimeout(() => { window.location.reload(); }, 800);
        } else {
            let msg = `<div class='text-red-500 mb-2'>${data.message}</div>`;
            if (data.errors) {
                msg += '<ul class="text-red-400 text-sm pl-4">';
                for (const key in data.errors) {
                    msg += `<li>${data.errors[key]}</li>`;
                }
                msg += '</ul>';
            }
            merchandiseModalMessage.innerHTML = msg;
        }
    })
    .catch(() => {
        merchandiseModalMessage.innerHTML = `<div class='text-red-500 mb-2'>An error occurred.`;
    });
};

function deleteMerchandise(id) {
    if (!confirm('Are you sure you want to delete this merchandise?')) return;
    fetch('/admin/delete-merchandise', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ merchandise_id: id })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert(data.message || 'Failed to delete merchandise.');
        }
    })
    .catch(() => {
        alert('An error occurred.');
    });
}

// Profile dropdown logic
const profileBtn = document.getElementById('profileBtn');
const profileDropdown = document.getElementById('profileDropdown');
if (profileBtn && profileDropdown) {
    profileBtn.addEventListener('click', () => {
        profileDropdown.classList.toggle('hidden');
    });
    document.addEventListener('click', (e) => {
        if (!profileBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
            profileDropdown.classList.add('hidden');
        }
    });
} 