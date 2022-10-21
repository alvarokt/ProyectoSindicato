

<form action="<?php echo base_url();?>index.php/socio/store" method="POST" class="form-horizontal">

    <div class="col-md-12 disabled" > 
        <label class="col-md-12 btn disabled border-bottom-warning  bg-gray-200 text-right "> <?php echo date('Y-m-d   H:i'); ?> </label>
        <input type="hidden" id="fechahora" name="fechahora" value="<?php echo date('Y-m-d H:i:s'); ?> "> 
    </div>

    <h5>ID: <?php echo $this->session->userdata('idusuario'); ?></h5>
    <h2>VENTA DE HOJAS DE RUTA</h2>


    <div class="container form-group mt-3">

        <div class="row">
            <div class="col col-md-2 mt-3">
                <label class="mt-2">DATO CI / NIT:</label> 
            </div>

            <div class="col col-md-2 mt-3">
                <input type="text" class="form-control border-left-success" id="nombresocio" name="nombresocio" required />
            </div>

            <div class="col col-md-2 mt-3">
                <label>SOCIO/RAZÓN SOCIAL:</label>
            </div>

            <div class="col col-md-4 mt-3">
                <input type="text" class="form-control border-left-success" id="socioname" name="socioname" readonly required />
                <input type="hidden" class="form-control " id="idsocios" name="idsocios" />
            </div>

            <div class="col col-md-2 mt-3">
                    <button class="btn btn-success " id="btn-oksocio" type="button" ><i class="fas fa-check"></i></button>             
                <!-- <button class="btn btn-success btn-circle" id="buscarmoviles" name = "buscarmoviles" type="button"><i class="fas fa-check"></i></button> -->
            </div>
        </div>
        
        <div class="row">
            <div class="col col-md-6">
                <label class="mt-3" for="">LINEA DE TRANSPORTE:</label>

                <select id="linea" class="form-control" disabled required>
                    <option value="" selected disabled>SELECCIONAR</option>
                    <?php 
                    foreach ($lineas as $i) {
                        echo '<option value="'. $i->idLinea .'">'. $i->nombreLinea .'</option>';
                    }
                    ?>  
                </select>

                <label class="mt-3" for="">AUTOMOVILES ASOCIADOS:</label>

                <select id="autos" class="form-control" disabled required>
                    <option value="0" selected disabled>SELECCIONAR</option>
                </select>

                <label class="mt-3" for="">HOJA DE RUTA:</label>

                <select id="hojas" class="form-control" disabled required>
                    <option value="0" selected disabled>SELECCIONAR</option>
                </select>


                
                <!-- <label for="">Linea de transporte:</label>
                <input type="text" class="form-control border-left-success" id="lineatransporte" name="lineatransporte"> -->
            </div>
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
            <th></th>
            <th>CANTIDAD</th>
            <th>CONCEPTO</th>
            <th>PRECIO UNIT.</th>
            <th>SUBTOTAL</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>


    <div class="form-group col-row">  
        <div class="col-md-4">
            <div class="input-group">
                <label class="mt-1">TOTAL (Bs.): </label>
                <input type="text" class="form-control" placeholder="0.00" id="total" name="total" readonly="readonly">
            </div>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-md-12">
        <button type="submit" id="guardaventa" class="btn btn-primary btn-flat">EJECUTAR VENTA</button>
    </div>
    
</div>
</form>

