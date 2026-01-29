<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resident_id = $_POST['resident_id'];
    $medicine = $_POST['medicine_name'];
    $dosage = $_POST['dosage'];
    $time = $_POST['schedule_time'];

    // Call stored procedure to insert medication
    $conn->query("CALL AddMedication($resident_id, '$medicine', '$dosage', '$time')");

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $resident_id = $_POST['resident_id'];
    $medicine_name = $_POST['medicine_name'];
    $dosage = $_POST['dosage'];
    $schedule_time = $_POST['schedule_time'];
    $status = 'Pending';

    // Insert into database
    $sql = "INSERT INTO medications (resident_id, medicine_name, dosage, schedule_time, status)
            VALUES ('$resident_id', '$medicine_name', '$dosage', '$schedule_time', '$status')";
    if ($conn->query($sql) === TRUE) {
        header("Location: medications.php?msg=success");
        exit();
    } else {
        echo "<div class='alert alert-danger'>Error: " . $conn->error . "</div>";
    }
}

    // ✅ Redirect to medications.php with success message
    header("Location: medications.php?msg=success");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Medication</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<div class="container mt-4">
    <h2>Add Medication</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Resident</label>
            <select name="resident_id" class="form-control" required>
                <?php
                $res = $conn->query("SELECT id, name FROM residents");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3"><label>Medicine Name</label><input type="text" name="medicine_name" class="form-control" required></div>
        <div class="mb-3"><label>Dosage</label><input type="text" name="dosage" class="form-control" required></div>
        <div class="mb-3"><label>Schedule Time</label><input type="time" name="schedule_time" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="medications.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
