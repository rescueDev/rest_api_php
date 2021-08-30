<?php

//Headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Acces-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Book.php');

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate Book and Author Obj
$book = new Book($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

$book->title = $data->title;
$book->price = $data->price;
$book->author = $data->author;
$book->year = $data->year;


//create book 
if ($book->create()) {
    echo json_encode(['message' => 'Book Created']);
} else {
    echo json_encode(['message' => 'Book Not Created']);
}
