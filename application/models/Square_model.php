<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Square_model extends CI_Model {

    public function get_square_day() {
        $where = array('Records.date_out' => date('Y-m-d'));
        $res = $this->db->select('*')->from('Records')->join('Vehicles', 'Vehicles.idVehicle=Records.idVehicle')->where($where)->get();
        if ($res->num_rows() > 0) {
            return $res->result();
        } else {
            return FALSE;
        }
    }

}
