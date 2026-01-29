<?php include("includes/db.php"); ?>
<?php
$id = $_GET['id'];
$conn->query("DELETE FROM residents WHERE id = $id");
header("Location: residents.php");
?>
