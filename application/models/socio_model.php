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

	public function save($data){
		return $this->db->insert("venta",$data);
	}

	public function lastID(){
		return $this->db->insert_id();
	}

	public function save_detalle($data){
		$this->db->insert("detalle",$data);
	}

	public function getAutos($idSocio) {
		$this->db->select("A.idAutomovil AS idAuto,CONCAT('Movil Nº: ',A.numeroMovil,'' -- Linea: ',H.descripcion) AS label");
		// $this->db->select("*");
		$this->db->from("automovil A");
		$this->db->join("hoja_ruta H ON A.idHoja_ruta = H.idHoja_ruta");
		$this->db->where("A.idSocio",$idSocio);
		$resultados = $this->db->get();
        
        if($resultados->num_rows() > 0){
            return $resultados->result();
        }
    }

  //   public function getAutos2($socio_id) {
		// $this->db->select("A.idAutomovil, CONCAT('Movil Nº: ',A.numeroMovil,'' -- Linea: ',H.descripcion) AS datos");
		// $this->db->from("automovil A");
		// $this->db->join("hoja_ruta H ON A.idHoja_ruta = H.idHoja_ruta");
		// $this->db->where("A.idSocio",$socio_id);
		// $res = $this->db->get();
        
  //       $output = '<option value="0">Selecionar</option>';
  //       foreach ($res->result() as $row) {
  //       	$output .= '<option value="'.$row->idAutomovil.'">'.$row->datos.'</option>';
  //       }
  //       return $output;

  //   }

     public function getAutos2($socio_id) {
		$this->db->select("idAutomovil, descripcion");
		$this->db->from("automovil");
		$this->db->where("idSocio",$socio_id);
		$res = $this->db->get('automovil');
        
        $output = '<option value="0">Selecionar</option>';
        foreach ($res->result() as $row) {
        	$output .= '<option value="'.$row->idAutomovil.'">'.$row->descripcion.'</option>';
        }
        return $output;

    }

    public function getAS($idsocio) {
    	$this->db->select("A.idAutomovil AS idAutos,CONCAT('Movil Nº: ',A.numeroMovil,'' -- Linea: ',H.descripcion) AS label");
		$this->db->from("automovil A");
		$this->db->join("hoja_ruta H ON A.idHoja_ruta = H.idHoja_ruta");
		$this->db->where("A.idSocio",$idsocio);
		$resultados = $this->db->get();
		return $resultados->result();

        // $this->db->where('idEstado', $idsocio);
        // $this->db->order_by('nombreCiudad', 'asc');
        // $ciudades = $this->db->get('Ciudades');
        
        // if($resultados->num_rows() > 0){
        //     return $resultados->result();
        // }
    }

	
}
