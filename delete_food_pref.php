<?php include("includes/db.php");
$id = $_GET['id'];
$conn->query("DELETE FROM food_preferences WHERE id = $id");
header("Location: food_prefs.php");
?>
