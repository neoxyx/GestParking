<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Roles_model extends CI_Model {

    public function get_roles() {
        $sql = $this->db->select('*')->from('Roles')->get();
        if ($sql->num_rows() > 0) {
            return $sql->result();
        } else {
            return FALSE;
        }
    }
   

}
