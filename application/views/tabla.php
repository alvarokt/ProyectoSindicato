<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Primer Apellido</th>
                    <th>Segundo Apellido</th>
                    <th>Telefono</th>
                    <th>Modificar</th>
                    <th>Deshabilitar</th>

                </tr>
                </thead>
                <tbody>
                    <?php 
                    $indice = 1;
                    foreach ($socio->result() as $row) 
                    {   
                        ?>
                         <tr>
                            <th scope="row"><?php echo $indice; ?></th>
                            <td><?php echo $row->nombres; ?></td>
                            <td><?php echo $row->apellidoPaterno; ?></td>
                            <td><?php echo $row->apellidoMaterno; ?></td>
                            <td><?php echo $row->telefono; ?></td>
                            <td>
                                <?php echo form_open_multipart('socio/modificar'); ?>
                                <input type="hidden" name="idsocio" value="<?php echo $row->idSocio; ?>">
                                <input type="submit" name="buttony" value="Modificar" class="btn btn-success">
                                <?php echo form_close(); ?>

                            </td>


                            <td>
                                <?php echo form_open_multipart('socio/deshabilitarbd'); ?>
                                <input type="hidden" name="idsocio" value="<?php echo $row->idSocio; ?>">
                                <input type="submit" name="buttonz" value="Deshabilitar" class="btn btn-warning">
                                <?php echo form_close(); ?>

                            </td>

                        </tr>
                        <?php
                        $indice++;        
                    }    
                    ?>
                   
                </tbody>
            </table>
        </div>
    </div>
</div>