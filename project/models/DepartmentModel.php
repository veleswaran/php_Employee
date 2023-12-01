<?php
require_once 'config.php'; 

class DepartmentModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllDepartments() {
        $sql = "SELECT * FROM Department";
        $result = $this->conn->query($sql);
        $departments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departments[] = $row;
            }
        }
        return $departments;
    }

    public function getDepartmentById($departmentId) {
        $sql = "SELECT * FROM Department WHERE id = $departmentId";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function createDepartment($name,$description) {
        $sql = "INSERT INTO Department (dept_name, description) VALUES ('$name', '$description')";
        $this->conn->query($sql);
    }

    public function updateDepartment($departmentId, $name, $description) {
        $sql = "UPDATE Department SET dept_name = '$name', description = '$description' WHERE id = $departmentId";
        return $this->conn->query($sql);
    }

    public function deleteDepartment($departmentId) {
        $sql = "DELETE FROM Department WHERE id = $departmentId";
        return $this->conn->query($sql);
    }
}

