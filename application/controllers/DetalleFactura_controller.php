<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DetalleFactura_controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();
        $this->load->model("DetalleFactura_model");
		$this->load->model("Liquidacion_model");
		$this->load->database();
	}

	public function index()
	{
		$data["rutas"] = $this->Liquidacion_model->GetRutas();
		$this->load->view('header/header');
		$this->load->view('facturas',$data);
		$this->load->view('footer/footer');
		$this->load->view("jsview/facturasjs");
	}

	public function getFacturas($codalmacen,$f1,$f2)
	{
		$this->DetalleFactura_model->getFacturas($codalmacen,$f1,$f2);
	}
}
?>