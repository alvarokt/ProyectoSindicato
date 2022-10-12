
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Agregar Socio</h2>

            <?php echo form_open_multipart('socio/agregarbd'); ?>

                  <div class="form-group">
                    <label for="inputAddress">CI/NIT:</label>
                    <input type="text" class="form-control mayus" name="cinit" id="cinit" placeholder="Ingrese número de CI o NIT" required>
                  </div>

                  <div class="form-group">
                    <label for="inputAddress">Nombres:</label>
                    <input type="text" class="form-control mayus" name="nombres" id="nombres" placeholder="Ingrese Nombre(s)" required>
                  </div>

                  <div class="form-group">
                    <label for="inputAddress">Apellido Paterno:</label>
                    <input type="text" class="form-control mayus" name="apellidopaterno" id="apellidopaterno" placeholder="Ingrese primer apellido" required>
                  </div>

                  <div class="form-group">
                    <label for="inputAddress">Apellido Materno:</label>
                    <input type="text" class="form-control mayus" name="apellidomaterno" id="apellidomaterno" placeholder="Ingrese segundo apellido">
                  </div>

                  <div class="form-group">
                    <label for="inputAddress">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="Teléfono" placeholder="Ingrese número telefonico">
                  </div>

                

                <button type="submit" class="btn btn-primary">AGREGAR SOCIO</button>

            <?php echo form_close(); ?>

            
        </div>
    </div>
</div>