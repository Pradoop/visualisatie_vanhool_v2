<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\FileModel;

class Home extends BaseController
{

    private $burger_menu;
    private $file_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->file_model = new FileModel();
        $this->data['scripts_to_load'] = array('jquery.min.js','bootstrap.bundle.min.js'); //js used everywhere
        $this->data['styles_to_load'] = array('bootstrap.min.css'); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
    }

    public function map_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Map');
        $data2["chassis_info"] = $this->file_model->readFile()[0];

        array_push($this->data['scripts_to_load'], 'map_view.js');
        array_push($this->data['styles_to_load'], 'map_view.scss');
        $this->data['content'] = view('map_view', $data2);
        return view('template', $this->data);
    }

    public function chassis_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Chassis');
        $data2["chassis_info"] = $this->file_model->readFile()[0];

        array_push($this->data['scripts_to_load'], 'chassis_view.js');
        array_push($this->data['styles_to_load'], 'chassis_view.scss');
        $this->data['content'] = view('chassis_view', $data2);
        return view('template', $this->data);
    }

    public function analyze_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Analyze');
        $data2["chassis_info"] = $this->file_model->readFile();

        $data2["total_in_production"]  = $this->calculateTotalInProduction($this->file_model->readFile()[1]);
        $data2["percentage_delayed"] = $this->calculatePercentageDelayed($this->file_model->readFile()[2]);
        $data2["average_delay"] = $this->calculateAverageDelay($this->file_model->readFile()[2]);
        $data2["welding_percentages"] = $this->calculateWeldingData();
        $data2["chassis_phase"] = $this->calculateChassisPerPhase($this->file_model->readFile()[2]);

        array_push($this->data['scripts_to_load'], 'analyze_view.js');
        array_push($this->data['styles_to_load'], 'analyze_view.scss');
        $this->data['content'] = view('analyze_view', $data2);
        return view('template', $this->data);
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
            switch ($my_array[$line_number]){
                case 07:
                case 03:
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
    * Function to calculate the percentage of all chassis that are delayed.
    * Input: Array that contains all the information (so the textfile)
    * Output: Percentage of chassis that are delayed overall
    * Explanation: Function calculates the percentage of chassis that is delayed
    */
    public function calculatePercentageDelayed($my_array){
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

    /* Function to calculate the percentages of cars to be welded by hand, to be welded using the robot,
     * finished welding by robot, or to be decided in general
     * Input: Array that contains all the information (so the textfile)
     * Output: Returns an array with the amount of chassis for each possibility
     * Explanation: array initialized with the different possibilities, which are abbreviations of the variables
     * based on value of the column, they are added in the list.
     */
    public function calculateWeldingData()
    {
        $my_array = $this->file_model->readFile()[3];
        $line_number = 1;
        $to_be_decided = 0;
        $manual_welding = 0;
        $prep_robot = 0;
        $finish_robot = 0;

        while ($line_number < sizeof($my_array)):
            switch ($my_array[$line_number]) {
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

    public function calculateChassisPerPhase($my_array){
        $line_number = 1;
        $verkocht = 0;
        $studie_start = 0;
        $studie_afgewerkt = 0;
        $studie_gefinalizeerd = 0;
        $start_seriploeg = 0;
        $prognose_prefab = 0;
        $prognose_basisserie = 0;
        $klaar_voor_montage = 0;
        $start_kaliber = 0;
        $einde_kaliber = 0;
        $start_lasrobot = 0;
        $start_aflassen = 0;
        $morgen_af_montage = 0;
        $vandaag_af_montage = 0;

        while ($line_number < sizeof($my_array)):
            switch ($my_array[$line_number]){
                case 01:
                    $verkocht++;
                    break;
                case 02:
                    $studie_start++;
                    break;
                case 20:
                    $studie_afgewerkt++;
                    break;
                case 03:
                    $studie_gefinalizeerd++;
                    break;
                case 04:
                    $start_seriploeg++;
                    break;
                case 40:
                    $prognose_prefab++;
                    break;
                case 39:
                    $prognose_basisserie++;
                    break;
                case 38:
                    $klaar_voor_montage++;
                    break;
                case 07:
                    $start_kaliber++;
                    break;
                case 83:
                    $einde_kaliber++;
                    break;
                case 85:
                    $start_lasrobot++;
                    break;
                case 86:
                    $start_aflassen++;
                    break;
                case 8:
                    $morgen_af_montage++;
                    break;
                case 81:
                    $vandaag_af_montage++;
                    break;
            }
            $line_number++;
        endwhile;

        return [
            "v" => $verkocht,
            "stu_sta" => $studie_start,
            "stu_af" => $studie_afgewerkt,
            "stu_fin" => $studie_gefinalizeerd,
            "sta_se" => $start_seriploeg,
            "pr_pre" => $prognose_prefab,
            "pr_bas" => $prognose_basisserie,
            "kl_mo" => $klaar_voor_montage,
            "s_ka" => $start_kaliber,
            "e_ka" => $einde_kaliber,
            "sta_las" => $start_lasrobot,
            "sta_afl" => $start_aflassen,
            "mo_mont" => $morgen_af_montage,
            "va_mont" => $vandaag_af_montage,
        ];

    }

}
