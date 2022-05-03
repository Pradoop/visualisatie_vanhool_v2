<?php

namespace App\Models;

class FileModel extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    public function readFile()
    {
        $main_arrays = array();
        $file_by_line_array = array();
        $status_array = array();
        $wdTeLaat_array = array();
        $standLas_array = array();
        $dtmGepland_array = array();
        $wagennr_dtmGepland_array = array();

        /*
        * Opens full txtFile and puts each file line as 1 string in array element
        */
        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                array_push($file_by_line_array, $line);
            }
            fclose($file);
        }

        /*
        * Opens small txtFile and gets the status of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[15],$array[16],$array[17],$array[18],$array[19]);
            array_push($status_array, $array);
        }

        /*
        * Opens small txtFile and gets the wdTeLaat of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[17],$array[18],$array[19]);
            array_push($wdTeLaat_array, $array);
        }

        /*
        * Opens small txtFile and gets the standLas of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[19]);
            array_push($standLas_array, $array);
        }

        /*
        * Opens small txtFile and gets the dtmGepland of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[18],$array[19]);
            array_push($dtmGepland_array, $array);
        }

        /*
        * Opens small txtFile and gets the wagennr and dtmGepland of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[18],$array[19]);
            array_push($wagennr_dtmGepland_array, $array);
        }

        array_push($main_arrays, $file_by_line_array);
        array_push($main_arrays, $status_array);
        array_push($main_arrays, $wdTeLaat_array);
        array_push($main_arrays, $standLas_array);
        array_push($main_arrays, $dtmGepland_array);
        array_push($main_arrays, $wagennr_dtmGepland_array);

        return $main_arrays;
    }

}