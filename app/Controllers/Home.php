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
        $this->data['scripts_to_load'] = array('jquery-3.6.0.min.js','bootstrap.bundle.min.js'); //js used everywhere
        $this->data['styles_to_load'] = array('bootstrap.min.css'); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
    }

    public function map_view()
    {
        $this->data['title_tab'] = 'Plattegrond';
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Plattegrond');

        $data2["ChassisInKaliberIV"] = $this->file_model->readFile()[1];
        $data2["chassisInMontage_array"] = $this->getChassisMap()[0];
        $data2["chassisInWachtkamer_array"] = $this->getChassisMap()[1];
        $data2["wdInMontageLimit"] = 0;

        $this->data['scripts_to_load'][] = 'map_view.js';
        $this->data['styles_to_load'][] = 'map_view.scss';
        $this->data['content'] = view('map_view', $data2);
        return view('template', $this->data);
    }

    public function chassis_view()
    {
        $this->data['title_tab'] = 'Overzicht';
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Overzicht');

        $data2["aantal_lines"] = $this->getChassisInfo();

        array_push($this->data['scripts_to_load'], 'chassis_view.js', 'jquery.dataTables.min.js', 'date-uk.js');
        array_push($this->data['styles_to_load'], 'chassis_view.scss', 'jquery.dataTables.min.css');
        $this->data['content'] = view('chassis_view', $data2);
        return view('template', $this->data);
    }

    public function analyze_view()
    {
        $this->data['title_tab'] = 'Dashboard';
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Dashboard');
        $data2["file_lines"] = $this->file_model->readFile()[0];

        $data2["total_in_production"]  = $this->calculateTotalInProduction($this->file_model->fileColumnArrays($data2["file_lines"])[0]);
        $data2["amount_delayed"] = $this->calculateAmountDelayed($this->file_model->fileColumnArrays($data2["file_lines"])[1]);
        $data2["planned_today"] = $this->calculatePlannedToday($this->file_model->fileColumnArrays($data2["file_lines"])[3]);
        $data2["avg_mont"] = $this->calculateAverageWdInMont($this->file_model->fileColumnArrays($data2["file_lines"])[6]);
        $data2["total_welding_info"] = $this->getWeldingData();
        $data2["welding_info"] = $this->calculateTotalWeldingData();
        $data2["chassis_phase"] = $this->calculateChassisPerPhase();
        $data2["planned_dates"] = $this->getPlannedTime();
        $data2["chassis_planned_dates"] = $this->getPlannedChassisAndTime();


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

    /* Function to calculate the amount of cars to be welded by hand, to be welded using the robot,
     * finished welding by robot, or to be decided in general
     * Input: Array that contains all the information (so the textfile)
     * Output: Returns an array with the amount of chassis for each possibility
     * Explanation: array initialized with the different possibilities, which are abbreviations of the variables
     * based on value of the column, they are added in the list.
     */
    public function calculateTotalWeldingData()
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[2];
        $line_number = 1;
        $to_be_decided = 0;
        $manual_welding = 0;
        $prep_robot = 0;
        $finish_robot = 0;

        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][18])) {
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
            }
            $line_number++;
        endwhile;

        return json_encode([
            "tbd" => $to_be_decided,
            "mw" => $manual_welding,
            "pr" => $prep_robot,
            "fr" => $finish_robot
        ]);

    }

    /* Function to calculate the amount of chassis in each phase,
     * Input: Array that contains all the information (so the textfile)
     * Output: Returns an array with the amount of chassis for each possibility
     * Explanation: array initialized with the different possibilities, which are abbreviations of the variables
     * based on value of the column, they are added in the list.
     */
    public function calculateChassisPerPhase()
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[0];
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
            if(isset($my_array[$line_number][14])) {
                switch ($my_array[$line_number][14]){
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
            }
            $line_number++;
        endwhile;

        return json_encode([
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
        ]);
    }

    public function getPlannedTime(): bool|string
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[3];
        $output_array = array();
        $line_number = 1;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][3])) {
                $output_array[] = strval($my_array[$line_number][3]);
            }
            $line_number++;
        endwhile;
        return json_encode($output_array);
    }

    public function getWeldingData(): bool|string
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[7];
        $output_array = array();
        $line_number = 1;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][0]) && isset($my_array[$line_number][3]) && isset($my_array[$line_number][18]) && strlen(trim($my_array[$line_number][18])) > 0) {
                $temp = array("chassis_nr"=>strval($my_array[$line_number][0]), "dtm_gepland"=>strval($my_array[$line_number][3]), "stand_las"=>strval($my_array[$line_number][18]));
                $output_array[] = $temp;
            }
            $line_number++;
        endwhile;
        return json_encode($output_array);
    }

    public function getPlannedChassisAndTime(): bool|string
    {
        $line_array = $this->file_model->readFile()[0];
        $my_array = $this->file_model->fileColumnArrays($line_array)[4];
        $output_array = array();
        $line_number = 1;
        while ($line_number < sizeof($my_array)):
            if(isset($my_array[$line_number][0])) {
                $output_array[] = strval($my_array[$line_number][0]);
            }
            if(isset($my_array[$line_number][3])) {
                $output_array[] = strval($my_array[$line_number][3]);
            }
            $line_number++;
        endwhile;
        return json_encode($output_array);
    }

    public function getChassisMap(): array
    {
        $line_array = $this->file_model->readFile()[0];
        $status_hal = array('07','83','85','86','8','81');//TODO
        $status_wait = array('38');//TODO

        $output_array = array();
        $hal_array = array();
        $wait_array = array();

        foreach($line_array as $line) {
            $array = preg_split('/\t/', $line);
            if(isset($array[14]) && in_array($array[14], $status_hal)) {
                $hal_array[] = $line;
            }
            else if(isset($array[14]) && in_array($array[14], $status_wait)) {
                $wait_array[] = $line;
            }
        }

        $output_array[] = $hal_array;
        $output_array[] = $wait_array;
        return $output_array;
    }

    public function getChassisInfo(): array
    {
        $line_array = $this->file_model->readFile()[0];
        $primary_array = array();
        $line_number = 1;
        while($line_number < sizeof($line_array)) {
            $array = preg_split('/\t/', $line_array[$line_number]);
            //Primary
            if(isset($array[3]) && isset($array[5]) && isset($array[7]) && isset($array[10]) && isset($array[12]) && isset($array[14]) && isset($array[17])) {
                $today = date("Y-m-d");
                $parts = str_split($array[3], 2);
                $gepland_new = $parts[2].'/'.$parts[1].'/'.$parts[0];
                $planned_date = '20'.$parts[0].'-'.$parts[1].'-'.$parts[2];
                $diff = strtotime($planned_date) - strtotime($today);

                $primary_string = $gepland_new.'!'.$array[0].'!'.$array[5].'!'.$array[7].'!'.$array[10].'!'.$array[12].'!'.round($diff/86400).'!'.$array[17].'!'.$array[14];
                $primary_array[] = $primary_string;
            }
            $line_number++;
        }

        return $primary_array;
    }

}
