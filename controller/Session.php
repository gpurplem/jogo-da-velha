<?php

class Session 
{
    public static function startSession(){
        if(session_status() != PHP_SESSION_ACTIVE){
            session_start();
        }
    }

    public static function endSession(){
        if(session_status() == PHP_SESSION_ACTIVE){
            $_SESSION = array();
            session_destroy();
        }
    }
}
