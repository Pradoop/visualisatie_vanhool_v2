<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\AnalyzeModel;

class ChassisController extends BaseController
{
    private $burger_menu;
    private $analyze_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->analyze_model = new AnalyzeModel();
        $this->data['scripts_to_load'] = array('jquery-3.6.0.min.js','bootstrap.bundle.min.js'); //js used everywhere
        $this->data['styles_to_load'] = array('bootstrap.min.css'); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
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

    public function getChassisInfo(): array
    {
        $line_array = $this->analyze_model->readFile();
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