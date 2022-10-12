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

	// public function getAutos($idSocio) {
	// 	$this->db->select('idSocio', $idSocio);
	// 	$this->db->from('automovil');
 //        $this->db->where('idSocio', $idSocio);
 //        $this->db->order_by('nombreCiudad', 'asc');
 //        $ciudades = $this->db->get('Ciudades');
        
 //        if($ciudades->num_rows() > 0){
 //            return $ciudades->result();
 //        }
 //    }

    public function getAutos($idSocio) {
        $idSocio2 =$_POST['idsocios'];
		$this->db->select("idAutomovil,CONCAT ('Nº Movil: ',numeroMovil,' -- ',descripcion) AS datos ");
        // $this->db->select('*');
		$this->db->from('automovil');
		$this->db->where('idSocio',$idSocio2);
        $this->db->where('idHoja_ruta',$idSocio);
		$resultados = $this->db->get();
        
        if($resultados->num_rows() > 0){
            return $resultados->result();
        }
    }



	public function lista()
	{
		$this->db->select('v.*, u.login,c.nombres,c.nit_carnet,GROUP_CONCAT(p.nombre) as nombre, GROUP_CONCAT(p.precio) as precio, GROUP_CONCAT(d.cantidad) as cantidad');
        $this->db->from('venta v'); 
        $this->db->join("usuario u","v.idUsuario = u.idUsuario");        
        $this->db->join("cliente c","v.idCliente = c.idCliente"); 
        $this->db->join("detalleventa d","v.idVenta = d.idVenta"); 
        $this->db->join("producto p","p.idProducto = d.idProducto"); 
        $this->db->where('v.estado', 1);      
        $this->db->group_by('v.idVenta');
        return $this->db->get();
	}

    public function recuperarVenta($idVenta){
        $this->db->select('*');
        $this->db->from('venta'); 
        $this->db->where('idVenta', $idVenta);
        return $this->db->get();
	}

    public function crearVenta($data) {

        $this->db->insert('venta', $data); 
        $insert_id = $this->db->insert_id();
        return  $insert_id;
        
    }

    public function modificarVenta($idVenta, $data)
    {
        $data['fechaActualizacion'] = $this->fechaActualizacion;
        $this->db->where('idVenta', $idVenta);
        $this->db->update('venta', $data); 
    }

    public function eliminarVenta($idVenta, $estado)
    {
        $data['estado'] = !$this->estado;
        $data['fechaActualizacion'] = $this->fechaActualizacion;
        $this->db->where('idVenta', $idVenta);
        $this->db->update('venta', $data);
    }

    public function eliminarDetalleVenta($idVenta, $estado)
    {
        $data['estado'] = 0;
        $this->db->where('idVenta', $idVenta);
        $this->db->update('detalleventa', $data);
    }

    public function listadeshabilitados()
	{
        $this->db->select('v.*, u.login,c.nombres,c.nit_carnet,GROUP_CONCAT(p.nombre) as nombre, GROUP_CONCAT(p.precio) as precio, GROUP_CONCAT(d.cantidad) as cantidad');
        $this->db->from('venta v'); 
        $this->db->join("usuario u","v.idUsuario = u.idUsuario");        
        $this->db->join("cliente c","v.idCliente = c.idCliente"); 
        $this->db->join("detalleventa d","v.idVenta = d.idVenta"); 
        $this->db->join("producto p","p.idProducto = d.idProducto"); 
        $this->db->where('v.estado', 0);      
        $this->db->group_by('v.idVenta');
        return $this->db->get();

	}

    function precioVenta($idProducto)
    {
        $this->db->select('idProducto, precio');
        $this->db->FROM('producto');
        $this->db->WHERE('idProducto', $idProducto);
        //$this->db->limit(1);
        $resultado = $this->db->get();

        if ($resultado->num_rows() > 0) {
            $r = $resultado->row();
            return $r->precio;
        }else{
            return 0;
        }
    }

    function contarVentas()
    {
        $this->db->select('idVenta');
        $this->db->FROM('venta');
        $resultado = $this->db->get();

        if ($resultado->num_rows() > 0) {
            $r = $resultado->row();
            return 1000 + $resultado->num_rows();
        }else{
            return 1000;
        }
    }

    function getNotaDeVenta($idVenta)
    {
        return $this->db->get_where('venta',array('idVenta'=>$idVenta))->row_array();
    }

    function getVentas($idVenta)
    {
        return $this->db->get_where('venta',array('idVenta'=>$idVenta))->row_array();
    }

    function getDetalleVentas($idVenta)
    {
        $this->db->select('di.idVenta, di.idProducto,di.cantidad,di.precioUnitario, p.nombre, p.descripcion');
        $this->db->from('detalleventa di');
        $this->db->join('Producto p','p.idProducto = di.idProducto');
        $this->db->Where('di.idVenta',$idVenta);
        return $this->db->get()->result_array();
    }

    function addDetalleVentas($datosDetalleVenta)
    {
        $this->db->insert('detalleventa',$datosDetalleVenta);
        return $this->db->insert_id();
    }

    function getAllVentas()
    {
        $this->db->order_by('idVenta', 'desc');
        //$this->db->where('estado', 1);
        return $this->db->get('venta')->result_array();
    }
}

