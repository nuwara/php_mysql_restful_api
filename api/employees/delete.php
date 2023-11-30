<?php

// headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With');

// inculde db and Employee model
require_once '../../config/Database.php';
require_once '../../models/Employee.php';

// instantiate the db obj
$database = new Database();
$db = $database->connect();

// instantiate the Employee obj
$employee = new Employee($db);

//get the id
$data = json_decode(file_get_contents('php://input'));

$employee->id = $data->id;

if ($employee->delete()) {
    echo json_encode(['message' => 'Data deleted successfully']);
} else {
    echo json_encode(['message' => 'Data could not be deleted']);
}
