<?php include("includes/db.php");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room = $_POST['room_number'];
    $floor = $_POST['floor'];
    $capacity = $_POST['capacity'];

    $conn->query("INSERT INTO rooms (room_number, floor, capacity) VALUES ('$room', $floor, $capacity)");

    // Simulate fragmentation
    if ($floor == 1) {
        $conn->query("INSERT INTO rooms_floor1 (room_number, floor, capacity) VALUES ('$room', $floor, $capacity)");
    } elseif ($floor == 2) {
        $conn->query("INSERT INTO rooms_floor2 (room_number, floor, capacity) VALUES ('$room', $floor, $capacity)");
    }

    header("Location: room_management.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Add Room</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Add New Room</h2>
    <form method="POST">
        <div class="mb-3"><label>Room Number</label><input type="text" name="room_number" required class="form-control"></div>
        <div class="mb-3"><label>Floor</label><input type="number" name="floor" required class="form-control"></div>
        <div class="mb-3"><label>Capacity</label><input type="number" name="capacity" required class="form-control"></div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="room_management.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
