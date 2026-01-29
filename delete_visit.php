<?php include("includes/db.php");
$id = $_GET['id'];
$conn->query("DELETE FROM family_visits WHERE id = $id");
header("Location: family_visits.php");
?>
