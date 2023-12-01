<?php
require_once 'config.php';
require_once 'models/DesignationModel.php'; 

$departmentModel = new DesignationModel();


$data = $departmentModel->getAllDesignations();
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $departmentId = $_POST['delete_id'];
    $departmentModel->deleteDesignation($departmentId);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Designation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
  <h2>Designation Table</h2>
           
  <table class="table text-center" >
    <thead>
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
        <?php foreach($data as $d){?>
        <tr>
            <td><?php echo $d['id'] ?></td>
            <td><?php echo $d['designation_name'] ?></td>
            <td><?php echo $d['description'] ?></td>
           
        </tr>
    <?php } ?>
    </tbody>
  </table>
  <a href="designation" class="btn btn-success">Add Designation</a>
</div>

</body>
</html>
