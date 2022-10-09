<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//require_once  APPPATH.'controllers/PDF_MC_Table.php';
		$this->load->model("venta_model");
	}


  
  public function index()
  {
    $lista = $this->venta_model->lista();
    $data['venta'] = $lista;

		$this->load->view('inc_header');
    $this->load->view('inc_menu');
		$this->load->view('venta/venta_lista',$data);
		$this->load->view('inc_footer');
	}

  public function venta()
  {
    $this->load->model('venta_model');
    $data['hojas'] = $this->venta_model->getHojas();
    
    // $this->load->view('viewComboBoxes', $data);

    $this->load->view('inc/headersba2');
    $this->load->view('inc/sidebarsba2');
    $this->load->view('inicio/topbarsba2');
    $this->load->view('venta',$data);
    $this->load->view('inc/footersbadmin2');
  }
  
  public function buscarAutos()
  {
    $idsocios =$_POST['socio_id'];
    $data2['infoautos']=$this->venta_model->listaAutosAsociados($idsocios);
  }

  public function fillAutos() {
        
        $idSocio = $this->input->post('idEstado');
        $idLinea = $this->input->post('idEstado');
        
        if($idSocio)
        {
          $this->load->model('venta_model');
          $autos = $this->venta_model->getAutos($idSocio);
          echo '<option value="0">Selecionar</option>';
          foreach($autos as $fila)
            {
              echo '<option value="'. $fila->idAutomovil .'">'. $fila->datos .'</option>';
            }
        }else 
        {
          echo '<option value="0">SELECCIONAR</option>';
        }
  }
  public function crearVenta()
  { 
    if ($_POST['idCliente'] != null) {
      $parametros = $this->datos();
      $idVenta = $this->venta_model->crearVenta($parametros);
      //Actualizar detalle de la venta
      foreach ($_POST['idarticulo'] as $key => $id) {
        $cantidad = $_POST['cantidad'][$key];
        $precio_venta = $_POST['precio_venta'][$key];
        if ($cantidad > 0) {
          
          $paramsDetalle = array(
            'idVenta' => $idVenta,
            'idProducto' => $id,
            'cantidad' => $cantidad,
            'precioUnitario' => $precio_venta
          );
          $this->detalleVenta_model->crearDetalleVenta($paramsDetalle);
          //Actualizar stock producto
          $infoProducto = $this->producto_model->recuperarProducto($id);
          foreach ($infoProducto->result() as $row) {
            $nuevoStock = $row->stock - $cantidad;
            $idProducto = $row->idProducto;
            $data['stock'] = $nuevoStock;    
            $this->producto_model->modificarProducto($idProducto, $data);
          }
        }
      }
      $this->notaDeVenta($idVenta);
      //redirect('venta/index', 'refresh');
    }
    else {
      $this->agregar();
    }
  }
  
}