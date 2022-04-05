<?php

namespace App\Controllers;

class Home extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data['scripts_to_load'] = array(); //js used everywhere
        $this->data['styles_to_load'] = array(); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
    }

    public function map_view()
    {
        $data2["important_chassis"] = array(926,758,419,784,964,569,773,679,806,306,398,507,638,307,769,915,101,445);

        array_push($this->data['styles_to_load'], 'map_view.scss');
        $this->data['content'] = view('map_view', $data2);
        return view('template', $this->data);
    }

    public function chassis_view()
    {
        $data2["all_chassis"] = array(5,10,15,20,25,30,35,40,45,50,55,60,65,70,75,80,85,90,95,100,105,110,115,120,125,130,135,140,145,150,155,160,165,170,175,180,185,190,195,200);

        array_push($this->data['styles_to_load'], 'chassis_view.scss');
        $this->data['content'] = view('chassis_view', $data2);
        return view('template', $this->data);
    }

    public function analyze_view()
    {
        array_push($this->data['styles_to_load'], 'analyze_view.scss');
        $this->data['content'] = view('analyze_view');
        return view('template', $this->data);
    }
}
