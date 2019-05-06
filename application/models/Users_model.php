<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Users_model extends CI_Model {

    public function get_user($user) {
        
        $sql = $this->db->get('Users', array('user' => $user));

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }

}
