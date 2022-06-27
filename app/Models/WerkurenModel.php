<?php

namespace App\Models;

class WerkurenModel extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    public function readFile(){
        /*
        * Medium txtFile with columns: Wagen,DLnr,DatumInMont,DatumMontAf,Info,Gewerkt,Gepland,NaamKlant,NaamType,Natie,ReeksVan,ReeksTot
        */
        $werkurenMontOpl_array = array();
        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\WerkurenMontOpl.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $werkurenMontOpl_array[] = $line;
            }
            fclose($file);
        }

        return $werkurenMontOpl_array;
    }

    public function fileColumnArrays($file_by_line_array){

    }


}