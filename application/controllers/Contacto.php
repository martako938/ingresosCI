<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Index_Model');
		$this->load->model('Contacto_Model');
	}

	public function index(){
		$data['Version'] = $this->config->item('version');

		$this->load->view('template/head');
		$this->load->view('template/sup');
		$this->load->view('contacto',$data);
		$this->load->view('indxJS/cont' );
		$this->load->view('template/foot',$data);	
	}
    public function traeFechComp($fecha){
		$datos = $this->Contacto_Model->fechaCompleta($fecha); 
		echo json_encode($datos);
	}
}

