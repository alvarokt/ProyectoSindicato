
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h2>Agregar Estudiante</h2>

            <?php echo form_open_multipart('estudiante/agregarbd'); ?>

                <input type="text" name="nombre" placeholder="Ingrese su nombre">
                <input type="text" name="primerapellido" placeholder="Ingrese su primer apellido">
                <input type="text" name="segundoapellido" placeholder="Ingrese su segundo apellido">
                <input type="text" name="nota" placeholder="Ingrese nota">
                <button type="submit" class="btn btn-primary">AGREGAR ESTUDIANTE</button>

            <?php echo form_close(); ?>

            
        </div>
    </div>
</div>