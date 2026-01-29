<?php include("includes/db.php");
$id = $_GET['id'];
$conn->query("DELETE FROM medical_history WHERE id = $id");
header("Location: medical_history.php");
?>
