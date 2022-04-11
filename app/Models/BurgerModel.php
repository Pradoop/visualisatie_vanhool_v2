<?php

namespace App\Models;

class BurgerModel extends \CodeIgniter\Model
{
    private $menu_items_all;

    public function __construct()
    {
        $this->menu_items_all= array(
            array('name'=> 'Map', 'title' => 'map_hover', 'link'=>'map_view', 'className'=>'active'),
            array('name'=> 'Chassis', 'title' => 'chassis_hover', 'link'=>'chassis_view', 'className'=>'inactive'),
            array('name'=> 'Analyze', 'title' => 'analyze_hover', 'link'=>'analyze_view', 'className'=>'inactive'),
        );
    }

    private function set_active($menutitle)
    {
        $temp_array= & $this->menu_items_all;

        foreach ($temp_array as &$item) { //want to change so ref to item, call by ref
            if (strcasecmp($menutitle, $item['name']) == 0) {
                $item['className'] = 'active';
            } else {
                $item['className'] = 'inactive';
            }
        }
    }

    public function get_menuitems($menutitle)
    {
        $this->set_active($menutitle);
        return $this->menu_items_all;
    }
}
