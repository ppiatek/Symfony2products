<?php

namespace Ppiatek\OrderBundle\Helper;



class Generator
{

    public static function generateRandomString($length = 10, $characters = 'abcdefghijklmnopqrstuvwxyz') {
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public static function getRandomFirstname() {
        return ucfirst(self::generateRandomString());
    }
    
    public static function getRandomLastname() {
         return ucfirst(self::generateRandomString(16));
    }
    
    public static function getRandomProductName() {
        return ucwords(self::generateRandomString(24, 'abcdefghijklmnopqrstuvwxyz '));
    }
    
    public static function getRandomProductPrice($min, $max) {
        return mt_rand ($min*100, $max*100) / 100;
    }
}
