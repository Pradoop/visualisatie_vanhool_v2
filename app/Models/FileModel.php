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
    * Function to calculate total amount of chassis in production and percentage in production.
    * Input: Array that contains all the information (so the textfile)
    * Output: Total amount of chassis in production and percentage of chassis in production
    * Explanation: Function searches based on the following statuses:
    * 38, 07, 83, 85, 86, 8, 81. If there is a match, then the chassis is in production and value is incremented
    */
    public function calculateTotalInProduction($my_array){
        $production_array = array();
        $line_number = 1;
        $total_in_production = 0;
        while ($line_number < sizeof($my_array)):
            switch ($my_array[$line_number][14]){
                case 07:
                case 3:
                case 85:
                case 86:
                case 8:
                case 81:
                case 38:
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
            $total_delay += $my_array[$line_number][16];
            $total_produced++;
            $line_number++;
        endwhile;

        return round(($total_delay / $total_produced)*(-1), 0,PHP_ROUND_HALF_UP );
    }

    /*
    * Function to calculate the percentage of all chassis that are delayed.
    * Input: Array that contains all the information (so the textfile)
    * Output: Percentage of chassis that are delayed overall
    * Explanation: Function calculates the percentage of chassis that is delayed
    */
    public function calculatePercentageDelayed($my_array){
        $line_number = 1;
        $delayed = 0;

        while ($line_number < sizeof($my_array)):
            if ($my_array[$line_number][16] < 0):
                $delayed++;
            else:
                $delayed--;
            endif;
            $line_number++;
        endwhile;
        return round(($delayed/$line_number)*100, 2, PHP_ROUND_HALF_UP);
    }

    /* Function to calculate the percentages of cars to be welded by hand, to be welded using the robot,
     * finished welding by robot, or to be decided in general
     * Input: Array that contains all the information (so the textfile)
     * Output: Returns an array with the amount of chassis for each possibility
     * Explanation: array initialized with the different possibilities, which are abbreviations of the variables
     * based on value of the column, they are added in the list.
     */
    public function calculateWeldingPercentages($my_array)
    {
        $line_number = 1;
        $to_be_decided = 0;
        $manual_welding = 0;
        $prep_robot = 0;
        $finish_robot = 0;

        while ($line_number < sizeof($my_array)):
            switch ($my_array[$line_number][18]) {
                case "L0":
                    $to_be_decided++;
                    break;
                case "L1":
                    $manual_welding++;
                    break;
                case "L2":
                    $prep_robot++;
                    break;
                case "L3":
                    $finish_robot++;
                    break;
            }
            $line_number++;
        endwhile;

        return [
            "tbd" => $to_be_decided,
            "mw" => $manual_welding,
            "pr" => $prep_robot,
            "fr" => $finish_robot
        ];
    }
}