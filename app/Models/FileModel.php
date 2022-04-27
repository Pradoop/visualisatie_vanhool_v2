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

        /*
        * Opens full txtFile and puts each file line as 1 string in array element
        */
        $file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/planningMontage.txt", "r");
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
        $file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($status_array, $array[14]);
            }
            fclose($file);
        }

        /*
        * Opens small txtFile and gets the wdTeLaat of each line in array
        */
        $file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($wdTeLaat_array, $array[16]);
            }
            fclose($file);
        }

        /*
        * Opens small txtFile and gets the standLas of each line in array
        */
        $file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($standLas_array, $array[18]);
            }
            fclose($file);
        }

        /*
        * Opens small txtFile and gets the dtmGepland of each line in array
        */
        $file = fopen("C:\Users\Yanni\OneDrive\Documenten\Master's Thesis (20sp)/VanHoolTestFile.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $array = preg_split('/\t/', $line);
                array_push($dtmGepland_array, $array[3]);
            }
            fclose($file);
        }

        array_push($main_arrays, $file_by_line_array);
        array_push($main_arrays, $status_array);
        array_push($main_arrays, $wdTeLaat_array);
        array_push($main_arrays, $standLas_array);
        array_push($main_arrays, $dtmGepland_array);
        return $main_arrays;
    }

}