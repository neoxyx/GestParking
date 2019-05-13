<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->model('Users_model');
        $this->load->model('Roles_model');
        $data['roles'] = $this->Roles_model->get_roles();
        $data['users'] = $this->Users_model->get_users();
        $this->load->view('templates/lte/users', $data);
    }

    public function add_user() {
        $this->load->model('Users_model');
        $session_data = $this->session->userdata('datos_usuario');
        if (!$session_data) {
            redirect('Login');
        }
        $data = array(
            'name' => $this->input->post('name'),
            'user' => $this->input->post('user'),
            'passw' => sha1($this->input->post('passw')),
            'idRol' => $this->input->post('rol')
        );
        $res = $this->Users_model->add_user($data);
        if ($res == TRUE) {
            echo 'ok';
        } else {
            echo 'error';
        }
    }

    public function edit() {
        $this->load->model('Users_model');
        $data['dato'] = $this->Users_model->get_user($this->input->get('id'));
        $this->load->view('templates/lte/edit_user', $data);
    }

    public function update() {
        $this->load->model('Users_model');
        $params = array(
            'passw' => sha1($this->input->post('passw')),
        );
        $res = $this->Users_model->update($this->input->post('id'), $params);
        if ($res) {
            echo "Actualización exitosa";
        } else {
            echo "error en bbdd";
        }
    }

}
