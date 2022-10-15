
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->
    <!-- Footer -->
    <footer class="sticky-footer bg-white">
        <div class="container my-auto">
            <div class="copyright text-center my-auto">
                <span>Copyright &copy; Sistema Web 2022</span>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Desea Salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Salir" para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>

                    <?php echo form_open_multipart('usuario/logout'); ?>
                        <button type="submit"  name="buton2" class="btn btn-primary">Salir</button>
                    <?php echo form_close(); ?>



                </div>
            </div>
        </div>
    </div>

    


<script src="<?php echo base_url();?>assets/template/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/template/jquery/jquery-3.6.0.min.js"></script>

   <!--  JS file -->
<script src="<?php echo base_url(); ?>autocomplete/jquery.easy-autocomplete.min.js"></script>

<!-- Using jQuery with a CDN
<script src="<?php echo base_url(); ?>sbadmin2/vendor/jquery/jquery.js"></script>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/jquery/jquery.min.js"></script> -->
<!-- jquery-ui -->
<script src="<?php echo base_url(); ?>sbadmin2/jquery-ui/jquery-ui.js"></script>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url(); ?>sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!--  Core plugin JavaScript
<script src="<?php echo base_url(); ?>sbadmin2/js/peticiones.js"></script> -->
<script src="<?php echo base_url(); ?>sbadmin2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url(); ?>sbadmin2/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url(); ?>sbadmin2/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts
<script src="<?php echo base_url(); ?>sbadmin2/js/demo/chart-area-demo.js"></script>
<script src="<?php echo base_url(); ?>sbadmin2/js/demo/chart-pie-demo.js"></script> -->
<script src="<?php echo base_url(); ?>sbadmin2/js/demo/datatables-demo.js"></script>

<script type="text/javascript">

$(document).ready(function(){

    var options = {
        url: "<?php echo base_url();?>index.php/socio/getdatos",

        getValue: "ciNit",

        list: {
            maxNumberOfElements: 4,
            match: {
                enabled: true
            },
            onChooseEvent: function() {

                var value1 = $("#nombresocio").getSelectedItemData().nombres;
                var value2 = $("#nombresocio").getSelectedItemData().idSocio;             

                $("#socioname").val(value1).trigger("change");
                $("#idsocios").val(value2).trigger("change");
            },
        }  
    };
    $("#nombresocio").easyAutocomplete(options);


    $('#nombresocio').keypress(function(e) {
        if (e.which == 13) {
            return false;
        }
    });

    
    // $("#lineatransporte").autocomplete({
    //     source:function(request, response){
    //         $.ajax({
    //             url: "<?php echo base_url();?>index.php/socio/getproductos",
    //             type: "POST",
    //             dataType: "json",
    //             data:{valor: request.term},
    //             success:function(data){
    //                 response(data);
    //             }
    //         });
    //     },
    //     minLength:3 ,
    //     select:function(event, ui){
    //         data = ui.item.idHoja_ruta + "*" + ui.item.label + "*" +ui.item.precioBase+ "*"+ui.item.saldo;
    //         $("#btn-agregar").val(data);

    //     },

    // });


    $('#btn-oksocio').on("click",function(){
        document.getElementById('linea').disabled=false;
        // $('#linea).prop('disabled', 'false');

    });


                       
    // $('#buscarmoviles').on("click",function(){
    // $("#idsocio").change(function() {
    //     $("#idsocio option:selected").each(function() {
    //         idsocio = $('#idsocio').val();
    //         $.post("<?php echo base_url(); ?>index.php/socio/fillAutoSocio", {
    //             idsocio : idsocio
    //         }, function(data) {
    //             $("#autosasociados").html(data);
    //         });
    //     });
    // });

    // });

    $("#linea").change(function() {
        $("#linea option:selected").each(function() {
                document.getElementById('autos').disabled=false;

                var idEstado = $('#idsocios').val();
                var idEstado2 = $('#linea').val();
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/venta/fillAutos/"+idEstado+"/"+idEstado2,
                        
                        // data:{idEstado:idEstado},
                        success:function(data)
                        {
                            $("#autos").html(data);
                        }
                    });
                    document.getElementById('hojas').disabled=false;
                    alert(idEstado2);
                    $.ajax({
                        type: "POST",
                        url: "<?php echo base_url();?>index.php/venta/fillHojas/"+idEstado2,
                        
                        // data1:{idEstado2:idEstado2},
                        success:function(data1)
                        {
                            $("#hojas").html(data1);
                        }
                    });
        });
    });

    // function activar(obj){
    //   if(obj.value=='activa')
    //          document.getElementById("dos").disabled=false;
    //   else
    //          document.getElementById("dos").disabled=true;  
    // }


    // $("#linea").change(function() {
    //     $("#linea option:selected").each(function() {
    //             var idEstado3 = $('#linea').val();
    //             alert(idEstado3);
    //             // var idEstado2 = $('#linea').val();
    //                 $.ajax({
    //                     type: "POST",
    //                     url: "<?php echo base_url();?>index.php/venta/fillHojas",
                        
    //                     data1:{idEstado3:idEstado3},
    //                     success:function(data1)
    //                     {
    //                         $("#hojas").html(data1);
    //                     }
    //                 });
    //     });
    // });



    $("#btn-agregar").on("click",function(){
        // data = $(this).val();

        var linea = $('#linea').val();
        var hoja = $('#hojas').val();
        // var hoja = document.getElementById("hojas");

        var lineadoc = document.getElementById("linea");
        var linealt = lineadoc.options[lineadoc.selectedIndex].text;

        var auto = document.getElementById("autos");
        var autoslt = auto.options[auto.selectedIndex].text;

        var hojadoc = document.getElementById("hojas");
        var hojalt = hojadoc.options[hojadoc.selectedIndex].text;

        alert(hoja);

        // var pb = $('#auso').val();
        alert(linea);
        if (hoja !='') {
            infohoja = hoja.split("*");
            html = "<tr>";
            html += "<td><input type='hidden' name='idhojaruta[]' value='"+infohoja[0]+"'>"+"•"+"</td>";
            // html += "<td><input type='hidden' name='idhojaruta[]' value='"+pb+"'>"+selected+"</td>";
            html += "<td><input type='text' name='cantidades[]' value='1' id='cantidades' style='width : 70px; heigth : 1px' readonly></td>";
            html += "<td style='font-size: 15px'><p>"+'HOJA DE RUTA #: '+hojalt+'<br>'+linealt+'<br>'+autoslt+"</p></td>";
            html += "<td><input type='hidden' name='precios[]' value='"+infohoja[1]+"'>"+infohoja[1]+"</td>";
            html += "<td><input type='hidden' name='importes[]' value='"+infohoja[1]+"'><p>"+infohoja[1]+"</p></td>";
            html += "<td><button type='button' id='eliminar' class='btn btn-danger btn-circle'><span class='fas fa-trash'></span></button></td>";
            html += "</tr>";
            $("#tbventas tbody").append(html);
            sumar();
            $("#btn-agregar").val(null);
            $("#lineatransporte").val(null);
            var prueba = $('#hojas').val();
            // let prueba = document.getElementById('hojas');
            // prueba.prop("disabled", true);
            alert(prueba);
            $("#hojas option:selected").prop("disabled", true);
            // prueba.remove(prueba.selectedIndex);
            // prueba.options[prueba].disabled.true;
        }else{
            alert("seleccione un producto...");
        }
    });

    $(document).on("click","#eliminar", function(){
        $(this).closest("tr").remove();
        sumar();
    });

    $(document).on("keyup","#tbventas input#cantidades", function(){
        cantidad = $(this).val();
        precio = $(this).closest("tr").find("td:eq(3)").text();
        importe = cantidad * precio;
        $(this).closest("tr").find("td:eq(4)").children("p").text(importe.toFixed(2));
        $(this).closest("tr").find("td:eq(4)").children("input").val(importe.toFixed(2));
        sumar();
    });

});

function sumar(){
    subtotal = 0;
    $("#tbventas tbody tr").each(function(){
        subtotal = subtotal + Number($(this).find("td:eq(3)").text());
    });
    $("input[name=subtotal]").val(subtotal.toFixed(2));
    total = subtotal;
    $("input[name=total]").val(total.toFixed(2));

}


</script>

<!-- <script type='text/javascript'>


    datagrafico();
    $(document).ready(function(){
        var year = (new Date).getFullYear();
        datagrafico(year);
        $("#year").on("change", function(){
            yearselect = $(this).val();
            datagrafico(yearselect);
            
        });

        $(".btn-view").on("click", function(){
            var id= $(this).val();
            $.ajax({
                url:  '<?=base_url()?>index.php/mantenimiento/Categorias/view',
                method: 'post',
                data: {id: id},
                dataType: 'json',
                success: function(response){

                    var len = response.length;
                                    
                        $('#suname,#sname,#semail').text('');
                        
                        if(len > 0){
                            // Read values
                            var nombre = response[0].nombre;
                            var descripcion = response[0].descripcion;

                            $("#modal-default .modal-body #name").html(nombre);
                            $("#modal-default .modal-body #description").html(descripcion);

                            
                        }

                }
            });

        });
        $("#example1").DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros por pagina",
            "zeroRecords": "No se encontraron resultados en su busqueda",
            "searchPlaceholder": "Buscar registros",
            "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
            "infoEmpty": "No existen registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
                },
            }
        });
        $('.slidebar-menu').tree();

        $("#comprobantes").on("change", function(){
            option =$(this).val();

            if(option != ""){
                infocomprobante = option.split("*");

                $("#idcomprobante").val(infocomprobante[0]);
                $("#igv").val(infocomprobante[2]);
                $("#serie").val(infocomprobante[3]);
                $("#numero").val(generarnumero(infocomprobante[1]));
            }else{
                $("#idcomprobante").val(null);
                $("#igv").val(null);
                $("#serie").val(null);
                $("#numero").val(null);
            }
            sumar();
        })
        $(document).on("click",".btn-check", function(){
            cliente = $(this).val();
            infocliente = cliente.split("*");
            $("#idcliente").val(infocliente[0]);
            $("#cliente").val(infocliente[1]);
            $("#modal-default").modal("hide");

        });
        $("#lineatransporte").autocomplete({
        source:function(request, response){
            $.ajax({
                url: "<?php echo base_url();?>index.php/socio/getdatos",
                type: "POST",
                dataType: "json",
                data:{valor: request.term},
                success:function(data){
                    response(data);
                }
            });
        },
        minLength:2,
        select:function(event, ui){
            data = ui.item.idHoja_ruta + "*" + ui.item.descripcion + "*" +ui.item.precioBase+ "*"+ui.item.saldo;
            $("#btn-agregar").val(data);

        },

        });
        $("#btn-agregar").on("click", function(){
            $data= $(this).val();
            if (data !=''){
                infoproducto = data.split("*");
                html = "<tr>";
                html += "<td><input type='hidden' name=idproductos[]' value='"+infoproducto[0]+"'>"+infoproducto[1]+"</td>";
                html += "<td>"+infoproducto[2]+"</td>";
                html += "<td><input type='hidden' name='precios[]' value='"+infoproducto[3]+"'>"+infoproducto[3]+"</td>";
                html += "<td>"+infoproducto[4]+"</td>";
                html += "<td><input type='text'> name='cantidades[]' value='1' class='cantidades'></td>";
                html += "<td><input type='hidden' name='importes[]' value='"+infoproducto[3]+"'><p>"+infoproducto[3]+"</p></td>";
                html += "<td><button type='button' class='btn btn-danger btn-remove-producto'><span class='fa fa-remove'></span> </button></td>";
                html += "</tr>";
                // $("#tbventas tbody").append(html);
                sumar();
                $("#btn-agregar").val(null);
                $("#producto").val(null);
                
                

            }else{
                alert("Seleccione un producto...");
            }

        });

        $(document).on("click",".btn-remove-producto", function(){
            $(this).closest("tr").remove();
            sumar();
        });

        $(document).on("keyup","#tbventas input.cantidades", function(){
            cantidad = $(this).val();
            precio = $(this).closest("tr").find("td:eq(2)").text();
            importe = cantidad * precio;
            $(this).closest("tr").find("td:eq(5)").children("p").text(importe.toFixed(2));
            $(this).closest("tr").find("td:eq(5)").children("input").val(importe.toFixed(2));
            sumar();
        });
        $(document).on("click" ,".btn-view-venta", function(){
            valor_id = $(this).val();
                $.ajax({
                    url: '<?=base_url()?>index.php/movimientos/ventas/view',
                    type:"POST",
                    dataType:"html",
                    data:{id:valor_id},
                    success:function(data){
                        $("#modal-default .modal-body").html(data);
                    }
                });

        });

    })

    function generarnumero(numero){
        if(numero>=99999 && numero<999999){   
            return Number(numero)+1;
        }
        if(numero>=9999 && numero<99999){   
            return "0" + (Number(numero)+1);
        }
        if(numero>=999 && numero<9999){   
            return "00" + (Number(numero)+1);
        }
        if(numero>=99 && numero<999){   
            return "000" + (Number(numero)+1);
        }
        if(numero>=9 && numero<99){   
            return "0000" + (Number(numero)+1);
        }
        if(numero < 9){   
            return "00000" + (Number(numero)+1);
        }
    }
    function sumar(){
        subtotal = 0;
        $("#tbventas tbody tr").each(function(){
            subtotal = subtotal + Number($(this).find("td:eq(5)").text());

        });
        $("input[name=subtotal]").val(subtotal.toFixed(2));
        porcentaje = $("#igv").val();
        igv = subtotal * (porcentaje/100);

        $("input[name=igv]").val(igv.toFixed(2));
        descuento = $("input[name=descuento]").val();
        total = subtotal + igv - descuento;

        $("input[name=total]").val(total.toFixed(2));

    }
    function datagrafico(year){
        namesMonth=["Ene","Feb","Mar","Abr","May","jun","jul","Ago","Set","Oct","Nov","Dic"];
            $.ajax({
                url: '<?=base_url()?>index.php/Dashboard/getData',
                type:"POST",
                data:{year: year},
                dataType:"json",
                success:function(data){
                    var meses = new Array();
                    var montos = new Array();
                    $.each(data,function(key,value){
                        meses.push(namesMonth[value.mes - 1]);
                        valor = Number(value.monto);
                        montos.push(valor);

                    });
                    graficar(meses,montos,year);
                }
            })
    }
    function graficar(meses,montos,year){
            Highcharts.chart('grafico', {
            chart: {
            type: 'column'
            },
            title: {
            text: 'Monto acumulado de la venta por meses'
            },
            subtitle: {
            text: 'Año: ' + year
            },
            xAxis: {
            categories: meses,
            crosshair: true
            },
            yAxis: {
            min: 0,
            title: {
                text: 'Monto acumulado (Bolivianos)'
            }
            },
            tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">Monto: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} Bolivianos</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
            },
            plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
            },
            series: [{
            name: 'Meses',
            data: montos

            }]
            });
    }
</script> -->



</body>
</html>