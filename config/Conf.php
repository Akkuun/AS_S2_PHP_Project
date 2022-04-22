<?php

class Conf{
    private static $databases = [
        'hostname' => 'localhost',
        'database' => 'elhidraouij',
        'login' => 'elhidraouij',
        'password' => 'webas'
    ];

    private static $debug = True;

    public static function getDebug(){
        return self::$debug;
    }

    public static function getLogin(){
        return self::$databases['login'];
    }

    public static function getHostname(){
        return self::$databases['hostname'];
    }

    public static function getDatabase(){
        return self::$databases['database'];
    }

    public static function getPassword(){
        return self::$databases['password'];
    }
}