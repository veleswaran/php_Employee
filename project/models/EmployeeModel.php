<?php
require_once 'config.php'; 

class EmployeeModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllEmployees() {
        $sql = "SELECT * FROM Employee";
        $result = $this->conn->query($sql);
        $departments = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departments[] = $row;
            }
        }
        return $departments;
    }

    public function getEmployeeById($departmentId) {
        $sql = "SELECT * FROM Designation WHERE id = $departmentId";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function createEmployee($name, $gender, $dob, $address, $phoneNumber, $email, $doj, $departmentId, $designationId,$imagePath) {
        $sql = "INSERT INTO Employee (name,gender,DOB,Address,mobile,email,DOJ,depart_id,designation_id,image) VALUES ('$name', '$gender', '$dob', '$address', '$phoneNumber', '$email', '$doj', '$departmentId', '$designationId','$imagePath')";
        $this->conn->query($sql);
    }

    public function updateEmployee($Id, $name,$gender, $dob, $address, $phoneNumber, $email, $doj, $departmentId, $designationId,$imagePath ) {
        $sql = "UPDATE Employee SET name = '$name',gender='$gender',DOB='$dob',Address='$address,mobile='$phoneNumber,email='$email',DOJ='$doj',depart_id='$departmentId',designation_id='$designationId',image='$imagePath' WHERE id = $Id";
        return $this->conn->query($sql);
    }

    public function deleteEmployee($departmentId) {
        $sql = "DELETE FROM Employee WHERE id = $departmentId";
        return $this->conn->query($sql);
    }
}

