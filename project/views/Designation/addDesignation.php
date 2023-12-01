<?php
require_once 'config.php';
require_once 'models/DepartmentModel.php';
require_once 'models/DesignationModel.php';
$department = new DepartmentModel();
$designation = new DesignationModel();

$departments=$department->getAllDepartments();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
  $name = $_POST['name'];
  $description = $_POST['desc'];
  $department =$_POST['department'];
  $designation->createDesignation($name, $department,$description);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Employee </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Employee App</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Employee</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showDept">Department</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showDesignation">Designation</a> 
        </li>  
        
      </ul>
    </div>
  </div>
</nav>

  <div class="container mt-3">
  <h2>AddDesignation form</h2>
  <form method="post">
    <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="mb-3 mt-3">
      <label for="desc">Description:</label>
      <input type="text" class="form-control" id="email" placeholder="Enter description" name="desc">
    </div>
    <div class="form-group">
        <label for="department">Department:</label>
        <select class="form-select" id="department" name="department">
          <option value="">choose department</option>
            <?php
            foreach ($departments as $department) {
                echo "<option value='{$department['id']}'>{$department['dept_name']}</option>";
            }
            ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
    <a href="showDesignation" class="btn btn-success mt-3">Designation</a>
  </form>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
