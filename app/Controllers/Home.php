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
