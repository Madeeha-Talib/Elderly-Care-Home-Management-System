<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Medications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4">
    <h2 class="mb-3 text-center">MEDICATION SCHEDULE</h2>

    <?php
    if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Medication added successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>

    <div class="text-center mb-3">
        <a href="add_medication.php" class="btn btn-success">+ Add Medication</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr><th>Resident</th><th>Medicine</th><th>Dosage</th><th>Time</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT m.*, r.name AS resident_name FROM medications m 
                    JOIN residents r ON m.resident_id = r.id ORDER BY m.id DESC";
            $res = $conn->query($sql);
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['resident_name']}</td>
                        <td>{$row['medicine_name']}</td>
                        <td>{$row['dosage']}</td>
                        <td>{$row['schedule_time']}</td>
                        <td><span class='badge bg-".($row['status']=='Pending'?'warning':'success')."'>{$row['status']}</span></td>
                        <td>
                            <a href='edit_medication.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_medication.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
