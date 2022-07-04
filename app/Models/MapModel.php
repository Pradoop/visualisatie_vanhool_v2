<?php

namespace App\Models;

class MapModel extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    /*
    * Opens txtFile and puts each file line as 1 string in array element
    */
    public function readFile(): array
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

}