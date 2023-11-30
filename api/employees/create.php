<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// inculde db and Employee model
require_once '../../config/Database.php';
require_once '../../models/Employee.php';

// instantiate the db obj
$database = new Database();
$db = $database->connect();

// instantiate the Employee obj
$employee = new Employee($db);

//get posted data
$data = json_decode(file_get_contents('php://input'));


// check if the fields is not empty
if (!empty($data->name) && !empty($data->email) && !empty($data->skill)) {
    // data inputs
    $employee->name = $data->name;
    $employee->email = $data->email;
    $employee->skill = $data->skill;

    //create the data
    if ($employee->create()) {
        echo json_encode(['message' => 'New data added successfully']);
    } else {
        echo json_encode(['message' => 'Data could not be added']);
    }
} else {
    echo json_encode(['message' => 'Please field all the fields']);
}
