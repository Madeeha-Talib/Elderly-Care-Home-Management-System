<?php include("includes/db.php"); ?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $admission_date = $_POST['admission_date'];
    $status = $_POST['status'];

    $conn->query("INSERT INTO residents (name, age, gender, admission_date, status) 
                  VALUES ('$name', $age, '$gender', '$admission_date', '$status')");

    header("Location: residents.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Resident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>
<body>
    
<div class="container mt-4">
    <h2>Add New Resident</h2>
    <form method="POST">
        <div class="mb-3"><label>Name</label><input type="text" name="name" required class="form-control"></div>
        <div class="mb-3"><label>Age</label><input type="number" name="age" required class="form-control"></div>
        <div class="mb-3"><label>Gender</label>
            <select name="gender" class="form-control">
                <option>Male</option><option>Female</option>
            </select>
        </div>
        <div class="mb-3"><label>Admission Date</label><input type="date" name="admission_date" required class="form-control"></div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-control">
                <option>Active</option><option>Observation</option><option>Discharged</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
        <a href="residents.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
