<?php

namespace App\Models;

class MapModel extends \CodeIgniter\Model
{
    /*
* Opens txtFile and puts each file line as 1 string in array element
*/
    public function readFile()
    {
        /*
        * Small txtFile with columns: wagen,DLnr,Kaliber,NaamFase,NaamKlant,NaamType,Natie,StandInProd,ReeksVan,ReeksTot
        */
        $chassisInKaliberIV_array = array();
        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\ChassisInKaliberIV.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $chassisInKaliberIV_array[] = $line;
            }
            fclose($file);
        }

        return $chassisInKaliberIV_array;
    }

    public function fileColumnArrays($file_by_line_array){

    }
}