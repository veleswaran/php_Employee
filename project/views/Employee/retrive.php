<?php
function getDepartmentName($departments, $departmentId) {
    foreach ($departments as $department) {
        if ($department['id'] === $departmentId) {
            return $department['dept_name'];
        }
    }
    return '';
}

function getDesignationName($designations, $designationId) {
    foreach ($designations as $designation) {
        if ($designation['id'] === $designationId) {
            return $designation['designation_name'];
        }
    }
    return '';
}
?>