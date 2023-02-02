<?php

namespace App\Fakex\lib;

class MotDePasse
{
    // Generate a random string of length $length

    public static function generateString($length): string
    {
        // Generate a random string of length $length
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for($i = 0; $i < $length; $i++) {
            $string .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $string;


    }

}