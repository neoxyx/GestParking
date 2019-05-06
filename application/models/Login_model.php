<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Login_model extends CI_Model {

    public function very_sesion($user,$passw) {

        $sql = $this->db->get_where('Users', array('user' => $user,
            'passw' => sha1($passw)));

        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }

}
