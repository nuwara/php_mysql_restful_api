<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// inculde db and Employee model
require_once '../../config/Database.php';
require_once '../../models/Employee.php';

// instantiate the db obj
$database = new Database();
$db = $database->connect();

// instantiate the Employee obj
$employee = new Employee($db);

//set the id for the record to be retrieved
$employee->id = isset($_GET['id']) ? $_GET['id'] : die();

//read the data
$employee->read_one();

if ($employee->name != null) {
    //create employee array
    $employee_list = [
        'id' => $employee->id,
        'name' => $employee->name,
        'email' => $employee->email,
        'skill' => $employee->skill
    ];
    echo json_encode($employee_list);
} else {
    echo json_encode(['message' => 'No data to display']);
}
