<?php
require_once 'config.php'; 

class DesignationModel {
    private $conn;

    public function __construct() {
        global $conn;
        $this->conn = $conn;
    }

    public function getAllDesignations() {
        $sql = "SELECT * FROM Designation";
        $result = $this->conn->query($sql);
        $designation = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $designation[] = $row;
            }
        }
        return $designation;
    }

    public function getDesignationById($designationId) {
        $sql = "SELECT * FROM Designation WHERE id = $designationId";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
        return null;
    }

    public function createDesignation($name,$department,$description) {
        $sql = "INSERT INTO Designation (designation_name,dept_id, description) VALUES ('$name','$department', '$description')";
        $this->conn->query($sql);
    }

    public function updateDesignation($designationId, $name, $description,$department) {
        $sql = "UPDATE Designation SET designation_name = '$name', description = '$description',dept_id=$department WHERE id = $designationId";
        return $this->conn->query($sql);
    }

    public function deleteDesignation($designationId) {
        $sql = "DELETE FROM Designation WHERE id = $designationId";
        return $this->conn->query($sql);
    }
}

