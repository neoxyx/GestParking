<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Vehicles_model extends CI_Model {

    public function get_vehicle($placa) {
        $where = array('Vehicles.placa' => $placa);
        $sql = $this->db->select('*')->from('Vehicles')->join('Types_vehicles', 'Types_vehicles.idType=Vehicles.idType')->where($where)->get();
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }

    public function set_vehicle($vehicle) {

        $this->db->insert('Vehicles', $vehicle);
        if ($this->db->affected_rows() > 0) {
            return $this->db->insert_id();
        } else {
            return FALSE;
        }
    }

    public function update_vehicle($placa, $data) {
        $this->db->where('placa', $placa);
        $this->db->update('Vehicles', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
