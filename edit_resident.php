<?php include("includes/db.php"); ?>
<?php
$id = $_GET['id'];
$res = $conn->query("SELECT * FROM residents WHERE id = $id");
$row = $res->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $admission_date = $_POST['admission_date'];
    $status = $_POST['status'];

    $conn->query("UPDATE residents SET name='$name', age=$age, gender='$gender', admission_date='$admission_date', status='$status' WHERE id=$id");

    header("Location: residents.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Resident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    
<div class="container mt-4">
    <h2>Edit Resident</h2>
    <form method="POST">
        <div class="mb-3"><label>Name</label><input type="text" name="name" value="<?= $row['name'] ?>" class="form-control"></div>
        <div class="mb-3"><label>Age</label><input type="number" name="age" value="<?= $row['age'] ?>" class="form-control"></div>
        <div class="mb-3"><label>Gender</label>
            <select name="gender" class="form-control">
                <option <?= $row['gender']=='Male'?'selected':'' ?>>Male</option>
                <option <?= $row['gender']=='Female'?'selected':'' ?>>Female</option>
            </select>
        </div>
        <div class="mb-3"><label>Admission Date</label><input type="date" name="admission_date" value="<?= $row['admission_date'] ?>" class="form-control"></div>
        <div class="mb-3"><label>Status</label>
            <select name="status" class="form-control">
                <option <?= $row['status']=='Active'?'selected':'' ?>>Active</option>
                <option <?= $row['status']=='Observation'?'selected':'' ?>>Observation</option>
                <option <?= $row['status']=='Discharged'?'selected':'' ?>>Discharged</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="residents.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
