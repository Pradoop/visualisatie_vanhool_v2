<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\FileModel;

class RendementController extends BaseController
{
    private $burger_menu;
    private $file_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->file_model = new FileModel();
        $this->data['scripts_to_load'] = array('jquery-3.6.0.min.js', 'bootstrap.bundle.min.js'); //js used everywhere
        $this->data['styles_to_load'] = array('bootstrap.min.css'); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
    }

    public function rendement_view()
    {
        $this->data['title_tab'] = 'Rendementen';
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Rendementen');
        $data2["file_lines"] = $this->file_model->readFile()[0];


        array_push($this->data['scripts_to_load'], 'rendement_view.js');
        array_push($this->data['styles_to_load'], 'rendement_view.scss');
        $this->data['content'] = view('rendement_view', $data2);
        return view('template', $this->data);
    }
}