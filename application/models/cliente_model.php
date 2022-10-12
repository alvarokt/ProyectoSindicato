<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {


	public function __construct(){
        $this->estado = true;
        $this->fechaRegistro = date("Y-m-d H:i:s");
        $this->fechaActualizacion = date("Y-m-d H:i:s");
    }





    public function lista()
	{
		$this->db->select('idCliente, CONCAT(c.nombres," ",c.primerApellido," ",IFNULL(c.segundoApellido,"")) as nombre_razonSocial, nit_carnet,telefono, direccion');
        $this->db->from('cliente c');
        $this->db->where('c.estado', 1);
        $this->db->where('c.habilitado', 1);
        return $this->db->get();
	}

    public function recuperarCliente($idCliente){
        $this->db->select('*');
        $this->db->from('cliente'); 
        $this->db->where('idCliente', $idCliente);
        return $this->db->get();
	}

     public function recuperarClienteRecibo($idCliente){
        $this->db->select('*');
        return $this->db->get_where('cliente',array('idCliente'=>$idCliente))->row_array();
    }

    public function recuperarClienteVenta($nit_carnet){
        return $this->db->get_where('cliente',array('nit_carnet'=>$nit_carnet))->row_array();
    }

    public function recuperarClientePorID($idCliente){
        return $this->db->get_where('cliente',array('idCliente'=>$idCliente))->row_array();
    }

    public function crearCliente($data) {
        $data['fechaRegistro'] =  $this->fechaRegistro;
        $data['estado'] = $this->estado;
        $this->db->insert('cliente', $data); 
    }
    public function modificarCliente($idCliente, $data)
    {
        $data['fechaActualizacion'] = $this->fechaActualizacion;
        $this->db->where('idCliente', $idCliente);
        $this->db->update('cliente', $data); 
    }

    public function eliminarCliente($idCliente, $estado)
    {
        $data['estado'] = $estado;
        $data['fechaActualizacion'] = $this->fechaActualizacion;
        $this->db->where('idCliente', $idCliente);
        $this->db->update('cliente', $data);
    }

    public function listadeshabilitados()
	{
		$this->db->select('idCliente, CONCAT(c.nombres," ",c.primerApellido," ",c.segundoApellido) as nombre_razonSocial, nit_carnet,telefono, direccion');
        $this->db->from('cliente c');
        $this->db->where('estado', 1);
        $this->db->where('habilitado', 0);
       
        return $this->db->get();
	}
    public function getClientes(){
		$this->db->select("c.*");
		$this->db->from("cliente c");
		$this->db->where("c.estado","1");
		$resultados = $this->db->get();
		return $resultados->result();
	}

    function listarTodosClientes()
    {
        $this->db->where('estado', 1);
        $this->db->where('habilitado', 1);
        $this->db->order_by('idCliente', 'desc');
        return $this->db->get('cliente'); //->result_array();
    }

}