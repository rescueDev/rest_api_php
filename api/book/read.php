<?php

//Headers
header('Acces-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once('../../config/Database.php');
include_once('../../models/Book.php');


//Instantiate DB & Connect
$database = new Database();
$db = $database->connect();

// Instatiate book object
$book = new Book($db);

// Book query
$result = $book->read();

// Get row count
$num = $result->rowCount();

// Check if any books
if ($num > 0) {

    // Book array
    $books_arr = [];
    $books_arr['data'] = [];

    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $book_item = [
            'id' => $id,
            'title' => $title,
            'price' => $price,
            'author' => $author,
            'year' => $year,
        ];

        //Push book_item in books['data]
        array_push($books_arr['data'], $book_item);
    }

    //Turn array into Json
    echo json_encode($books_arr);
} else {
    //Turn errors into Json
    echo json_encode(['message' => 'No books found']);
}
