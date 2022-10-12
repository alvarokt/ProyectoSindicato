<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto_model extends CI_Model {

	public function __construct(){
        $this->estado = true;
        $this->fechaRegistro = date("Y-m-d H:i:s");
        $this->fechaActualizacion = date("Y-m-d H:i:s");
    }

	public function lista()
    {
        $this->db->select('p.*, t.tipoProducto');
        $this->db->from('producto p'); 
        $this->db->join("tipoproducto t","p.idTipoProducto = t.idTipoProducto");        
        $this->db->where('p.estado', 1);       
        $this->db->where('p.habilitado', 1);  
        return $this->db->get();
    }

    public function recuperarProducto($idProducto){
        $this->db->select('*');
        $this->db->from('producto'); 
        $this->db->where('idProducto', $idProducto);
        return $this->db->get();
    }

    public function crearProducto($data) {
        $data['fechaRegistro'] =  $this->fechaRegistro;
        $data['estado'] = $this->estado;
        $this->db->insert('producto', $data); 
        
    }

    public function modificarProducto($idProducto, $data)
    {
        $data['fechaActualizacion'] = $this->fechaActualizacion;
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data); 
    }

    public function eliminarProducto($idProducto, $estado)
    {
        $data['estado'] = !$this->estado;
        $data['fechaActualizacion'] = $this->fechaActualizacion;
        $this->db->where('idProducto', $idProducto);
        $this->db->update('producto', $data);
    }
    public function listadeshabilitados()
    {
        $this->db->select('u.*, t.tipoProducto');
        $this->db->from('producto u'); 
        $this->db->join("tipoproducto t","u.idTipoProducto = t.idTipoProducto");        
        $this->db->where('estado', 1);
        $this->db->where('habilitado', 0);
       
        return $this->db->get();
    }

    function listarTodosProducto()
    {
        $this->db->where('estado', 1);
        $this->db->order_by('idProducto', 'desc');
        return $this->db->get('producto')->result_array();
    }
}

