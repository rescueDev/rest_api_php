<?php

//Headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Acces-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Acces-Control-Allow-Methods,Authorization,X-Requested-With');

include_once('../../config/Database.php');
include_once('../../models/Book.php');

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instantiate book obj
$book = new Book($db);

//Get raw data
$data = json_decode(file_get_contents('php://input'));

//Get ID
$book->id = $data->id;

//Set data
$book->title = $data->title;
$book->price = $data->price;
$book->author = $data->author;
$book->year = $data->year;
$book->id = $book->id;

//check 
if ($book->update()) {

    http_response_code(200);

    echo json_encode(['message' => 'Book updated']);
} else {

    http_response_code(503);

    echo json_encode(['message' => 'Book not updated']);
}
