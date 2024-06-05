<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once 'database.php';
include_once 'event.php';

$database = new Database();
$db = $database->getConnection();
$event = new event($db);

$data = json_decode(file_get_contents("php://input"));
$event->id = $data->id;
  
if($event->delete()){
    http_response_code(200);
    echo json_encode(array("message" => "event was delete."));
} else{
    http_response_code(503);
    echo json_encode(array("message" => "Unable to delete event."));
}
?>