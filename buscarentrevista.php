<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>

<style>
  .btn-rounded{
    color: #dc3545;
  }
  .btn-rounded:hover{
    color: white;
  }
  a:focus {
    outline: none;
    text-decoration: none;
    color: #dc3545;
    box-shadow: none;
  }
</style>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Buscar Entrevista</h1>
  <ol class="breadcrumb">
    <li><a>Cronograma de entrevistas</a></li>
    <li><i class="fa fa-angle-right"></i> Buscar entrevista</li>
  </ol>
</div>

<!-- Main content -->
<div class="content">
  <div class="row">
    
      <div class="col-12">
          <div class="card">
              <div class="card-body">
                <h4 class="text-black">Búsqueda</h4>
                <form id="frmBusqueda" role="form" >
                  <div class="row">
                    <div class="col-lg-3">
                      <fieldset class="form-group">
                        <label>Identificación del estudiante:</label>
                        <input class="form-control" id="bCodEstudiante" name="bCodEstudiante" type="number">
                      </fieldset>
                    </div>
                    <div class="col-lg-3">
                      <fieldset class="form-group">
                        <label>Periodo académico:</label>
                        <select class="form-control" name="codperiodo_" id="codperiodo_">
                          <option value="">Seleccione</option>
                          <option value="20201">20201</option>
                          <option value="20202">20202</option>
                          <option value="20211">20211</option>
                          <option value="20212">20212</option>
                          <option value="20221">20221</option>
                        </select>
                      </fieldset>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label style="width:100%">Acciones</label>
                        <div class="btn-group" role="group" >
                          <button type="button" class="btn btn-primary" onclick="buscar();"><i class="fa fa-search"></i> Buscar</button>
                          <button type="button" class="btn btn-danger tooltips" data-rel="tooltip" data-placement="bottom" title="Limpiar búsqueda" onclick="deletebus()"><i class="fa fa-trash-o"></i></button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
          </div>
      </div>

      <div class="col-12 m-t-3">
        <div class="card">
          <div class="card-body">
            <h4 class="text-black" style="float: left;">Detalles de entrevista</h4>
            <div style="float: left;margin-top: -8px;margin-left: 15px;margin-bottom: 8px;">
              <form action="../PDF" method="post">
                <input type="hidden" id="idestudiante" name="idestudiante">
                <input type="hidden" id="snp" name="snp">
                <input type="hidden" id="idpsico" name="idpsico">
                <input type="hidden" id="codprogramatemp" name="codprogramatemp">
                <input type="hidden" id="codperiodotemp" name="codperiodotemp">
                <button type="submit" id="btnPDF" formtarget="_blank" class="btn btn-rounded btn-outline-danger" style="display: none;"><i class="fa fa-file-pdf-o" style=""></i> VER PDF</button>
              </form>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tbl_detalle" style="display:none;">
                    
                    <tr id="trSede">
                      <td  style="width:22%;"><b>Sede: </b></td>
                      <td id="sede"></td>
                    </tr>
                    <tr>
                      <td style="width:22%;"><b>Psicólogo: </b></td>
                      <td id="psicologo"></td>
                    </tr>
                    <tr>
                      <td ><b>Nombre estudiante: </b></td>
                      <td id="nombreestudiante"></td>
                    </tr>
                    <tr>
                      <td ><b>Nro. teléfono estudiante: </b></td>
                      <td id="telefonoestudiante"></td>
                    </tr>
                    <tr>
                      <td ><b>Programa académico: </b></td>
                      <td id="programa"></td>
                    </tr>
                    <tr id="trFecha">
                      <td ><b>Fecha: </b></td>
                      <td id="fecha"></td>
                    </tr>
                    <tr id="trHoraInicio">
                      <td ><b>Hora inicio: </b></td>
                      <td id="horainicio"></td>
                    </tr>
                    <tr id="trHoraFin">
                      <td ><b>Hora fin: </b></td>
                      <td id="horafin"></td>
                    </tr>
                    <tr>
                      <td ><b>Notificado: </b></td>
                      <td id="notificado"></td>
                    </tr>
                    <tr class="enGestion">
                      <td><b>Evidencias pruebas psicotécnicas:</b></td>
                      <td id="evidenciaspruebaspsico"></td>
                    </tr>
                    <tr>
                      <td ><b>Estado: </b></td>
                      <td id="estado" style="color: white !important"></td>
                    </tr>
                    <tr class="enGestion">
                      <td><b>Fecha de ejecución de entrevista:</b></td>
                      <td id="fechaejecucion"></td>
                    </tr>
                    <tr class="enCancelacion">
                      <td><b>Fecha de cancelación de entrevista:</b></td>
                      <td id="fechacancelacion"></td>
                    </tr>
                    <tr class="enCancelacion">
                      <td><b>Motivo de cancelación de entrevista:</b></td>
                      <td id="motivoscancelacion"></td>
                    </tr>
                    
                </table>

                <table class="table table-striped table-bordered" id="tbl_init"> 
                    <tr>
                        <td class="text-center"><b id="tdcargando" >Sin detalles que mostrar</b></td>
                    </tr>
                </table>

                <div class="observaciones" style="display:none">
                  <div style="display:block; overflow:hidden;">
                    <h6 style="float:left;">Observaciones:</h6>
                    <?php
                      if($_SESSION['SAEP_codrol'] == 4){
                        echo '<a onclick="newObservation();" style="cursor:pointer;float:right;">Nueva</a>';
                      }
                    ?>
                  </div>
                    <div class="list-group" id="listobservaciones"> 
                    
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<!-- MODAL -->
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

    $("#frmBusqueda").submit(function( event ) {
      event.preventDefault();
      buscar();
    });

    //---------------
  });

  function deletebus(){
    $("#idpsico").val('');
    $("#snp").val('');
    $("#bCodEstudiante").val('');
    $("#tbl_detalle").hide();
    $("#tbl_init").show();
    $(".form-group").removeClass("has-error");
    $("#tdcargando").text('Sin detalles que mostrar');
    $(".observaciones").hide();
    $("#idestudiante").val('');
  }

  function buscar(){

    var regexname = /^[0-9]*$/;
    var bCodEstudiante = $("#bCodEstudiante").val();
    var codperiodo_ = $("#codperiodo_").val();
    console.log('codperiodo_',codperiodo_)
    if(bCodEstudiante == ''){
      toastr.error("Por favor, ingrese Identificación de estudiante");
      $("#bCodEstudiante").focus();
      $("#bCodEstudiante").parent().addClass("has-error");
    }
    else if(!regexname.test(bCodEstudiante)){
      toastr.error("Ingrese solo números en Identificación");
      $("#bCodEstudiante").focus();
      $("#bCodEstudiante").parent().addClass("has-error");
    }
    else if(codperiodo_ == ''){
      toastr.error("Por favor, seleccione Periodo académico");
      $("#codperiodo_").focus();
      $("#codperiodo_").parent().addClass("has-error");
    }
    else {
        deletebus();
        $(".form-group").removeClass("has-error");
        $("#tbl_detalle").hide();
        $("#tbl_init").show();
        $("#tdcargando").text('cargando...');
        $('.desactivarC').fadeIn(500);
        $("#bCodEstudiante").val(bCodEstudiante);
        $("#evidenciaspruebaspsico").html("");
        $.ajax({
            url: "<?php url('Lopersa/detalleEntrevista'); ?>",
            type: 'POST',
            dataType: "JSON",
            data: {
              documento: bCodEstudiante,
              codperiodo_: $("#codperiodo_").val()
            },
            success: function( json ) {
                if(json.success){
                  
                  if(json.estado == 'Gestionada'){
                    $("#trSede").hide();
                    $("#btnPDF").show();
                    $("#trHoraInicio").hide();
                    $("#trHoraFin").hide();
                    $("#evidenciaspruebaspsico").html(json.evidenciasPruebaPsico);
                    // $("#trFecha").hide();
                    if(json.fecha){
                      $("#fecha").text(json.fecha);
                    }else{
                      var fh = $.fullCalendar.moment(json.start).format('DD/MMMM/YYYY');
                      $("#fecha").text(fh);
                    }
                  }else{
                    $("#btnPDF").hide();
                    $("#trSede").show();
                    // $("#trFecha").show();
                    var fh = $.fullCalendar.moment(json.start).format('DD/MMMM/YYYY');
                    var starttime = $.fullCalendar.moment(json.start).format('h:mm a');
                    var endtime = $.fullCalendar.moment(json.end).format('h:mm a ');
                    $("#fecha").text(fh);
                    $("#horainicio").text(starttime);
                    $("#horafin").text(endtime);
                    $("#trHoraInicio").show();
                    $("#trHoraFin").show();
                  }

                    $("#codperiodotemp").val(json.codperiodo);
                    $("#idpsico").val(json.idpsicologo);
                    $("#idestudiante").val(json.id);
                    $("#sede").text(json.sede);
                    $("#psicologo").text(json.nombrepsicologo);
                    $("#nombreestudiante").text(json.nombreestudiante);
                    $("#telefonoestudiante").text(json.telefonoestudiante);
                    $("#codprogramatemp").val(json.codprograma);
                    $("#programa").text(json.codprograma + ' - ' + json.programa);
                    $("#snp").val(json.snp);
                    $("#notificado").text(json.estNoti);
                    $("#estado").text(json.estado).css('background-color', json.backgroundColor)

                    if(json.aas == 1){
                      $("#fechaejecucion").text(json.fechagestion);
                      $(".enGestion").show();
                      $(".enCancelacion").hide();
                    }else if(json.aas == 2 || json.aas == 3){
                      $(".enGestion").hide();
                      $(".enCancelacion").hide();
                    }else if(json.aas == 4){
                      $(".enGestion").hide();
                      $("#fechacancelacion").text(json.fechacancelacion);
                      $("#motivoscancelacion").text(json.motivos);
                      $(".enCancelacion").show();
                    }

                    $("#tbl_detalle").show();
                    $("#tbl_init").hide();
                    
                }else{
                    $("#tdcargando").text('Sin detalles que mostrar');
                    $("#tbl_detalle").hide();
                    $("#tbl_init").show();
                    toastr.error(json.message);
                }
            }, complete: function(){
              floadObservaciones(bCodEstudiante);
            }
        });
    }
  }


  function floadObservaciones(id){
    var loading = '<div class="list-group-item list-group-item-action flex-column align-items-start"><p class="mb-1">Cargando...</p></div>';
    $("#listobservaciones").html(loading);
    $(".observaciones").show();
    $.ajax({
      url: "<?php url('Lopersa/loadObservaciones'); ?>",
      type: 'POST',
      dataType: "JSON",
      data: {
        codperiodo : $('#codperiodotemp').val(),
        documento: id,
        codprograma: $("#codprogramatemp").val(),
      },
      success: function( data ) {
        var html = '';
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
            html += '<h5 class="mb-1" style="font-size: 15px;"><i><b class="gray">'+v.nombrepsicologo+' - '+v.nombreperfil.toLowerCase() +'</b></i></h5>';
            html += '<small>'+v.fechahora+'</small> ';
            html += '</div>';
            html += '<p class="mb-1">'+v.novedad.toLowerCase()+'</small>';
            html += '</div>';
          });
        }
        $("#listobservaciones").html(html);
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
    var id = $("#idestudiante").val();
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
          nombre: $("#nombreestudiante").text(),
          nombrepsico: $("#psicologo").text(),
          codprograma: $("#codprogramatemp").val(),
          programa : $("#programa").text(),
          fecha: $("#fecha").text(),
          horainicio: $("#horainicio").text()
        },
        success: function( json ) {
          if(json.success){
            floadObservaciones(id);
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