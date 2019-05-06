<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Records_model extends CI_Model {

    public function set_record($record) {
        
        $this->db->insert('Records', $record);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function update_record($idVehicle,$data) {
        $this->db->where('idVehicle',$idVehicle);
        $this->db->where('date_out',NULL);
        $this->db->update('Records', $data);
        if ($this->db->affected_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
