<?php
require_once 'models/EmployeeModel.php';
require_once 'models/DepartmentModel.php';
require_once 'models/DesignationModel.php';

class EmployeeController {
    private $employeeModel;
    private $departmentModel;
    private $designationModel;

    public function __construct() {
        $this->employeeModel = new EmployeeModel();
        $this->departmentModel = new DepartmentModel();
        $this->designationModel = new DesignationModel();
    }

    public function index() {
        $employees = $this->employeeModel->getAllEmployees();
        include 'views/employee/index.php';
    }

    public function addEdit() {
        $departments = $this->departmentModel->getAllDepartments();
        $designations = $this->designationModel->getAllDesignations();
        include 'views/employee/add_edit.php';
    }

    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
           
            header('Location: index.php');
            exit();
        }
    }

    public function edit($id) {
        // Fetch employee details by ID and pass to edit view
        // $employee = $this->employeeModel->getEmployeeById($id);
        // include 'views/employee/edit.php';
    }

    public function delete($id) {
        // Delete employee by ID
        // $this->employeeModel->deleteEmployee($id);
        
        // After deleting, redirect to employee list
        header('Location: index.php');
        exit();
    }
}
?>
