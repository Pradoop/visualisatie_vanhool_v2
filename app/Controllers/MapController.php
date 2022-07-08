<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\AnalyzeModel;
use App\Models\MapModel;

class MapController extends BaseController
{

    private BurgerModel $burger_menu;
    private AnalyzeModel $analyze_model;
    private MapModel $map_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->analyze_model = new AnalyzeModel();
        $this->map_model = new MapModel();
        $this->data['scripts_to_load'] = array('jquery-3.6.0.min.js','bootstrap.bundle.min.js'); //js used everywhere
        $this->data['styles_to_load'] = array('bootstrap.min.css'); //css used everywhere
    }

    public function index(): string
    {
        return $this->map_view();
    }

    public function map_view(): string
    {
        $this->data['title_tab'] = 'Plattegrond';
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Plattegrond');

        $data2["ChassisInKaliberIV"] = $this->map_model->readFile();

        $this->data['scripts_to_load'][] = 'map_view.js';
        $this->data['styles_to_load'][] = 'map_view.scss';
        $this->data['content'] = view('map_view', $data2);
        return view('template', $this->data);
    }

    public function getChassisMap()
    {
        $line_array = $this->analyze_model->readFile();
        $status_hal = array('07','83','85','86','8','81');
        $status_wait = array('38');//TODO

        $output_array = array();
        $hal_array = array();
        $wait_array = array();

        foreach($line_array as $line) {
            $array = preg_split('/\t/', $line);
            if(isset($array[14]) && in_array($array[14], $status_hal)) {
                $hal_array[] = utf8_encode($line);
            }
            else if(isset($array[14]) && in_array($array[14], $status_wait)) {
                $wait_array[] = utf8_encode($line);
            }
        }

        $output_array[] = $hal_array;
        $output_array[] = $wait_array;

        return json_encode($output_array);
    }

}
