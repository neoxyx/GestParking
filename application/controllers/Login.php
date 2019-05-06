<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('Login_model','Users_model'));
    }

    public function index() {
        $data['msn'] = '';
        $this->load->view('login', $data);
    }

    public function very_sesion() {
        $user = $this->input->post('user');
        $passw = $this->input->post('passw');

        $variable = $this->Login_model->very_sesion($user, $passw);

        if ($variable != FALSE) {
            $user = $this->Users_model->get_user($user);
            if ($user) {
                $user_data = array(
                    'id' => $user->idUser,
                    'name' => $user->name,
                    'permits' => $user->idRol
                );
                redirect('Atm');
            }
        } else {
            $data['msn'] = 'Usuario y/o Contraseña erroneas';
            $this->load->view('login', $data);
        }
    }
    
    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    

}
