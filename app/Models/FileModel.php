<?php

namespace App\Models;

class FileModel extends \CodeIgniter\Model
{

    public function __construct()
    {

    }

    /*
    * Opens txtFile and puts each file line as 1 string in array element
    */
    public function readFile()
    {
        $files_array = array();

        /*
        * Large txtFile with columns: Wagen,Ew,Aantal,dtmGepland,wagtyp,naamWagTyp,KlantNr,naamKlant,Land,LijnNr,ReeksVan,Afdeling,Galva,DLnr,Status,CntrDtm,wdTeLaat,wdInMont,standLas
        */
        $planningMontage_array = array();
        $file = fopen("C:\Users\pradk\Documents\Uni\Thesis\planningMontage.txt", "r");
        if($file) {
            while(!feof($file)) {
                $line = fgets($file);
                $planningMontage_array[] = $line;
            }
            fclose($file);
        }

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

        $files_array[] = $planningMontage_array;
        $files_array[] = $chassisInKaliberIV_array;
        $files_array[] = $werkurenMontOpl_array;

        return $files_array;
    }

    public function fileColumnArrays($file_by_line_array)
    {
        $main_arrays = array();
        $status_array = array();
        $wdTeLaat_array = array();
        $standLas_array = array();
        $dtmGepland_array = array();
        $wagennr_dtmGepland_array = array();
        $wdInMont_array = array();
        $wagennr_dtmGepland_standLas_array = array();
        $galva_array = array();
        $table_info = array();

        /*
        * Gets the status of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[15],$array[16],$array[17],$array[18],$array[19]);
            $status_array[] = $array;
        }

        /*
        * Gets the dtmGepland and Status of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[15],$array[16], $array[17],$array[18],$array[19]);
            $wdTeLaat_array[] = $array;
        }

        /*
        * Gets the wdInMont of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[18],$array[19]);
            array_push($wdInMont_array, $array);
        }

        /*
        * Gets the standLas of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[19]);
            $standLas_array[] = $array;
        }

        /*
        * Gets the dtmGepland of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[18],$array[19]);
            $dtmGepland_array[] = $array;
        }

        /*
        * Gets the wagennr and dtmGepland of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[6],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[18],$array[19]);
            $wagennr_dtmGepland_array[] = $array;
        }

        /*
        * Gets the galva of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[0],$array[1],$array[2],$array[3],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[13],$array[14],$array[15],$array[16],$array[17],$array[18],$array[19]);
            $galva_array[] = $array;
        }

        /*
        * Gets the wagennr, dtmGepland and standLas of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[5],$array[6],$array[7],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[19]);
            array_push($wagennr_dtmGepland_standLas_array, $array);
        }

        /*
        * Gets the wagennr, dtmGepland and wagTyp and klantNaam of each line in array
        */
        foreach($file_by_line_array as $line) {
            $array = preg_split('/\t/', $line);
            unset($array[1],$array[2],$array[4],$array[6],$array[8],$array[9],$array[10],$array[11],$array[12],$array[13],$array[14],$array[15],$array[16],$array[17],$array[18],$array[19]);
            array_push($table_info, $array);
        }

        $main_arrays[] = $status_array;
        $main_arrays[] = $wdTeLaat_array;
        $main_arrays[] = $standLas_array;
        $main_arrays[] = $dtmGepland_array;
        $main_arrays[] = $wagennr_dtmGepland_array;
        $main_arrays[] = $galva_array;
        $main_arrays[] = $wdInMont_array;
        $main_arrays[] = $wagennr_dtmGepland_standLas_array;
        $main_arrays[] = $table_info;

        return $main_arrays;
    }

}