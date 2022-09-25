
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Modificar Socio</h2>

            <?php

                foreach ($infosocio->result() as $row)//Antes infoestudiante
                {
                    echo form_open_multipart('socio/modificarbd');//Antes estudiante/modificarbd
                    ?>

                    <input type="hidden" name="idsocio" value="<?php echo $row->idSocio; ?>">
                    <input type="text" name="nombres" placeholder="Ingrese su nombre(s)" value="<?php echo $row->nombres; ?>">
                    <input type="text" name="apellidopaterno" placeholder="Ingrese su primer apellido" value="<?php echo $row->apellidoPaterno; ?>">
                    <input type="text" name="apellidomaterno" placeholder="Ingrese su segundo apellido" value="<?php echo $row->apellidoMaterno; ?>">
                    <input type="text" name="telefono" placeholder="Ingrese número telefónico" value="<?php echo $row->telefono; ?>">
                    <button type="submit" class="btn btn-primary">MODIFICAR SOCIO</button>
                    <?php 
                    form_close(); 
                }

                ?>  

        </div>
    </div>
</div>