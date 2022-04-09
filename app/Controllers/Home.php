<?php

namespace App\Controllers;

use App\Models\BurgerModel;

class Home extends BaseController
{

    private $burger_menu;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->data['scripts_to_load'] = array(); //js used everywhere
        $this->data['styles_to_load'] = array(); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
    }

    public function map_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Map View');
        $data2["important_chassis"] = array(926,758,419,784,964,569,773,679,806,306,398,507,638,307,769,915,101,445);

        array_push($this->data['styles_to_load'], 'map_view.scss');
        $this->data['content'] = view('map_view', $data2);
        return view('template', $this->data);
    }

    public function chassis_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Chassis View');
        $data2["chassis_info"] = array();
        $handle = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)\TestFile.txt","r");
        if($handle) {
            while(($line = fgets($handle)) !== false) {
                $word_array = preg_split('/\s+/', $line);
                $data2["chassis_info"] = $word_array;
            }
            fclose($handle);
        }

        array_push($this->data['styles_to_load'], 'chassis_view.scss');
        $this->data['content'] = view('chassis_view', $data2);
        return view('template', $this->data);
    }

    public function analyze_view()
    {
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Analyze View');
        array_push($this->data['styles_to_load'], 'analyze_view.scss');
        $this->data['content'] = view('analyze_view');
        return view('template', $this->data);
    }
}
