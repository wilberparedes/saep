<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Municipios</h1>
  <ol class="breadcrumb">
    <li><a>Gestión de Datos</a></li>
    <li><i class="fa fa-angle-right"></i> Municipio</li>
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
                        <label>Departamento:</label>
                        <select id="sbDepartamento" name="sbDepartamento" class="form-control"></select>
                      </fieldset>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label style="width:100%">Acciones</label>
                        <div class="btn-group" role="group" >
                          <button type="button" class="btn btn-primary" onclick="buscar();"><i class="fa fa-search"></i> Buscar</button>
                          <button type="button" class="btn btn-danger tooltips" data-rel="tooltip" data-placement="bottom" title="Limpiar búsqueda" onclick="realoadTable('tbl_municipios', '<?php url("Lopersa/loadMunicipios"); ?>'); $('#sbDepartamento').val('');"><i class="fa fa-trash-o"></i></button>
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
              <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Municipio</a>
              <table id="tbl_municipios" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Departamento</th>
                    <th>Nombre Municipio</th>
                    <th>Estado Municipio</th>
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
                  <input type="hidden" id="txtCodMunicipio" name="txtCodMunicipio">
                  <h4 class="modal-title"><strong>Editar Municipio</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmEditar" method="POST" class="form-horizontal">
                      <div class="form-body row">
                          <div class="form-group col-lg-12" >
                              <label>Departamento: </label>
                              <select id="bDepartamento" name="bDepartamento" class="form-control">
                                <option value="" selected="">Todos</option>
                              </select>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="control-label ">Nombre Municipio
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="txtNombreMunicipio" id="txtNombreMunicipio" class="form-control"  required="true" />
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
                  <h4 class="modal-title"><strong>Nuevo Municipio</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmNuevo" method="POST" class="form-horizontal">
                      <div class="form-body row">

                          <div class="form-group col-lg-12" >
                            <label>Departamento: </label>
                            <select id="nbDepartamento" name="nbDepartamento" class="form-control">
                              <option value="" selected="">Todos</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="control-label">Nombre
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="ntxtNombreMunicipio" id="ntxtNombreMunicipio" class="form-control" required="true" />
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

    combobox('sbDepartamento',"<?php url('Lopersa/sloadDepartamentos'); ?>",'Seleccione...');
    combobox('bDepartamento',"<?php url('Lopersa/sloadDepartamentos'); ?>",'Seleccione...');
    combobox('nbDepartamento',"<?php url('Lopersa/sloadDepartamentos'); ?>",'Seleccione...');
    floadMunicipios();

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


  function floadMunicipios(){
    $('#tbl_municipios').dataTable({
        ajax : "<?php url('Lopersa/loadMunicipios'); ?>",
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
  function fmodalEditar(cod, coddepartamento, nombre){
    $("#txtCodMunicipio").val(cod);
    $("#bDepartamento").val(coddepartamento);
    $("#txtNombreMunicipio").val(nombre);
    $("#mEditar").modal('show');
  }

  function fEditarItem(){
    var txtCodMunicipio = $("#txtCodMunicipio").val();
    var bDepartamento = $("#bDepartamento").val();
    var txtNombreMunicipio = $("#txtNombreMunicipio").val();

    if($.trim(bDepartamento) == ''){
        toastr.error('Por favor, seleccione el Departamento.');
        $("#bDepartamento").focus();

    }else if($.trim(txtNombreMunicipio) == ''){
        toastr.error('Por favor, ingrese nombre de Municipio.');
        $("#txtNombreMunicipio").focus();
    }else{

      $.ajax({
          url : "<?php url('Lopersa/editItemMunicipio'); ?>",
          type : "POST",
          data : {
              'codmunicipio' : txtCodMunicipio,
              'coddepartamento' : bDepartamento,
              'nombre_municipio' : txtNombreMunicipio
          },
          dataType : "JSON",
          success : function (json){
              if(json.success == true){
                  toastr.success("Item Actualizado exitosamente");
                  $("#frmEditar")[0].reset();
                  
                  $("#mEditar").modal('hide');
                  $('#tbl_municipios').DataTable().ajax.reload();
                 
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
        palabreo = "¿Está seguro de Inhabilitar este Municipio?";
    }else{
        palabreo = "¿Está seguro de Habilitar este Municipio?";   
    }
    bootbox.confirm(palabreo, function(result) {
        if (result) {
            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "<?php url('Lopersa/editEstadoMunicipio'); ?>",
                type: "POST",
                data: {codmunicipio : cod, estado : est}
            })
            .done(function(data) {
                if(data.success == true){
                    var cb = function (){ $('.tooltips').tooltip() };
                    $('#tbl_municipios').DataTable().ajax.reload(cb);
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
    var nbDepartamento = $("#nbDepartamento").val();
    var ntxtNombreMunicipio = $("#ntxtNombreMunicipio").val();
    var nestado = $("#nestado").val();

    if($.trim(nbDepartamento) == ''){
      toastr.error('Por favor, seleccione Departamento.');
      $("#nbDepartamento").focus();
    }else if($.trim(ntxtNombreMunicipio) == ''){
      toastr.error('Por favor, ingrese Nombre de Municipio.');
      $("#ntxtNombreMunicipio").focus();
    }else if($.trim(nestado) == ''){
      toastr.error('Por favor, seleccione Estado de Municipio.');
      $("#nestado").focus();
    }else{
      $.ajax({
          url : "<?php url('Lopersa/insertItemMunicipio'); ?>",
          type : "POST",
          data : {
              'coddepartamento' : nbDepartamento,
              'nombre_municipio' : ntxtNombreMunicipio,
              'estado' : nestado
          },
          dataType : "JSON",
          success : function (json){
            if(json.success == true){
              toastr.success("Item agregado exitosamente");
              $("#frmNuevo")[0].reset();
              $("#mNuevo").modal('hide');
              $('#tbl_municipios').DataTable().ajax.reload();
            }else{
              toastr.error(json.mensaje);
            }
          }
      });
    }

  }

  

  function buscar(){
    var coddepartamento = $("#sbDepartamento").val();
    var url = "<?php url('Lopersa/loadMunicipios'); ?>?coddepartamento="+coddepartamento;
    realoadTable('tbl_municipios', url);
  }

  

  


  




</script>
<!-- /.content --> 