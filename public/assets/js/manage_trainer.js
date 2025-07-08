// Modal logic
const trainerModal = document.getElementById('trainerModal');
const trainerModalTitle = document.getElementById('trainerModalTitle');
const trainerForm = document.getElementById('trainerForm');
const trainerModalMessage = document.getElementById('trainerModalMessage');
const trainerIdInput = document.getElementById('trainerId');
const trainerNameInput = document.getElementById('trainerName');
const trainerSpecialtyInput = document.getElementById('trainerSpecialty');
const trainerEmailInput = document.getElementById('trainerEmail');
const trainerPhoneInput = document.getElementById('trainerPhone');
const trainerStatusInput = document.getElementById('trainerStatus');

function openAddTrainerModal() {
    trainerModalTitle.textContent = 'Add New Trainer';
    trainerForm.reset();
    trainerIdInput.value = '';
    trainerModalMessage.innerHTML = '';
    trainerModal.classList.remove('hidden');
}

function closeTrainerModal() {
    trainerModal.classList.add('hidden');
    trainerModalMessage.innerHTML = '';
}

function editTrainer(trainerId) {
    const row = document.querySelector(`tr[data-trainer-id='${trainerId}']`);
    if (!row) return;
    trainerModalTitle.textContent = 'Edit Trainer';
    trainerIdInput.value = trainerId;
    trainerNameInput.value = row.querySelector('[data-field="name"]').textContent.trim();
    trainerSpecialtyInput.value = row.querySelector('[data-field="specialty"]').textContent.trim();
    trainerEmailInput.value = row.querySelector('[data-field="email"]').textContent.trim();
    trainerPhoneInput.value = row.querySelector('[data-field="phone"]').textContent.trim();
    trainerStatusInput.value = row.querySelector('[data-field="status"]').textContent.trim();
    trainerModalMessage.innerHTML = '';
    trainerModal.classList.remove('hidden');
}

trainerForm.onsubmit = function(e) {
    e.preventDefault();
    trainerModalMessage.innerHTML = '';
    const isEdit = !!trainerIdInput.value;
    const url = isEdit ? '/admin/update-trainer' : '/admin/create-trainer';
    const formData = new FormData(trainerForm);
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            trainerModalMessage.innerHTML = `<div class='text-green-500 mb-2'>${data.message}</div>`;
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
            trainerModalMessage.innerHTML = msg;
        }
    })
    .catch(() => {
        trainerModalMessage.innerHTML = `<div class='text-red-500 mb-2'>An error occurred.</div>`;
    });
};

function deleteTrainer(trainerId) {
    if (!confirm('Are you sure you want to delete this trainer?')) return;
    fetch('/admin/delete-trainer', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ trainer_id: trainerId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert(data.message || 'Failed to delete trainer.');
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