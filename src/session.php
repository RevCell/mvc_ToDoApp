<?php

namespace App;

class session{
    public static function set(string $key,$value):void
    {
        $_SESSION[$key]=$value;
    }

    public static function end(string $key)
    {
        unset($_SESSION[$key]);
    }

    public static function get(string $key)
    {
        return $_SESSION[$key] ?? null;
    }
}