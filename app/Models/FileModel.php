<?php

namespace App\Models;

class FileModel extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    public function readFile()
    {
        $all_arrays = array();
        $file_by_line_array = array();
        $total_in_production_array = array();
        $percentage_delayed_array = array();
        $welding_data_array = array();

        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                array_push($file_by_line_array, $line);
            }
            fclose($file);
        }

        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($total_in_production_array, $array[14]);
            }
            fclose($file);
        }

        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($percentage_delayed_array, $array[16]);
            }
            fclose($file);
        }

        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($welding_data_array, $array[18]);
            }
            fclose($file);
        }

        array_push($all_arrays, $file_by_line_array);
        array_push($all_arrays, $total_in_production_array);
        array_push($all_arrays, $percentage_delayed_array);
        array_push($all_arrays, $welding_data_array);

        return $all_arrays;
    }

}