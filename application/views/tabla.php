
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Primer Apellido</th>
                    <th scope="col">Segundo Apellido</th>
                    <th scope="col">Telefono</th>
                    <th scope="col">Modificar</th>
                    <th scope="col">Eliminar</th>
                    <th scope="col">Deshabilitar</th>

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
                                <?php echo form_open_multipart('socio/eliminarbd'); ?>
                                <input type="hidden" name="idsocio" value="<?php echo $row->idSocio; ?>">
                                <input type="submit" name="buttonx" value="Eliminar" class="btn btn-danger">
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
