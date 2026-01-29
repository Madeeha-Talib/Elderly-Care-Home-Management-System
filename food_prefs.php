<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Food Preferences</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4">
    <div class="text-center">
        <h2>🍽 RESIDENT FOOD PREFRENCES</h2>
        <a href="add_food_pref.php" class="btn btn-success mb-3">+ Add Food Preference</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr><th>Resident</th><th>Preference</th><th>Notes</th><th>Actions</th></tr>
        </thead>
        <tbody>
            <?php
            $res = $conn->query("SELECT f.*, r.name AS resident_name 
                                 FROM food_preferences f 
                                 JOIN residents r ON f.resident_id = r.id");
            while ($row = $res->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['resident_name']}</td>
                        <td>{$row['preference']}</td>
                        <td>{$row['notes']}</td>
                        <td>
                            <a href='edit_food_pref.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_food_pref.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure?')\">Delete</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
