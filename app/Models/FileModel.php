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

        $file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/planningMontage.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                array_push($file_by_line_array, $line);
            }
            fclose($file);
        }

        $file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/VanHoolTestFile.txt", "r");
        //$file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/planningMontage.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($total_in_production_array, $array[14]);
                array_push($percentage_delayed_array, $array[16]);
            }
            fclose($file);
        }

        array_push($all_arrays, $file_by_line_array);
        array_push($all_arrays, $total_in_production_array);
        array_push($all_arrays, $percentage_delayed_array);

        return $all_arrays;
    }

    /*
    * Function to calculate total amount of chassis in production.
    * Input: Array that contains all the information (so the textfile)
    * Output: Total amount of chassis in production
    * Explanation: Function searches based on the following statuses:
    * 38, 07, 83, 85, 86, 8, 81. If there is a match, then the chassis is in production and value is incremented
    */
    public function calculateTotalInProduction($my_array)
    {
        $production_array = array();
        $line_number = 1;
        $total_in_production = 0;
        $percentage_in_production = 0;
        while ($line_number < sizeof($my_array)):
            switch ($my_array[$line_number]){
                case 38:
                    $total_in_production++;
                    break;
                case 07:
                    $total_in_production++;
                    break;
                case 3:
                    $total_in_production++;
                    break;
                case 85:
                    $total_in_production++;
                    break;
                case 86:
                    $total_in_production++;
                    break;
                case 8:
                    $total_in_production++;
                    break;
                case 81:
                    $total_in_production++;
                    break;
            }
            $line_number++;
        endwhile;
        $percentage_in_production = round(($total_in_production/($line_number-1))*100, 2, PHP_ROUND_HALF_UP);
        $production_array[0] = $total_in_production;
        $production_array[1] = $percentage_in_production;
        return $production_array;
    }

    /*
    * Function to calculate the percentage of all chassis that are delayed.
    * Input: Array that contains all the information (so the textfile)
    * Output: Percentage of chassis that are delayed overall
    * Explanation: Function calculates the percentage of chassis that is delayed
    */
    public function calculatePercentageDelayed($my_array)
    {
        $line_number = 1;
        $delayed = 0;

        while ($line_number < sizeof($my_array)):
            if ($my_array[$line_number] < 0):
                $delayed++;
            else:
                $delayed--;
            endif;
            $line_number++;
        endwhile;
        return round(($delayed/$line_number)*100, 2, PHP_ROUND_HALF_UP);
    }

    /*
    * Function to calculate the average delay of all chassis.
    * Input: Array that contains all the information (so the textfile)
    * Output: Average amount of delays for all chassis
    * Explanation: Function calculates the average delay
    */
    public function calculateAverageDelay($my_array)
    {
        $line_number = 1;
        $total_delay = 0;
        $total_produced = 0;

        while ($line_number < sizeof($my_array)):
            $total_delay += $my_array[$line_number];
            $total_produced++;
            $line_number++;
        endwhile;
        return round(($total_delay / $total_produced)*(-1), 0,PHP_ROUND_HALF_UP );
    }

}