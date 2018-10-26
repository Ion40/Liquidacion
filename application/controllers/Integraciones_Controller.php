<?php
class Integraciones_Controller extends CI_Controller
{
 function __construct()
 {
     parent::__construct();
     $this->load->model('Integraciones_model');
 }

 public function index()
 {
     $this->load->view('header/header');
     $this->load->view('integracion');
     $this->load->view('footer/footer');
     $this->load->view('jsview/integracionesjs');
 }

 public function integraciones()
 {
     $this->Integraciones_model->integraciones();
 }

 public function getFacturasDet($serie)
 {
    $this->Integraciones_model->getFacturasDet($serie);
 }
}
?>