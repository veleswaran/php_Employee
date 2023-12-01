<?php
$path=[
    "/"=>"views/Employee/index.php",
    "/addEmp"=>"views/Employee/add.php",
    "/addDept"=>"views/Department/addDepartment.php",
    "/showDept"=>"views/Department/showDepartment.php",
    "/designation"=>"views/Designation/addDesignation.php",
    "/showDesignation"=>"views/Designation/showDesignation.php"
];

if(array_key_exists($_SERVER["REQUEST_URI"],$path)){
    require $path[$_SERVER["REQUEST_URI"]];
}
else{
    require 'view/404.php';
}
?>