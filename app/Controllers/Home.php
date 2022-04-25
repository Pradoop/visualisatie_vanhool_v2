<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\FileModel;

class Home extends BaseController
{

    private $burger_menu;
    private $file_model;
    private $data;
    private $total_in_production;

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
        $data2["chassis_info"] = $this->file_model->readFile();

        array_push($this->data['scripts_to_load'], 'map_view.js');
        array_push($this->data['styles_to_load'], 'map_view.scss');
        $this->data['content'] = view('map_view', $data2);
        return view('template', $this->data);
    }

    public function chassis_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Chassis');
        $data2["chassis_info"] = $this->file_model->readFile();

        array_push($this->data['scripts_to_load'], 'chassis_view.js');
        array_push($this->data['styles_to_load'], 'chassis_view.scss');
        $this->data['content'] = view('chassis_view', $data2);
        return view('template', $this->data);
    }

    public function analyze_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Analyze');
        $data2["chassis_info"] = $this->file_model->readFile();

        $total_in_production = $this->calculateTotalInProduction();
        $data2["total_in_production"] = $total_in_production;

        array_push($this->data['scripts_to_load'], 'analyze_view.js');
        array_push($this->data['styles_to_load'], 'analyze_view.scss');
        $this->data['content'] = view('analyze_view', $data2);
        return view('template', $this->data);
    }

    /*
     * Function to calculate total amount of chassis in production.
     * Input: Array from which is being read
     * Output: Total amount of chassis in production
     * Explanation: Function searches based on the following statuses:
     * 38, 07, 83, 85, 86, 8, 81. If there is a match, then the chassis is in production
     */
    public function calculateTotalInProduction(){
        $line_number = 1;
        $total_produced = 0;
        $chassis_info = $this->file_model->readFile();
        while ($line_number < sizeof($chassis_info)):
            switch ($chassis_info[$line_number][14]){
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

}
