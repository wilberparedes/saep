<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>


<style>
    .dt-buttons{
        width: 50%;
        float: left;
    }
    .dt-button{
        border-radius: 5px;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid transparent;
            border-top-color: transparent;
            border-right-color: transparent;
            border-bottom-color: transparent;
            border-left-color: transparent;
        font-size: 14px;
        padding: 10px 20px;
        background-color: white;
        cursor: pointer;
    }
    .buttons-excel {
        border-color: #00a65a;
    }
    .buttons-pdf{
        border-color: #F83123;
    }
    .buttons-print{
        border-color: #0073B7;
    }
    .buttons-excel:hover {
        color: white;
        background-color: #00a65a;
    }
    .buttons-pdf:hover{
        color: white;
        background-color: #F83123;
    }
    .buttons-print:hover{
        color: white;
        background-color: #0073B7;
    }
    #tbl_entrevistas_filter > label  > input {
        display: block;
        width: 100%;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }
</style>
<script>

  $(function(){
    
  });

</script>

<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Reporte detalles entrevistas</h1>
  <ol class="breadcrumb">
    <li><a>Reportes y consultas</a></li>
    <li><i class="fa fa-angle-right"></i> Reporte detalles entrevistas</li>
  </ol>
</div>

<!-- Main content -->
<div class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-black">Filtros</h4>
                    <form id="frmFiltros" role="form" >
                        <div class="row">
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label>Periodo:</label>
                                    <select name="bPeriodo" id="bPeriodo" class="form-control">
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label>Modalidad de estudio:</label>
                                    <select name="bModalidad" id="bModalidad" class="form-control">
                                        <option value="todas">Todas</option>
                                        <option value="1">Presencial</option>
                                        <option value="4">Virtual</option>
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label>Sede:</label>
                                    <select name="bSede" id="bSede" class="form-control">
                                    </select>
                                </fieldset>
                            </div>
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label>Programa acádemico:</label>
                                    <select name="bPrograma" id="bPrograma" class="form-control">
                                    </select>
                                </fieldset>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button class="btn btn-primary" type="button" onclick="fgenerarReporte();">GENERAR REPORTE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="content report_estadoentrevistaxestado" style="display:none;">

    <div class="row" id="divcalendar">
        <div class="col-md-12">
            
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-body table-responsive">
                        <h4 class="text-black">Entrevistas <span class="estadoen"></span></h4><br>

                        <form action="../Excel" method="POST">
                            <input type="hidden" id="inputJson" name="inputJson">
                            <button type="submit" id="btnExcel" formtarget="_blank" class="btn btn-sm btn-outline-success" style="float: left;margin-right: 5px;"><i class="fa fa-file-excel-o"></i> EXPORTAR EXCEL</button>
                        </form>
                        <form action="../MasivoPDF" method="POST">
                            <input type="hidden" id="inputJsonPDF" name="inputJsonPDF">
                            <input type="hidden" id="codperiodo" name="codperiodo">
                            <button type="submit" id="btnPDF" formtarget="_blank" class="btn btn-sm btn-outline-danger"><i class="fa fa-file-pdf-o"></i> EXPORTAR PDFs</button>
                        </form>
                        <br/>
                        <table class="table table-bordered" id="tbl_entrevistas" style="text-align:center;">
                            <thead>
                                <tr class="bg-blue">
                                    <th scope="col">Sede</th>
                                    <th scope="col">Psicólogo</th>
                                    <th scope="col">Identificación estudiante</th>
                                    <th scope="col">Nombre estudiante</th>
                                    <th scope="col">Programa acádemico</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- MODALS -->
<!-- FIN MODALS -->

<script>

    $(function(){
        fLoadPeriodos();
        fLoadSedes("todas");
        fLoadProgramas("todas", "todas")
        $("#bModalidad").change(function(){
            fLoadSedes($(this).val());
            fLoadProgramas("todas", "todas");
        });
        $("#bSede").change(function(){
            fLoadProgramas($(this).val(), $("#bModalidad").val());
        });
        $("#bTipoReporte").change(function(){
            if($(this).val() == 'estadoentrevista'){
                $(".estadoentrevista").show();
            }
        });
    });

    function fLoadPeriodos(){
        
        $.ajax({
            url : "<?php url('Lopersa/sLoadPeriodos'); ?>",
            type : "POST",
            dataType : "JSON",
            success : function (json){
                if(json.success == true){
                    var html = '';
                    html += '<option value="">Seleccione...</option>';
                    json.periodos.forEach(element => {
                        html += '<option value="'+element.codigo+'" id="'+element.codigo+'" data-start="'+element.fechainicio+'" data-end="'+element.fechafin+'">'+element.nombre+'</option>';
                    });
                    $("#bPeriodo").html(html);

                }else{
                    toastr.error(json.mensaje);
                }
            }
        });
    }

    function fLoadSedes(modalidad){
        $("#bSede").html('<option value="">Cargando...</option>');
        $.ajax({
            url : "<?php url('Lopersa/sLoadSedes'); ?>",
            type : "POST",
            data: {
                modalidad
            },
            dataType : "JSON",
            success : function (json){
                if(json.success == true){
                    var html = '';
                    html += '<option value="todas">Todas</option>';
                    json.sedes.forEach(element => {
                        html += '<option value="'+element.codigo+'">'+element.nombre+'</option>';
                    });
                    $("#bSede").html(html);
                }else{
                    $("#bSede").html('<option value="">error</option>');
                }
            }
        });
    }

    function fLoadProgramas(sede, modalidad){
        $("#bPrograma").html('<option value="">Cargando...</option>');
        $.ajax({
            url : "<?php url('Lopersa/sLoadProgramas'); ?>",
            type : "POST",
            data: {
                sede,
                modalidad
            },
            dataType : "JSON",
            success : function (json){
                if(json.success == true){
                    var html = '';
                    html += '<option value="todos">Todos</option>';
                    json.sedes.forEach(element => {
                        html += '<option value="'+element.codigo+'">'+element.nombre+'</option>';
                    });
                    $("#bPrograma").html(html);
                }else{
                    toastr.error(json.mensaje);
                    $("#bPrograma").html('<option value="">error</option>');
                }
            }
        });
    }

    function reset(){
        $(".report_estadoentrevistaxestado").hide();
    }

    function fgenerarReporte(){
        reset();
                $(".report_estadoentrevistaxestado").show();
                $(".estadoen").text('gestionadas');
                floadEntrevistasxEstado('gestionadas');
    }
    var inittable = 0;
    var table;
    
    function floadEntrevistasxEstado(estado){
        var codperiodo = $("#bPeriodo").val();
        var datestart = $("#"+codperiodo).attr('data-start');
        var dateend = $("#"+codperiodo).attr('data-end');
        $('.desactivarC').fadeIn(500);
        if(inittable != 0){
            $('#tbl_entrevistas').DataTable().ajax.reload(function(json){
                $('#inputJson').val(JSON.stringify(json))
                $('#inputJsonPDF').val(JSON.stringify(json))
                $('#codperiodo').val($("#bPeriodo").val())
                $('[data-rel="tooltip"]').tooltip(); 
                $('.desactivarC').fadeOut(500);
            });
        }else{
            table = $('#tbl_entrevistas').dataTable({
                ajax : {
                    "url": "<?php url('Lopersa/loadEntrevistasGestionadas'); ?>",
                    "data":function (d){
                        d.estado = estado;
                        d.datestart = $("#"+$("#bPeriodo").val()).attr('data-start');
                        d.dateend = $("#"+$("#bPeriodo").val()).attr('data-end');
                        d.codperiodo =  $("#bPeriodo").val();
                        d.metodologia =  $("#bModalidad").val();
                        d.sede = $("#bSede").val();
                        d.codprograma =  $("#bPrograma").val();
                    }
                },
                "aoColumnDefs" : [{
                    "aTargets" : [0]
                }],
                "oLanguage" : {
                    "sLengthMenu" : "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "No hay Datos registrados en el sistema",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _MAX_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sLoadingRecords": "Cargando Datos...",
                    "sSearch" : "",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                },
                "searching": true,
                "aaSorting" : [[0, 'desc']],
                "aLengthMenu" : [
                    [10, 15, 20, -1], 
                    [10, 15, 20, "Todos"] // change per page values here
                ],
                "columns": [ //agregar configuraciones a cada una de las columnas de las tablas
                    {}, //column 1
                    { "class": "center", "orderable": false }, //column 2
                    { "orderable": false }, //column 3
                    { "class": "center", "orderable": false }, //column 4
                    { "class": "center", "orderable": false }, //column 5
                    { "class": "center", "orderable": false }, //column 6
                    { "class": "center", "orderable": false }, //column 7
                ],
                initComplete: function(oSettings, json) {
                    $('#inputJson').val(JSON.stringify(json))
                    $('#inputJsonPDF').val(JSON.stringify(json))
                    $('#codperiodo').val($("#bPeriodo").val())
                    $('[data-rel="tooltip"]').tooltip(); 
                    inittable = 1;
                    $('.desactivarC').fadeOut(500);
                },
                "iDisplayLength" : 10,
                'autoWidth'   : false
            });
        }
    }

</script>


<!-- /.content --> 



