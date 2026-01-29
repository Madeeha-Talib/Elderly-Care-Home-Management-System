<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Audit Logs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4">
    <h2 class="mb-3 text-center">🔒 Audit Log Viewer</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr><th>ID</th><th>Action</th><th>Table</th><th>Record ID</th><th>User</th><th>Time</th></tr>
        </thead>
        <tbody>
            <?php
            $res = $conn->query("SELECT * FROM audit_log ORDER BY action_time DESC");
            while ($row = $res->fetch_assoc()) {
                $color = match ($row['action_type']) {
                    'INSERT' => 'success',
                    'UPDATE' => 'warning',
                    'DELETE' => 'danger',
                    default => 'secondary'
                };
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td><span class='badge bg-$color'>{$row['action_type']}</span></td>
                        <td>{$row['table_name']}</td>
                        <td>{$row['record_id']}</td>
                        <td>{$row['user_info']}</td>
                        <td>{$row['action_time']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
