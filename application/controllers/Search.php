<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Search extends CI_Controller {

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
        $this->load->view('templates/lte/search');
    }

    public function get_sale() {
        $this->load->model(array('Vehicles_model', 'Records_model'));
        $placa = $this->input->post("placa");
        $vrrate = $this->input->post("vr");
        $dateIn = $this->input->post("date_in");
        $dateOut = $this->input->post("date_out");
        $hourIn = $this->input->post("hour_in");
        $hourOut = $this->input->post("hour_out");
        $Vehicle = $this->Vehicles_model->get_vehicle($placa);
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
                $vrtotal = ($difDays->days * 1500) + ($vrrate * 2);
            } else
            if ($totalHoras > 16.10 && $totalHoras <= 24) {
                $vrtotal = ($difDays->days * $vrrate * 3) + ($vrrate * 3);
            } else {
                $vrtotal = ($difDays->days * $vrrate * 3) + ($vrrate);
            }
        }

        if ($Vehicle->idType == 2 || $Vehicle->idType == 3 || $Vehicle->idType == 4 || $Vehicle->idType == 5 || $Vehicle->idType == 7) {
            if ($totalHoras > 5.10 && $totalHoras <= 12) {
                $vrtotal = ($difDays->days * ($vrrate + 600)) + ($vrrate + 600);
            } else
            if ($totalHoras > 12.10) {
                $vrtotal = ($difDays->days * ($vrrate + 600)) + ($vrrate + 600);
            } else {
                $vrtotal = ($difDays->days * ($vrrate + 600)) + $vrrate;
            }
        }

        if ($Vehicle->idType == 6) {
            if ($totalHoras > 4.10 && $totalHoras <= 5) {
                $vrtotal = ($difDays->days * ($vrrate + 3200)) + ($vrrate + 1200);
            } else
            if ($totalHoras > 5.10 && $totalHoras < 12) {
                $vrtotal = ($difDays->days * ($vrrate + 3200)) + ($vrrate + 2600);
            } else
            if ($totalHoras == 12) {
                $vrtotal = ($difDays->days * ($vrrate + 3200)) + ($vrrate + 3200);
            } else {
                $vrtotal = ($difDays->days * ($vrrate + 3200)) + ($vrrate * $totalHoras);
            }
        }
        //$vrrateformat = number_format($vrrate, 0, ".", ",");
        //$vrtotal = (float) $vrrate * (float) $totalHorasFormat;
        $vrformat = number_format($vrtotal, 0, ",", ".");
        $res = $difDays->days . ' Días ' . $totalHorasFormat .
                ' Horas<br>Valor a pagar: $ ' . $vrformat;
        echo $res;
    }

}
