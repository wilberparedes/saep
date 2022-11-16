<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Perfiles</h1>
  <ol class="breadcrumb">
    <li><a>Configuraciones</a></li>
    <li><i class="fa fa-angle-right"></i> Gestionar Perfiles</li>
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
                            <label>Nombre perfiles:</label>
                            <input class="form-control" id="bNombreperfil" name="bNombreperfil" type="text" onkeyup="doSearch('bNombreperfil', 'tbl_perfil')">
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
                <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Perfil</a>
                <table id="tbl_perfil" class="table table-bordered table-hover" data-name="cool-table">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nombre Perfil</th>
                        <th>Rol</th>
                        <th>Descripción</th>
                        <th>Estado Perfil</th>
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
                  <input type="hidden" id="txtCodPerfil" name="txtCodPerfil">
                  <h4 class="modal-title"><strong>Editar Menú</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmEditar" method="POST" class="form-horizontal">
                      <div class="form-body row">
                          <div class="form-group col-lg-12">
                              <label class="control-label ">Nombre Perfil
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="txtNombrePerfil" id="txtNombrePerfil" class="form-control"  required="true" />
                          </div>
                          <div class="form-group col-lg-12">
                              <label class="control-label">Rol
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <select id="Rol" name="Rol" class="form-control">
                              </select>
                          </div>       
                            <div class="form-group col-lg-12">
                                <label class="control-label">Descripción
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="txtDescripcion" id="txtDescripcion" class="form-control" required="true" />
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
                  <h4 class="modal-title"><strong>Nuevo Perfil</strong></h4>
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
                                <input type="text" name="ntxtNombrePerfil" id="ntxtNombrePerfil" class="form-control" required="true" />
                            </div>
                          <div class="form-group col-lg-12">
                              <label class="control-label">Rol
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <select id="nRol" name="nRol" class="form-control">
                              </select>
                          </div>       
                            <div class="form-group col-lg-12">
                                <label class="control-label">Descripción
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="nTxtDescripcion" id="nTxtDescripcion" class="form-control" required="true" />
                            </div>

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
    // combobox('bRol','developer/Lopersa/loadRol','Todos');
    combobox('nRol',"<?php url('Lopersa/loadRol'); ?>",'Seleccione...');
    combobox('Rol',"<?php url('Lopersa/loadRol'); ?>",'Seleccione...');
    
    floadPerfiles();

    //---------------
  });


  function floadPerfiles(){
    $('#tbl_perfil').dataTable({
        ajax : "<?php url('Lopersa/loadPerfiles'); ?>",
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
            { "orderable": false },//column 4
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
  function fmodalEditar(cod, codrol, nombre, descripcion, estado){
    $("#txtCodPerfil").val(cod);
    $("#txtNombrePerfil").val(nombre);
    $("#Rol").val(codrol);
    $("#txtDescripcion").val(descripcion);
    $("#estado").val(estado);
    $("#mEditar").modal('show');
  }

  function fEditarItem(){
        var txtCodPerfil = $("#txtCodPerfil").val();
        var txtNombrePerfil = $("#txtNombrePerfil").val();
        var codrol = $("#Rol").val();
        var txtDescripcion = $("#txtDescripcion").val();
        var estado = $("#estado").val();

        if($.trim(txtNombrePerfil) == ''){
            toastr.error('Por favor, ingrese nombre de Perfil.');
            $("#txtNombrePerfil").focus();

        }
        else if($.trim(codrol) == ''){
            toastr.error('Por favor, seleccione Rol.');
            $("#codrol").focus();
        }
        else if($.trim(txtDescripcion) == ''){
            toastr.error('Por favor, ingrese descripción de Perfil.');
            $("#txtDescripcion").focus();
        }
        else if($.trim(estado) == ''){
            toastr.error('Por favor, seleccione estado de Perfil.');
            $("#estado").focus();
        }else{

            $.ajax({
                url : "<?php url('Lopersa/editItemPerfil'); ?>",
                type : "POST",
                data : {
                    'codperfil':txtCodPerfil,
                    'nombre_perfil' : txtNombrePerfil,
                    'rol' : codrol,
                    'descripcion_perfil' : txtDescripcion,
                    'estado_perfil' : estado
                },
                dataType : "JSON",
                success : function (json){
                    if(json.success == true){
                        toastr.success("Item Actualizado exitosamente");
                        $("#frmEditar")[0].reset();
                        
                        // $("#dPadre").hide();
                        $("#mEditar").modal('hide');
                        $('#tbl_perfil').DataTable().ajax.reload();

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
        var ntxtNombrePerfil = $("#ntxtNombrePerfil").val();
        var nRol = $("#nRol").val();
        var nTxtDescripcion = $("#nTxtDescripcion").val();
        
        var nestado = $("#nestado").val();

        if($.trim(ntxtNombrePerfil) == ''){
            toastr.error('Por favor, ingrese Nombre de Perfil.');
            $("#ntxtNombrePerfil").focus();

        }else if($.trim(nRol) == ''){
            toastr.error('Por favor, seleccione Rol.');
            $("#nRol").focus();
        }
        else if($.trim(nTxtDescripcion) == ''){
            toastr.error('Por favor, ingrese Descripción del Perfil.');
            $("#nTxtDescripcion").focus();
        }
        else if($.trim(nestado) == ''){
            toastr.error('Por favor, seleccione Estado de Perfil.');
            $("#nestado").focus();

        }else{

            $.ajax({
                url : "<?php url('Lopersa/insertItemPerfil'); ?>",
                type : "POST",
                data : {
                    'nombre_perfil' : ntxtNombrePerfil,
                    'rol': nRol,             
                    'descripcion_perfil': nTxtDescripcion,
                    'estado_perfil' : nestado
                },
                dataType : "JSON",
                success : function (json){
                    if(json.success == true){
                        toastr.success("Item agregado exitosamente");
                        $("#frmNuevo")[0].reset();
                        $("#mNuevo").modal('hide');
                        $('#tbl_perfil').DataTable().ajax.reload();

                        reloadmenu();
                    }else{
                        toastr.error(json.mensaje);
                    }
                }
            });
        }

    }


  function buscar(){
    var nombre_perfil = $("#bNombreperfil").val();
    
    var url = "<?php url('Lopersa/buscarPerfil'); ?>?nombre_perfil="+nombre_perfil;
    $('#tbl_perfil').DataTable().ajax.url( url ).load();

  }

  $("#frmBusqueda").submit(function( event ) {
    event.preventDefault();
    buscar();
  })




</script>
<!-- /.content --> 