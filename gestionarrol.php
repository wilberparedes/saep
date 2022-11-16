<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Roles</h1>
  <ol class="breadcrumb">
    <li><a>Configuraciones</a></li>
    <li><i class="fa fa-angle-right"></i> Gestionar Roles</li>
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
                        <label>Nombre roles:</label>
                        <input class="form-control" id="bNombrerol" name="bNombrerol" type="text" onkeyup="doSearch('bNombrerol', 'tbl_rol')">
                      </fieldset>
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
              <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Rol</a>
              <table id="tbl_rol" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Nombre Rol</th>
                    <th>Menús</th>
                    <th>Estado Rol</th>
                    <th>Acciones</th>
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
                <input type="hidden" id="txtCodRol" name="txtCodRol">
                <h4 class="modal-title"><strong>Editar Rol</strong></h4>
            </div>
            <div class="modal-body">
                <!-- BEGIN FORM-->
                <form id="frmEditar" method="POST" class="form-horizontal">
                    <div class="form-body row">
                        <div class="form-group col-lg-12">
                            <label class="control-label ">Nombre Rol
                                <span class="required">
                                     *
                                </span>
                            </label>
                            <input type="text" name="txtNombreRol" id="txtNombreRol" class="form-control"  required="true" />
                        </div>
                        <div class="form-group col-lg-12">
                            <label class="control-label ">Estado
                              <span class="required">
                                   *
                              </span>
                            </label>
                            <select id="estado" name="estado" class="form-control">
                                <option value="" disabled selected>Seleccione...</option>
                                <option value="on">Habilitado</option>
                                <option value="off">Inhabilitado</option>
                            </select>
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
                  <h4 class="modal-title"><strong>Nuevo Rol</strong></h4>
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
                              <input type="text" name="ntxtNombreRol" id="ntxtNombreRol" class="form-control" required="true" />
                          </div>
                          <!-- <div class="form-group">
                              <label class="control-label col-md-4">Orden
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <div class="col-md-6">
                                  <input type="text" name="ntxtOrden" id="ntxtOrden" placeholder="1" class="form-control" readonly required="true" style="text-align:right; color:red; font-weight: bold;" />
                              </div>
                          </div> -->
                          <div class="form-group col-lg-12">
                            <label class="control-label">Estado
                              <span class="required">
                                *
                              </span>
                            </label>
                            <select id="nestado" name="nestado" class="form-control">
                              <option value="" disabled selected>Seleccione...</option>
                              <option value="on">Habilitado</option>
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
    $("#frmEditar").submit(function( event ) {
      event.preventDefault();
      fEditarItem();
    });
    $("#frmNuevo").submit(function( event ) {
        event.preventDefault();
        fNuevoItem();
    });

    floadRoles();
    //---------------
    combobox('nRol',"<?php url('Lopersa/loadRol'); ?>",'Seleccione...');

  });


  function floadRoles(){
    $('#tbl_rol').dataTable({
        ajax : "<?php url('Lopersa/loadRolTable'); ?>",
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
            { "class": "center", "orderable": false },//column 2
            { "orderable": false },//column 3
            { "orderable": false },//column 5
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
  function fmodalEditar(cod, nombre, menu, estado){
    $("#txtCodRol").val(cod);
    $("#txtNombreRol").val(nombre);
    $("#estado").val(estado);
    $("#mEditar").modal('show');
  }

  function fEditarItem(){
    var txtCodRol = $("#txtCodRol").val();
        var txtNombreRol = $("#txtNombreRol").val();
        var estado = $("#estado").val();

        if($.trim(txtNombreRol) == ''){
            toastr.error('Por favor, ingrese nombre del Rol.');
            $("#txtNombreRol").focus();

        }else if($.trim(estado) == ''){
            toastr.error('Por favor, seleccione estado de Rol.');
            $("#estado").focus();

        }else{

            $.ajax({
                url : "<?php url('Lopersa/editItemRol'); ?>",
                type : "POST",
                data : {
                  'codrol':txtCodRol,
                  'nombre_rol' : txtNombreRol,
                  'estado_rol' : estado
                },
                dataType : "JSON",
                success : function (json){
                  if(json.success == true){
                    toastr.success("Item Actualizado exitosamente");
                    $("#frmEditar")[0].reset();
                      
                    $("#mEditar").modal('hide');
                    $('#tbl_rol').DataTable().ajax.reload();

                    reloadmenu();
                     
                  }else{
                    toastr.error(json.mensaje);
                  }
                }
            });
        }

  }


  //functions new item
  function fmodalNuevo(){
    $("#mNuevo").modal('show');
  }

  function fNuevoItem(){
      var ntxtRol = $("#ntxtRol").val();
      var ntxtNombreRol = $("#ntxtNombreRol").val();
      var nestado = $("#nestado").val();

      if($.trim(ntxtNombreRol) == ''){
          toastr.error('Por favor, ingrese Nombre de Rol.');
          $("#ntxtNombreRol").focus();

      }else if($.trim(nestado) == ''){
          toastr.error('Por favor, seleccione Estado de Rol.');
          $("#nestado").focus();

      }else{

          $.ajax({
              url : "<?php url('Lopersa/insertItemRol'); ?>",
              type : "POST",
              data : {
                'nombre_rol' : ntxtNombreRol,             
                'estado_rol' : nestado
              },
              dataType : "JSON",
              success : function (json){
                  if(json.success == true){
                      toastr.success("Item agregado exitosamente");
                      $("#frmNuevo")[0].reset();
                      $("#mNuevo").modal('hide');
                      $('#tbl_rol').DataTable().ajax.reload();

                      reloadmenu();
                  }else{
                      toastr.error(json.mensaje);
                  }
              }
          });
      }

  }


  function buscar(){
    var nombre_rol = $("#bNombrerol").val();
    
    var url = "<?php url('Lopersa/buscarPerfil'); ?>?nombre_perfil="+nombre_perfil;
    $('#tbl_rol').DataTable().ajax.url( url ).load();

  }

  $("#frmBusqueda").submit(function( event ) {
    event.preventDefault();
    buscar();
  })




</script>
<!-- /.content --> 