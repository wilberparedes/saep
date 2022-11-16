<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Departamentos</h1>
  <ol class="breadcrumb">
    <li><a> Gestión de Datos</a></li>
    <li><i class="fa fa-angle-right"></i> Departamentos</li>
  </ol>
</div>

<!-- Main content -->
<div class="content">
  <div class="row">
    
      <!-- <div class="col-12">
          <div class="card">
              <div class="card-body">
                <h4 class="text-black">Búsqueda</h4>
                <form id="frmBusqueda" role="form" >
                  <div class="row">
                    <div class="col-lg-3">
                      <fieldset class="form-group">
                        <label>Nombre departamento:</label>
                        <input class="form-control" id="bNombreDepartamentos" name="bNombreDepartamentos" type="text" onkeyup="doSearch('bNombreDepartamentos', 'tbl_departamentos')">
                      </fieldset>
                    </div>
                  </div>
                </form>
              </div>
          </div>
      </div> -->

      <div class="col-12 m-t-3">
        <div class="card">
          <div class="card-body">
            <h4 class="text-black">Listado</h4>
            <div class="table-responsive">
              <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Departamento</a>
              <table id="tbl_departamentos" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nombre Departamento</th>
                    <th>Estado Departamento</th>
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
                  <input type="hidden" id="txtCodDepartamento" name="txtCodDepartamento">
                  <h4 class="modal-title"><strong>Editar Departamento</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmEditar" method="POST" class="form-horizontal">
                      <div class="form-body row">
                          <div class="form-group col-lg-12">
                              <label class="control-label ">Nombre Departamento
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="txtNombreDepartamento" id="txtNombreDepartamento" class="form-control"  required="true" />
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
                  <h4 class="modal-title"><strong>Nuevo Departamento</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmNuevo" method="POST" class="form-horizontal">
                      <div class="form-body row">
                          <div class="form-group col-lg-12">
                              <label class="control-label">Nombre
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="ntxtNombreDepartamento" id="ntxtNombreDepartamento" class="form-control" required="true" />
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

    floadDepartamentos();

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


  function floadDepartamentos(){
    $('#tbl_departamentos').dataTable({
        ajax : "<?php url('Lopersa/loadDepartamentos'); ?>",
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
            {},//column 1
            { "class": "center", "orderable": false },//column 2
            { "orderable": false },//column 3
            { "class": "center", "orderable": false }//column 6
            
        ],
        initComplete: function(oSettings, json) {
            $('[data-rel="tooltip"]').tooltip(); 
        },
        "iDisplayLength" : 10,
        'autoWidth'   : false
    });

  }

  //functions update item
  function fmodalEditar(cod, nombre){
    $("#txtCodDepartamento").val(cod);
    $("#txtNombreDepartamento").val(nombre);
    $("#mEditar").modal('show');
  }

  function fEditarItem(){
    var txtCodDepartamento = $("#txtCodDepartamento").val();
    var txtNombreDepartamento = $("#txtNombreDepartamento").val();

    if($.trim(txtNombreDepartamento) == ''){
        toastr.error('Por favor, ingrese nombre de Departamento.');
        $("#txtNombreDepartamento").focus();
    }else{

      $.ajax({
          url : "<?php url('Lopersa/editItemDepartamento'); ?>",
          type : "POST",
          data : {
              'coddepartamento':txtCodDepartamento,
              'nombre_departamento' : txtNombreDepartamento
          },
          dataType : "JSON",
          success : function (json){
              if(json.success == true){
                  toastr.success("Item Actualizado exitosamente");
                  $("#frmEditar")[0].reset();
                  
                  $("#mEditar").modal('hide');
                  $('#tbl_departamentos').DataTable().ajax.reload();
                 
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
        palabreo = "¿Está seguro de Inhabilitar este Departamento?";
    }else{
        palabreo = "¿Está seguro de Habilitar este Departamento?";   
    }
    bootbox.confirm(palabreo, function(result) {
        if (result) {
            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "<?php url('Lopersa/editEstadoDepartamento'); ?>",
                type: "POST",
                data: {coddepartamento : cod, estado : est}
            })
            .done(function(data) {
                if(data.success == true){
                    var cb = function (){ $('.tooltips').tooltip() };
                    $('#tbl_departamentos').DataTable().ajax.reload(cb);
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
    var ntxtRol = $("#ntxtRol").val();
    var ntxtNombreDepartamento = $("#ntxtNombreDepartamento").val();
    var nestado = $("#nestado").val();

    if($.trim(ntxtNombreDepartamento) == ''){
      toastr.error('Por favor, ingrese Nombre de Departamento.');
      $("#ntxtNombreDepartamento").focus();
    }else if($.trim(nestado) == ''){
      toastr.error('Por favor, seleccione Estado de Departamento.');
      $("#nestado").focus();
    }else{
      $.ajax({
          url : "<?php url('Lopersa/insertItemDepartamento'); ?>",
          type : "POST",
          data : {
              'nombre_departamento' : ntxtNombreDepartamento,
              'estado' : nestado
          },
          dataType : "JSON",
          success : function (json){
            if(json.success == true){
              toastr.success("Item agregado exitosamente");
              $("#frmNuevo")[0].reset();
              $("#mNuevo").modal('hide');
              $('#tbl_departamentos').DataTable().ajax.reload();
            }else{
              toastr.error(json.mensaje);
            }
          }
      });
    }

  }

  

  function buscar(){
    var nombre_perfil = $("#bNombreDepartamentos").val();
    var url = "<?php url('Lopersa/buscarPerfil'); ?>?nombre_perfil="+nombre_perfil;
    $('#tbl_departamentos').DataTable().ajax.url( url ).load();
  }

  


  




</script>
<!-- /.content --> 