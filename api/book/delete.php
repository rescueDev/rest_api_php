<?php

//Headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Acces-Control-Allow-Methods,Authorization,X-Requested-With');


include_once('../../config/Database.php');
include_once('../../models/Book.php');

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate book object
$book = new Book($db);

$data = json_decode(file_get_contents("php://input"));

$book->id = $data->id;

if ($book->delete()) {
    http_response_code(200);
    echo json_encode(array("message" => "Book Deleted"));
} else {
    //503 service unavailable
    http_response_code(503);
    echo json_encode(array("message" => "Cannot delete the book."));
}
