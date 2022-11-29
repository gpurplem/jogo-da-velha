<?php

class Database 
{
    public static $dbConnection;

    public static function connectToDb(){
        $userBD = "root";
        $passBD = "";
        $dbConnection = new PDO('mysql:host=localhost;dbname=tictactoe', $userBD, $passBD);
    }
}
