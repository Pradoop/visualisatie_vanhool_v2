<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\FileModel;


class AnalyzeController extends BaseController
{

    private $burger_menu;
    private $file_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->file_model = new FileModel();
        $this->data['scripts_to_load'] = array('jquery-3.6.0.min.js', 'bootstrap.bundle.min.js'); //js used everywhere
        $this->data['styles_to_load'] = array('bootstrap.min.css'); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
    }

    public function analyze_view()
    {
        $this->data['title_tab'] = 'Dashboard';
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Dashboard');
        $data2["file_lines"] = $this->file_model->readFile()[0];

        $data2["total_in_production"] = $this->calculateTotalInProduction($this->file_model->fileColumnArrays($data2["file_lines"])[0]);
        $data2["amount_delayed"] = $this->calculateAmountDelayed($this->file_model->fileColumnArrays($data2["file_lines"])[1]);
        $data2["planned_today"] = $this->calculatePlannedToday($this->file_model->fileColumnArrays($data2["file_lines"])[3]);
        $data2["avg_mont"] = $this->calculateAverageWdInMont($this->file_model->fileColumnArrays($data2["file_lines"])[6]);
        $data2["total_welding_info"] = $this->getWeldingData();
        $data2["chassis_planned_dates"] = $this->getWeekChartInfo();
        $data2["table_info"] = $this->getTableInfoToday();


        array_push($this->data['scripts_to_load'], 'analyze_view.js');
        array_push($this->data['styles_to_load'], 'analyze_view.scss');
        $this->data['content'] = view('analyze_view', $data2);
        return view('template', $this->data);
    }

    public function getTableInfoToday()
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[8];
        $output_array = array();
        $line_number = 1;
        while ($line_number < sizeof($my_array)):
            $temp = array();
            if(isset($my_array[$line_number][0])) {
                $temp[] = trim($my_array[$line_number][0]);
            }
            if(isset($my_array[$line_number][3])) {
                $temp[] = trim($my_array[$line_number][3]);
            }
            if(isset($my_array[$line_number][5])) {
                $temp[] = trim($my_array[$line_number][5]);
            }
            if(isset($my_array[$line_number][7])) {
                $temp[] = trim($my_array[$line_number][7]);
            }
            $line_number++;
            if (isset($temp[1]) && ($temp[1] == date('ymd'))){
                $output_array[] = $temp;
            }
        endwhile;
        return json_encode($output_array);
    }

    /*
* Function to calculate total amount of chassis in production and percentage in production.
* Input: Array that contains all the information (so the textfile)
* Output: Total amount of chassis in production and percentage of chassis in production
* Explanation: Function searches based on the following statuses:
* 38, 07, 83, 85, 86, 8, 81. If there is a match, then the chassis is in production and value is incremented
*/
    public function calculateTotalInProduction($my_array)
    {
        $production_array = array();
        $line_number = 1;
        $total_in_production = 0;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][14])) {
                switch ($my_array[$line_number][14]){
                    case 07:
                    case 83:
                    case 85:
                    case 86:
                    case 8:
                    case 81:
                        $total_in_production++;
                        break;
                }
            }
            $line_number++;
        endwhile;
        $percentage_in_production = round(($total_in_production/($line_number-1))*100, 2, PHP_ROUND_HALF_UP);

        $production_array[0] = $total_in_production;
        $production_array[1] = $percentage_in_production;
        return $production_array;
    }

    /*
    * Function to calculate the amount of all chassis that are delayed.
    * Input: Array that contains all the information (so the textfile)
    * Output: Percentage of chassis that are delayed overall
    * Explanation: Function calculates the percentage of chassis that is delayed
    */
    public function calculateAmountDelayed($my_array): float
    {
        $delayed = 0;
        $montage_array = array();
        $today = date('ymd');
        for ($i = 1; $i < sizeof($my_array); $i+=1){
            if(isset($my_array[$i][14])) {
                switch ($my_array[$i][14]){
                    case 07:
                    case 83:
                    case 85:
                    case 86:
                    case 8:
                    case 81:
                        $montage_array[] = $my_array[$i][3];
                        break;
                }
            }
        }
        for ($j = 0; $j < sizeof($montage_array); $j++){
            if ($today - $montage_array[$j] > 0){
                $delayed++;
            }
        }
        return $delayed;
    }


    /*
    * Function to calculate the average delay of all chassis.
    * Input: Array that contains all the information (so the textfile)
    * Output: Average amount of delays for all chassis
    * Explanation: Function calculates the average delay
    */
    public function calculateAverageWdInMont($my_array)
    {
        $line_number = 1;
        $total_delay = 0;
        $total_mont = 0;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][17]) && $my_array[$line_number][17] >= 0) {
                $total_delay += (int) $my_array[$line_number][17];
                $total_mont++;
            }
            $line_number++;
        endwhile;


        return round(($total_delay / $total_mont), 0,PHP_ROUND_HALF_UP );
    }

    /*
    * Function to calculate the average delay of all chassis.
    * Input: Array that contains all the information (so the textfile)
    * Output: Average amount of delays for all chassis
    * Explanation: Function calculates the average delay
    */
    public function calculatePlannedToday($my_array)
    {
        $line_number = 1;
        $total_today = 0;
        $today = date('ymd');

        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][3]) && $my_array[$line_number][3] == $today) {
                $total_today++;
            }
            $line_number++;
        endwhile;

        return $total_today;
    }

    public function getWeldingData(): bool|string
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[7];
        $output_array = array();
        $line_number = 1;
        while ($line_number < sizeof($my_array)):
            $temp = array();
            if(isset($my_array[$line_number][0])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][0]));
            }
            if(isset($my_array[$line_number][3])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][3]));
            }
            if(isset($my_array[$line_number][5])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][5]));
            }
            if(isset($my_array[$line_number][7])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][7]));
            }
            if(isset($my_array[$line_number][18])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][18]));
            }
            if (date('l') == "Monday"){
                $period_start_date = strtotime('now');
            }
            else{
                $period_start_date = strtotime('last Monday');
            }
            $period_end_date = strtotime('+3 weeks', $period_start_date);
            $period_end_date = date('ymd', strtotime('-1 day', $period_end_date));
            $line_number++;
            if ((isset($temp[1])) && ($temp[1] < $period_end_date) && ($temp[1] >= date('ymd', $period_start_date))){
                $output_array[] = $temp;
            }
        endwhile;
        return json_encode($output_array);
    }

    public function getWeekChartInfo()
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[4];
        $output_array = array();
        $line_number = 1;
        while ($line_number < sizeof($my_array)):
            $temp = array();
            if(isset($my_array[$line_number][0])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][0]));
            }
            if(isset($my_array[$line_number][3])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][3]));
            }
            if(isset($my_array[$line_number][5])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][5]));
            }
            if(isset($my_array[$line_number][7])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][7]));
            }
            if (date('l') == "Monday"){
                $period_start_date = strtotime('now');
            }
            else{
                $period_start_date = strtotime('last Monday');
            }
            $period_end_date = strtotime('+3 weeks', $period_start_date);
            $period_end_date = date('ymd', strtotime('-1 day', $period_end_date));
            $line_number++;
            if ((isset($temp[1])) && ($temp[1] < $period_end_date) && ($temp[1] >= date('ymd', $period_start_date))){
                $output_array[] = $temp;
            }
        endwhile;
        return json_encode($output_array);
    }

}