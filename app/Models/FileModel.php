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


    /*
    * Function to calculate total amount of chassis in production.
    * Input: Array that contains all the information (so the textfile)
    * Output: Total amount of chassis in production
    * Explanation: Function searches based on the following statuses:
    * 38, 07, 83, 85, 86, 8, 81. If there is a match, then the chassis is in production and value is incremented
    */
    public function calculateTotalInProduction($my_array){
        $line_number = 1;
        $total_produced = 0;
        while ($line_number < sizeof($my_array)):
            switch ($my_array[$line_number][14]){
                case 38:
                    $total_produced++;
                    break;
                case 07:
                    $total_produced++;
                    break;
                case 3:
                    $total_produced++;
                    break;
                case 85:
                    $total_produced++;
                    break;
                case 86:
                    $total_produced++;
                    break;
                case 8:
                    $total_produced++;
                    break;
                case 81:
                    $total_produced++;
                    break;
            }
            $line_number++;
        endwhile;
        return $total_produced;
    }

    public function calculateAverageDelay($my_array)
    {
        $line_number = 1;
        $total_delay = 0;
        $total_produced = 0;

        while ($line_number < sizeof($my_array)):
            $total_delay += $my_array[$line_number][16];
            $total_produced++;
            $line_number++;
        endwhile;

        return round($total_delay / $total_produced, 0,PHP_ROUND_HALF_UP );
    }

}