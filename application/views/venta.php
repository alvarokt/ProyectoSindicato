
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        Caja
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box box-solid">
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        
                        <form action="<?php echo base_url();?>index.php/movimientos/ventas/store" method="POST" class="form-horizontal">
                            <div class="form-group">
                               
                                 
                            </div>

                            <div class="form-group">
                                <div class="col-md-6">
                                    <label for="">Socio:</label>
                                    <input type="text" class="form-control" id="nombresocio" />
                                </div>

                                <div class="col-md-6">
                                    <label for="">Linea:</label>
                                    <input type="text" class="form-control" id="producto">
                                </div>

                                <div class="row col-md-12">
                                    <div class="col col-md-6">
                                        <label for="">Número de hoja de ruta:</label>
                                        <input type="text" class="form-control" id="producto" required>
                                    </div>
                                    <div class="col col-md-2">
                                        <label for="">&nbsp;</label>
                                        <button id="btn-agregar" type="button" class="btn btn-success btn-flat btn-block"><span class="fa fa-plus"></span> Agregar</button>
                                    </div>
                                </div>

                                

                                
                            </div>
                            <div class="col-md-12">
                                <table id="tbventas" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th># Hoja de ruta</th>
                                        <th>Linea</th>
                                        <th>Stock</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Importe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                            </div>
                            

                            <div class="form-group">
                                
                                
                                    <div class="col-md-3">
                                        <label>TOTAL:</label>
                                        <br>
                                        <input type="text" class="form-control" placeholder="0.00" name="total" readonly="readonly">
                                    </div>
                                
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-success btn-flat">Guardar</button>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Lita de Clientes</h4>
            </div>
            <div class="modal-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Opcion</th>
                        </tr>
                    </thead>
                    <tbody>
                                <?php if(!empty($clientes)):?>
                                    <?php foreach($clientes as $cliente):?>
                                        <tr>
                                            <td><?php echo $cliente->id;?></td>
                                            <td><?php echo $cliente->nombre;?></td>
                                            <td><?php echo $cliente->num_documento;?></td>
                                            <?php $datacliente = $cliente->id."*".$cliente->nombre."*".$cliente->tipocliente."*".$cliente->tipodocumento."*".$cliente->num_documento."*".$cliente->telefono."*".$cliente->direccion;?>
                                            <td>
                                                <button type="button" class="btn btn-success btn-check" value="<?php echo $datacliente;?>"><span class="fa fa-check"></span></button>
                                              
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
