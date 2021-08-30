 <?php


    require "config/Database.php";

    //Instantiate DB & Connect
    $database = new Database();

    $database->create();
