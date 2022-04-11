<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\FileHandler;

class Home extends BaseController
{

    private $burger_menu;
    private $file_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->file_model = new FileHandler();
        $this->data['scripts_to_load'] = array(); //js used everywhere
        $this->data['styles_to_load'] = array(); //css used everywhere
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

        array_push($this->data['styles_to_load'], 'chassis_view.scss');
        $this->data['content'] = view('chassis_view', $data2);
        return view('template', $this->data);
    }

    public function analyze_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Analyze');
        $data2["chassis_info"] = $this->file_model->readFile();

        array_push($this->data['styles_to_load'], 'analyze_view.scss');
        $this->data['content'] = view('analyze_view', $data2);
        return view('template', $this->data);
    }

}
