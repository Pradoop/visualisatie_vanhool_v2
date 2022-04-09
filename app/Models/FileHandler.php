<?php

namespace App\Models;

class FileHandler extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    public function readFile($file)
    {
        $main_array = array();
        $count_lines = count($file);
        $i = 0;
        while($i < $count_lines) {
            $array = preg_split('/\s+/', $file[$i]);
            array_push($main_array, $array);
            $i++;
        }
        return $main_array;
    }
}