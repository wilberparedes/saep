<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Conceptos a Evaluar</h1>
  <ol class="breadcrumb">
    <li><a>Gestión de Datos</a></li>
    <li><i class="fa fa-angle-right"></i> Conceptos a Evaluar</li>
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
                        <label>Aspecto evaluativo:</label>
                        <select id="sAspectos" name="sAspectos" class="form-control"></select>
                      </fieldset>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label style="width:100%">Acciones</label>
                        <div class="btn-group" role="group" >
                          <button type="button" class="btn btn-primary" onclick="buscar();"><i class="fa fa-search"></i> Buscar</button>
                          <button type="button" class="btn btn-danger tooltips" data-rel="tooltip" data-placement="bottom" title="Limpiar búsqueda" onclick="realoadTable('tbl_conceptos', '<?php url("Lopersa/loadMunicipios"); ?>'); $('#sAspectos').val('');"><i class="fa fa-trash-o"></i></button>
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
            <h4 class="text-black">Listado</h4>
            <div class="table-responsive">
              <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Concepto</a>
              <table id="tbl_conceptos" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Aspecto evaluativo</th>
                    <th>Nombre concepto</th>
                    <th>Preguntas sugeridas</th>
                    <th>Estado Concepto</th>
                    <th style="width: 100px;">Acciones</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>

<!-- MODAL -->

  <div class="modal fade" id="mEditar" tabindex="-1" role="dialog" aria-labelledby="mEditar" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <input type="hidden" id="txtCodConcepto" name="txtCodConcepto">
                  <h4 class="modal-title"><strong>Editar Concepto</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmEditar" method="POST" class="form-horizontal">
                      <div class="form-body row">
                          <div class="form-group col-lg-12" >
                              <label>Aspecto: </label>
                              <select id="bAspectos" name="bAspectos" class="form-control">
                                <option value="" selected="">Seleccione</option>
                              </select>
                          </div>

                            <div class="form-group col-lg-12">
                                <label class="control-label ">Nombre Concepto
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="txtNombreConcepto" id="txtNombreConcepto" class="form-control"  required="true" />
                            </div>
                            <div class="form-group col-lg-12">
                                <label class="control-label ">Preguntas Sugeridas
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <textarea name="txaSugerencias" id="txaSugerencias" class="form-control" cols="20" rows="5"></textarea>
                            </div>
                      </div>
                  </form>
                  <!-- END FORM-->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" onclick="fEditarItem();">Guardar cambios</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
      </div>
  </div>

  <div class="modal fade" id="mNuevo" tabindex="-1" role="dialog" aria-labelledby="mNuevo" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"><strong>Nuevo Concepto</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmNuevo" method="POST" class="form-horizontal">
                      <div class="form-body row">

                          <div class="form-group col-lg-12" >
                            <label>Aspecto: </label>
                            <select id="nbAspectos" name="nbAspectos" class="form-control">
                              <option value="" selected="">Seleccionar</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="control-label">Nombre
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="ntxtNombreConcepto" id="ntxtNombreConcepto" class="form-control" required="true" />
                          </div>
                                                 
                          <div class="form-group col-lg-12">
                              <label class="control-label">Estado
                                <span class="required">
                                  *
                                </span>
                              </label>
                              <select id="nestado" name="nestado" class="form-control">
                                  <option value="on" selected>Habilitado</option>
                                  <option value="off">Inhabilitado</option>
                              </select>
                          </div>
                      </div>
                  </form>
                  <!-- END FORM-->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" onclick="fNuevoItem();">Guardar item</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              </div>
          </div>
      </div>
  </div>

<!-- FIN MODALS -->

<script>
// $("table").tableExport({formats: ["xlsx","xls", "csv", "txt"],    });
</script>


<script>


  $(function(){

    combobox('sAspectos',"<?php url('Lopersa/sloadAspectos'); ?>",'Seleccione...');
    combobox('bAspectos',"<?php url('Lopersa/sloadAspectos'); ?>",'Seleccione...');
    combobox('nbAspectos',"<?php url('Lopersa/sloadAspectos'); ?>",'Seleccione...');
    floadConceptos();

    $("#frmEditar").submit(function( event ){
      event.preventDefault();
      fEditarItem();
    });

    $("#frmNuevo").submit(function( event ){
      event.preventDefault();
      fNuevoItem();
    });

    $("#frmBusqueda").submit(function( event ) {
      event.preventDefault();
      buscar();
    });

    //---------------
  });


  function floadConceptos(){
    $('#tbl_conceptos').dataTable({
        ajax : "<?php url('Lopersa/loadConceptosTable'); ?>",
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
        "searching": false,
        "aaSorting" : [[0, 'desc']],
        "aLengthMenu" : [
            [10, 15, 20, -1], 
            [10, 15, 20, "Todos"] // change per page values here
        ],
        "columns": [ //agregar configuraciones a cada una de las columnas de las tablas
            {},//column 1
            { "class": "center"},//column 2
            {},//column 3
            {},//column 3
            { "orderable": false },//column 4
            { "class": "center", "orderable": false }//column 5
        ],
        initComplete: function(oSettings, json) {
            $('[data-rel="tooltip"]').tooltip(); 
        },
        "iDisplayLength" : 10,
        'autoWidth'   : false
    });

  }

  //functions update item
  function fmodalEditar(cod, coddepartamento, nombre, sugerencia){
    $("#txtCodConcepto").val(cod);
    $("#bAspectos").val(coddepartamento);
    $("#txtNombreConcepto").val(nombre);
    $.ajax({
      url : "<?php url('Lopersa/deco'); ?>",
      type : "POST",
      data : {
        'text' : sugerencia
      },
      dataType : "JSON",
      success : function (json){
        $("#txaSugerencias").val(json.text);
      }
    });
    $("#mEditar").modal('show');
  }

  function fEditarItem(){
    var txtCodConcepto = $("#txtCodConcepto").val();
    var bAspectos = $("#bAspectos").val();
    var txtNombreConcepto = $("#txtNombreConcepto").val();
    var txaSugerencias = $("#txaSugerencias").val();
    

    if($.trim(bAspectos) == ''){
        toastr.error('Por favor, seleccione el Aspecto Evaluativo.');
        $("#bAspectos").focus();

    }else if($.trim(txtNombreConcepto) == ''){
        toastr.error('Por favor, ingrese nombre de Concepto a Evaluar.');
        $("#txtNombreConcepto").focus();

    }else{

      $.ajax({
          url : "<?php url('Lopersa/editItemConcepto'); ?>",
          type : "POST",
          data : {
              'codconcepto' : txtCodConcepto,
              'codaspecto' : bAspectos,
              'nombre_concepto' : txtNombreConcepto,
              'sugerencias' : txaSugerencias
          },
          dataType : "JSON",
          success : function (json){
              if(json.success == true){
                  toastr.success("Item Actualizado exitosamente");
                  $("#frmEditar")[0].reset();
                  
                  $("#mEditar").modal('hide');
                  $('#tbl_conceptos').DataTable().ajax.reload();
                 
              }else{
                  toastr.error(json.mensaje);
              }
          }
      });
    }
  }

  //Editar estado
  function feditEstado(cod,est){
    var palabreo;
    if(est == 'off'){
        palabreo = "¿Está seguro de Inhabilitar este Concepto a Evaluar?";
    }else{
        palabreo = "¿Está seguro de Habilitar este Concepto a Evaluar?";
    }
    bootbox.confirm(palabreo, function(result) {
        if (result) {
            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "<?php url('Lopersa/editEstadoConcepto'); ?>",
                type: "POST",
                data: {codaspecto : cod, estado : est}
            })
            .done(function(data) {
                if(data.success == true){
                    var cb = function (){ $('.tooltips').tooltip() };
                    $('#tbl_conceptos').DataTable().ajax.reload(cb);
                    $('.desactivarC').fadeOut(500);
                    toastr.success("Acción realizada exitosamente", "Gestionar Datos");
                }else{
                   toastr.error( "Request failed: " + data.mensaje); 
                }
            })
            .fail(function( jqXHR, textStatus ) {
                $('.desactivarC').fadeOut(500);
                toastr.error( "Request failed: " + jqXHR.responseText);
            });
        }
    });
  }


  //functions new item
  function fmodalNuevo(){
    $("#mNuevo").modal('show');
  }

  function fNuevoItem(){
    var nbAspectos = $("#nbAspectos").val();
    var ntxtNombreConcepto = $("#ntxtNombreConcepto").val();
    var nestado = $("#nestado").val();

    if($.trim(nbAspectos) == ''){
      toastr.error('Por favor, seleccione Aspecto evaluativo.');
      $("#nbAspectos").focus();
    }else if($.trim(ntxtNombreConcepto) == ''){
      toastr.error('Por favor, ingrese Nombre de Concepto a evaluar.');
      $("#ntxtNombreConcepto").focus();
    }else if($.trim(nestado) == ''){
      toastr.error('Por favor, seleccione Estado de Concepto a evaluar.');
      $("#nestado").focus();
    }else{
      $.ajax({
          url : "<?php url('Lopersa/insertItemConcepto'); ?>",
          type : "POST",
          data : {
              'codaspecto' : nbAspectos,
              'nombre_concepto' : ntxtNombreConcepto,
              'estado' : nestado
          },
          dataType : "JSON",
          success : function (json){
            if(json.success == true){
              toastr.success("Item agregado exitosamente");
              $("#frmNuevo")[0].reset();
              $("#mNuevo").modal('hide');
              $('#tbl_conceptos').DataTable().ajax.reload();
            }else{
              toastr.error(json.mensaje);
            }
          }
      });
    }

  }


    function buscar(){
        var codaspecto = $("#sAspectos").val();
        var url = "<?php url('Lopersa/loadConceptosTable'); ?>?codaspecto="+codaspecto;
        realoadTable('tbl_conceptos', url);
    }


</script>
<!-- /.content --> 