
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Modificar Socio</h2>

            <?php
                foreach ($infosocio->result() as $row)
                {
                echo form_open_multipart('socio/modificarbd');
            ?>

                    <input type="hidden" name="idsocio" value="<?php echo $row->idSocio; ?>">

                    <div class="form-group">
                        <label for="inputAddress">CI/NIT:</label>
                        <input type="text" class="form-control" name="cinit" id="cinit" placeholder="Ingrese número de ci" required value="<?php echo $row->ciNit; ?>">
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Nombres:</label>
                        <input type="text" class="form-control mayus" name="nombres" id="nombres" placeholder="Ingrese Nombre(s)" required value="<?php echo $row->nombres; ?>">
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Apellido Paterno:</label>
                        <input type="text" class="form-control mayus" name="apellidopaterno" id="apellidopaterno" placeholder="Ingrese primer apellido" value="<?php echo $row->apellidoPaterno; ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Apellido Materno:</label>
                        <input type="text" class="form-control mayus" name="apellidomaterno" id="apellidomaterno" placeholder="Ingrese segundo apellido" value="<?php echo $row->apellidoMaterno; ?>">
                    </div>

                    <div class="form-group">
                        <label for="inputAddress">Teléfono:</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Ingrese número telefonico" value="<?php echo $row->telefono; ?>">
                    </div>
                    

                    <button type="submit" class="btn btn-primary">MODIFICAR SOCIO</button>


            <?php 
            form_close(); 
            }
            ?>  

        </div>
    </div>
</div>