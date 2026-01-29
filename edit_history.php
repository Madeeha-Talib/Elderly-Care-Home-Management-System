<?php include("includes/db.php");
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM medical_history WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $diagnosis = $_POST['diagnosis'];
    $treatment = $_POST['treatment'];
    $date = $_POST['visit_date'];

    $conn->query("UPDATE medical_history SET diagnosis='$diagnosis', treatment='$treatment', visit_date='$date' WHERE id=$id");
    header("Location: medical_history.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Medical History</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Medical History</h2>
    <form method="POST">
        <div class="mb-3"><label>Diagnosis</label><input type="text" name="diagnosis" value="<?= $row['diagnosis'] ?>" class="form-control" required></div>
        <div class="mb-3"><label>Treatment</label><textarea name="treatment" class="form-control" required><?= $row['treatment'] ?></textarea></div>
        <div class="mb-3"><label>Visit Date</label><input type="date" name="visit_date" value="<?= $row['visit_date'] ?>" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="medical_history.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
