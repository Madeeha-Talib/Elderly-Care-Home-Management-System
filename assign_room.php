<?php include("includes/db.php");
$room_id = $_GET['room_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resident_id = $_POST['resident_id'];
    $conn->query("INSERT INTO room_assignments (resident_id, room_id, assign_date) 
                  VALUES ($resident_id, $room_id, CURDATE())");
    $conn->query("UPDATE rooms SET occupied = occupied + 1 WHERE id = $room_id");

    header("Location: room_management.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Assign Room</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Assign Room</h2>
    <form method="POST">
        <div class="mb-3"><label>Select Resident</label>
            <select name="resident_id" class="form-control">
                <?php
                $res = $conn->query("SELECT id, name FROM residents");
                while ($row = $res->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign</button>
        <a href="room_management.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
