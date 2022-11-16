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
    // $(".content-header h1, .breadcrumb li").text($("#m"+localStorage.idpaginaSAEP+" a span").text());
    
  });

</script>

<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Reporte general</h1>
  <ol class="breadcrumb">
    <li><a>Reportes y consultas</a></li>
    <li><i class="fa fa-angle-right"></i> Reporte general</li>
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

                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                    <label>Tipo de reporte:</label>
                                    <select name="bTipoReporte" id="bTipoReporte" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="estadoentrevista">Estado de la entrevista</option>
                                        <!-- <option value="cumplimientometas">Cumplimiento de metas</option> -->
                                        <!-- <option value="estadomatricula">Estado de matricula</option> -->
                                    </select>
                                </fieldset>
                            </div>

                            <div class="col-lg-12 estadoentrevista" style="display: none">
                                <fieldset class="form-group">
                                    <label>Estado de la entrevista:</label>
                                    <select name="bEstadoEntrevista" id="bEstadoEntrevista" class="form-control">
                                        <option value="todos">Todos</option>
                                        <option value="gestionadas">Gestionadas</option>
                                        <option value="vencidas">Vencidas</option>
                                        <option value="pendientes">Pendientes</option>
                                        <option value="canceladas">Canceladas</option>
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


<div class="content report_estadoentrevista" style="display:none;">

    <div class="row">

          <div class="col-lg-12" style="margin: 0 auto;">
            <div class="info-box">
              <div class="col-12">
                <div class="d-flex flex-wrap">
                  <div>
                    <h5 class="m-b-15">Estadística</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 m-auto m-top-40 m-bot-10">
                <div id="donut" style="margin-top: 20px"></div>
              </div>
            </div>
          </div>
        
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-body table-responsive">
                        <table class=" table table-bordered" style="text-align:center;">
                            <thead>
                                <tr class="bg-blue">
                                    <th scope="col"># de entrevistas Solicitadas</th>
                                    <th scope="col"># de entrevistas Gestionadas</th>
                                    <th scope="col"># de entrevistas Pendientes</th>
                                    <th scope="col"># de entrevistas Vencidas</th>
                                    <th scope="col"># de entrevistas Canceladas</th>
                                    <th scope="col">% de Cumplimiento</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td id="numSolicitadas" style="font-size: 28px;"></td>
                                    <td id="numGestionadas" style="font-size: 28px;"></td>
                                    <td id="numPendientes" style="font-size: 28px;"></td>
                                    <td id="numVencidas" style="font-size: 28px;"></td>
                                    <td id="numCanceladas" style="font-size: 28px;"></td>
                                    <td id="porCumplimiento" style="font-size: 28px;"></td>
                                </tr>
                            </tbody>
                        </table>
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

                        <form action="../ExportarExcelxEstados" method="POST">
                            <input type="hidden" id="inputJson" name="inputJson">
                            <button type="submit" id="btnExcel" formtarget="_blank" class="btn btn-sm btn-outline-success" style="float: left;margin-right: 5px;"><i class="fa fa-file-excel-o"></i> EXPORTAR EXCEL</button>
                        </form>

                        <table class=" table table-bordered" id="tbl_entrevistas" style="text-align:center;">
                            <thead>
                                <tr class="bg-blue">
                                    <th scope="col">Sede</th>
                                    <th scope="col">Psicólogo</th>
                                    <th scope="col">Identificación estudiante</th>
                                    <th scope="col">Nombre estudiante</th>
                                    <th scope="col">Nro. teléfono estudiante</th>
                                    <th scope="col">Programa acádemico</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora inicio</th>
                                    <th scope="col">Notificado</th>
                                    <th scope="col">Nro. de días vencida</th>
                                    <th scope="col">En seguimiento</th>
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

<div class="modal" id="calendarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header" style="display:block">
            <h5 class="modal-title" style="float:left;">Observaciones: </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            <?php
                if($_SESSION["SAEP_codperfil"] != 3){
                    echo '<a onclick="newObservation();" class="btn btn-sm btn-success" style="cursor:pointer;float:right;">Nueva</a>';
                }
            ?>
           
        </div>
        <div class="modal-body">
          <input type="hidden" id="eventID" />
          <input type="hidden" id="codperiodotemp" />
          <input type="hidden" id="codprogramatemp" />
          <input type="hidden" id="idpsico" />
          <input type="hidden" id="snp" />
          <input type="hidden" id="nombreestudiante" />
          <input type="hidden" id="nombrepsicologo" />
          <input type="hidden" id="programa" />
          
          <input type="hidden" id="fecha" />
          <input type="hidden" id="fecha1" />
          <input type="hidden" id="hora" />
          
          
          
          <div class="observaciones">
            
            <div style="display:block; overflow:hidden;">
              <!-- <h6 style="float:left;">Observaciones:</h6> -->

                <div class="pCancelacion">
                    <p class="pCancelacion"><b style="color:#333 !important">Fecha de cancelación de entrevista: </b><span style="color:#333 !important" id="sFechaCancelacion"></span></p>
                    <p class="pCancelacion"><b style="color:#333 !important">Motivo de cancelación de entrevista: </b><span style="color:#333 !important" id="motivosCancelacion"></span></p>
                    <hr class="pCancelacion">
                </div>

                <div class="pGestionada">
                    <p class="pGestionada"><b style="color:#333 !important">Fecha de gestión de entrevista: </b><span style="color:#333 !important" id="sFechaGestion"></span></p>
                    <hr class="pGestionada">
                </div>
              
            </div>
              <div class="list-group" id="listobservaciones"> 
                
              </div>
            </div>

        </div>
          <div class="modal-footer" id="btnGes">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
    </div>
  </div>

<div class="modal" id="observationModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Observación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <fieldset class="form-group">
                <label>Escriba su observación:</label>
                <textarea class="form-control" name="txaObservacion" id="txaObservacion" cols="30" rows="5"></textarea>
                </fieldset>
            </div>
            <div class="modal-footer" >
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="saveObservacion()">Guardar</button>
            </div>
        </div>
    </div>
</div>

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
        $(".report_estadoentrevista").hide();
        $(".report_estadoentrevistaxestado").hide();
    }

    function fgenerarReporte(){
        var tiporeporte = $("#bTipoReporte").val();
        var estadoentrevista = $("#bEstadoEntrevista").val();
        reset();
        if(tiporeporte == ''){
            toastr.error("Por favor, seleccione un Tipo de reporte");
        }
        else if(tiporeporte == 'estadoentrevista'){
            if(estadoentrevista == 'todos'){
                floadStatistics();
            }else{
                $(".report_estadoentrevistaxestado").show();
                $(".estadoen").text($("#bEstadoEntrevista").val());
                // $('#tbl_entrevistas').destroy();
                floadEntrevistasxEstado($("#bEstadoEntrevista").val());
            }
        }
    }

    function floadStatistics(){
        $('.desactivarC').fadeIn(500);
        $(".report_estadoentrevista").show();
        $("#donut").empty();
        $("#numSolicitadas").text('');
        $("#numGestionadas").text('');
        $("#numPendientes").text('');
        $("#numVencidas").text('');
        $("#numCanceladas").text('');
        $("#porCumplimiento").text('%');
        // ======
        // Donut Chart Starts
        // ======
        var codperiodo = $("#bPeriodo").val();
        var datestart = $("#"+codperiodo).attr('data-start');
        var dateend = $("#"+codperiodo).attr('data-end');

        var metodologia =  $("#bModalidad").val();
        var sede = $("#bSede").val();
        var codprograma =  $("#bPrograma").val();
        $.ajax({
            url: "<?php url('Lopersa/loadDonutReporteMercadeo'); ?>",
            type: 'POST',
            dataType: "JSON",
            data: {
                datestart,
                dateend,
                codperiodo,
                metodologia,
                sede,
                codprograma
            },
            success: function( json ) {
                if(json.success){
                    $("#numSolicitadas").text(json.total);
                    $("#numGestionadas").text(json.gestionadas);
                    $("#numPendientes").text(json.pendientes);
                    $("#numVencidas").text(json.vencidas);
                    $("#numCanceladas").text(json.canceladas);
                    $("#porCumplimiento").text(json.porges+'%');

                    Morris.Bar({
                        element: 'donut',
                        data: [
                            {y: 'Gestionadas', a: json.porges},
                            {y: 'Pendientes', a: json.porpen},
                            {y: 'Vencidas', a: json.porven,},
                            {y: 'Canceladas', a: json.porcan},
                        ],
                        xkey: 'y',
                        ykeys: ['a'],
                        labels: ['Porcentaje'],
                        hideHover: false,
                        barColors: function (row, series, type) {
                            if(row.label == "Vencidas") return "#f45959";
                            else if(row.label == "Pendientes") return "#ffac64";
                            else if(row.label == "Gestionadas") return "#3ace43";
                            else if(row.label == "Canceladas") return "#868E96";
                        },
                        formatter: function (x) { console.log(x)}
                    }).on('click', function(i, row){
                        resize: true
                    });

                    
                }else{
                    toastr.error(json.message);
                }
            }, complete: function(){
                $('.desactivarC').fadeOut(500);
            }
        });
        // ======
        // Donut chart End
        // ======
    }

    var inittable = 0;
    var table;
    function floadEntrevistasxEstado(estado){
        var estado = $("#bEstadoEntrevista").val();
        var codperiodo = $("#bPeriodo").val();
        var datestart = $("#"+codperiodo).attr('data-start');
        var dateend = $("#"+codperiodo).attr('data-end');
        $('.desactivarC').fadeIn(500);
        if(inittable != 0){
            $('#tbl_entrevistas').DataTable().ajax.reload(function(json){
                console.log('reload')
                console.log(json)
                $('#inputJson').val(JSON.stringify(json))
                $('[data-rel="tooltip"]').tooltip(); 
                $('.desactivarC').fadeOut(500);
            });
        }else{
            table = $('#tbl_entrevistas').dataTable({
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        text : 'Excel',
                        filename: function(){
                            var d = new Date();
                            var n = d.getTime();
                            return 'Reporte entrevistas ' + $("#bEstadoEntrevista").val() +' ' + n;
                        },
                    },
                    {
                        extend: 'print',
                        text : 'Imprimir',
                        filename: function(){
                            var d = new Date();
                            var n = d.getTime();
                            return 'Reporte entrevistas ' + $("#bEstadoEntrevista").val() +' ' + n;
                        },
                    }
                ],
                ajax : {
                    "url": "<?php url('Lopersa/loadEntrevistasxEstado'); ?>",
                    "data":function (d){
                        d.estado = $("#bEstadoEntrevista").val();
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
                    { "class": "center", "orderable": false }, //column 4
                    { "class": "center", "orderable": false }, //column 5
                    { "class": "center", "orderable": false }, //column 6
                    { "class": "center", "orderable": false }, //column 7
                    { "class": "center", "orderable": false }, //column 8
                    { "class": "center", "orderable": false }, //column 9
                    { "class": "center", "orderable": false }, //column 10
                    
                ],
                initComplete: function(oSettings, json) {
                    console.log('initComplete')
                    console.log(json)
                    $('#inputJson').val(JSON.stringify(json))
                    $('[data-rel="tooltip"]').tooltip(); 
                    inittable = 1;
                    $('.desactivarC').fadeOut(500);
                },
                "iDisplayLength" : 10,
                'autoWidth'   : false
            });
        }
    }


    function floadObservaciones(id, codperiodo, codprograma, idpsico, snp, nombreestudiante, nombrepsicologo, programa, fecha, estado, fechagestion){
        $("#eventID").val(id);
        $("#codperiodotemp").val(codperiodo);
        $("#codprogramatemp").val(codprograma);
        $("#idpsico").val(idpsico);
        $("#snp").val(snp);
        $("#nombreestudiante").val(nombreestudiante);
        $("#nombrepsicologo").val(nombrepsicologo);
        $("#programa").val(programa);
        $("#fecha1").val(fecha);
        $("#fecha").val($.fullCalendar.moment(fecha).format('DD/MMMM/YYYY'));
        $("#hora").val($.fullCalendar.moment(fecha).format('h:mm a'));
        
        
        var loading = '<div class="list-group-item list-group-item-action flex-column align-items-start"><p class="mb-1">Cargando...</p></div>';
        $("#listobservaciones").html(loading);
        $(".observaciones").show();
        $.ajax({
        url: "<?php url('Lopersa/loadObservaciones'); ?>",
        type: 'POST',
        dataType: "JSON",
        data: {
            codperiodo,
            documento: id,
            codprograma,
            estado
        },
        success: function( data ) {
            var html = '';
            if(estado == 'canceladas'){
                $("#sFechaCancelacion").text(data.fechaCancelacion);
                $("#motivosCancelacion").text(data.motivos);
                $(".pCancelacion").show();
                $(".pGestionada").hide();
            }else if(estado == 'gestionadas'){
                $(".pGestionada").show();
                $(".pCancelacion").hide();
                $("#sFechaGestion").text(fechagestion);
            }else{
                $(".pGestionada").hide();
                $(".pCancelacion").hide();
            }
            if(data.observaciones == ''){
                html += '<div class="list-group-item list-group-item-action flex-column align-items-start">';
                html += '<div class="d-flex w-100 justify-content-between">';
                html += '</div>';
                html += '<p class="mb-1">Ninguna</p>';
                html += '</div> ';
            }else{
                $.each(data.observaciones,function(k,v){
                    html += '<div class="list-group-item list-group-item-action flex-column align-items-start">';
                    html += '<div class="d-flex w-100 justify-content-between">';
                    html += '<h5 class="mb-1" style="font-size: 15px;"><i><b class="gray">'+v.nombrepsicologo+' - '+v.nombreperfil.toUpperCase() +'</b></i></h5>';
                    html += '<small>'+v.fechahora+'</small> ';
                    html += '</div>';
                    html += '<p class="mb-1">'+v.novedad.toLowerCase()+'</small>';
                    html += '</div>';
                });
            }
            $("#listobservaciones").html(html);
            $('#calendarModal').modal();
        }, complete: function(){
            $('.desactivarC').fadeOut(500);
        }
        });
    }

    function newObservation(){
        $("#observationModal").modal();
    }

    function saveObservacion(){
        var txaObservacion = $("#txaObservacion").val();
        var id = $("#eventID").val();
        if(txaObservacion.trim() == ''){
            toastr.error("Por favor, ingrese observación");
        }else{
            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "<?php url('Lopersa/saveObservacion'); ?>",
                type: 'POST',
                dataType: "JSON",
                data: {
                    codperiodo : $('#codperiodotemp').val(),
                    idpsicologo: $("#idpsico").val(),
                    snp: $("#snp").val(),
                    novedad: txaObservacion.toLowerCase(),
                    documento: id,
                    nombre: $("#nombreestudiante").val(),
                    nombrepsico: $("#nombrepsicologo").val(),
                    codprograma: $("#codprogramatemp").val(),
                    programa :  $("#programa").val(),
                    fecha: $("#fecha").val(),
                    horainicio: $("#hora").val()
                },
                success: function( json ) {
                if(json.success){
                    floadObservaciones(id, $('#codperiodotemp').val(), $("#codprogramatemp").val(), $("#idpsico").val(), $("#snp").val(),  $("#nombreestudiante").val(), $("#nombrepsicologo").val(),  $("#programa").val(), $("#fecha1").val());
                    $('#tbl_entrevistas').DataTable().ajax.reload();
                    $("#observationModal").modal('hide');
                    $("#txaObservacion").val('');
                    toastr.success("Observación guardada con exito!");
                }else{
                    toastr.error(json.message);
                }
                }, complete: function(){
                $('.desactivarC').fadeOut(500);
                }
            });
        }
    }

</script>


<!-- /.content --> 



