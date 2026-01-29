<?php include("includes/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resident_id = $_POST['resident_id'];
    $preference = $_POST['preference'];
    $notes = $_POST['notes'];

    $conn->query("INSERT INTO food_preferences (resident_id, preference, notes) 
                  VALUES ($resident_id, '$preference', '$notes')");
    header("Location: food_prefs.php");
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Food Preference</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Add Food Preference</h2>
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
        <div class="mb-3"><label>Preference</label><input type="text" name="preference" required class="form-control"></div>
        <div class="mb-3"><label>Notes</label><textarea name="notes" class="form-control"></textarea></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="food_prefs.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
 