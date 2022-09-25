<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socio_model extends CI_Model {

	public function listasocios() //Antes listaestudiantes
	{
		$this->db->select('*');//select *
		$this->db->from('socio'); // tabla
		$this->db->where('estado','1'); // tabla
		return $this->db->get(); //devolucion del estado de la consulta

	}

	public function agregarsocio($data) //Antes agregarestudiante
	{
		
		$this->db->insert('socio',$data); 

	}

	public function eliminarsocio($idsocio)//Antes eliminar socio
	{
		
		$this->db->where('idSocio',$idsocio); //BDD,variable
		$this->db->delete('socio');

	}

	public function recuperarsocio($idsocio)//Antes recuperar estudiante
	{
		$this->db->select('*');//select *
		$this->db->from('socio'); // tabla
		$this->db->where('idSocio',$idsocio); //BDD,variable
		return $this->db->get(); //devolucion del estado de la consulta

	}

	public function modificarsocio($idsocio,$data)//Antes modificar estudiantes
	{
		
		$this->db->where('idSocio',$idsocio);
		$this->db->update('socio',$data);  

	}

	public function listasociosdeshabilitados()//Antes listaestudiantesdeshabilitados
	{
		$this->db->select('*');//select *
		$this->db->from('socio'); // tabla
		$this->db->where('estado','0'); // tabla
		return $this->db->get(); //devolucion del estado de la consulta

	}
}
