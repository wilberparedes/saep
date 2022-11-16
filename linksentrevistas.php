<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Link de entrevistas</h1>
  <ol class="breadcrumb">
    <li><a>Gestión de Datos</a></li>
    <li><i class="fa fa-angle-right"></i> Link de entrevistas</li>
  </ol>
</div>

<!-- Main content -->
<div class="content">
  <div class="row">
 
      <div class="col-12 m-t-3">
        <div class="card">
          <div class="card-body">
            <h4 class="text-black">Listado</h4>
            <div class="table-responsive">
              <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Link</a>
              <table id="tbl_links" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>C.C Psicólogo</th>
                    <th>Nombre</th>
                    <th>URL</th>
                    <th>E-Mail</th>
                    <th>Contraseña</th>
                    <th>Estado</th>
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
                  <input type="hidden" id="txtCodLink" name="txtCodLink">
                  <h4 class="modal-title"><strong>Editar Link</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                    <form id="frmEditar" method="POST" class="form-horizontal">
                        <div class="form-body row">
                            
                            <div class="form-group col-lg-12">
                                <label class="control-label ">C.C Psicólogo
                                    <span class="required">
                                       *
                                    </span>
                                </label>
                                <input type="text" name="txtccPsicologo" id="txtccPsicologo" class="form-control"  readonly />
                            </div>
                            
                            <div class="form-group col-lg-12">
                                <label class="control-label ">Nombre
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="txtNombreLink" id="txtNombreLink" class="form-control"  required="true" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="control-label ">URL
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="txtLink" id="txtLink" class="form-control"  required="true" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="control-label ">E-Mail
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="txtEmail" id="txtEmail" class="form-control"  required="true" />
                            </div>
                            
                            <div class="form-group col-lg-12">
                                <label class="control-label ">Contraseña
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="txtPassword" id="txtPassword" class="form-control"  required="true" />
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
                  <h4 class="modal-title"><strong>Nuevo Link</strong></h4>
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
                                <input type="text" name="ntxtNombreLink" id="ntxtNombreLink" class="form-control" required="true" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="control-label ">C.C psicólogo
                                    <span class="required">
                                       *
                                    </span>
                                </label>
                                <input type="text" name="ntxtccPsicologo" id="ntxtccPsicologo" class="form-control"  required="true" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="control-label ">URL
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="ntxtLink" id="ntxtLink" class="form-control"  required="true" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="control-label ">E-Mail
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="email" name="ntxtEmail" id="ntxtEmail" class="form-control"  required="true" />
                            </div>

                            <div class="form-group col-lg-12">
                                <label class="control-label ">Contraseña
                                    <span class="required">
                                        *
                                    </span>
                                </label>
                                <input type="text" name="ntxtPassword" id="ntxtPassword" class="form-control"  required="true" />
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

        floadLinks();

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

        combobox('sPsicologo',"<?php url('Lopersa/sloadPsicologos'); ?>",'Seleccione');

        //---------------
    });


    function floadLinks(){
        $('#tbl_links').dataTable({
            ajax : "<?php url('Lopersa/loadLinks'); ?>",
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
                { "orderable": false },//column 3
                { "orderable": false },//column 3
                { "orderable": false },//column 3
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
    function fmodalEditar(cod, nombre, codpsicologo, link, correo, pass){
        $("#txtCodLink").val(cod);
        $("#txtNombreLink").val(nombre);
        $("#txtccPsicologo").val(codpsicologo);
        $("#txtEmail").val(correo);
        $("#txtPassword").val(pass);
        $("#txtLink").val(link);
        $("#mEditar").modal('show');
    }

    function fEditarItem(){
        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var txtCodLink = $.trim($("#txtCodLink").val());
        var txtNombreLink = $.trim($("#txtNombreLink").val());
        var txtccPsicologo = $.trim($("#txtccPsicologo").val());
        var txtEmail = $.trim($("#txtEmail").val());
        var txtPassword = $.trim($("#txtPassword").val());
        var txtLink = $("#txtLink").val();
        
        if(txtNombreLink == ''){
            toastr.error('Por favor, ingrese nombre de Link.');
            $("#txtNombreLink").focus();
        }
        else if(txtLink == ''){
            toastr.error('Por favor, ingrese URL.');
            $("#txtLink").focus();
        }
        else if(txtEmail == ''){
            toastr.error('Por favor, ingrese E-Mail.');
            $("#txtEmail").focus();
        }
        else if(!regex.test($("#txtEmail").val())) {
            toastr.error('Formato de E-Mail inválido.');
            $("#txtEmail").focus();
        }
        else if(txtPassword == ''){
            toastr.error('Por favor, ingrese Contraseña.');
            $("#txtPassword").focus();
        }
        else{

        $.ajax({
            url : "<?php url('Lopersa/editItemLink'); ?>",
            type : "POST",
            data : {
                'codigolink' : txtCodLink,
                'nombrelink' : txtNombreLink,
                'correolink' : txtEmail,
                'passlink' : txtPassword,
                'urllink' : txtLink
            },
            dataType : "JSON",
            success : function (json){
                if(json.success == true){
                    toastr.success("Item Actualizado exitosamente");
                    $("#frmEditar")[0].reset();
                    
                    $("#mEditar").modal('hide');
                    $('#tbl_links').DataTable().ajax.reload();
                    
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
            palabreo = "¿Está seguro de Inhabilitar este Link?";
        }else{
            palabreo = "¿Está seguro de Habilitar este Link?";   
        }
        bootbox.confirm(palabreo, function(result) {
            if (result) {
                $('.desactivarC').fadeIn(500);
                $.ajax({
                    url: "<?php url('Lopersa/editEstadoLink'); ?>",
                    type: "POST",
                    data: {codigolink : cod, estado : est}
                })
                .done(function(data) {
                    if(data.success == true){
                        var cb = function (){ $('.tooltips').tooltip() };
                        $('#tbl_links').DataTable().ajax.reload(cb);
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
        var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var regexname = /^[0-9]*$/;
        var ntxtNombreLink = $("#ntxtNombreLink").val();
        var ntxtccPsicologo = $("#ntxtccPsicologo").val();
        var ntxtLink = $("#ntxtLink").val();
        var ntxtEmail = $("#ntxtEmail").val();
        var ntxtPassword = $("#ntxtPassword").val();
        var nestado = $("#nestado").val();
        
        if($.trim(ntxtNombreLink) == ''){
            toastr.error('Por favor, ingrese Nombre link.');
            $("#ntxtNombreLink").focus();
        }
        else if($.trim(ntxtccPsicologo) == ''){
            toastr.error('Por favor, ingrese C.C de Psicólogo.');
            $("#ntxtccPsicologo").focus();
        }
        else if(!regexname.test($.trim($("#ntxtccPsicologo").val()))){
            toastr.error('ingrese solo números C.C de Psicólogo.');
            $("#ntxtccPsicologo").focus();
        }
        else if($.trim(ntxtLink) == ''){
            toastr.error('Por favor, ingrese URL.');
            $("#ntxtLink").focus();
        }
        else if(ntxtEmail == ''){
            toastr.error('Por favor, ingrese E-Mail.');
            $("#ntxtEmail").focus();
        }
        else if(!regex.test($("#ntxtEmail").val())) {
            toastr.error('Formato de E-Mail inválido.');
            $("#ntxtEmail").focus();
        }
        else if(ntxtPassword == ''){
            toastr.error('Por favor, ingrese Contraseña.');
            $("#ntxtPassword").focus();
        }
        else if($.trim(nestado) == ''){
            toastr.error('Por favor, seleccione Estado de Link.');
            $("#nestado").focus();
        }else{
            $.ajax({
                url : "<?php url('Lopersa/insertItemLink'); ?>",
                type : "POST",
                data : {
                    'nombrelink' : ntxtNombreLink,
                    'ccpsicologo' : ntxtccPsicologo,
                    'urllink' : ntxtLink,
                    'correolink' : ntxtEmail,
                    'passlink' : ntxtPassword,
                    'estado' : nestado
                },
                dataType : "JSON",
                success : function (json){
                    if(json.success == true){
                        toastr.success("Item agregado exitosamente");
                        $("#frmNuevo")[0].reset();
                        $("#mNuevo").modal('hide');
                        $('#tbl_links').DataTable().ajax.reload();
                    }else{
                        toastr.error(json.message);
                    }
                }
            });
        }
    }

  
</script>
<!-- /.content --> 