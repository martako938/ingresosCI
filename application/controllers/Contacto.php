<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacto extends CI_Controller {

    public function __construct(){
		parent::__construct();
		$this->load->model('Index_Model');
		$this->load->model('Contacto_Model');
	}

	public function index(){
		// $data['iNumEmp'] = $this->config->item('HTTP_NUMEMP');				    //Trae num de empleado
		// $data['vcUser'] = $this->config->item('HTTP_USER');					    //Trae vcUser
		
		// $datos = $this->Index_Model->traerUsuario($data['iNumEmp']);		    //Recupera el nombre del empleado para mostrarlo en head
		// if($datos == NULL ||  $datos == '0'){ 									//Verifica si no llegaron datos de la API		
		// 	$datos= array(
		// 		"iNumEmp" => '0',
		// 		"vcPatEmp" =>  $this->config->item('HTTP_APELLIDOPATERNO'),
		// 		"vcMatEmp" =>  $this->config->item('HTTP_APELLIDOMATERNO'),
		// 		"vcNomEmp" =>  $this->config->item('HTTP_NOMBRE'),
		// 		"cRfcEmp" =>  '0',	"vcCurp" => '0', 	"Nivel" => '0 '
		// 	);
		// }
		// $data['usuario']= $datos;

		$this->load->view('template/head');
		$this->load->view('template/sup');
		$this->load->view('contacto');
		$this->load->view('indxJS/cont' );
		$this->load->view('template/foot');	
	}
    public function traeFechComp($fecha){
		$datos = $this->Contacto_Model->fechaCompleta($fecha); 
		echo json_encode($datos);
	}
}

