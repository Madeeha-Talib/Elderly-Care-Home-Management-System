<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Database Admin Tools</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4">
    <h2>⚙️ Database Admin Tools</h2>
    <div class="row g-4">

        <!-- Export Residents -->
        <div class="col-md-4">
            <div class="card p-3">
                <h5>📤 Export Residents</h5>
                <p>Download all residents as a CSV file.</p>
                <a href="export_residents.php" class="btn btn-outline-primary">Export Now</a>
            </div>
        </div>

        <!-- Import Residents -->
        <div class="col-md-4">
            <div class="card p-3">
                <h5>📥 Import Residents</h5>
                <p>Upload a CSV file to import resident records.</p>
                <a href="import_residents.php" class="btn btn-outline-success">Import Now</a>
            </div>
        </div>

        <!-- Refresh Materialized View -->
        <div class="col-md-4">
            <div class="card p-3">
                <h5>🔄 Refresh Resident Summary</h5>
                <p>Recompute materialized view with latest data.</p>
                <form method="POST">
                    <button type="submit" name="refresh_summary" class="btn btn-outline-warning">Refresh Summary</button>
                </form>
                <?php
                if (isset($_POST['refresh_summary'])) {
                    $conn->query("CALL RefreshResidentSummary()");
                    echo "<div class='alert alert-success mt-2'>Summary refreshed successfully!</div>";
                }
                ?>
            </div>
        </div>

        <!-- View Partitioned Room Data -->
        <div class="col-md-6">
            <div class="card p-3">
                <h5>📂 View Partitioned Room Data</h5>
                <p>Shows horizontal fragmentation (floor-wise).</p>
                <table class="table table-sm table-bordered">
                    <thead class="table-light">
                        <tr><th>Room</th><th>Floor</th><th>Capacity</th><th>Occupied</th></tr>
                    </thead>
                    <tbody>
                        <?php
                            // STEP 1: Attempt to create partitioned tables if they don't exist
                            $conn->query("CREATE TABLE IF NOT EXISTS rooms_floor1 AS SELECT * FROM rooms WHERE floor = 1");
                            $conn->query("CREATE TABLE IF NOT EXISTS rooms_floor2 AS SELECT * FROM rooms WHERE floor = 2");

                            // STEP 2: Try fetching from partitioned tables
                            $query = "SELECT * FROM rooms_floor1 UNION ALL SELECT * FROM rooms_floor2";
                            $res = $conn->query($query);

                            // STEP 3: If partitioned tables don't work, fallback to main 'rooms' table
                            if (!$res) {
                                echo "<div class='alert alert-warning'>Partitioned tables not available, showing full room list instead.</div>";
                                $query = "SELECT * FROM rooms";
                                $res = $conn->query($query);
                            }

                            // STEP 4: Output results if available
                            if ($res && $res->num_rows > 0) {
                                while ($row = $res->fetch_assoc()) {
                                    echo "<tr>
                                            <td>{$row['room_number']}</td>
                                            <td>{$row['floor']}</td>
                                            <td>{$row['capacity']}</td>
                                            <td>{$row['occupied']}</td>
                                        </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='4'>No room data found.</td></tr>";
                            }

                            $query = "SELECT * FROM rooms_floor1 UNION ALL SELECT * FROM rooms_floor2";
                            $res = $conn->query($query);
                            while ($row = $res->fetch_assoc()) {
                                echo "<tr>
                                        <td>{$row['room_number']}</td>
                                        <td>{$row['floor']}</td>
                                        <td>{$row['capacity']}</td>
                                        <td>{$row['occupied']}</td>
                                    </tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Link to Summary Report -->
        <div class="col-md-6">
            <div class="card p-3">
                <h5>📋 Resident Summary Report</h5>
                <p>View precomputed stats from materialized view.</p>
                <a href="resident_summary.php" class="btn btn-outline-dark">Open Report</a>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
