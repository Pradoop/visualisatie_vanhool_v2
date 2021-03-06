<?php

namespace App\Controllers;

use App\Models\BurgerModel;
use App\Models\RendementModel;

class RendementController extends BaseController
{
    private BurgerModel $burger_menu;
    private RendementModel $werkuren_model;
    private $data;

    public function __construct()
    {
        $this->burger_menu = new BurgerModel();
        $this->werkuren_model = new RendementModel();
        $this->data['scripts_to_load'] = array('jquery-3.6.0.min.js', 'bootstrap.bundle.min.js'); //js used everywhere
        $this->data['styles_to_load'] = array('bootstrap.min.css'); //css used everywhere
    }

    public function index()
    {
        return $this->map_view();
    }

    public function rendement_view(): string
    {
        $this->data['title_tab'] = 'Rendementen';
        $this->data['burger_menu'] = $this->burger_menu->get_menuitems('Rendementen');
        $data2["file_lines"] = $this->werkuren_model->readFile();

        $data2["data_lines"] = $this->getRendementInfo();

        array_push($this->data['scripts_to_load'], 'rendement_view.js', 'jquery.dataTables.min.js', 'date-uk.js', 'percent.js', 'searchBar.js');
        array_push($this->data['styles_to_load'], 'rendement_view.scss', 'jquery.dataTables.min.css');
        $this->data['content'] = view('rendement_view', $data2);
        return view('template', $this->data);
    }

    public function getRendementInfo(): array
    {
        $line_array = $this->werkuren_model->readFile();
        $primary_array = array();
        $line_number = 1;
        while($line_number < sizeof($line_array)) {
            $array = preg_split('/\t/', $line_array[$line_number]);
            if(isset($array[0]) && isset($array[2]) && isset($array[3]) && isset($array[4]) && isset($array[5]) && isset($array[6]) && isset($array[7]) && isset($array[8]) && isset($array[9]) && isset($array[10]) && isset($array[11])) {
                $datumInMontParts = str_split($array[2], 2);
                $datumInMont = $datumInMontParts[0].'/'.$datumInMontParts[1].'/'.$datumInMontParts[2];

                if($array[3] != '      ') {
                    $datumInMontAfParts = str_split($array[3], 2);
                    $datumInMontAf = $datumInMontAfParts[0].'/'.$datumInMontAfParts[1].'/'.$datumInMontAfParts[2];
                }
                else {
                    $datumInMontAf = ' ';
                }

                if($array[6] != 0) {
                    $percentage = round(($array[5]/$array[6])*100,2).'%';
                }
                else {
                    $percentage = '0%';
                }

                $primary_string = $percentage.'!'.$array[5].'!'.$array[6].'!'.$array[0].'!'.$array[4].'!'.$array[7].'!'.$array[8].'!'.$array[10].'!'.$array[11].'!'.$array[9].'!'.$datumInMont.'!'.$datumInMontAf;
                //$primary_string = $array[0].'!'.$datumInMont.'!'.$datumInMontAf.'!'.$array[4].'!'.$array[5].'!'.$array[6].'!'.$array[7].'!'.$array[8].'!'.$array[9].'!'.$array[10].'!'.$array[11];
                $primary_array[] = $primary_string;

            }
            $line_number++;
        }
        return $primary_array;
    }

}