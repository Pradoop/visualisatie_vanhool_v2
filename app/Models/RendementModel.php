<?php

namespace App\Models;

class RendementModel extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    public function readFile(): array
    {
        /*
        * Medium txtFile with columns: Wagen,DLnr,DatumInMont,DatumMontAf,Info,Gewerkt,Gepland,NaamKlant,NaamType,Natie,ReeksVan,ReeksTot
        */
        $werkurenMontOpl_array = array();
        $file = fopen("D:\KU Leuven Group T\Master in de industriele wetenschappen elektronica-ICT\Gemeenschappelijk deel\Master's Thesis (20sp)\WerkurenMontOpl.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $werkurenMontOpl_array[] = $line;
            }
            fclose($file);
        }

        return $werkurenMontOpl_array;
    }

    public function fileColumnArrays($file_by_line_array): array
    {
        $main_arrays = array();
        $geplande_uren_array = array();
        $gewerkte_uren_array = array();
        $uren_array = array();
        $montage_array = array();
        $chassis_info_array = array();
        $rendement_info_array = array();


        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[5],$array[7],$array[8],$array[9],$array[10],$array[11]);
            $geplande_uren_array[] = $array;
        }

        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11]);
            $gewerkte_uren_array[] = $array;
        }

        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[7],$array[8],$array[9],$array[10],$array[11]);
            $uren_array[] = $array;
        }

        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4], $array[5], $array[6], $array[7],$array[8],$array[9],$array[10],$array[11]);
            $montage_array[] = $array;
        }

        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[9],$array[10],$array[11]);
            $chassis_info_array[] = $array;
        }

        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[10],$array[11]);
            $rendement_info_array[] = $array;
        }

        $main_arrays[] = $geplande_uren_array;
        $main_arrays[] = $gewerkte_uren_array;
        $main_arrays[] = $uren_array;
        $main_arrays[] = $montage_array;
        $main_arrays[] = $chassis_info_array;
        $main_arrays[] = $rendement_info_array;

        return $main_arrays;

    }


}