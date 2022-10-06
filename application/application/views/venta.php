

<form action="<?php echo base_url();?>socio/store" method="POST" class="form-horizontal">
<div class="col-md-12 disabled" > 
<label class="col-md-12 btn disabled border-bottom-warning  bg-gray-200 text-right "> <?php echo date('Y-m-d   H:i'); ?> </label> 
</div>

<h1>ID: <?php echo $this->session->userdata('idusuario'); ?></h1>

<div class="row col col-md-12 form-group mt-3">

    <!-- <div class="col-md-6">
        <label for="">Tipo de busqueda:</label>
        <select class="form-control" >
          <option selected>Seleccione una opción</option>
          <option value="1">CI / NIT</option>
          <option value="2">Razón Social</option>
        </select>
    </div> -->


    <div class="col col-md-6 mt-3">
        <label for="">Dato CI / NIT:</label>
        <input type="text" class="form-control border-left-success" id="nombresocio" name="nombresocio" />
        <input type="hidden" class="form-control " id="id-socio" name="id-socio" />
        <input type="hidden" class="form-control " id="socioname" name="socioname" />
    </div>

    <div class="col col-md-6 mt-3">
        <label for="">Socio:</label>
        <input type="hidden" class="form-control " id="id-socio" name="id-socio" readonly />
        <input type="hidden" class="form-control " id="socioname" name="socioname" />
    </div>

   <!--  <form id="p1">
         <div class="col-md-6">
            <label for="">Linea:</label>
            <input type="text" class="form-control" id="producto">
        </div>
    </form>

    <div class="col-md-6">
        <label for="">Linea:</label>
        <input type="text" class="form-control" id="producto">
    </div> -->

    <div class="col col-md-6 mt-3">
            <label for="">Linea de transporte:</label>
            <input type="text" class="form-control border-left-success" id="lineatransporte" name="lineatransporte">
    </div>

    <div class="col col-md-6 mt-3">

            <button id="btn-agregar" type="button" class="col-md-6 btn btn-success" >AGREGAR</button>

            <!-- <input type="hidden" name="idsocio" value="<?php echo $row->idSocio; ?>">
            <button id="btn1" class="btn btn-success" onclick="mostrar();">  SELECCIONAR </button>
            <?php echo form_close(); ?> --> 
    </div>

    

    <!-- <script id="sd" type="text/javascript">

        function mostrar2(){
            document.getElementById('tb').style.display = 'block';           
        }
    </script>     -->
</div>

<div class="col-md-12" id="tablaventa">
    <table id="tbventas" class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <!-- <th>#</th> -->
            <th>CANTIDAD</th>
            <th>DETALLE</th>
            <th>PRECIO UNIT.</th>
            <th>SUBTOTAL</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
    
    </tbody>
</table>


    <div class="form-group col-row">  
        <div class="col-md-4">
            <div class="input-group">
                <label>Total:</label>
                <input type="text" class="form-control" placeholder="0.00" id="total" name="total" readonly="readonly">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <button type="submit" class="btn btn-success btn-flat">Guardar</button>
    </div>
    
</div>
</form>

