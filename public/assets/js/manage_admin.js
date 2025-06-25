// Dropdown toggle
document.getElementById('profileBtn').addEventListener('click', () => {
    const dropdown = document.getElementById('profileDropdown');
    dropdown.classList.toggle('hidden');
});

// Logout confirmation
function confirmLogout() {
    if (confirm("Are you sure you want to logout?")) {
        window.location.href = "logout.php";
    }
}

// Placeholder Edit
function editAdmin() {
    alert("Edit admin clicked. You can link this to an edit form.");
}

// Placeholder Delete
function deleteAdmin() {
    if (confirm("Are you sure you want to delete this admin?")) {
        alert("Admin deleted. (Simulated — real DB delete will come later.)");
    }
}
