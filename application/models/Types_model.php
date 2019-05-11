<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Types_model extends CI_Model {

    public function get_types() {
        $res = $this->db->get('Types_vehicles');
        if ($res->num_rows() > 0) {
            return $res->result();
        } else {
            return FALSE;
        }
    }

    public function update_record($idVehicle, $data) {
        $this->db->where('idVehicle', $idVehicle);
        $this->db->where('date_out', NULL);
        $this->db->update('Records', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_last_record($idVehicle) {
        $sql = $this->db->get_where('Records', array('idVehicle' => $idVehicle, 'date_out' => NULL));
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }

}
