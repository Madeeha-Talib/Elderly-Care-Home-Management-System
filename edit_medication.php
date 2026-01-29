<?php include("includes/db.php");
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM medications WHERE id=$id");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $medicine = $_POST['medicine_name'];
    $dosage = $_POST['dosage'];
    $time = $_POST['schedule_time'];
    $status = $_POST['status'];

    $conn->query("UPDATE medications SET 
        medicine_name='$medicine',
        dosage='$dosage',
        schedule_time='$time',
        status='$status'
        WHERE id=$id");

    header("Location: medications.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Medication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Medication</h2>
    <form method="POST">
        <div class="mb-3"><label>Medicine</label><input type="text" name="medicine_name" class="form-control" value="<?= $row['medicine_name'] ?>" required></div>
        <div class="mb-3"><label>Dosage</label><input type="text" name="dosage" class="form-control" value="<?= $row['dosage'] ?>" required></div>
        <div class="mb-3"><label>Schedule Time</label><input type="time" name="schedule_time" class="form-control" value="<?= $row['schedule_time'] ?>" required></div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-control">
                <option <?= $row['status']=='Pending'?'selected':'' ?>>Pending</option>
                <option <?= $row['status']=='Administered'?'selected':'' ?>>Administered</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="medications.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
