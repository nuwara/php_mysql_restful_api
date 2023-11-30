<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// inculde db and Employee model
require_once '../../config/Database.php';
require_once '../../models/Employee.php';

// instantiate the db obj
$database = new Database();
$db = $database->connect();

// instantiate the Employee obj
$employee = new Employee($db);

//get the posted data with id
$data = json_decode(file_get_contents('php://input'));

// id to update
$employee->id = $data->id;

// other data fields to update
$employee->name = $data->name;
$employee->email = $data->email;
$employee->skill = $data->skill;

//update the data
if ($employee->update()) {
    echo json_encode(['message' => 'Data updated successfully']);
} else {
    echo json_encode(['message' => 'Data could not be updated']);
}
