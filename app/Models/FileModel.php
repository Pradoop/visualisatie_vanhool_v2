<?php

namespace App\Models;

class FileModel extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    public function readFile()
    {
        $main_array = array();
        $file = file("C:\Users\pradk\Documents\Uni\Thesis\VanHoolTestFile.txt");
        $count_lines = count($file);
        $i = 0;
        while($i < $count_lines) {
            $array = preg_split('/\t/', $file[$i]);
            array_push($main_array, $array);
            $i++;
        }
        return $main_array;
    }
}