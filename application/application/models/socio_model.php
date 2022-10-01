<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socio_model extends CI_Model {

	public function listasocios() 
	{
		/*$this->db->select('*');
		$this->db->from('socio'); 
		$this->db->where('estado','1'); 
		return $this->db->get();*/ 

		$sql = "SELECT *
			    FROM socio
			    WHERE estado=1
			    ORDER BY 3";
		return $this->db->query($sql); 

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

	public function modificarsocio($idsocio,$data)
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

	public function getdatoscom(){
		$sql="SELECT idSocio, ciNit,CONCAT(nombres,' ',apellidoPaterno,' ',apellidoMaterno) AS nombres, telefono FROM socio ORDER BY 2;";
		return $this->db->query($sql); //devolucion del estado de la consulta
	}

	// public function getdatoscom(){
	// 	$sql="SELECT idHoja_ruta, descripcion,precioBase, saldo FROM hoja_ruta ORDER BY 2;";
	// 	return $this->db->query($sql); //devolucion del estado de la consulta
	// }

	public function getproductos($valor){
		$this->db->select("idHoja_ruta,descripcion as label,precioBase,saldo");
		$this->db->from("hoja_ruta");
		$this->db->like("descripcion",$valor);
		// return $this->db->get();
		// return $resultados->result_array();
		$res = $this->db->get();
		return $res->result_array();

	}

	
}
