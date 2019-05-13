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
    
    public function get_rate($id) {
        $where = array('Types_vehicles.idType' => $id);
        $sql = $this->db->select('*')->from('Types_vehicles')->where($where)->get();
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }   
    
    public function update($id,$param) {
        $this->db->where('idType',$id);
        $res = $this->db->update('Types_vehicles',$param);
        if($res){
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
