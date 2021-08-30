<?php

//Headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../../config/Database.php');
include_once('../../models/Book.php');

//Instantiate DB and connect
$database = new Database();
$db = $database->connect();

//Instatiate Single Book
$book = new Book($db);

//Get ID
$book->id = isset($_GET['id']) ? $_GET['id'] : die();

//Exec method from model
$book->single_read();

//Create book
$book_arr = [
    'id' => $book->id,
    'title' => $book->title,
    'price' => $book->price,
    'author' => $book->author,
    'year' => $book->year,
];

//check if book searched exists or not filtering 
if (count(array_filter($book_arr)) == count($book_arr)) {
    echo json_encode(['data' => $book_arr]);
} else {
    echo json_encode(['message' => 'No book found']);
}
