<?php include("includes/db.php");
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM food_preferences WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $preference = $_POST['preference'];
    $notes = $_POST['notes'];

    $conn->query("UPDATE food_preferences SET preference='$preference', notes='$notes' WHERE id=$id");
    header("Location: food_prefs.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Edit Food Preference</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Edit Food Preference</h2>
    <form method="POST">
        <div class="mb-3"><label>Preference</label><input type="text" name="preference" value="<?= $row['preference'] ?>" class="form-control" required></div>
        <div class="mb-3"><label>Notes</label><textarea name="notes" class="form-control"><?= $row['notes'] ?></textarea></div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="food_prefs.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
