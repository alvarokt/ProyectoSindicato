
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Agregar Socio</h2>

            <?php echo form_open_multipart('socio/agregarbd'); ?>

                <input type="text" name="nombres" placeholder="Ingrese su nombre">
                <input type="text" name="apellidopaterno" placeholder="Ingrese su primer apellido">
                <input type="text" name="apellidomaterno" placeholder="Ingrese su segundo apellido">
                <input type="text" name="telefono" placeholder="Ingrese número telefónico">
                <button type="submit" class="btn btn-primary">AGREGAR SOCIO</button>

            <?php echo form_close(); ?>

            
        </div>
    </div>
</div>