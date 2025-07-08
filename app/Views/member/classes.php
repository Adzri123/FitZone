<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Fitness Classes</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background: #18181b;
      color: #fff;
      font-family: 'Segoe UI', 'Montserrat', 'Poppins', sans-serif;
      margin: 0;
      min-height: 100vh;
      overflow-x: hidden;
    }

    .navbar {
      background: #18181b !important;
      border-bottom: 2px solid #751111;
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.08);
    }

    .navbar-brand {
      color: #ef4444 !important;
      font-weight: bold;
      font-size: 1.5rem;
      letter-spacing: 2px;
    }

    .navbar .btn-outline-light {
      border-color: #ef4444;
      color: #ef4444;
      transition: background 0.2s, color 0.2s;
    }
    .navbar .btn-outline-light:hover {
      background: #ef4444;
      color: #fff;
    }

    .sidebar {
      background: #751111;
      color: #fff;
      width: 250px;
      height: 100vh;
      position: fixed;
      top: 56px;
      left: 0;
      padding-top: 20px;
      box-shadow: 2px 0 10px rgba(239, 68, 68, 0.08);
    }

    .sidebar a {
      color: #fff;
      padding: 15px 20px;
      display: block;
      text-decoration: none;
      border-left: 4px solid transparent;
      font-weight: 500;
      border-radius: 0.5rem;
      margin-bottom: 8px;
      transition: background 0.2s, border-left 0.2s, color 0.2s;
    }
    .sidebar a.active,
    .sidebar a:hover {
      background: #ef4444;
      border-left: 4px solid #fff;
      color: #fff;
      box-shadow: 0 2px 8px 0 rgba(239, 68, 68, 0.15);
    }

    .content {
      margin-left: 250px;
      margin-top: 70px;
      padding: 30px 20px;
      background: #18181b;
      min-height: 100vh;
    }

    .card {
      background: #232326;
      color: #fff;
      border: none;
      border-radius: 15px;
      box-shadow: 0 5px 15px rgba(239, 68, 68, 0.08);
      transition: transform 0.3s ease;
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 10px 25px rgba(239, 68, 68, 0.15);
    }
    .class-card {
      height: 100%;
      position: relative;
    }
    .class-type-badge {
      position: absolute;
      top: 15px;
      right: 15px;
      padding: 5px 15px;
      border-radius: 20px;
      font-size: 0.8em;
      font-weight: bold;
      color: white;
    }
    .class-type-yoga { background: linear-gradient(135deg, #ef4444 0%, #751111 100%); }
    .class-type-cardio { background: linear-gradient(135deg, #f59e42 0%, #ef4444 100%); }
    .class-type-strength { background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%); }
    .class-type-pilates { background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); }
    .class-type-spinning { background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); }
    .class-type-zumba { background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); }
    .class-type-boxing { background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); }
    .class-type-other { background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); }
    
    .schedule-item {
      border-left: 4px solid #22c55e;
      background-color: #232326;
      margin-bottom: 10px;
      padding: 15px;
      border-radius: 8px;
      transition: all 0.3s ease;
      border: 1px solid #333;
    }
    .schedule-item:hover {
      transform: translateX(5px);
      box-shadow: 0 3px 10px rgba(239, 68, 68, 0.15);
    }
    .schedule-item.booked {
      border-left-color: #ef4444;
      background-color: #751111;
    }
    .schedule-item.full {
      border-left-color: #dc3545;
      background-color: #333;
      opacity: 0.7;
    }
    .filter-buttons {
      margin-bottom: 20px;
    }
    .filter-buttons .btn {
      margin-right: 10px;
      margin-bottom: 10px;
    }
    
    /* Calendar Styles */
    .calendar-grid {
      border: 1px solid #333;
      border-radius: 8px;
      overflow: hidden;
    }
    
    .calendar-header {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      background: linear-gradient(135deg, #751111 0%, #ef4444 100%);
      color: white;
    }
    
    .calendar-day-header {
      padding: 10px;
      text-align: center;
      font-weight: bold;
      font-size: 0.9em;
    }
    
    .calendar-body {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
    }
    
    .calendar-day {
      min-height: 80px;
      border: 1px solid #333;
      padding: 5px;
      position: relative;
      background: #232326;
      transition: all 0.3s ease;
    }
    
    .calendar-day:hover {
      background-color: #333;
    }
    
    .calendar-day.empty {
      background-color: #18181b;
    }
    
    .calendar-day.has-schedule {
      background: linear-gradient(135deg, #751111 0%, #232326 100%);
    }
    
    .calendar-day.has-schedule:hover {
      background: linear-gradient(135deg, #ef4444 0%, #751111 100%);
      cursor: pointer;
    }
    
    .day-number {
      font-weight: bold;
      font-size: 0.9em;
      color: #fff;
      margin-bottom: 5px;
    }
    
    .schedule-slot {
      background: linear-gradient(135deg, #ef4444 0%, #751111 100%);
      color: white;
      padding: 2px 4px;
      border-radius: 4px;
      font-size: 0.7em;
      margin-bottom: 2px;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    
    .schedule-slot:hover {
      background: linear-gradient(135deg, #751111 0%, #ef4444 100%);
      transform: scale(1.05);
    }
    
    .schedule-slot.booked {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
      color: white;
      cursor: default;
    }
    
    .schedule-slot.booked:hover {
      background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
      transform: none;
    }
    
    .schedule-slot.full {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      color: white;
      cursor: not-allowed;
      opacity: 0.7;
    }
    
    .schedule-slot.full:hover {
      background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
      transform: none;
    }
    
    .btn-primary, .btn-danger, .btn-success, .btn-warning {
      border: none;
      border-radius: 8px;
      font-weight: 600;
      padding: 8px 18px;
      transition: background 0.2s, color 0.2s;
    }
    
    .btn-primary {
      background: #ef4444;
      color: #fff;
    }
    .btn-primary:hover {
      background: #751111;
      color: #fff;
    }
    
    .btn-danger {
      background: #751111;
      color: #fff;
    }
    .btn-danger:hover {
      background: #ef4444;
      color: #fff;
    }
    
    .btn-success {
      background: #22c55e;
      color: #fff;
    }
    .btn-warning {
      background: #f59e42;
      color: #fff;
    }
    
    .alert-success {
      background: #22c55e;
      color: #fff;
      border: none;
    }
    .alert-danger {
      background: #ef4444;
      color: #fff;
      border: none;
    }

    .text-success {
      color: #22c55e !important;
    }
    .text-muted {
      color: #fff !important;
    }
    .text-primary {
      color: #ef4444 !important;
    }
    
    /* Modal Styles - Grey Theme */
    .modal-content {
      background: #6b7280;
      color: #fff;
      border: none;
      border-radius: 15px;
    }
    
    .modal-header {
      background: #4b5563;
      color: #fff;
      border-bottom: 1px solid #374151;
      border-radius: 15px 15px 0 0;
    }
    
    .modal-body {
      background: #6b7280;
      color: #fff;
    }
    
    .modal-footer {
      background: #4b5563;
      border-top: 1px solid #374151;
      border-radius: 0 0 15px 15px;
    }
    
    .modal .btn-close {
      filter: invert(1);
    }
    
    .modal .btn-secondary {
      background: #9ca3af;
      border: none;
      color: #1f2937;
    }
    
    .modal .btn-secondary:hover {
      background: #6b7280;
      color: #fff;
    }
    
    @media (max-width: 991px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: static;
        box-shadow: none;
    }
      .content {
        margin-left: 0;
        margin-top: 100px;
        padding: 10px;
      }
    }
  </style>
</head>
<body>

<!-- Top Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand" href="#"><i class="fas fa-dumbbell"></i> FITZONE</a>
    <div class="d-flex align-items-center">
      <span class="text-white me-3"><i class="fas fa-user"></i> Welcome, <?= session('name') ?? session('email') ?></span>
      <span class="text-info me-3"><i class="fas fa-coins"></i> <?= session('balancePoint') ?? 0 ?> pts</span>
      <a class="btn btn-outline-light btn-sm" href="<?= site_url('/logout') ?>"><i class="fas fa-sign-out-alt"></i> Logout</a>
    </div>
  </div>
</nav>

<!-- Sidebar -->
<div class="sidebar">
  <a href="<?= site_url('/dashboard/member') ?>"><i class="fas fa-home"></i> Dashboard</a>
  <a href="<?= site_url('/shop') ?>"><i class="fas fa-shopping-cart"></i> Shop</a>
  <a href="<?= site_url('/buy-membership') ?>"><i class="fas fa-credit-card"></i> Buy Membership</a>
  <a href="<?= site_url('/classes') ?>" class="active"><i class="fas fa-calendar-alt"></i> Classes</a>
</div>

<!-- Main Content -->
<div class="content">
  <div class="container">
    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    <?php endif; ?>

    <h2 class="mb-4"><i class="fas fa-calendar-alt"></i> Fitness Classes</h2>

    <!-- Capacity Information -->
    <div class="capacity-info">
      <h6><i class="fas fa-info-circle"></i> Class Capacity Information</h6>
      <div class="row">
        <div class="col-md-3">
          <span class="badge bg-primary"><i class="fas fa-circle"></i></span> Available
        </div>
        <div class="col-md-3">
          <span class="badge bg-success"><i class="fas fa-check"></i></span> You're Booked
        </div>
        <div class="col-md-3">
          <span class="badge bg-danger"><i class="fas fa-times"></i></span> Full
        </div>
        <div class="col-md-3">
          <span class="badge bg-secondary"><i class="fas fa-users"></i></span> Shows Available/Total Spots
        </div>
      </div>
    </div>

    <!-- Class Type Filters -->
    <div class="filter-buttons">
      <button class="btn btn-outline-primary active" data-filter="all">All Classes</button>
      <button class="btn btn-outline-success" data-filter="yoga">Yoga</button>
      <button class="btn btn-outline-danger" data-filter="cardio">Cardio</button>
      <button class="btn btn-outline-info" data-filter="strength">Strength</button>
      <button class="btn btn-outline-warning" data-filter="pilates">Pilates</button>
      <button class="btn btn-outline-secondary" data-filter="spinning">Spinning</button>
      <button class="btn btn-outline-dark" data-filter="zumba">Zumba</button>
      <button class="btn btn-outline-danger" data-filter="boxing">Boxing</button>
    </div>

    <!-- Classes Grid -->
    <div class="row g-4">
      <?php if (isset($classes) && count($classes) > 0): ?>
        <?php foreach ($classes as $class): ?>
          <div class="col-md-6 col-lg-4" data-class-type="<?= strtolower($class['class_type']) ?>">
            <div class="card class-card" style="cursor: pointer;" onclick="openScheduleModal(<?= $class['classID'] ?>, '<?= esc($class['class_name']) ?>', '<?= esc($class['trainer_name']) ?>', '<?= strtolower($class['class_type']) ?>')">
              <div class="class-type-badge class-type-<?= strtolower($class['class_type']) ?>">
                <?= ucfirst($class['class_type']) ?>
              </div>
              <div class="card-body">
                <h5 class="card-title"><?= esc($class['class_name']) ?></h5>
                <p class="card-text">
                  <i class="fas fa-user-tie"></i> <strong>Trainer:</strong> <?= esc($class['trainer_name']) ?>
                </p>
                
                <!-- Click to view schedules -->
                <div class="mt-3 text-center">
                  <button class="btn btn-outline-primary btn-sm" onclick="event.stopPropagation(); openScheduleModal(<?= $class['classID'] ?>, '<?= esc($class['class_name']) ?>', '<?= esc($class['trainer_name']) ?>', '<?= strtolower($class['class_type']) ?>')">
                    <i class="fas fa-calendar-alt"></i> View Schedules
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12">
          <div class="text-center py-5">
            <i class="fas fa-dumbbell fa-3x text-muted mb-3"></i>
            <h4 class="text-muted">No classes available</h4>
            <p class="text-muted">Check back later for new classes!</p>
          </div>
        </div>
      <?php endif; ?>
    </div>

    <!-- Your Bookings -->
    <div class="row mt-5">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-calendar-check"></i> Your Booked Classes</h5>
            <?php if (isset($userBookings) && count($userBookings) > 0): ?>
              <div class="row">
                <?php foreach ($userBookings as $booking): ?>
                  <div class="col-md-6 mb-3">
                    <div class="schedule-item booked">
                      <div class="d-flex justify-content-between align-items-start">
                        <div>
                          <h6 class="mb-1"><i class="fas fa-dumbbell"></i> Class: <?= esc($booking['class_name']) ?></h6>
                          <p class="mb-1"><i class="fas fa-calendar"></i> <?= date('D, d M Y', strtotime($booking['schedule_date'])) ?></p>
                          <p class="mb-0"><i class="fas fa-clock"></i> <?= date('h:i A', strtotime($booking['start_time'])) ?></p>
                        </div>
                        <span class="badge bg-primary">Booked</span>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            <?php else: ?>
              <div class="text-center py-4">
                <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                <p class="text-muted">You have no booked classes.</p>
                <p class="text-muted">Browse the classes above and book your first session!</p>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Class Information -->
    <div class="row mt-4">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><i class="fas fa-info-circle"></i> Class Information</h5>
            <div class="row">
              <div class="col-md-4">
                <div class="text-center mb-3">
                  <i class="fas fa-clock fa-2x text-primary mb-2"></i>
                  <h6>Class Duration</h6>
                  <p class="text-muted">Most classes are 60 minutes long</p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="text-center mb-3">
                  <i class="fas fa-users fa-2x text-success mb-2"></i>
                  <h6>Class Size</h6>
                  <p class="text-muted">Limited capacity to ensure quality instruction</p>
                  <p class="text-muted"><small>First come, first served basis</small></p>
                </div>
              </div>
              <div class="col-md-4">
                <div class="text-center mb-3">
                  <i class="fas fa-user-tie fa-2x text-warning mb-2"></i>
                  <h6>Expert Trainers</h6>
                  <p class="text-muted">Certified and experienced instructors</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Schedule Modal -->
    <div class="modal fade" id="scheduleModal" tabindex="-1" aria-labelledby="scheduleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="scheduleModalLabel">
              <i class="fas fa-calendar-alt"></i> <span id="modalClassName"></span>
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!-- Class Details -->
            <div class="row mb-4">
              <div class="col-md-12">
                <div class="d-flex align-items-center mb-2">
                  <i class="fas fa-user-tie text-primary me-2"></i>
                  <strong>Trainer:</strong> <span id="modalTrainerName" class="ms-2"></span>
                </div>
              </div>
            </div>

            <!-- Available Schedules -->
            <div id="modalSchedules">
              <!-- Calendar will be loaded here -->
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Class type filter functionality
document.addEventListener('DOMContentLoaded', function() {
  const filterButtons = document.querySelectorAll('[data-filter]');
  const classCards = document.querySelectorAll('.col-md-6, .col-lg-4');

  filterButtons.forEach(button => {
    button.addEventListener('click', function() {
      const selectedFilter = this.getAttribute('data-filter');
      
      // Update active button
      filterButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
      
      // Filter class cards
      classCards.forEach(card => {
        const classType = card.getAttribute('data-class-type');
        if (selectedFilter === 'all' || classType === selectedFilter) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});

// Schedule modal functionality
function openScheduleModal(classId, className, trainerName, classType) {
  console.log('Opening modal for class:', classId, className);
  
  // Set modal content
  document.getElementById('modalClassName').textContent = className;
  document.getElementById('modalTrainerName').textContent = trainerName;
  
  // Get schedules for this class
  const schedules = <?= json_encode($classSchedules ?? []) ?>;
  const classSchedules = schedules[classId] || [];
  console.log('Schedules for class', classId, ':', classSchedules);
  
  // Get user's existing bookings
  const userBookings = <?= json_encode($userBookings ?? []) ?>;
  console.log('User bookings:', userBookings);
  
  // Get membership info for quota display
  const membership = <?= json_encode($membership ?? null) ?>;
  const userMembership = <?= json_encode($userMembership ?? null) ?>;
  console.log('Membership:', membership);
  console.log('User membership:', userMembership);
  
  // Create calendar view
  let calendarHtml = createCalendarView(classSchedules, userBookings);
  
  // Add quota information if membership exists
  if (membership && userMembership) {
    const weeklyBookings = countWeeklyBookings(userBookings);
    const remainingClasses = membership.classLimit - weeklyBookings;
    const quotaHtml = `
      <div class="alert alert-info mb-3">
        <i class="fas fa-info-circle"></i> 
        <strong>Current Week Quota:</strong> ${weeklyBookings}/${membership.classLimit} classes used 
        (${remainingClasses} remaining this week)
        <br><small class="text-muted">Note: You can book classes for future weeks even if current week is full</small>
      </div>
    `;
    calendarHtml = quotaHtml + calendarHtml;
  }
  
  document.getElementById('modalSchedules').innerHTML = calendarHtml;
  
  // Show modal
  const modal = new bootstrap.Modal(document.getElementById('scheduleModal'));
  modal.show();
  
  // Initialize calendar navigation if multiple months exist
  if (window.calendarData && window.calendarData.monthKeys.length > 1) {
    console.log('Multiple months detected, initializing navigation');
    // Use setTimeout to ensure modal is fully rendered
    setTimeout(() => {
      displayCurrentMonth();
    }, 100);
  } else {
    console.log('Single month or no calendar data');
  }
}

// Function to count weekly bookings for a specific date
function countWeeklyBookings(userBookings, targetDate = null) {
  let dateToCheck;
  
  if (targetDate) {
    // If targetDate is provided, count bookings for that specific week
    dateToCheck = new Date(targetDate);
  } else {
    // If no targetDate, count bookings for current week
    dateToCheck = new Date();
  }
  
  const weekStart = new Date(dateToCheck);
  weekStart.setDate(dateToCheck.getDate() - dateToCheck.getDay() + 1); // Monday
  weekStart.setHours(0, 0, 0, 0);
  
  const weekEnd = new Date(weekStart);
  weekEnd.setDate(weekStart.getDate() + 6); // Sunday
  weekEnd.setHours(23, 59, 59, 999);
  
  return userBookings.filter(booking => {
    const bookingDate = new Date(booking.schedule_date);
    return bookingDate >= weekStart && bookingDate <= weekEnd;
  }).length;
}

// Function to create calendar view
function createCalendarView(schedules, userBookings) {
  console.log('createCalendarView called with schedules:', schedules);
  if (schedules.length === 0) {
    console.log('No schedules found');
    return '<div class="text-center py-4"><i class="fas fa-calendar-times fa-3x text-muted mb-3"></i><p class="text-muted">No schedules available for this class.</p></div>';
  }

  // Group schedules by month
  const schedulesByMonth = {};
  schedules.forEach(schedule => {
    const date = new Date(schedule.schedule_date);
    const monthKey = date.getFullYear() + '-' + (date.getMonth() + 1);
    if (!schedulesByMonth[monthKey]) {
      schedulesByMonth[monthKey] = [];
    }
    schedulesByMonth[monthKey].push(schedule);
  });

  const monthKeys = Object.keys(schedulesByMonth).sort();
  console.log('Schedules by month:', schedulesByMonth);
  console.log('Month keys:', monthKeys);
  
  if (monthKeys.length === 1) {
    // Single month - no navigation needed
    const monthKey = monthKeys[0];
    const monthSchedules = schedulesByMonth[monthKey];
    const firstDate = new Date(monthSchedules[0].schedule_date);
    const monthName = firstDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
    
    return `
      <h6><i class="fas fa-calendar"></i> Available Schedules:</h6>
      <div class="calendar-month mb-4">
        <h6 class="text-primary mb-3">${monthName}</h6>
        <div class="calendar-grid">
          ${createMonthCalendar(firstDate, monthSchedules, userBookings)}
        </div>
      </div>
    `;
  } else {
    // Multiple months - add navigation
    let calendarHtml = '<h6><i class="fas fa-calendar"></i> Available Schedules:</h6>';
    
    // Add month navigation
    calendarHtml += `
      <div class="calendar-navigation mb-3">
        <div class="d-flex justify-content-between align-items-center">
          <button class="btn btn-outline-primary btn-sm" onclick="changeMonth(-1)" id="prevMonthBtn">
            <i class="fas fa-chevron-left"></i> Previous Month
          </button>
          <h6 class="text-primary mb-0" id="currentMonthDisplay"></h6>
          <button class="btn btn-outline-primary btn-sm" onclick="changeMonth(1)" id="nextMonthBtn">
            Next Month <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    `;
    
    // Add calendar container
    calendarHtml += '<div id="calendarContainer"></div>';
    
    // Store month data globally for navigation
    window.calendarData = {
      schedulesByMonth: schedulesByMonth,
      monthKeys: monthKeys,
      currentMonthIndex: 0,
      userBookings: userBookings
    };
    
    return calendarHtml;
  }
}

// Function to create a month calendar
function createMonthCalendar(firstDate, schedules, userBookings) {
  const year = firstDate.getFullYear();
  const month = firstDate.getMonth();
  
  // Get first day of month and number of days
  const firstDay = new Date(year, month, 1);
  const lastDay = new Date(year, month + 1, 0);
  const daysInMonth = lastDay.getDate();
  const startingDay = firstDay.getDay();
  
  // Create schedule lookup
  const scheduleLookup = {};
  schedules.forEach(schedule => {
    const date = new Date(schedule.schedule_date);
    const day = date.getDate();
    if (!scheduleLookup[day]) {
      scheduleLookup[day] = [];
    }
    scheduleLookup[day].push(schedule);
  });

  // Create user booking lookup
  const userBookingLookup = {};
  userBookings.forEach(booking => {
    const date = new Date(booking.schedule_date);
    const day = date.getDate();
    const monthKey = date.getFullYear() + '-' + (date.getMonth() + 1);
    const currentMonthKey = year + '-' + (month + 1);
    
    if (monthKey === currentMonthKey) {
      if (!userBookingLookup[day]) {
        userBookingLookup[day] = [];
      }
      userBookingLookup[day].push(booking);
    }
  });

  let calendarHtml = `
    <div class="calendar-header">
      <div class="calendar-day-header">Sun</div>
      <div class="calendar-day-header">Mon</div>
      <div class="calendar-day-header">Tue</div>
      <div class="calendar-day-header">Wed</div>
      <div class="calendar-day-header">Thu</div>
      <div class="calendar-day-header">Fri</div>
      <div class="calendar-day-header">Sat</div>
    </div>
    <div class="calendar-body">
  `;

  let dayCount = 1;
  const totalCells = Math.ceil((daysInMonth + startingDay) / 7) * 7;

  for (let i = 0; i < totalCells; i++) {
    if (i < startingDay || dayCount > daysInMonth) {
      calendarHtml += '<div class="calendar-day empty"></div>';
    } else {
      const hasSchedule = scheduleLookup[dayCount];
      const hasUserBooking = userBookingLookup[dayCount];
      let dayClass = 'calendar-day';
      
      if (hasSchedule) {
        dayClass += ' has-schedule';
      }
      if (hasUserBooking) {
        dayClass += ' has-user-booking';
      }
      
      calendarHtml += `<div class="${dayClass}" data-day="${dayCount}">`;
      calendarHtml += `<div class="day-number">${dayCount}</div>`;
      
      if (hasSchedule) {
        hasSchedule.forEach(schedule => {
          const startTime = new Date('2000-01-01T' + schedule.start_time).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
          
          // Check if user has booked this specific schedule
          const isBooked = userBookings.some(booking => 
            booking.scheduleID == schedule.scheduleID
          );
          
          // Check if class is booked by anyone
          const isBookedByAnyone = schedule.is_booked_by_anyone;
          const bookedByName = schedule.booked_by_name;
          const bookedByEmail = schedule.booked_by_email;
          
          // Check if class is full
          const isFull = schedule.is_full || false;
          const availableSpots = schedule.available_spots || 0;
          const capacity = schedule.capacity || 20;
          
          let slotClass = 'schedule-slot';
          let slotText = startTime;
          let onClick = `onclick="showScheduleDetails(${schedule.scheduleID}, '${schedule.schedule_date}', '${schedule.start_time}', '${schedule.end_time}')"`;
          let bookedByHtml = '';
          
          if (isBookedByAnyone) {
            slotClass = 'schedule-slot booked';
            slotText = `<i class="fas fa-check"></i> ${startTime} (Booked)`;
            onClick = '';
            if (bookedByName || bookedByEmail) {
              bookedByHtml = `<br><small class='text-muted'>Booked by: ${bookedByName ? bookedByName : bookedByEmail}</small>`;
            }
          } else if (isBooked) {
            slotClass = 'schedule-slot booked';
            slotText = `<i class="fas fa-check"></i> ${startTime}`;
            onClick = '';
          } else if (isFull) {
            slotClass = 'schedule-slot full';
            slotText = `<i class="fas fa-times"></i> ${startTime}`;
            onClick = '';
          } else {
            slotText = `${startTime} (${availableSpots}/${capacity})`;
          }
          
          calendarHtml += `
            <div class="${slotClass}" ${onClick}>
              <small>${slotText}</small>
              ${bookedByHtml}
            </div>
          `;
        });
      }
      
      calendarHtml += '</div>';
      dayCount++;
    }
  }

  calendarHtml += '</div>';
  return calendarHtml;
}

// Function to display current month
function displayCurrentMonth() {
  console.log('displayCurrentMonth called');
  if (!window.calendarData) {
    console.log('No calendar data found');
    return;
  }
  
  const { schedulesByMonth, monthKeys, currentMonthIndex, userBookings } = window.calendarData;
  const currentMonthKey = monthKeys[currentMonthIndex];
  const monthSchedules = schedulesByMonth[currentMonthKey];
  const firstDate = new Date(monthSchedules[0].schedule_date);
  const monthName = firstDate.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
  
  // Update month display
  document.getElementById('currentMonthDisplay').textContent = monthName;
  
  // Update navigation buttons
  const prevBtn = document.getElementById('prevMonthBtn');
  const nextBtn = document.getElementById('nextMonthBtn');
  
  prevBtn.disabled = currentMonthIndex === 0;
  nextBtn.disabled = currentMonthIndex === monthKeys.length - 1;
  
  // Update calendar content
  const calendarContainer = document.getElementById('calendarContainer');
  calendarContainer.innerHTML = `
    <div class="calendar-grid">
      ${createMonthCalendar(firstDate, monthSchedules, userBookings)}
    </div>
  `;
}

// Function to change month
function changeMonth(direction) {
  if (!window.calendarData) return;
  
  const newIndex = window.calendarData.currentMonthIndex + direction;
  
  if (newIndex >= 0 && newIndex < window.calendarData.monthKeys.length) {
    window.calendarData.currentMonthIndex = newIndex;
    displayCurrentMonth();
  }
}

// Function to show schedule details and booking option
function showScheduleDetails(scheduleID, scheduleDate, startTime, endTime) {
  const date = new Date(scheduleDate);
  const formattedDate = date.toLocaleDateString('en-US', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
  const startTimeFormatted = new Date('2000-01-01T' + startTime).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
  const endTimeFormatted = new Date('2000-01-01T' + endTime).toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });

  // Check if user has already booked this schedule
  const userBookings = <?= json_encode($userBookings ?? []) ?>;
  const isBooked = userBookings.some(booking => booking.scheduleID == scheduleID);

  // Get schedule information including capacity
  const schedules = <?= json_encode($classSchedules ?? []) ?>;
  let scheduleInfo = null;
  for (const classSchedules of Object.values(schedules)) {
    const found = classSchedules.find(s => s.scheduleID == scheduleID);
    if (found) {
      scheduleInfo = found;
      break;
    }
  }

  const isFull = scheduleInfo ? scheduleInfo.is_full : false;
  const availableSpots = scheduleInfo ? scheduleInfo.available_spots : 0;
  const capacity = scheduleInfo ? scheduleInfo.capacity : 20;

  // Check membership and quota for the specific week of this schedule
  const membership = <?= json_encode($membership ?? null) ?>;
  const userMembership = <?= json_encode($userMembership ?? null) ?>;
  const hasMembership = membership && userMembership;
  const weeklyBookingsForSchedule = countWeeklyBookings(userBookings, scheduleDate);
  const hasQuota = hasMembership && weeklyBookingsForSchedule < membership.classLimit;

  // Check if class is booked by anyone (other than current user)
  const isBookedByAnyone = scheduleInfo ? scheduleInfo.is_booked_by_anyone : false;
  const bookedByName = scheduleInfo ? scheduleInfo.booked_by_name : null;
  const bookedByEmail = scheduleInfo ? scheduleInfo.booked_by_email : null;

  let buttonHtml = '';
  if (isBooked) {
    buttonHtml = `
      <div class="alert alert-success">
        <i class="fas fa-check-circle"></i> You have already booked this class!
      </div>
    `;
  } else if (isBookedByAnyone) {
    buttonHtml = `
      <div class="alert alert-danger">
        <i class="fas fa-times-circle"></i> This class has already been booked by someone else.<br>
        <small>Booked by: ${bookedByName ? bookedByName : bookedByEmail}</small>
      </div>
    `;
  } else if (isFull) {
    buttonHtml = `
      <div class="alert alert-danger">
        <i class="fas fa-times-circle"></i> This class is full (${capacity}/${capacity} spots taken).
        <br><small>Please try another time slot.</small>
      </div>
    `;
  } else if (!hasMembership) {
    buttonHtml = `
      <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i> You need an active membership to book classes.
      </div>
    `;
  } else if (!hasQuota) {
    buttonHtml = `
      <div class="alert alert-danger">
        <i class="fas fa-times-circle"></i> You have reached your weekly class limit of ${membership.classLimit} classes for this week (${formattedDate.split(',')[0]}).
        <br><small>You can still book classes for other weeks!</small>
      </div>
    `;
  } else {
    buttonHtml = `
      <form action="<?= site_url('/book-class') ?>" method="post">
        <input type="hidden" name="scheduleID" value="${scheduleID}">
        <button type="submit" class="btn btn-primary btn-sm">
          <i class="fas fa-bookmark"></i> Book This Class (${availableSpots} spots left)
        </button>
      </form>
    `;
  }

  const detailsHtml = `
    <div class="schedule-details-popup">
      <div class="card">
        <div class="card-body">
          <h6 class="card-title">
            <i class="fas fa-calendar-day"></i> Schedule Details
            ${isBooked ? '<span class="badge bg-success ms-2"><i class="fas fa-check"></i> Booked</span>' : ''}
            ${isFull ? '<span class="badge bg-danger ms-2"><i class="fas fa-times"></i> Full</span>' : ''}
          </h6>
          <p><strong>Date:</strong> ${formattedDate}</p>
          <p><strong>Time:</strong> ${startTimeFormatted} - ${endTimeFormatted}</p>
          <p><strong>Capacity:</strong> ${availableSpots}/${capacity} spots available</p>
          ${hasMembership ? `<p><strong>Weekly Quota for this week:</strong> ${weeklyBookingsForSchedule}/${membership.classLimit} classes used</p>` : ''}
          ${hasMembership && weeklyBookingsForSchedule >= membership.classLimit ? `<p class="text-warning"><small><i class="fas fa-info-circle"></i> This week is full, but you can book classes for other weeks!</small></p>` : ''}
          ${buttonHtml}
        </div>
      </div>
    </div>
  `;

  // Remove any existing popup
  const existingPopup = document.querySelector('.schedule-details-popup');
  if (existingPopup) {
    existingPopup.remove();
  }

  // Add new popup
  document.body.insertAdjacentHTML('beforeend', detailsHtml);
  
  // Auto-remove popup after 5 seconds
  setTimeout(() => {
    const popup = document.querySelector('.schedule-details-popup');
    if (popup) {
      popup.remove();
    }
  }, 5000);
}
</script>
</body>
</html> 