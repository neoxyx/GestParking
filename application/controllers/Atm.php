<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Atm extends CI_Controller {

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
        $this->load->view('templates/lte/atm');
    }

    public function in() {
        $this->load->helper('date');
        $this->load->view('templates/lte/in');
    }

    public function out() {
        $this->load->view('templates/lte/out');
    }

    public function get_registry() {
        $this->load->model(array('Vehicles_model','Records_model'));
        $placa = $this->input->get("placa");
        $vehicle = $this->Vehicles_model->get_vehicle($placa);
        if ($vehicle) {
            $data['vehicle'] = $this->Vehicles_model->get_vehicle($placa);
            $data['record'] = $this->Records_model->get_last_record($vehicle->idVehicle);
            $resultadosJson = json_encode($data);
            echo $_GET["jsoncallback"] . '(' . $resultadosJson . ');';
        }
    }

    public function set_registry() {
        $this->load->model(array('Vehicles_model', 'Records_model'));
        $placa = $this->input->post("placa");
        $vehicle = $this->Vehicles_model->get_vehicle($placa);
        if ($vehicle) {
            $post_vehicle = array(
                'color' => $this->input->post('color'),
                'observations' => $this->input->post('obsv')
            );
            $this->Vehicles_model->update_vehicle($placa, $post_vehicle);

            $record = array(
                'date_in' => $this->input->post('date_in'),
                'hour_in' => $this->input->post('hour_in'),
                'idVehicle' => $vehicle->idVehicle
            );
            $this->Records_model->set_record($record);
            $res = 'Ingreso realizado exitosamente';
        } else {
            $post_vehicle = array(
                'plate' => $this->input->post('placa'),
                'opt' => $this->input->post('opc'),
                'color' => $this->input->post('color'),
                'observations' => $this->input->post('obsv'),
                'idType' => $this->input->post('type')
            );
            $idVehicle = $this->Vehicles_model->set_vehicle($post_vehicle);
            if ($idVehicle != FALSE) {
                $record = array(
                    'date_in' => $this->input->post('date_in'),
                    'hour_in' => $this->input->post('hour_in'),
                    'idVehicle' => $idVehicle
                );
                $this->Records_model->set_record($record);
                $res = 'Ingreso realizado exitosamente';
            } else {
                $res = 'Error en bbdd';
            }
        }
        echo $res;
    }

    public function set_registry_out() {
        $this->load->model(array('Vehicles_model', 'Records_model'));
        $placa = $this->input->post("placa");
        $idVehicle = $this->Vehicles_model->get_vehicle($placa)->idVehicle;
        $record = array(
            'date_out' => $this->input->post('date_out'),
        );
        $this->Records_model->update_record($idVehicle,$record);
        $res = 'Salida registrada exitosamente';
        echo $res;
    }

}
