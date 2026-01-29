<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Resident Summary Report</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>📊 Resident Summary Report</h2>
        <form method="POST" class="d-inline">
            <button type="submit" name="refresh" class="btn btn-primary">🔄 Refresh Summary</button>
        </form>
    </div>

    <?php
    // Refresh the materialized view
    if (isset($_POST['refresh'])) {
        $conn->query("CALL RefreshResidentSummary()");
        echo '<div class="alert alert-info mt-3">Summary refreshed successfully!</div>';
    }
    ?>

    <table class="table table-bordered mt-3">
        <thead class="table-dark">
            <tr><th>Resident</th><th>Total Visits</th><th>Total Medications</th></tr>
        </thead>
        <tbody>
            <?php
            $res = $conn->query("SELECT * FROM resident_summary ORDER BY resident_name");
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['resident_name']}</td>
                        <td>{$row['total_visits']}</td>
                        <td>{$row['total_medications']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
