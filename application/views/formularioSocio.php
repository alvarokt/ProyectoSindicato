
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Agregar Socio</h2>

            <?php echo form_open_multipart('socio/agregarbd'); ?>
                  <div class="form-group">
                    <label for="inputAddress">Nombres:</label>
                    <input type="text" class="form-control" name="nombres" id="inputAddress" placeholder="Ingrese Nombre(s)" required>
                  </div>

                  <div class="form-group">
                    <label for="inputAddress">Apellido Paterno:</label>
                    <input type="text" class="form-control" name="apellidopaterno" id="inputAddress" placeholder="Ingrese primer apellido" required>
                  </div>

                  <div class="form-group">
                    <label for="inputAddress">Apellido Materno:</label>
                    <input type="text" class="form-control" name="apellidomaterno" id="inputAddress" placeholder="Ingrese segundo apellido">
                  </div>

                  <div class="form-group">
                    <label for="inputAddress">Teléfono:</label>
                    <input type="text" class="form-control" name="telefono" id="inputAddress" placeholder="Ingrese número telefonico">
                  </div>

                

                <button type="submit" class="btn btn-primary">AGREGAR SOCIO</button>

            <?php echo form_close(); ?>

            
        </div>
    </div>
</div>