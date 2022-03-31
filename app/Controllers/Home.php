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
        $data2["important"] = array(926, 758, 419, 784, 964);
        $data2["total"] = array(926, 758, 419, 784, 964, 569, 773, 679, 806, 306, 398, 507, 638, 307, 769, 915);

        array_push($this->data['styles_to_load'], 'main_visualisation.scss');
        $this->data['content'] = view('main_visualisation', $data2);
        return view('template', $this->data);
    }

    public function detailed_view()
    {
        return view('template');
    }
}
