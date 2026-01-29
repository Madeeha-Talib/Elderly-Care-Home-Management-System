<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Residents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>

<div class="container mt-4">
    <h2 class="mb-3 text-center">RESIDENTS</h2>
    <div class="text-center mb-3">
        <a href="add_resident.php" class="btn btn-success">+ Add Resident</a>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr><th>ID</th><th>Name</th><th>Age</th><th>Gender</th><th>Admission</th><th>Status</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php
            $res = $conn->query("SELECT * FROM residents ORDER BY id DESC");
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['age']}</td>
                    <td>{$row['gender']}</td>
                    <td>{$row['admission_date']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='edit_resident.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_resident.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
