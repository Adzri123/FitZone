// Modal logic
const classModal = document.getElementById('classModal');
const classModalTitle = document.getElementById('classModalTitle');
const classForm = document.getElementById('classForm');
const classModalMessage = document.getElementById('classModalMessage');
const classIdInput = document.getElementById('classId');
const classNameInput = document.getElementById('className');
const trainerIdInput = document.getElementById('trainerId');

function openAddClassModal() {
    classModalTitle.textContent = 'Add New Class';
    classForm.reset();
    classIdInput.value = '';
    classModalMessage.innerHTML = '';
    classModal.classList.remove('hidden');
}

function closeClassModal() {
    classModal.classList.add('hidden');
    classModalMessage.innerHTML = '';
}

function editClass(classId) {
    // Fetch class data from server
    fetch(`/admin/get-class?class_id=${classId}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const classData = data.data;
                classModalTitle.textContent = 'Edit Class';
                classIdInput.value = classId;
                classNameInput.value = classData.class_name;
                trainerIdInput.value = classData.trainerID;
                classModalMessage.innerHTML = '';
                classModal.classList.remove('hidden');
            } else {
                alert(data.message || 'Failed to load class data.');
            }
        })
        .catch(() => {
            alert('An error occurred while loading class data.');
        });
}

classForm.onsubmit = function(e) {
    e.preventDefault();
    classModalMessage.innerHTML = '';
    const isEdit = !!classIdInput.value;
    const url = isEdit ? '/admin/update-class' : '/admin/create-class';
    const formData = new FormData(classForm);
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            classModalMessage.innerHTML = `<div class='text-green-500 mb-2'>${data.message}</div>`;
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
            classModalMessage.innerHTML = msg;
        }
    })
    .catch(() => {
        classModalMessage.innerHTML = `<div class='text-red-500 mb-2'>An error occurred.</div>`;
    });
};

function deleteClass(classId) {
    if (!confirm('Are you sure you want to delete this class?')) return;
    fetch('/admin/delete-class', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ class_id: classId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            window.location.reload();
        } else {
            alert(data.message || 'Failed to delete class.');
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