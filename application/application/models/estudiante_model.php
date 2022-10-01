<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estudiante_model extends CI_Model {

	public function listaestudiantes()
	{
		$this->db->select('*');//select *
		$this->db->from('estudiante'); // tabla
		$this->db->where('habilitado','1'); // tabla
		return $this->db->get(); //devolucion del estado de la consulta

	}

	public function agregarestudiante($data)
	{
		
		$this->db->insert('estudiante',$data); 

	}

	public function eliminarestudiante($idestudiante)
	{
		
		$this->db->where('idEstudiante',$idestudiante); 
		$this->db->delete('estudiante');

	}

	public function recuperarestudiante($idestudiante)
	{
		$this->db->select('*');//select *
		$this->db->from('estudiante'); // tabla
		$this->db->where('idEstudiante',$idestudiante); 
		return $this->db->get(); //devolucion del estado de la consulta

	}

	public function modificarestudiante($idestudiante,$data)
	{
		
		$this->db->where('idEstudiante',$idestudiante);
		$this->db->update('estudiante',$data);  

	}

	public function listaestudiantesdeshabilitados()
	{
		$this->db->select('*');//select *
		$this->db->from('estudiante'); // tabla
		$this->db->where('habilitado','0'); // tabla
		return $this->db->get(); //devolucion del estado de la consulta

	}
}
