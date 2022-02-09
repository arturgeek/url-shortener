<?php
namespace App\Tools;
/**
 * Part of this class was taken from https://www.codexworld.com/php-url-shortener-library-create-short-url/
 * and was adapted to the context of this application
 */
class TinyUrlGenerator
{
    private $chars = "abcdfghjkmnpqrstvwxyz|ABCDFGHJKLMNPQRSTVWXYZ|0123456789";
    private $codeLength = 7;

    protected $timestamp;

    public function __construct( $tinyStringLength = 7 ){
        $this->tinyStringLength = $tinyStringLength;
        $this->timestamp = date("Y-m-d H:i:s");
    }

    public function generateRandomString(){
        $sets = explode('|', $this->chars);
        $all = '';
        $randString = '';
        foreach($sets as $set){
            $randString .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for($i = 0; $i < $this->tinyStringLength - count($sets); $i++){
            $randString .= $all[array_rand($all)];
        }
        $randString = str_shuffle($randString);
        return $randString;
    }
}
