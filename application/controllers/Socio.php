<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socio extends CI_Controller {

	public function index()
	{
		$lista=$this->socio_model->listasocios();
		$data['socio']=$lista;

		$this->load->view('inc/headersbadmin2');
		$this->load->view('inc/sidebarsbadmin2');
        $this->load->view('lista',$data);
        $this->load->view('inc/footersbadmin2');
	}

	public function agregar()
	{

		$this->load->view('inc/header');
        $this->load->view('formularioSocio');
        $this->load->view('inc/footer');
	}

	public function agregarbd()
	{
		$data['nombres']=$_POST['nombres'];
		$data['apellidoPaterno']=$_POST['apellidopaterno'];
		$data['apellidoMaterno']=$_POST['apellidomaterno'];
		$data['telefono']=$_POST['telefono'];

		$lista=$this->socio_model->agregarsocio($data);
		redirect('socio/index','refresh');

	}

	public function eliminarbd()
	{

		$idsocio=$_POST['idsocio'];
		$this->socio_model->eliminarsocio($idsocio);
		redirect('socio/index','refresh');
	}

	public function modificar()
	{

		$idsocio =$_POST['idsocio'];
		$data ['infosocio']=$this->socio_model->recuperarsocio($idsocio);

		$this->load->view('inc/header');
        $this->load->view('formulariomodificar',$data);
        $this->load->view('inc/footer');
	}

	public function modificarbd()
	{
		$idsocio =$_POST['idsocio'];
		$data['nombres']=$_POST['nombres'];
		$data['apellidoPaterno']=$_POST['apellidopaterno'];
		$data['apellidoMaterno']=$_POST['apellidomaterno'];
		$data['telefono']=$_POST['telefono'];

		$this->socio_model->modificarsocio($idsocio,$data);
		redirect('socio/index','refresh');
	}

	public function deshabilitarbd()
	{
		$idsocio =$_POST['idsocio'];
		$data['estado']='0';

		$this->socio_model->modificarsocio($idsocio,$data);
		redirect('socio/index','refresh');
	}

	public function deshabilitados()
	{
		$lista=$this->socio_model->listasociosdeshabilitados();
		$data['socio']=$lista;

		$this->load->view('inc/header');
        $this->load->view('listadeshabilitados',$data);
        $this->load->view('inc/footer');
	}

	public function habilitarbd()
	{
		$idsocio =$_POST['idsocio'];
		$data['estado']='1';

		$this->socio_model->modificarsocio($idsocio,$data);
		redirect('socio/deshabilitados','refresh');
	}

}