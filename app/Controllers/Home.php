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

        $data2["total_in_production"]  = $this->file_model->calculateTotalInProduction($data2["chassis_info"]);
        $data2["average_delay"] = $this->file_model->calculateAverageDelay($data2["chassis_info"]);
        $data2["percentage_delayed"] = $this->file_model->calculatePercentageDelayed($data2["chassis_info"]);
        $data2["welding_percentages"] = $this->file_model->calculateWeldingPercentages($data2["chassis_info"]);

        array_push($this->data['scripts_to_load'], 'analyze_view.js');
        array_push($this->data['styles_to_load'], 'analyze_view.scss');
        $this->data['content'] = view('analyze_view', $data2);
        return view('template', $this->data);
    }


}
