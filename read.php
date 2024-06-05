<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
include_once 'database.php';
include_once 'event.php';

$database = new Database();
$db = $database->getConnection();

$event = new event($db); 
$stmt = $event->read(); 
$num = $stmt->rowCount();
if($num>0){
    $events_arr=array();
    $events_arr["records"]=array(); 

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $event_item=array(
            "id" => $id,
            "title" => $title,
        );

        array_push($events_arr["records"], $event_item); 
    }
    http_response_code(200);

    echo json_encode($events_arr);
}else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No events found.") 
    );
}
?>