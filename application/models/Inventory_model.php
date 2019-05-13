<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Inventory_model extends CI_Model {

    public function get_inventory_day() {
        $where = array('Records.date_out' => NULL);
        $sql = $this->db->select('*')->from('Records')
                ->join('Vehicles', 'Records.idVehicle=Vehicles.idVehicle')
                ->join('Types_vehicles', 'Vehicles.idType=Types_vehicles.idType')
                ->where($where)->get();
        if ($sql->num_rows() > 0) {
            return $sql->result();
        } else {
            return FALSE;
        }
    }    

}
