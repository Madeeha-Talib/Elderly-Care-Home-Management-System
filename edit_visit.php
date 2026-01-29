<?php include("includes/db.php");
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM family_visits WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visitor_name = $_POST['visitor_name'];
    $relationship = $_POST['relationship'];
    $visit_time = $_POST['visit_time'];
    $status = $_POST['status'];

    $conn->query("UPDATE family_visits SET 
        visitor_name='$visitor_name',
        relationship='$relationship',
        visit_time='$visit_time',
        status='$status'
        WHERE id=$id");

    header("Location: family_visits.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Visit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Visit</h2>
    <form method="POST">
        <div class="mb-3"><label>Visitor Name</label><input type="text" name="visitor_name" class="form-control" value="<?= $row['visitor_name'] ?>" required></div>
        <div class="mb-3"><label>Relationship</label><input type="text" name="relationship" class="form-control" value="<?= $row['relationship'] ?>" required></div>
        <div class="mb-3"><label>Visit Time</label><input type="datetime-local" name="visit_time" class="form-control" value="<?= str_replace(' ', 'T', $row['visit_time']) ?>" required></div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-control">
                <option <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                <option <?= $row['status']=='Confirmed'?'selected':'' ?>>Confirmed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="family_visits.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
