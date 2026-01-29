<?php include("includes/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resident_id = $_POST['resident_id'];
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $date = $_POST['visit_date'];

    $conn->query("INSERT INTO medical_history (resident_id, diagnosis, treatment, visit_date)
                  VALUES ($resident_id, '$diagnosis', '$treatment', '$date')");
    header("Location: medical_history.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Medical History</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Add Medical History</h2>
    <form method="POST">
        <div class="mb-3">
            <label>Resident</label>
            <select name="resident_id" class="form-control">
                <?php
                $res = $conn->query("SELECT id, name FROM residents");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="mb-3"><label>Diagnosis</label><input type="text" name="diagnosis" required class="form-control"></div>
        <div class="mb-3"><label>Treatment</label><textarea name="treatment" required class="form-control"></textarea></div>
        <div class="mb-3"><label>Visit Date</label><input type="date" name="visit_date" required class="form-control"></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="medical_history.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
