<?php
require_once 'config.php';
require_once 'models/EmployeeModel.php'; 
require_once 'models/DepartmentModel.php'; 
require_once 'models/DesignationModel.php'; 
require_once 'views/Employee/retrive.php';

$employee = new EmployeeModel();
$department = new DepartmentModel();
$designation = new DesignationModel();
$employees = $employee->getAllEmployees();
$designations = $designation->getAllDesignations();
$departments = $department->getAllDepartments();
if($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST['delete_id'])){
  $id = $_POST['delete_id'];
  $employee->deleteEmployee($id);
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
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

    <div class="container">
        <h1>Employee List</h1>  
        <table class="table">
            <thead>
                <tr class="text-center">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>email</th>
                    <th>gender</th>
                    <th>DOB</th>
                    <th>DOJ</th>
                    <th>Department</th>
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody> 
                <?php
                foreach ($employees as $employee) {?>
                <tr class="text-center align-middle">
                  <td><?php echo $employee['id']?></td>
                  <td><?php echo $employee['name']?></td>
                  <td><?php echo $employee['mobile']?></td>
                  <td><?php echo $employee['email']?></td>
                  <td><?php echo $employee['gender']?></td>
                  <td><?php echo $employee['DOB']?></td>
                  <td><?php echo $employee['DOJ']?></td>
                  <td><?php echo getDepartmentName($departments, $employee['depart_id']) ?></td>
                  <td><?php echo getDesignationName($designations, $employee['designation_id'])?></td>
                 <td> <img src="<?php echo $employee['image']; ?>" class="card-img-top" style="width:100px;height: 100px;" alt="Employee Image"></td>
                 <td>
                    <form method="post" style="display: inline-block;">
                        <input type="hidden" name="delete_id" value="<?php echo $employee['id'] ?>">
                        <input type="submit" class="btn btn-danger" value="delete"></input>
                    </form>
                 </td>

                </tr>

                <?php } ?>
            </tbody>
        </table>
        <a href="addEmp" class="btn btn-success">Add Employee</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
