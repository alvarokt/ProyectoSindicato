<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta_model extends CI_Model {

	public function __construct(){
        $this->estado = true;
        $this->fechaRegistro = date("Y-m-d H:i:s");
        $this->fechaActualizacion = date("Y-m-d H:i:s");
    }


    public function getHojas() {

        $this->db->select('*');
        $this->db->from('hoja_ruta');
        $this->db->order_by('2', 'asc');
        $estados = $this->db->get();
        
        if($estados->num_rows() > 0){
            return $estados->result();
        }
    }

	public function listaAutosAsociados($idSocio)
	{
		$this->db->select("A.idAutomovil,CONCAT('Movil Nº: ',A.numeroMovil,'' -- Linea: ',H.descripcion) AS datos");
		$this->db->from("automovil A");
		$this->db->join("hoja_ruta H ON A.idHoja_ruta = H.idHoja_ruta");
		$this->db->where("A.idSocio",$idSocio);
		$resultados = $this->db->get();
        
        if($resultados->num_rows() > 0){
            return $resultados->result();
        }
	}
}

