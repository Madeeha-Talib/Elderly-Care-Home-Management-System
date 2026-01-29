<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Medical History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4 d-flex justify-content-center">
    <div style="width: 100%; max-width: 900px;">
        <h2 class="text-center">🏥 RESIDENT MEDICAL HISTORY</h2>
        <div class="d-flex justify-content-center mb-3">
            <a href="add_history.php" class="btn btn-success">+ Add Medical History</a>
        </div>
        <table class="table table-bordered">
            <thead class="table-dark text-center">
                <tr><th>Resident</th><th>Diagnosis</th><th>Treatment</th><th>Visit Date</th><th>Actions</th></tr>
            </thead>
            <tbody class="text-center">
                <?php
                $res = $conn->query("SELECT h.*, r.name AS resident_name 
                                     FROM medical_history h 
                                     JOIN residents r ON h.resident_id = r.id");
                while ($row = $res->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['resident_name']}</td>
                            <td>{$row['diagnosis']}</td>
                            <td>{$row['treatment']}</td>
                            <td>{$row['visit_date']}</td>
                            <td>
                                <a href='edit_history.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_history.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
