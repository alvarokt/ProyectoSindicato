<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function index()
	{
		
		if($this->session->userdata('login'))
		{
			//el_usuario_ya_esta_logueado
			redirect('usuario/panel','refresh');
		}
		else
		{
			//usuario_no_esta_logueado
			$this->load->view('inc/header');
	        $this->load->view('login');
	        $this->load->view('inc/footer');
		}	
	}

	public function user()
	{
		
		$this->load->view('inc/header');
	    $this->load->view('user');
	    $this->load->view('inc/footer');
		
		
	}

	public function validar()
	{
		$login=$_POST['login'];
		$password=md5($_POST['password']);

		$consulta=$this->usuario_model->validar($login,$password);

		if($consulta->num_rows()>0)
		{
			//Se_tiene_una_validacion_efectiva
			foreach($consulta->result() as $row)
			{
				$this->session->set_userdata('idusuario',$row->idUsuario);
				$this->session->set_userdata('login',$row->nombreUsuario);
				$this->session->set_userdata('tipo',$row->tipo);
				redirect('usuario/panel','refresh');
			}
		}
		else
		{
			//No hay validacion efectiva y redirigimos a login
			redirect('usuario/index','refresh');
		}
	}

	public function panel()
	{
		if($this->session->userdata('login'))
		{
			if ($this->session->userdata('tipo')=='admin') 
			{
				redirect('inicio/index','refresh');
			}
			else
			{
				redirect('inicio/index','refresh');
			}

		}
		else
		{
			redirect('usuario/index','refresh');
		}
	}

	public function logout()
	{
			$this->session->sess_destroy();
			redirect('usuario/index','refresh');
	}

}
