<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Room Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <a href="dashboard.php" class="btn btn-outline-primary" style="font-size: 2.3rem; line-height: 1; margin-top: 20px; margin-left: 20px;">
        &#8592;
    </a>
<div class="container mt-4">
    <div class="text-center">
        <h2>🛏 ROOM MANAGEMENT</h2>
        <a href="add_room.php" class="btn btn-success mb-3">+ Add Room</a>
    </div>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Room No</th>
                <th>Floor</th>
                <th>Capacity</th>
                <th>Occupied</th>
                <th>Resident Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT 
                    rooms.*, 
                    COUNT(room_assignments.resident_id) AS resident_count,
                    GROUP_CONCAT(residents.name SEPARATOR ', ') AS resident_names
                FROM rooms
                LEFT JOIN room_assignments ON rooms.id = room_assignments.room_id
                LEFT JOIN residents ON room_assignments.resident_id = residents.id
                GROUP BY rooms.id
                ORDER BY rooms.floor, rooms.room_number";
        $res = $conn->query($sql);
        if (!$res) {
            die("SQL Error: " . $conn->error);
        }
        while ($row = $res->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['room_number']}</td>
                    <td>{$row['floor']}</td>
                    <td>{$row['capacity']}</td>
                    <td>{$row['occupied']}</td>
                    <td>" . ($row['resident_names'] ? $row['resident_names'] : '-') . "</td>
                    <td>
                        <a href='assign_room.php?room_id={$row['id']}' class='btn btn-primary btn-sm'>Assign</a> ";
            if ($row['resident_count'] == 1) {
                echo "<a href='delete_room.php?room_id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this room?')\">Delete</a>";
            }
            echo "</td>
                </tr>";
        }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
