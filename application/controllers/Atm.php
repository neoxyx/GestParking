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
        $this->load->model('Types_model');
        $data['types'] = $this->Types_model->get_types();
        $this->load->view('templates/lte/in', $data);
    }

    public function out() {
        $this->load->view('templates/lte/out');
    }

    public function get_registry() {
        $this->load->model(array('Vehicles_model', 'Records_model'));
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
        $vrrate = $this->input->post("vr");
        $dateIn = $this->input->post("date_in");
        $dateOut = $this->input->post("date_out");
        $hourIn = $this->input->post("hour_in");
        $hourOut = $this->input->post("hour_out");
        $Vehicle = $this->Vehicles_model->get_vehicle($placa);
        $record = array(
            'date_out' => $dateOut,
            'hour_out' => $hourOut
        );
        $this->Records_model->update_record($Vehicle->idVehicle, $record);
        $date1 = new DateTime($dateIn);
        $date2 = new DateTime($dateOut);
        $difDays = $date1->diff($date2);
        $hour1 = new DateTime($hourIn);
        $hour2 = new DateTime($hourOut);
        $totalSegundos = abs($hour1->getTimestamp() - $hour2->getTimestamp());
        $totalMinutos = $totalSegundos / 60;
        $totalHoras = $totalMinutos / 60;
        //echo $totalHoras;
        setlocale(LC_MONETARY, 'es_CO');
        $totalHorasFormat = number_format($totalHoras, 0, ".", ",");
        if ($Vehicle->idType == 1) {
            if ($totalHoras > 8.10 && $totalHoras < 16) {
                $vrtotal = $vrrate * 2;
            } else
            if ($totalHoras > 16.10 && $totalHoras <= 24) {
                $vrtotal = $vrrate * 3;
            } else
            if ($difDays->days > 0 && $totalHoras < 0.10) {
                $vrtotal = ($vrrate * 3) * $difDays->days;
            } else
            if ($difDays->days > 0 && $totalHoras > 0.10) {
                $vrtotal = ($vrrate * 4) * $difDays->days;
            } else {
                $vrtotal = $vrrate;
            }
        }

        if ($Vehicle->idType == 2 || $Vehicle->idType == 3 || $Vehicle->idType == 4 || $Vehicle->idType == 5 || $Vehicle->idType == 7) {
            if ($totalHoras > 5.10 && $totalHoras <= 12) {
                $vrtotal = $vrrate + 600;
            } else
            if ($totalHoras > 12.10 && $difDays->days < 1) {
                $vrtotal = $vrrate + 600;
            } else
            if ($difDays->days > 0) {
                $vrtotal = $vrrate + (600 * 2 * $difDays->days);
            } else {
                $vrtotal = $vrrate;
            }
        }

        if ($Vehicle->idType == 6) {
            if ($totalHoras > 4.10 && $totalHoras <= 5) {
                $vrtotal = $vrrate + 1200;
            } else
            if ($totalHoras > 5.10 && $totalHoras < 12) {
                $vrtotal = $vrrate + 2600;
            } else
            if ($difDays->days < 1 && $totalHoras = 12) {
                $vrtotal = $vrrate + 3200;
            } else
            if ($difDays->days > 0) {
                $vrtotal = ($vrrate + 3200) * $difDays->days;
            } else {
                $vrtotal = $vrrate * $totalHoras;
            }
        }
        //$vrrateformat = number_format($vrrate, 0, ".", ",");
        //$vrtotal = (float) $vrrate * (float) $totalHorasFormat;
        $vrformat = number_format($vrtotal, 0, ",", ".");
        $recordpay = array(
            'totalpay' => $vrformat
        );
        $this->Records_model->update_record_pay($Vehicle->idVehicle, $recordpay);
        $res = $difDays->days . ' Días ' . $totalHorasFormat .
                ' Horas<br>Valor a pagar: $ ' . $vrformat;
        echo $res;
    }

}
