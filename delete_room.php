<?php
include("includes/db.php");

$room_id = intval($_GET['room_id']);

// Check if only one resident is assigned
$sql = "SELECT COUNT(*) AS cnt FROM room_assignments WHERE room_id = $room_id";
$res = $conn->query($sql);
$row = $res->fetch_assoc();

if ($row['cnt'] == 1) {
    // Delete assignments first (if needed)
    $conn->query("DELETE FROM room_assignments WHERE room_id = $room_id");
    // Delete the room
    $conn->query("DELETE FROM rooms WHERE id = $room_id");
    header("Location: room_management.php?msg=deleted");
    exit;
} else {
    header("Location: room_management.php?msg=not_deleted");
    exit;
}
?>