<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Family Visits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4">
    <div class="text-center">
        <h2>FAMILY VISIT SCHEDULE</h2>
        <a href="add_visit.php" class="btn btn-success mb-3">+ Add Visit</a>
    </div>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr><th>Resident</th><th>Visitor</th><th>Relationship</th><th>Visit Time</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT f.*, r.name AS resident_name 
                    FROM family_visits f JOIN residents r ON f.resident_id = r.id";
            $res = $conn->query($sql);
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['resident_name']}</td>
                        <td>{$row['visitor_name']}</td>
                        <td>{$row['relationship']}</td>
                        <td>{$row['visit_time']}</td>
                        <td><span class='badge bg-".($row['status']=='Confirmed'?'success':'warning')."'>{$row['status']}</span></td>
                        <td>
                            <a href='edit_visit.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_visit.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
