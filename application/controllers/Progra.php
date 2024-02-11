<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progra extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Index_Model');
		$this->load->model('Progra_Model');
	}

	public function index(){
		$data['Version'] = $this->config->item('version');

        $this->load->view('template/head');
		$this->load->view('template/sup');				
		$this->load->view('programatico');		
		$this->load->view('indxJS/pro' );
        $this->load->view('template/foot',$data);
    }

	public function traeSal(){
		$datos = $this->Progra_Model->seleccionar_salida(); 
		 echo json_encode($datos);
   	}

	public function traeEnt(){
		$datos = $this->Progra_Model->seleccionar_entrada(); 
		 echo json_encode($datos);
   	}

	// public function borraEnt(){
	// 	$datos = $this->Progra_Model->borrar_entrada(); 
	// 	echo json_encode($datos);
   	// }

	public function ingresaNum(){
		$vcNumsFil = ''; $vcNumslim='';
		foreach ($_POST as $campo => $valor) {
            $var = "$".$campo."='". $valor."';"; 
            eval($var); 
        }
		$numerosletra = explode(",", $vcNumsFil);
		$numeros = explode(",", $vcNumslim);
		$datos = $this->Progra_Model->ingresaNumeros($numerosletra, $numeros); 
		echo json_encode($datos);
	}

	public function traeIngre(){
		$datos = $this->Progra_Model->seleccionar_ingresos(); 
		 echo json_encode($datos);
   	}
	
}