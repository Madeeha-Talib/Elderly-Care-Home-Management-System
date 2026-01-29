<?php include("includes/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resident_id = $_POST['resident_id'];
    $visitor_name = $_POST['visitor_name'];
    $relationship = $_POST['relationship'];
    $visit_time = $_POST['visit_time'];
    $status = $_POST['status'];

    $conn->query("INSERT INTO family_visits (resident_id, visitor_name, relationship, visit_time, status)
                  VALUES ($resident_id, '$visitor_name', '$relationship', '$visit_time', '$status')");

    header("Location: family_visits.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Family Visit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Add Visit</h2>
    <form method="POST">
        <div class="mb-3"><label>Resident</label>
            <select name="resident_id" class="form-control">
                <?php
                $res = $conn->query("SELECT * FROM residents");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3"><label>Visitor Name</label><input type="text" name="visitor_name" class="form-control" required></div>
        <div class="mb-3"><label>Relationship</label><input type="text" name="relationship" class="form-control" required></div>
        <div class="mb-3"><label>Visit Time</label><input type="datetime-local" name="visit_time" class="form-control" required></div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-control">
                <option>Pending</option><option>Confirmed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="family_visits.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
