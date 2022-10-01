<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante extends CI_Controller {

	public function index()
	{
		$lista=$this->estudiante_model->listaestudiantes();
		$data['estudiante']=$lista;

		$this->load->view('inc/header');
        $this->load->view('lista',$data);
        $this->load->view('inc/footer');
	}

	public function agregar()
	{

		$this->load->view('inc/header');
        $this->load->view('formulario');
        $this->load->view('inc/footer');
	}

	public function agregarbd()
	{
		$data['nombre']=$_POST['nombre'];
		$data['primerApellido']=$_POST['primerapellido'];
		$data['segundoApellido']=$_POST['segundoapellido'];
		$data['nota']=$_POST['nota'];

		$lista=$this->estudiante_model->agregarestudiante($data);
		redirect('estudiante/index','refresh');

	}

	public function eliminarbd()
	{

		$idestudiante=$_POST['idestudiante'];
		$this->estudiante_model->eliminarestudiante($idestudiante);
		redirect('estudiante/index','refresh');
	}

	public function modificar()
	{

		$idestudiante =$_POST['idestudiante'];
		$data ['infoestudiante']=$this->estudiante_model->recuperarestudiante($idestudiante);

		$this->load->view('inc/header');
        $this->load->view('formulariomodificar',$data);
        $this->load->view('inc/footer');
	}

	public function modificarbd()
	{
		$idestudiante =$_POST['idestudiante'];
		$data['nombre']=$_POST['nombre'];
		$data['primerApellido']=$_POST['primerapellido'];
		$data['segundoApellido']=$_POST['segundoapellido'];
		$data['nota']=$_POST['nota'];

		$this->estudiante_model->modificarestudiante($idestudiante,$data);
		redirect('estudiante/index','refresh');
	}

	public function deshabilitarbd()
	{
		$idestudiante =$_POST['idestudiante'];
		$data['habilitado']='0';

		$this->estudiante_model->modificarestudiante($idestudiante,$data);
		redirect('estudiante/index','refresh');
	}

	public function deshabilitados()
	{
		$lista=$this->estudiante_model->listaestudiantesdeshabilitados();
		$data['estudiante']=$lista;

		$this->load->view('inc/header');
        $this->load->view('listadeshabilitados',$data);
        $this->load->view('inc/footer');
	}

	public function habilitarbd()
	{
		$idestudiante =$_POST['idestudiante'];
		$data['habilitado']='1';

		$this->estudiante_model->modificarestudiante($idestudiante,$data);
		redirect('estudiante/deshabilitados','refresh');
	}

}