<?php include("includes/db.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Import Residents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2>Import Residents from CSV</h2>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["csv"])) {
        $file = $_FILES["csv"]["tmp_name"];
        if (($handle = fopen($file, "r")) !== FALSE) {
            fgetcsv($handle); // skip header
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $name = $data[1];
                $age = $data[2];
                $gender = $data[3];
                $admission_date = $data[4];
                $status = $data[5];

                $conn->query("INSERT INTO residents (name, age, gender, admission_date, status)
                              VALUES ('$name', $age, '$gender', '$admission_date', '$status')");
            }
            fclose($handle);
            echo "<div class='alert alert-success'>Residents imported successfully!</div>";
        }
    }
    ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3"><label>Upload CSV File</label><input type="file" name="csv" accept=".csv" class="form-control" required></div>
        <button type="submit" class="btn btn-primary">Import</button>
        <a href="residents.php" class="btn btn-secondary">Back</a>
    </form>
</div>
</body>
</html>
