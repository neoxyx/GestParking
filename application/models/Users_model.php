<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 *
 */
class Users_model extends CI_Model {

    public function get_users() {
        $sql = $this->db->select('*')->from('Users')->join('Roles', 'Roles.idRol=Users.idRol')->get();
        if ($sql->num_rows() > 0) {
            return $sql->result();
        } else {
            return FALSE;
        }
    }
    
    public function get_user($id) {
        $where = array('Users.idUser' => $id);
        $sql = $this->db->select('*')->from('Users')->join('Roles', 'Roles.idRol=Users.idRol')->where($where)->get();
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }
    
    public function get_user_xuser($user) {
        $where = array('Users.user' => $user);
        $sql = $this->db->select('*')->from('Users')->join('Roles', 'Roles.idRol=Users.idRol')->where($where)->get();
        if ($sql->num_rows() > 0) {
            return $sql->row();
        } else {
            return FALSE;
        }
    }
    
    public function add_user($data) {
        $this->db->insert('Users',$data);
        if($this->db->affected_rows()>0){
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    public function update($id,$param) {
        $this->db->where('idUser',$id);
        $res = $this->db->update('Users',$param);
        if($res){
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
