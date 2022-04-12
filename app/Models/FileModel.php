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
        //$file = file("C:\Users\YAGU\Documents\ChassisInKaliberIVCopy.txt");
        //$file = file("\\ivserver\mainframe\Student\ChassisInKaliberIV.txt");
        //$file = file("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)\TestFile.txt");
        $file = file("C:\Users\pradk\Documents\Uni\Thesis\TestFile.txt");
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