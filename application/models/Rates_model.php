<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Rates_model extends CI_Model {

    public function get_rates() {
        $sql = $this->db->select('*')->from('Types_vehicles')->get();
        if ($sql->num_rows() > 0) {
            return $sql->result();
        } else {
            return FALSE;
        }
    }    

}
