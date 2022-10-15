<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta extends CI_Controller {

	public function __construct(){
		parent::__construct();
		//require_once  APPPATH.'controllers/PDF_MC_Table.php';
		$this->load->model("venta_model");
	}

	

	public function buscarAutos()
	{
  		$idsocios =$_POST['socio_id'];
  		$data2['infoautos']=$this->venta_model->listaAutosAsociados($idsocios);
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
      $data['lineas'] = $this->venta_model->getLineas();

      $this->load->view('inc/headersba2');
      $this->load->view('inc/sidebarsba2');
      $this->load->view('venta/topbarsba2');
      $this->load->view('venta',$data);
      $this->load->view('inc/footersbadmin2');
  }

  public function fillAutos() {
        
      // $idSocio = $this->input->get('idEstado');
      $idSocio = $this->uri->segment(3);
      $idLinea = $this->uri->segment(4);
      
      if($idSocio && $idLinea)
      {
          $this->load->model('venta_model');
          $autos = $this->venta_model->getAutos($idSocio,$idLinea);
          echo '<option value="0">SELECCIONAR MOVIL</option>';
          foreach($autos as $fila)
          {
            echo '<option value="'. $fila->idAutomovil .'">'. $fila->datos .'</option>';
            // echo '<option value="'. $fila->idAutomovil .''."*".''.$fila->idAutomovil.'">'. $fila->datos .'</option>';
          }
      }
      else 
      {
        echo '<option value="0">SIN AUTOMOVILES ASOCIADOS</option>';
      }
  }

  public function fillHojas() {
        
      // $idHoja = $this->input->post('idEstado2');
      $idHoja = $this->uri->segment(3);
      
      if($idHoja)
      {
          $this->load->model('venta_model');
          $hojas = $this->venta_model->getHojas($idHoja);
          echo '<option value="0">SELECCIONAR HOJA</option>';
          foreach($hojas as $fila)
          {
            echo '<option value="'. $fila->idHoja_ruta .''."*".''. $fila->precioBase .'">'. $fila->numeroHoja .'</option>';
          }
      }
      else 
      {
        echo '<option value="0">SIN HOJAS DISPONIBLES</option>';
      }
  }
  
  public function agregar()
  {
    $data['clientes'] = $this->cliente_model->listarTodosClientes();
    $data['productos'] = $this->producto_model->listarTodosProducto();
    $this->load->view('inc_header');
    $this->load->view('inc_menu');
    $this->load->view('venta/venta_agregar',$data);
    $this->load->view('inc_footer');
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

  public function buscarCliente()
  {

    $nit_carnet = $this->input->post('nit_carnet');
    $data['cliente'] = $this->cliente_model->recuperarClienteVenta($nit_carnet);
    $data['productos'] = $this->producto_model->listarTodosProducto();
    //print_r($data['cliente']);
    ///*
    $this->load->view('inc_header');
    $this->load->view('inc_menu');
    $this->load->view('venta/venta_agregar',$data);
    $this->load->view('inc_footer');
    //*/
  }

  function datos()
  {
    $params = array(
      'fecha' => $this->input->post('fecha'),
      'total' => $this->input->post('montoTotal'),
      'idusuario' => $this->session->userdata("idusuario"),
      'idCliente' => $this->input->post('idCliente'),
      'nroComprobante' => $this->input->post('nroComprobante'),
    );
    return $params;
  }

  public function modificar()
  {
    $idVenta = $_POST['idVenta'];
    $data['infoVenta'] = $this->venta_model->recuperarVenta($idVenta);

    $this->load->view('inc_header');
    $this->load->view('inc_menu');
    $this->load->view('venta/venta_modificar', $data);
    $this->load->view('inc_footer');
  }

  public function modificarVenta()
  {
    $idVenta = $_POST['idVenta'];
    $data['nombre'] = $_POST['nombre'];    
    $data['descripcion'] = $_POST['descripcion']; 
    $data['precio'] = $_POST['precio']; 
    $data['img'] = $_POST['img'];
    $data['idTipoVenta'] = $_POST['idTipoVenta'];    
   
    $this->venta_model->modificarVenta($idVenta, $data);
    redirect('venta/index', 'refresh');
  }

  public function eliminarVentaBd($idVenta, $estado)
  { 
    /* $idVenta = $_POST['idVenta'] */;
    $this->venta_model->eliminarVenta($idVenta, $estado);
    $this->venta_model->eliminarDetalleVenta($idVenta, $estado);

    redirect('venta/index', 'refresh');
  }
  
  public function deshabilitarVentaBd()
	{		
        $idVenta=$_POST['idVenta'];
        $data['estado']='0';

        $this->venta_model->modificarVenta($idVenta,$data);
        redirect('venta/index','refresh');
	}
  public function habilitarVentaBd()
	{		
        $idVenta=$_POST['idVenta'];
        $data['estado']='1';

        $this->venta_model->modificarVenta($idVenta,$data);
        redirect('venta/deshabilitados','refresh');
	}

  public function Anulados()
  {
    $lista = $this->venta_model->listadeshabilitados();
    $data['venta'] = $lista;

    $this->load->view('inc_header');
    $this->load->view('inc_menu');
    $this->load->view('venta/venta_anuladas', $data);
    $this->load->view('inc_footer');
  }
 
  public function generarRecibo() {
    $idVenta = $_POST['idVenta'];
    $data['infoVenta'] = $this->venta_model->recuperarVenta($idVenta);
    
    $this->load->view('inc_header');
    $this->load->view('inc_menu');
    $this->load->view('venta/venta_recibo', $data);
    $this->load->view('inc_footer');
  }

  public function notaDeVenta($idventa)
    {
        $data = $this->venta_model->getNotaDeVenta($idventa);
        $cliente = $this->cliente_model->recuperarClienteRecibo($data['idCliente']);
        $ventas = $this->venta_model->getVentas($data['idVenta']);
        $this->pdf = new PDF_MC_Table();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $logo      = base_url()."fotos/logo.png";
        $anulado   = base_url()."fotos/anulado.png";
        $empresa   = utf8_decode('AGREGADOS MAXSAMU');
        $documento = "NIT: 7965913011";
        $direccion = utf8_decode("Dirección: Vinto Km 18 1/2 Carretera Cochabamba-Oruro");
        $telefono  = utf8_decode("Número de Telefono: 68936065");
        $email     = "Email: ledezmasamuel658@gmail.com";
        $x1        = 30;
        $y1        = 8;
        $this->pdf->Image($logo, 3, 5, 25, 23);
        if ($data['estado']==0) {
            $this->pdf->Image($anulado, 60, 35, 90,90);
        }
        ///////////////////////// datos de la empresa ////////////////////////////////
        $this->pdf->SetXY($x1, $y1);
        $this->pdf->SetFont('Arial', 'B', 15);
        $length = $this->pdf->GetStringWidth($empresa);
        $this->pdf->Cell($length, 2, $empresa);
        ///////
        $this->pdf->SetXY($x1, $y1 + 4);
        $this->pdf->SetFont('Arial', '', 10);
        $length = $this->pdf->GetStringWidth($documento);
        $this->pdf->Cell($length, 2, $documento);
        ///////
        $this->pdf->SetXY($x1, $y1 + 8);
        $this->pdf->SetFont('Arial', '', 10);
        $length = $this->pdf->GetStringWidth($telefono);
        $this->pdf->Cell($length, 2, $email);
        ///////
        $this->pdf->SetXY($x1, $y1 + 12);
        $this->pdf->SetFont('Arial', '', 10);
        $length = $this->pdf->GetStringWidth($email);
        $this->pdf->Cell($length, 2, $telefono);
        ///////
        $this->pdf->SetXY($x1, $y1 + 16);
        $this->pdf->SetFont('Arial', '', 10);
        $length = $this->pdf->GetStringWidth($direccion);
        $this->pdf->Cell($length, 2, $direccion);
        ///////////////////////// fin datos de la empresa //////////////////////////////
        ///////////////////////// datos del cliente //////////////////////////////////
        //Obtenemos los datos de la cabecera de la venta actual
        $r1   = 10;
        $r2   = $r1 + 68;
        $y1   = 40;
        $this->pdf->SetXY($r1, $y1);
        $this->pdf->SetFont("Arial", "B", 10);
        $this->pdf->MultiCell(60, 4, "Cliente:");
        $this->pdf->SetXY($r1, $y1 + 5);
        $this->pdf->SetFont("Arial", "", 10);

        $this->pdf->MultiCell(150, 4, utf8_decode($cliente['nombres']. ' '.$cliente['primerApellido']. ' '.$cliente['segundoApellido']));
        $this->pdf->SetXY($r1, $y1 + 10);
        $this->pdf->MultiCell(150, 4, utf8_decode("Dirección: ").utf8_decode($cliente['direccion']));
        $this->pdf->SetXY($r1, $y1 + 15);
        $this->pdf->MultiCell(150, 4, "NIT/CI: " . utf8_decode($cliente['nit_carnet']));
        $this->pdf->SetXY($r1, $y1 + 20);
        $this->pdf->MultiCell(150, 4, "Telefono: " . $cliente['telefono']);
        ///////////////////////// fin datos del cliente //////////////////////////////
        ///////////////////////// Inicio recibo y fecha  //////////////////////////////
        $r1 = 220 - 90;
        $r2 = $r1 + 68;
        $y1 = 6;
        $y2 = $y1 + 2;
        $this->pdf->SetFillColor(72, 209, 204);
        $this->pdf->SetXY($r1 + 1, $y1 + 5);
        $this->pdf->SetFont("Arial", "B", 10);
        $this->pdf->Cell($r2 - $r1 - 1, 5, 'RECIBO', 1, 3, "C");
        $this->pdf->Cell($r2 - $r1 - 1, 5, 'No. '.$ventas['nroComprobante'], 1, 2, "C");
        $this->pdf->Ln(5);
        $this->pdf->SetXY($r1 + 1, $y1 + 17);
        $originalDate = $ventas['fecha'];
        $newDate = date("d/m/Y", strtotime($originalDate));
        $this->pdf->Cell($r2 - $r1 - 1, 5, 'Fecha: '.$newDate, 0, 0, "C");
        ///////////////////////// Fin recibo y fecha //////////////////////////////
        $this->pdf->Ln(55);

        //Creamos las celdas para los títulos de cada columna y le asignamos un fondo gris y el tipo de letra
        $this->pdf->SetFillColor(232, 232, 232);
        $this->pdf->SetFont('Arial', 'B', 10);
        $this->pdf->Cell(10, 6, utf8_decode('Nº'), 1, 0, 'L', 1);
        $this->pdf->Cell(30, 6, utf8_decode('Nombre'), 1, 0, 'L', 1);
        $this->pdf->Cell(85, 6, utf8_decode('Descripción'), 1, 0, 'L', 1);
        $this->pdf->Cell(20, 6, utf8_decode('Cant. (m³)'), 1, 0, 'L', 1);
        $this->pdf->Cell(20, 6, 'P. Unitario', 1, 0, 'L', 1);
        $this->pdf->Cell(20, 6, utf8_decode('Sub Total'), 1, 0, 'L', 1);

        $this->pdf->Ln(6);
        //Comenzamos a crear las filas de los registros según la consulta mysql
        $detalle = $this->venta_model->getDetalleVentas($data['idVenta']);

        //Table with rows and columns
        $this->pdf->SetWidths(array(10, 30, 85, 20, 20, 20));
        //Obtenemos todos los detalles de la venta actual
        $numero = 1;
        $total  = 0;
        foreach($detalle as $row) {
            $descripcion        = $row['descripcion'];
            $nombre      = $row['nombre'];
            $cantidad      = $row['cantidad'];
            $precioUnitario  = $row['precioUnitario'];
            $subtotal      = $row['cantidad']*$row['precioUnitario'];
            $total += $subtotal;
            $this->pdf->SetFont('Arial', '', 10);
            $this->pdf->Row(array(utf8_decode($numero), utf8_decode($nombre), utf8_decode($descripcion), $cantidad, $precioUnitario, $subtotal));
            $numero = $numero + 1;
        }
        $this->pdf->Ln(1);
        //Convertimos el total en letras
        $formatterES = new NumberFormatter("es", NumberFormatter::SPELLOUT);
        $centavos = explode(".", $total);
        //print_r( $centavos);
        $numero_cents = sizeof($centavos);
        //echo $numero_cents;
        if ($numero_cents==2) {
          if ($centavos[1]<10) {
            $centavos[1] = '0'.$centavos[1];
          }
          $con_letra = strtoupper('SON '.$formatterES->format($total).' '.$centavos[1] .'/100 bolivianos');
        }else{
          $con_letra = strtoupper('SON '.$formatterES->format($total).' 00/100 bolivianos');
        }

        $this->pdf->Ln(5);
        $this->pdf->SetFillColor(255, 255, 255);
        $this->pdf->SetFont('Arial', 'B', 8);
        $this->pdf->Cell(143, 6, utf8_decode('Importe Total: ' . '--- ' . $con_letra . ' ---'), 1, 0, 'L', 1);
        $this->pdf->Cell(1, 6, utf8_decode(''), 0, 0, 'L', 1);
        $this->pdf->Cell(1, 6, utf8_decode(''), 0, 0, 'L', 1);
        $this->pdf->Cell(20, 6, 'Total a pagar ', 1, 0, 'L', 1);
        $this->pdf->Cell(20, 6, utf8_decode($total) . ' Bs.', 1, 0, 'L', 1);
        $this->pdf->Output("notadeventa.pdf","I");
        ///////////////////////// datos de la empresa ////////////////////////////////
    }

    public function reporteVentas()
    {
        $data = $this->Ventas_model->getAllVentas();
        $this->pdf = new \FPDF();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(300,300,300);
        $this->pdf->SetXY(31, 11);
        $logo = base_url()."fotos/logo.png";
        $this->pdf->Image($logo, 15, 5, 25, 23);
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(5);
        $this->pdf->Cell(160,3,utf8_decode('MACETAS PACHA'),0,0,'R');
        $this->pdf->Ln(5);
        $this->pdf->Cell(182,3,date('d-m-Y'),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Ln(15);
        $this->pdf->Cell(30);
        $this->pdf->Cell(120,10,utf8_decode('LISTA DE VENTAS'),0,0,'C');

        $this->pdf->Ln(10);

        $this->pdf->Cell(10,5,utf8_decode("No."),'TBLR',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode("SERIE"),'TBLR',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode("NÚMERO"),'TBLR',0,'L',1);
        $this->pdf->Cell(50,5,utf8_decode("FECHA"),'TBLR',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode("TOTAL VENTA"),'TBLR',0,'C',1);
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial','',12);
        $indice=1;
        $montoTotal = 0;
        foreach ($data as $row) {
            $this->pdf->Cell(10,5,utf8_decode($indice),'TBLR',0,'L',0);
            $this->pdf->Cell(40,5,utf8_decode($row['serie_comprobante']),'TBLR',0,'L',0);
            $this->pdf->Cell(40,5,utf8_decode($row['num_comprobante']),'TBLR',0,'L',0);
            $this->pdf->Cell(50,5,utf8_decode($row['fecha_hora']),'TBLR',0,'L',1);
            $this->pdf->Cell(40,5,utf8_decode($row['total_venta']),'TBLR',0,'C',1);
            $this->pdf->Ln(5);
            $montoTotal += $row['total_venta'];
            $indice++;
        }
        $this->pdf->Ln(5);
        $this->pdf->Cell(10,5,utf8_decode(''),'',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode(''),'',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode(''),'',0,'L',1);
        $this->pdf->Cell(50,5,utf8_decode('Total General'),'TBLR',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode($montoTotal.' Bs.'),'TBLR',0,'C',1);

        $this->pdf->Output("listaventas.pdf","I");
    }

    public function generarReporte()
    {
        $de = $this->input->post('de');
        $hasta = $this->input->post('hasta');
        if ($de>$hasta) {
            $data['mensaje'] = "La fecha de no puede ser mayor a la fecha hasta";
            $this->load->view('layout/header');
            $this->load->view('ventas/reporte',$data);
            $this->load->view('layout/footer');
        }else{
        $data = $this->Ventas_model->generarReporte($de,$hasta);

        $this->pdf = new \FPDF();
        $this->pdf->AddPage();
        $this->pdf->AliasNbPages();
        $this->pdf->SetLeftMargin(15);
        $this->pdf->SetRightMargin(15);
        $this->pdf->SetFillColor(300,300,300);
        $this->pdf->SetXY(31, 11);
        $logo = base_url()."fotos/logo.png";
        $this->pdf->Image($logo, 15, 5, 25, 23);
        $this->pdf->SetFont('Arial','B',8);
        $this->pdf->Cell(5);
        $this->pdf->Cell(160,3,utf8_decode('MACETAS PACHA'),0,0,'R');
        $this->pdf->Ln(5);
        $this->pdf->Cell(182,3,date('d-m-Y'),0,0,'R');
        $this->pdf->SetFont('Arial','B',12);
        $this->pdf->Ln(15);
        $this->pdf->Cell(30);
        $this->pdf->Cell(120,10,utf8_decode('LISTA DE VENTAS DEL '.$de.' AL '.$hasta),0,0,'C');

        $this->pdf->Ln(10);

        $this->pdf->Cell(10,5,utf8_decode("No."),'TBLR',0,'L',1);
        $this->pdf->Cell(80,5,utf8_decode("NOTA DE VENTA"),'TBLR',0,'L',1);
        $this->pdf->Cell(50,5,utf8_decode("FECHA"),'TBLR',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode("TOTAL VENTA"),'TBLR',0,'C',1);
        $this->pdf->Ln(5);
        $this->pdf->SetFont('Arial','',12);
        $indice=1;
        $montoTotal = 0;
        foreach ($data as $row) {
            $this->pdf->Cell(10,5,utf8_decode($indice),'TBLR',0,'L',0);
            $this->pdf->Cell(80,5,utf8_decode($row['serie_comprobante'].'-'.$row['num_comprobante']),'TBLR',0,'L',0);
            $this->pdf->Cell(50,5,utf8_decode($row['fecha_hora']),'TBLR',0,'L',1);
            $this->pdf->Cell(40,5,utf8_decode($row['total_venta']),'TBLR',0,'C',1);
            $this->pdf->Ln(5);
            $montoTotal += $row['total_venta'];
            $indice++;
        }
        $this->pdf->Ln(5);
        $this->pdf->Cell(10,5,utf8_decode(''),'',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode(''),'',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode(''),'',0,'L',1);
        $this->pdf->Cell(50,5,utf8_decode('Total General'),'TBLR',0,'L',1);
        $this->pdf->Cell(40,5,utf8_decode($montoTotal.' Bs.'),'TBLR',0,'C',1);

        $this->pdf->Output("comprasfechas.pdf","I");
        }
    }
}