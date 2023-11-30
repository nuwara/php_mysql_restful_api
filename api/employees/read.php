<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// inculde db and Employee model
require_once '../../config/Database.php';
require_once '../../models/Employee.php';

// instantiate the db obj
$database = new Database();
$db = $database->connect();

// instantiate the Employee obj
$employee = new Employee($db);

//query employee
$result = $employee->read();

// check if data is available
if ($result->rowCount() > 0) {
    // employee array
    $employee_arr = [];
    $employee_arr['data'] = [];

    //retrieve data
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        // extract the row
        extract($row);

        // employee list
        $employee_list = [
            'id' => $id,
            'name' => $name,
            'email' => $email,
            'skill' => $skill,
        ];

        // push to the employee array
        array_push($employee_arr['data'], $employee_list);
    }

    // output the employee
    echo json_encode($employee_arr);
} else {
    echo json_encode(['message' => 'No data to display']);
}
