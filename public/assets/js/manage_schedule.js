// Manage Schedule JS
let scheduleModal = document.getElementById('scheduleModal');
let scheduleModalTitle = document.getElementById('scheduleModalTitle');
let scheduleForm = document.getElementById('scheduleForm');
let scheduleIdInput = document.getElementById('scheduleId');
let classIdInput = document.getElementById('classId');
let scheduleDateInput = document.getElementById('scheduleDate');
let startTimeInput = document.getElementById('startTime');
let endTimeInput = document.getElementById('endTime');
let scheduleModalMessage = document.getElementById('scheduleModalMessage');

function openAddScheduleModal() {
    scheduleModalTitle.textContent = 'Add New Schedule';
    scheduleForm.reset();
    scheduleIdInput.value = '';
    scheduleModalMessage.innerHTML = '';
    scheduleModal.classList.remove('hidden');
}

function closeScheduleModal() {
    scheduleModal.classList.add('hidden');
    scheduleModalMessage.innerHTML = '';
}

function editSchedule(scheduleId) {
    fetch(`/admin/get-schedule?schedule_id=${scheduleId}`)
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const schedule = data.data;
                scheduleModalTitle.textContent = 'Edit Schedule';
                scheduleIdInput.value = scheduleId;
                classIdInput.value = schedule.classID;
                scheduleDateInput.value = schedule.schedule_date;
                startTimeInput.value = schedule.start_time;
                endTimeInput.value = schedule.end_time;
                scheduleModalMessage.innerHTML = '';
                scheduleModal.classList.remove('hidden');
            } else {
                alert(data.message || 'Failed to load schedule data.');
            }
        })
        .catch(() => {
            alert('An error occurred while loading schedule data.');
        });
}

function deleteSchedule(scheduleId) {
    if (!confirm('Are you sure you want to delete this schedule?')) return;
    fetch('/admin/delete-schedule', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ schedule_id: scheduleId })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Failed to delete schedule.');
        }
    })
    .catch(() => {
        alert('An error occurred while deleting schedule.');
    });
}

scheduleForm.onsubmit = function(e) {
    e.preventDefault();
    let errors = [];
    if (!classIdInput.value) errors.push('Please select a class.');
    if (!scheduleDateInput.value) errors.push('Please select a date.');
    if (!startTimeInput.value) errors.push('Please enter a start time.');
    if (!endTimeInput.value) errors.push('Please enter an end time.');
    if (errors.length > 0) {
        scheduleModalMessage.innerHTML = '<div class="text-red-500 mb-2">' + errors.join('<br>') + '</div>';
        return false;
    }
    scheduleModalMessage.innerHTML = '';
    const isEdit = !!scheduleIdInput.value;
    const url = isEdit ? '/admin/update-schedule' : '/admin/create-schedule';
    const formData = new FormData(scheduleForm);
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            scheduleModalMessage.innerHTML = `<div class='text-red-500 mb-2'>${data.message}</div>`;
        }
    })
    .catch(() => {
        scheduleModalMessage.innerHTML = `<div class='text-red-500 mb-2'>An error occurred.`;
    });
};

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