<?php

class Database
{
    public static $dbConnection;

    public static function connectToDb()
    {
        $DbUser = "root";
        $DbPassword = "";

        self::$dbConnection = new PDO('mysql:host=localhost;dbname=tictactoe', $DbUser, $DbPassword);
    }
}
