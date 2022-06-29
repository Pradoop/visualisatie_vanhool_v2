<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\AnalyzeModel;
use App\Models\RendementModel;


class AnalyzeController extends BaseController
{

    private $burger_menu;
    private $analyze_model;
    private $rendement_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->analyze_model = new AnalyzeModel();
        $this->rendement_model = new RendementModel();
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
        $data2["file_lines"] = $this->analyze_model->readFile();
        $data2["rendement_lines"] = $this->rendement_model->readFile();


        //Data for "algemeen"tab in dashboard
        $data2["total_in_production"] = $this->calculateTotalInProduction($this->analyze_model->fileColumnArrays($data2["file_lines"])[0]);
        $data2["amount_delayed"] = $this->calculateAmountDelayed($this->analyze_model->fileColumnArrays($data2["file_lines"])[1]);
        $data2["planned_today"] = $this->calculatePlannedToday($this->analyze_model->fileColumnArrays($data2["file_lines"])[3]);
        $data2["avg_mont"] = $this->calculateAverageWdInMont($this->analyze_model->fileColumnArrays($data2["file_lines"])[6]);
        $data2["total_welding_info"] = $this->getWeldingData();
        $data2["chassis_planned_dates"] = $this->getWeekChartInfo();
        $data2["table_info"] = $this->getTableInfoToday();

        //Data for "rendementen" tab in dashboard
        $data2["average_planned_hours"] = $this->calculateAveragePlannedHours($this->rendement_model->fileColumnArrays($data2["rendement_lines"])[0]);
        $data2["average_worked_hours"] = $this->calculateAverageWorkedHours($this->rendement_model->fileColumnArrays($data2["rendement_lines"])[1]);
        $data2["amount_overtime"] = $this->calculateAmountOvertime($this->rendement_model->fileColumnArrays($data2["rendement_lines"])[2]);
        $data2["amount_montage"] = $this->calculateAmountMontage($this->rendement_model->fileColumnArrays($data2["rendement_lines"])[3]);
        $data2["rendementen_info"] = $this->getCurrentRendementData();


        $this->data['scripts_to_load'][] = 'analyze_view.js';
        $this->data['scripts_to_load'][] = 'analyze_view_rendementen.js';
        $this->data['styles_to_load'][] = 'analyze_view.scss';
        $this->data['content'] = view('analyze_view', $data2);
        return view('template', $this->data);
    }

    public function getTableInfoToday()
    {
        $line_array = $this->analyze_model->readFile();
        $my_array = $this->analyze_model->fileColumnArrays($line_array)[8];
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
        $line_array = $this->analyze_model->readFile();
        $my_array = $this->analyze_model->fileColumnArrays($line_array)[7];
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
        $line_array = $this->analyze_model->readFile();
        $my_array = $this->analyze_model->fileColumnArrays($line_array)[4];
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

    public function calculateAveragePlannedHours($my_array){
        $average_planned_hours = array();
        $line_number = 1;
        $average_planned_hours_complete = 0;
        $count_complete = 0;
        $average_planned_hours_in_progress = 0;
        $count_in_progress = 0;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) != "" && isset($my_array[$line_number][6])){
                $average_planned_hours_complete+= ($my_array[$line_number][6]);
                $count_complete++;
            }
            else if (isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) == "" && isset($my_array[$line_number][6])){
                $average_planned_hours_in_progress+= ($my_array[$line_number][6]);
                $count_in_progress++;
            }
            $line_number++;
        endwhile;

        $average_planned_hours[0] = round($average_planned_hours_complete/$count_complete, 2, PHP_ROUND_HALF_UP);
        $average_planned_hours[1] = round($average_planned_hours_in_progress/$count_in_progress, 2, PHP_ROUND_HALF_UP);
        return $average_planned_hours;
    }

    public function calculateAverageWorkedHours($my_array){
        $average_worked_hours = array();
        $line_number = 1;
        $average_worked_hours_complete = 0;
        $count_complete = 0;
        $average_worked_hours_in_progress = 0;
        $count_in_progress = 0;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) != "" && isset($my_array[$line_number][5])){
                $average_worked_hours_complete+= ($my_array[$line_number][5]);
                $count_complete++;
            }
            else if (isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) == "" && isset($my_array[$line_number][5])){
                $average_worked_hours_in_progress+= ($my_array[$line_number][5]);
                $count_in_progress++;
            }
            $line_number++;
        endwhile;

        $average_worked_hours[0] = round($average_worked_hours_complete/$count_complete, 2, PHP_ROUND_HALF_UP);
        $average_worked_hours[1] = round($average_worked_hours_in_progress/$count_in_progress, 2, PHP_ROUND_HALF_UP);
        return $average_worked_hours;
    }

    public function calculateAmountOvertime($my_array){
        $amount_overtime = array();
        $line_number = 1;
        $amount_overtime_complete = 0;
        $amount_overtime_in_progress = 0;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) != "" && isset($my_array[$line_number][5]) && isset($my_array[$line_number][6])){
                if(($my_array[$line_number][5] - $my_array[$line_number][6]) > 0){
                    $amount_overtime_complete++;
                }
            }
            else if (isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) == "" && isset($my_array[$line_number][5]) && isset($my_array[$line_number][6])){
                if(($my_array[$line_number][5] - $my_array[$line_number][6]) > 0) {
                    $amount_overtime_in_progress++;
                }
            }
            $line_number++;
        endwhile;

        $amount_overtime[0] = $amount_overtime_complete;
        $amount_overtime[1] = $amount_overtime_in_progress;
        return $amount_overtime;
    }

    public function calculateAmountMontage($my_array){
        $amount_montage = array();
        $line_number = 1;
        $amount_montage_complete = 0;
        $amount_montage_in_progress = 0;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) != ""){
                    $amount_montage_complete++;
            }
            else if (isset($my_array[$line_number][3]) && trim($my_array[$line_number][3]) == ""){
                    $amount_montage_in_progress++;
            }
            $line_number++;
        endwhile;

        $amount_montage[0] = $amount_montage_complete;
        $amount_montage[1] = $amount_montage_in_progress;
        return $amount_montage;
    }

    public function getCurrentRendementData(){
        $line_array = $this->rendement_model->readFile();
        $my_array = $this->rendement_model->fileColumnArrays($line_array)[4];
        $output_array = array();
        $sorted_output_array = array();
        $line_number = 1;
        $status = "";
        while ($line_number < sizeof($my_array)):
            $temp = array();
            if(isset($my_array[$line_number][0])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][0]));
            }
            if((isset($my_array[$line_number][3])) && (trim($my_array[$line_number][3]) == "")) {
                $temp[] = utf8_encode(trim($my_array[$line_number][3]));
            }
            if(isset($my_array[$line_number][4])) {
                $value = utf8_encode(trim($my_array[$line_number][4]));
                if($value == ""){
                    $temp[] = "buffer";
                }
                else{
                    $temp[] = $value;
                }
            }
            if(isset($my_array[$line_number][5]) && isset($my_array[$line_number][6])) {
                $worked =   intval(trim($my_array[$line_number][5]));
                $planned =  intval(trim($my_array[$line_number][6]));

                if ($worked > $planned){
                    $status = "dringend";
                }
                else{
                    $status = "OK";
                }
                $temp[] = $worked;
                $temp[] = $planned;
            }
            if(isset($my_array[$line_number][7]) && isset($my_array[$line_number][8])) {
                $temp[] = utf8_encode(trim($my_array[$line_number][7]));
                $temp[] = utf8_encode(trim($my_array[$line_number][8]));
            }
            if (sizeof($temp) != 7){
                array_splice($temp, 1, 1);
            }
            if ($status != "OK" && trim($my_array[$line_number][3]) == ""){
                $output_array[] = $temp;
            }
            $line_number++;
        endwhile;

        for ($i = 0; $i < sizeof($output_array); $i++){
            $current_chassis = $output_array[$i];
            $diff = $current_chassis[3] - $current_chassis[4];
            if (sizeof($sorted_output_array) == 0){
                $sorted_output_array[] = $current_chassis;
            }
            elseif (sizeof($sorted_output_array) == 1){
                $sorted_chassis = $sorted_output_array[0];
                $sorted_diff = $sorted_chassis[3] - $sorted_chassis[4];
                if ($diff > $sorted_diff){
                    array_splice( $sorted_output_array, 0, 0, array($current_chassis));
                }
                else{
                    array_splice( $sorted_output_array, 1, 0, array($current_chassis));
                }
            }
            else{
                for($j = 0; $j < sizeof($sorted_output_array) ; $j++){
                    $sorted_chassis = $sorted_output_array[$j];
                    if ($j+1 < sizeof($sorted_output_array)){
                        $next_sorted_chassis = $sorted_output_array[($j+1)];
                    }
                    else{
                        $next_sorted_chassis = $sorted_output_array[sizeof($sorted_output_array)-1];
                    }
                    $sorted_diff = $sorted_chassis[3] - $sorted_chassis[4];
                    $next_sorted_diff = $next_sorted_chassis[3] - $next_sorted_chassis[4];
                    if (($diff <= $sorted_diff) && ($diff > $next_sorted_diff)){
                        $sorted_output_array[] = $current_chassis;
                    }
                    elseif ($diff < $next_sorted_diff){
                        $sorted_output_array[] = $current_chassis;
                    }
                }
            }

        }
        return json_encode($sorted_output_array);
    }



}