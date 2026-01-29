<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | ElderCare</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color:rgb(215, 235, 254); }
        .sidebar { min-height: 100vh; background-color: #fff; padding: 1rem; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
        .sidebar a { display: block; margin-bottom: 1rem; text-decoration: none; color: #333; }
        .sidebar a.active, .sidebar a:hover { color: #0d6efd; font-weight: bold; }
        .card-stat { padding: 1rem; text-align: center; border: 1px solid #ddd; background-color: #fff; border-radius: 6px; }
        .card-stat h2 { font-size: 2rem; margin-bottom: 0; }
        .tab-content .badge { font-size: 0.85rem; }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar with Hide/Show Feature -->
        <div class="col-md-2 sidebar position-relative" id="sidebar">
            <button id="toggleSidebar" class="btn btn-light position-absolute top-0 end-0 mt-2 me-2" style="z-index:2;" title="Hide Sidebar">
                <span id="toggleIcon">&#x25C0;</span>
            </button>
            <h5 class="text-primary fw-bold mb-4">ElderCare</h5>
            <a class="active" href="dashboard.php">📊 Dashboard</a>
            <a href="residents.php">👴 Residents</a>
            <a href="medications.php">💊 Medications</a>
            <a href="food_prefs.php">🍽️ Dietary Plans</a>
            <a href="room_management.php">🛏️ Room Management</a>
            <a href="family_visits.php">👪 Family Visits</a>
            <a href="medical_history.php">🏥 Medical History</a>
            <a href="resident_summary.php">📋 Reports</a>
            <a href="db_tools.php">⚙️ Database Admin</a>
            <a href="audit_logs.php">🔒 Audit Logs</a>
        </div>
        <!-- Floating show button at the header -->
        <button id="showSidebarBtn"
            class="btn btn-primary position-fixed"
            style="z-index:1050; display:none; padding:0; font-size:1.2rem;"
            title="Show Sidebar">
            <span>&#x25B6;</span>
        </button>
        <script>
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebar');
            const showSidebarBtn = document.getElementById('showSidebarBtn');

            function hideSidebar() {
                sidebar.style.width = '0';
                sidebar.style.minWidth = '0';
                sidebar.style.overflow = 'hidden';
                sidebar.classList.add('collapsed');
                toggleBtn.style.display = 'none';
                showSidebarBtn.style.display = 'flex';
            }

            function showSidebar() {
                sidebar.style.width = '';
                sidebar.style.minWidth = '';
                sidebar.style.overflow = '';
                sidebar.classList.remove('collapsed');
                toggleBtn.style.display = '';
                showSidebarBtn.style.display = 'none';
            }

            toggleBtn.onclick = hideSidebar;
            showSidebarBtn.onclick = showSidebar;
        </script>
        <style>
            .sidebar.collapsed {
                padding: 0 !important;
                box-shadow: none !important;
                width: 0 !important;
                min-width: 0 !important;
                overflow: hidden !important;
                transition: width 0.2s;
            }
            #showSidebarBtn {
                background: transparent !important;
                border: none !important;
                color: #0d6efd; /* Optional: make the arrow blue like your theme */
                display: none;
                transition: opacity 0.2s;
                border-radius: 24px 0 0 24px;
            }
        </style>


        <!-- Main content -->
        <div class="col-md-10 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3>Dashboard</h3>
                <a href="add_resident.php" class="btn btn-primary">+ Add New Resident</a>
            </div>

            <!-- Stats -->
            <div class="row g-3 mb-4">
                <div class="col-md-3">
                    <div class="card-stat">
                        <h2>
                            <?php
                            $res = $conn->query("SELECT COUNT(*) as total FROM residents");
                            echo $res->fetch_assoc()['total'];
                            ?>
                        </h2>
                        <small>Currently in care</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-stat">
                        <h2>
                            <?php
                            // Show all pending medications
                            $res = $conn->query("SELECT COUNT(*) as due FROM medications WHERE status='Pending' AND DATE(schedule_time) = CURDATE()");
                            echo $res->fetch_assoc()['due'];
                            ?>
                        </h2>
                        <small>Medications Due</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-stat">
                        <h2>
                            <?php
                            $res = $conn->query("SELECT COUNT(*) as occupied FROM rooms WHERE occupied=1");
                            $occupied = $res->fetch_assoc()['occupied'];
                            echo "$occupied/50";
                            ?>
                        </h2>
                        <small>Rooms Occupied</small>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card-stat">
                        <h2>
                            <?php
                            $res = $conn->query("SELECT COUNT(*) as today_visits FROM family_visits WHERE DATE(visit_time) = CURDATE()");
                            echo $res->fetch_assoc()['today_visits'];
                            ?>
                        </h2>
                        <small>Scheduled Visits</small>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
                <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#recent" role="tab">Recent Admissions</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#meds" role="tab">Medication Alerts</a></li>
                <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#visits" role="tab">Upcoming Visits</a></li>
            </ul>
            <div class="tab-content p-3 border bg-white">
                <!-- Recent Admissions -->
                <div class="tab-pane fade show active" id="recent" role="tabpanel">
                    <table class="table">
                        <thead><tr><th>Name</th><th>Age</th><th>Gender</th><th>Admission Date</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT * FROM residents ORDER BY admission_date DESC LIMIT 5");
                            while($row = $res->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['age']}</td>
                                    <td>{$row['gender']}</td>
                                    <td>{$row['admission_date']}</td>
                                    <td><span class='badge bg-success'>{$row['status']}</span></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>


                <!-- Medication Alerts -->
                <div class="tab-pane fade" id="meds" role="tabpanel">
                    <table class="table">
                        <thead><tr><th>Resident</th><th>Medicine</th><th>Time</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT r.name, m.medicine_name, m.schedule_time, m.status
                                FROM medications m JOIN residents r ON r.id = m.resident_id
                                WHERE m.status='Pending' AND DATE(m.schedule_time) = CURDATE()
                                ORDER BY m.schedule_time ASC LIMIT 5");
                            if ($res && $res->num_rows > 0) {
                                while($row = $res->fetch_assoc()) {
                                    echo "<tr>
                                        <td>{$row['name']}</td>
                                        <td>{$row['medicine_name']}</td>
                                        <td>{$row['schedule_time']}</td>
                                        <td><span class='badge bg-danger'>{$row['status']}</span></td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>No medication alerts for today.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>

                <!-- Upcoming Visits -->
                <div class="tab-pane fade" id="visits" role="tabpanel">
                    <table class="table">
                        <thead><tr><th>Resident</th><th>Visitor</th><th>Relationship</th><th>Scheduled</th><th>Status</th></tr></thead>
                        <tbody>
                            <?php
                            $res = $conn->query("SELECT r.name, f.visitor_name, f.relationship, f.visit_time, f.status
                                FROM family_visits f JOIN residents r ON r.id = f.resident_id
                                WHERE f.visit_time >= NOW()
                                ORDER BY f.visit_time ASC LIMIT 5");
                            while($row = $res->fetch_assoc()) {
                                echo "<tr>
                                    <td>{$row['name']}</td>
                                    <td>{$row['visitor_name']}</td>
                                    <td>{$row['relationship']}</td>
                                    <td>{$row['visit_time']}</td>
                                    <td><span class='badge bg-".($row['status']=='Confirmed'?'success':'warning')."'>{$row['status']}</span></td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
