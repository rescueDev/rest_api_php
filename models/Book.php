<?php

class Book
{
    //DB stuff
    private $conn;
    private $table = 'book';

    // Book properties
    public $id;
    public $title;
    public $price;
    public $author;
    public $year;

    //Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // get books
    public function read()
    {


        //create query
        $query =

            '
        SELECT *

        FROM
            ' . $this->table . '
                
        ORDER BY 
            title DESC

        ';

        //Prepare statement

        $stmt = $this->conn->prepare($query);

        //Execute

        $stmt->execute();

        return $stmt;
    }

    //single book
    public function single_read()
    {

        //create query
        $query =

            'SELECT *
        FROM ' . $this->table . '        
        WHERE 
            id = ?
        LIMIT 0,1';

        //Prepare query
        $stmt = $this->conn->prepare($query);

        //Execute and bind param
        $stmt->execute([$this->id]);

        $row =  $stmt->fetch(PDO::FETCH_ASSOC);

        //Set Props
        $this->title = $row['title'];
        $this->price = $row['price'];
        $this->author = $row['author'];
        $this->year = $row['year'];
    }

    // create book
    public function create()
    {

        //Book query insert
        $query = '
            INSERT INTO book (title, price, author, year)
                VALUES (:title, :price,
                     :author, :year);';

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->year = htmlspecialchars(strip_tags($this->year));



        //Bind data

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':year', $this->year);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function update()
    {
        //Query Update
        $query = 'UPDATE ' . $this->table . ' 
                    SET 
                        title = :title,
                        price = :price,
                        author = :author,
                        year = :year

                    WHERE
                        id = :id';

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->price = htmlspecialchars(strip_tags($this->price));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->year = htmlspecialchars(strip_tags($this->year));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':price', $this->price);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':year', $this->year);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        echo "\nPDO::errorInfo():\n";
        print_r($this->conn->errorInfo());

        return false;
    }

    public function delete()
    {
        //query remove book
        $query = "DELETE FROM " . $this->table . "WHERE id = ?";

        //prepare query
        $stmt = $this->conn->prepare($query);

        //clean data
        $this->id = htmlspecialchars(strip_tags($this->id));

        //execute query
        $stmt->bindParam(1, $this->id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
