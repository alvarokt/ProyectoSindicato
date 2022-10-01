 <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Lista de Socios</h1>
                    <p class="mb-4">Lista de socios activos.</p>

                     <?php echo form_open_multipart('socio/deshabilitados'); ?>
                        <button type="submit" name="buton2" class="btn btn-warning">VER SOCIOS DESHABILITADOS</button>
                    <?php echo form_close(); ?>

                    <br>

                    <?php echo form_open_multipart('socio/agregar'); ?>
                        <button type="submit" name="buton1" class="btn btn-primary">AGREGAR SOCIO</button>

                    <?php echo form_close(); ?>
