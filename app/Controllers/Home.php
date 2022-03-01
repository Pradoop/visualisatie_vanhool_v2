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
        return $this->chassis_home();
    }

    public function chassis_home()
    {
        $this->data['content'] = view('main_visualisation');
        array_push($this->data['styles_to_load'], 'main_visualisation.scss');
        return view('template', $this->data);
    }

    public function chassis_list()
    {
        return view('template');
    }
}
