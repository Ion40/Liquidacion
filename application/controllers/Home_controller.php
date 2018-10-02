<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_controller extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model("Liquidacion_model");
	}

	public function index()
	{
		$data["rutas"] = $this->Liquidacion_model->GetRutas();
		$this->load->view('header/header');
		$this->load->view('home',$data);
		$this->load->view('footer/footer');
		$this->load->view("jsview/liquidacionjs");
	}

	public function getDataLiq($ruta,$f1,$f2)
	{
		$this->Liquidacion_model->getData($ruta,$f1,$f2);
	}

	public function getStock($codal,$codArt)
	{
		$this->Liquidacion_model->getStock($codal,$codArt);
	}

	public function getCredito($ruta,$fecha1,$fecha2)
	{
		$this->Liquidacion_model->getCredito($ruta,$fecha1,$fecha2);
	} 
}
