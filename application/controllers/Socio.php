<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Socio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("socio_model");
		// require_once  APPPATH.'controllers/PDF_MC_Table.php';
	}

	public function index()
	{
		$lista=$this->socio_model->listasocios();
		$data['socio']=$lista;

		$this->load->view('inc/headersba2');
		$this->load->view('inc/sidebarsba2');
		$this->load->view('inc/topbarsba2');
        $this->load->view('tabla',$data);
        $this->load->view('inc/footersbadmin2');
	}

	public function agregar()
	{

		$this->load->view('inc/headersba2');
		$this->load->view('inc/sidebarsba2');
		$this->load->view('inicio/topbarsba2');
        $this->load->view('formularioSocio');
        $this->load->view('inc/footersbadmin2');
	}

	// public function venta()
	// {

	// 	$this->load->view('inc/headersba2');
	// 	$this->load->view('inc/sidebarsba2');
	// 	$this->load->view('inc/topbarUSER');
 //        $this->load->view('venta');
 //        $this->load->view('inc/footersbadmin2');
	// }

	public function agregarbd()
	{
		$data['ciNit']=$_POST['cinit'];
		$data['nombres']=strtoupper($_POST['nombres']);
		$data['apellidoPaterno']=$_POST['apellidopaterno'];
		$data['apellidoMaterno']=$_POST['apellidomaterno'];
		$data['telefono']=$_POST['telefono'];

		$lista=$this->socio_model->agregarsocio($data);
		redirect('socio/index','refresh');

	}

	public function eliminarbd()
	{

		$idsocio=$_POST['idsocio'];
		$this->socio_model->eliminarsocio($idsocio);
		redirect('socio/index','refresh');
	}

	public function modificar()
	{

		$idsocio =$_POST['idsocio'];
		$data ['infosocio']=$this->socio_model->recuperarsocio($idsocio);

		$this->load->view('inc/headersba2');
		$this->load->view('inc/sidebarsba2');
		$this->load->view('inc/topbarUSER');
        $this->load->view('formulariomodificar',$data);
        $this->load->view('inc/footersbadmin2');
	}

	public function modificarbd()
	{
		$idsocio =$_POST['idsocio'];
		$data['ciNit']=$_POST['cinit'];
		$data['nombres']=strtoupper($_POST['nombres']);
		$data['apellidoPaterno']=strtoupper($_POST['apellidopaterno']);
		$data['apellidoMaterno']=strtoupper($_POST['apellidomaterno']);
		$data['telefono']=$_POST['telefono'];
		//$data['fechaActualizacion']=date('Y-m-d H:i:s');


		$this->socio_model->modificarsocio($idsocio,$data);
		//echo json_encode($data);

		redirect('socio/index','refresh');
	}

	public function deshabilitarbd()
	{
		$idsocio =$_POST['idsocio'];
		$data['estado']='0';

		$this->socio_model->modificarsocio($idsocio,$data);
		redirect('socio/index','refresh');
	}

	public function deshabilitados()
	{
		$lista=$this->socio_model->listasociosdeshabilitados();
		$data['socio']=$lista;

		$this->load->view('inc/headersba2');
		$this->load->view('inc/sidebarsba2');
		$this->load->view('inc/topbarUSER');
        $this->load->view('listadeshabilitados',$data);
        $this->load->view('inc/footersbadmin2');

        //echo json_encode($data);
	}

	public function habilitarbd()
	{
		$idsocio =$_POST['idsocio'];
		$data['estado']='1';

		$this->socio_model->modificarsocio($idsocio,$data);
		redirect('socio/deshabilitados','refresh');
	}

	public function getdatos2()
	{
		$resultado = $this->db->get('socio');
		echo json_encode($resultado->result());
	}

	public function getdatos()
	{
		$resultado = $this->socio_model->getdatoscom();
		echo json_encode($resultado->result());
	}

	public function getproductos()
	{
		$producto = $this->input->post("lineatransporte"); //productos?
		$productos = $this->socio_model->getproductos($producto);
		echo json_encode($productos);
	}

	public function store(){
		$this->db->trans_start();

        //DATOS

		$fecha = $this->input->post("fechahora");
		$total = $this->input->post("total");
		$idsocio = $this->input->post("idsocios");
		$idusuario = $this->session->userdata('idusuario');

		$hojaruta = $this->input->post("idhojaruta");
		$preciounit = $this->input->post("precios");
		$cantidades = $this->input->post("cantidades");
        $movil = $this->input->post("automv");
		// $importes = $this->input->post("importes");

		$data = array(
			'idSocio' => $idsocio,
			'idUsuario' => $idusuario,
			'fecha' => $fecha,
			'total' => $total,
            'fechaActualizacion' => $fecha,
		);

		if ($this->socio_model->save($data)) {
			$idventa = $this->socio_model->lastID();
			$this->save_detalle($idventa,$movil,$hojaruta,$cantidades,$preciounit);
            $this->blqauto($movil);
            $this->blqhoja($hojaruta);
			//redirect(base_url()."movimientos/ventas");
			$this->db->trans_complete();

            //redireccionar a otro metodo Socio imprimir pdf
            //redirect('socio/crearPdf/'.$idVenta.'','refresh');
			redirect('socio/deshabilitados','refresh');

		}else{
			//redirect(base_url()."movimientos/ventas/add");
			// redirect('movimientos/ventas/add', 'refresh');
			redirect('socio/index','refresh');
		}

	}

	protected function save_detalle($idventa,$movil,$hojaruta,$cantidades,$preciounit){
		for ($i=0; $i < count($cantidades); $i++) { 
			$data  = array(
				'idVenta' => $idventa, 
				'idAutomovil' => $movil[$i],
				'idHoja_ruta' => $hojaruta[$i],
				'cantidad' => $cantidades[$i],
				'precioUnitario'=> $preciounit[$i],
			);

			$this->socio_model->save_detalle($data);
			// $this->updateProducto($productos[$i],$cantidades[$i]);

		}
	}

    protected function blqauto($movil){
        for ($i=0; $i < count($movil); $i++) { 
            $data  = $movil[$i];

            $this->socio_model->save_blqauto($data);
            // $this->updateProducto($productos[$i],$cantidades[$i]);

        }
    }

    protected function blqhoja($hojaruta){
        for ($i=0; $i < count($hojaruta); $i++) { 
            $data  = $hojaruta[$i];

            $this->socio_model->save_blqhoja($data);
            // $this->updateProducto($productos[$i],$cantidades[$i]);

        }
    }

    // protected function save_detalle($idventa,$movil,$hojaruta,$cantidades,$preciounit){
    //     for ($i=0; $i < count($cantidades); $i++) { 
    //         $data  = array(
    //             'idVenta' => $idventa, 
    //             'idAutomovil' => $movil[$i],
    //             'idHoja_ruta' => $hojaruta[$i],
    //             'cantidad' => $cantidades[$i],
    //             'precioUnitario'=> $preciounit[$i],
    //         );

    //         $this->socio_model->save_detalle($data);
    //         // $this->updateProducto($productos[$i],$cantidades[$i]);

    //     }
    // }

	public function fillAutos() {
		$idsocio =$_POST['socio_id'];
        // $idSocio = $this->input->post('1');
        // $this->load->model('venta_model');
        // $autos = $this->venta_model->getAutos($idSocio);
        // echo '<option value="0">AUTOS</option>';
        // foreach($autos as $row){
        //     echo '<option value="'. $row->idAuto .'">'. $row->label .'</option>';
        // }
        
        if($idsocio){
            // $this->load->model('venta_model');
            $autos = $this->socio_model->getAutos($idsocio);
            echo '<option value="0">AUTOS</option>';
            foreach($autos as $row){
                echo '<option value="'. $row->idAuto .'">'. $row->label .'</option>';
            }
        }  else {
            echo '<option value="0">AUTOS22222</option>';
        }
    }

    public function fillAutos2(){
    	echo "<script>alert('Estás suscrito, ¡Gracias!.');</script>";
        echo "<script>alert('socio_id');</script>";
        if($this->input->post('socio_id')){
            echo $this->socio_model->getAutos2($this->input->post('socio_id'));
        }

    }

    public function fillAutoSocio() {
    	echo "<script>alert('Estás suscrito, ¡Gracias!.');</script>";
    	// $idsocio =$_POST['socio_id'];
        // $idsocioa = $this->input->post('socio_id');
        $idsocioa = 1;
        echo '<script>alert("Hola '.$idsocioa.' drogo");</script>';
        // // if($idsocioa){
        // //     $this->load->model('socio_model');
        //     $autos = $this->socio_model->getAS($idsocioa);
        //     echo '<option value="0">SELECCIONAR SDSDS</option>';
        //     foreach($autos as $fila){
        //         echo '<option value="'. $fila->idAutos .'">'. $fila->label .'</option>';
        //     }
        // }  else {
        //     echo '<option value="0">ERROR</option>';
        // }

        $this->db->select("A.idAutomovil AS idAutos,CONCAT('Movil Nº: ',A.numeroMovil,'' -- Linea: ',H.descripcion) AS label");
		$this->db->from("automovil A");
		$this->db->join("hoja_ruta H ON A.idHoja_ruta = H.idHoja_ruta");
		$this->db->where("A.idSocio",$idsocio);
		$resultados = $this->db->get();

        // $this->db->where('idEstado', $idsocio);
        // $this->db->order_by('nombreCiudad', 'asc');
        // $ciudades = $this->db->get('Ciudades');
        
        if($resultados->num_rows() > 0){
            return $resultados->result();
        }
    }

    public function pp(){
    	echo "<script>alert('Estás suscrito, ¡Gracias!.');</script>";
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

}