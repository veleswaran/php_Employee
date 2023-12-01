<?php
require_once 'config.php';
require_once 'models/EmployeeModel.php'; 
require_once 'models/DepartmentModel.php'; 
require_once 'models/DesignationModel.php'; 
$department = new DepartmentModel();
$departments=$department->getAllDepartments();
$designation = new DesignationModel();
$designations=$designation->getAllDesignations();
$employee = new EmployeeModel();
$employees = $employee->getAllEmployees();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['add'];
    $phoneNumber = $_POST['phoneNumber'];
    $email = $_POST['email'];
    $doj = $_POST['doj'];
    $departmentId = $_POST['department'];
    $designationId = $_POST['designation'];

    $imageDir = '/uploads/';  
    $imageName = $_FILES['image']['name'];
    $imageTmp = $_FILES['image']['tmp_name'];
    $imagePath = $imageDir . $imageName;

    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    
    if(isset($_POST["image"])) {
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
    }
    
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    
    if ($_FILES["image"]["size"] > 5000000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } 
    else {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
      
        $employee = $employeeModel->updateEmployee($name, $gender, $dob, $address, $phoneNumber, $email, $doj, $departmentId, $designationId, $imagePath);
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
   

    
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Employee</title>
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
        <h1 class="text-center">Add Employee</h1>
        <form  method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name" value=<?php echo $employees[0]['name']?>>
            </div>
            <div class="mb-3">
                <label class="form-label">Select your gender:</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="maleRadio" value="male">
                    <label class="form-check-label" for="maleRadio">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="femaleRadio" value="female">
                    <label class="form-check-label" for="femaleRadio">Female</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="otherRadio" value="other">
                    <label class="form-check-label" for="otherRadio">Other</label>
                </div>
            </div>
            <div class="mb-3">
                <label for="dob">DOB:</label>
                <input type="date" class="form-control" id="dob" name="dob" value=<?php echo $employees[0]['DOB']?>>
            </div>
            <div class="mb-3">
                <label for="add">Address:</label>
                <input type="text" class="form-control" id="add" name="add" value=<?php echo $employees[0]['Address']?>>
            </div>
            <div class="mb-3">
                <label for="phoneNumber" class="form-label">Phone Number:</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter phone number" pattern="[9876][0-9]{9}" title="Please enter a 10-digit phone number" value=<?php echo $employees[0]['mobile']?>>
            </div>
            <div class="mb-3">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value=<?php echo $employees[0]['email']?>>
            </div>
            <div class="mb-3">
                <label for="doj">DOJ(join date):</label>
                <input type="date" class="form-control" id="doj" name="doj" value=<?php echo $employees[0]['DOJ']?>>
            </div>
            <div class="mb-3">
                <label for="image">upload image:  <span class="opacity-50 fst-italic">less than 1.5MB </span> </label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
         
            <div class="mb-3">
                <label for="department mt-2">Department:</label>
                <select class="form-select" id="department" name="department">
                    <?php
                    foreach ($departments as $department) {
                        echo "<option value='{$department['id']}'>{$department['dept_name']}</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="designation">Designation:</label>
                <select class="form-select" id="designation" name="designation">
                    <?php
                    foreach ($designations as $designation) {
                        echo "<option value='{$designation['id']}'>{$designation['designation_name']}</option>";
                    }
                    ?>
                </select>
            </div>
           
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
