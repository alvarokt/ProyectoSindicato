
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1>Lista de socios deshabilitados</h1>


            <?php echo form_open_multipart('socio/index'); ?>
                <button type="submit" name="buton2" class="btn btn-primary">VER SOCIOS HABILITADOS</button>

            <?php echo form_close(); ?>

            <br>

            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Primer Apellido</th>
                    <th scope="col">Segundo Apellido</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Habilitar</th>

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
                                <?php echo form_open_multipart('socio/habilitarbd'); ?>
                                <input type="hidden" name="idsocio" value="<?php echo $row->idSocio; ?>">
                                <input type="submit" name="buttonz" value="Habilitar" class="btn btn-warning">
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