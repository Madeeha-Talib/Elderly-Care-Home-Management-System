<?php
include("includes/db.php");

header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=residents_export.csv');

$output = fopen('php://output', 'w');
fputcsv($output, ['ID', 'Name', 'Age', 'Gender', 'Admission Date', 'Status']);

$result = $conn->query("SELECT * FROM residents");
while ($row = $result->fetch_assoc()) {
    fputcsv($output, [$row['id'], $row['name'], $row['age'], $row['gender'], $row['admission_date'], $row['status']]);
}
fclose($output);
exit;
?>
