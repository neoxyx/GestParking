<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Users_model extends CI_Model {

    public function get_user($user) {
        $where = array('Users.user' => $user);
        $sql = $this->db->select('*')->from('Users')->join('Roles', 'Roles.idRol=Users.idRol')->where($where)->get();
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }

}
