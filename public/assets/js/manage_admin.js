// Modal logic
const adminModal = document.getElementById('adminModal');
const adminModalTitle = document.getElementById('adminModalTitle');
const adminForm = document.getElementById('adminForm');
const adminModalMessage = document.getElementById('adminModalMessage');
const adminIdInput = document.getElementById('adminId');
const adminNameInput = document.getElementById('adminName');
const adminEmailInput = document.getElementById('adminEmail');
const adminPhoneInput = document.getElementById('adminPhone');
const adminPasswordInput = document.getElementById('adminPassword');

function openAddAdminModal() {
    adminModalTitle.textContent = 'Add New Admin';
    adminForm.reset();
    adminIdInput.value = '';
    adminModalMessage.innerHTML = '';
    adminModal.classList.remove('hidden');
}

function closeAdminModal() {
    adminModal.classList.add('hidden');
    adminModalMessage.innerHTML = '';
}

function editAdmin(adminId) {
    const row = document.querySelector(`tr[data-admin-id='${adminId}']`);
    if (!row) return;
    adminModalTitle.textContent = 'Edit Admin';
    adminIdInput.value = adminId;
    adminNameInput.value = row.querySelector('[data-field="name"]').textContent.trim();
    adminEmailInput.value = row.querySelector('[data-field="email"]').textContent.trim();
    adminPhoneInput.value = row.querySelector('[data-field="phone"]').textContent.trim();
    adminPasswordInput.value = '';
    adminModalMessage.innerHTML = '';
    adminModal.classList.remove('hidden');
}

adminForm.onsubmit = function(e) {
    e.preventDefault();
    adminModalMessage.innerHTML = '';
    const isEdit = !!adminIdInput.value;
    const url = isEdit ? '/admin/update-admin' : '/admin/create-admin';
    const formData = new FormData(adminForm);
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            adminModalMessage.innerHTML = `<div class='text-green-500 mb-2'>${data.message}</div>`;
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
            adminModalMessage.innerHTML = msg;
        }
    })
    .catch(() => {
        adminModalMessage.innerHTML = `<div class='text-red-500 mb-2'>An error occurred.</div>`;
    });
};

function deleteAdmin(adminId) {
    if (!confirm('Are you sure you want to delete this admin?')) return;
    fetch('/admin/delete-admin', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ admin_id: adminId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert(data.message || 'Failed to delete admin.');
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