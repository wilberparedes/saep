<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Usuarios</h1>
  <ol class="breadcrumb">
    <li><a>Inicio</a></li>
    <li><i class="fa fa-angle-right"></i> Usuarios</li>
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
                        <label>Nombre menú:</label>
                        <input class="form-control" id="bNombremenu" name="bNombremenu" type="text">
                      </fieldset>
                    </div>

                    <div class="col-lg-3">
                      <fieldset class="form-group">
                        <label>Nivel:</label>
                        <select class="form-control" id="bNivel" name="bNivel">
                          <option value=""  selected>Todos</option>
                          <option>1</option>
                          <option>2</option>
                        </select>
                      </fieldset>
                    </div>

                    <div class="col-lg-3 bdivpadre" style="display:none">
                      <div class="form-group">
                        <label>Padre: </label>
                        <select id="bPadre" name="bPadre" class="form-control">
                          <option value="" selected="">Todos</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-lg-3">
                      <div class="form-group">
                        <label style="width:100%">Acciones</label>
                        <div class="btn-group" role="group" >
                          <button type="button" class="btn btn-primary " onclick="buscar();"><i class="fa fa-search"></i> Buscar</button>
                          <button type="button" class="btn btn-danger tooltips" data-rel="tooltip" data-placement="bottom" title="Limpiar búsqueda" onclick="$('#tbl_menu').DataTable().ajax.url('developer/Lopersa/loadMenu').load(); $('#bNombremenu').val('');$('#bNivel').val(''); "><i class="fa fa-trash-o"></i></button>
                        </div>
                      </div>
                    </div>


                  </div>
                </form>
              </div>
          </div>
      </div> -->

      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <h4 class="text-black">Listado</h4>
            <div class="table-responsive">
              <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Usuario</a>
              <table id="tbl_usuarios" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Identificación</th>
                    <th>Nombre</th>
                    <th>E-Mail</th>
                    <th>Perfil</th>
                    <th>Psicólogo CAT</th>
                    <th>Estado</th>
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

  <div class="modal fade" id="mNuevo" tabindex="-1" role="dialog" aria-labelledby="mNuevo" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Nuevo Usuario</strong></h4>
            </div>
            <div class="modal-body">
                <!-- BEGIN FORM-->
                <form id="frmNuevo" method="POST" class="form-horizontal">
                    <div class="form-body row">
                        <div class="form-group col-lg-12">
                            <label class="control-label">Usuario SINU (identificación)
                                <span class="required">
                                     *
                                </span>
                            </label>
                            <div style="overflow: hidden;position: relative;" >
                              <input type="hidden" id="ccpsicologo">
                              <input class="form-control tooltips" id="ntxtUsuario" name="ntxtUsuario" type="number" data-rel="tooltip" data-placement="bottom" data-original-title="Digite el número de identificación y luego presione la tecla <Enter>" onkeypress="if (event.which == 13 || event.keyCode == 13) {consultarFuncionario();}">
                              <div onclick="consultarFuncionario();" style="position: absolute;right: 0px;top: 0px;background: #0185ff;padding: 6px 16px;color: white;border-radius: 0px 4px 4px 0px;">
                                <i class="fa fa-search"></i>
                              </div>
                            </div>
                        </div>

                        <div class="form-group col-lg-12">
                          <label class="control-label">Nombre
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <input type="text" name="ntxtNombre" id="ntxtNombre" class="form-control"  readonly required="true" />
                        </div>

                        <div class="form-group col-lg-12">
                          <label class="control-label">E-Mail
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <input type="text" name="ntxtEmail" id="ntxtEmail" class="form-control"  required="true" />
                        </div>

                        <div class="form-group col-lg-12">
                            <label class="control-label">Perfil
                                <span class="required">
                                     *
                                </span>
                            </label>
                            <select id="nPerfil" name="nPerfil" class="form-control">
                            </select>
                        </div> 

                        <div class="form-group col-lg-12 divpsicologocat">
                          <label class="control-label">Psicólogo CAT
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <select id="nsPsicologoCat" name="nsPsicologoCat" class="form-control"  required="true"></select>
                        </div>
                        
                        <div class="form-group col-lg-12">
                            <label class="control-label">Estado
                                <span class="required">
                                     *
                                </span>
                            </label>
                            <select id="nestado" name="nestado" class="form-control">
                              <option value="">Seleccione</option>
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

  <div class="modal fade" id="mEditar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><strong>Editar Usuario</strong></h4>
            </div>
            <div class="modal-body">
                <!-- BEGIN FORM-->
                <form id="frmEditar" method="POST" class="form-horizontal">
                    <div class="form-body row">
                        <div class="form-group col-lg-12">
                          <label class="control-label">Usuario
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <input type="hidden" name="txtCodigoUsu" id="txtCodigoUsu" />
                          <input type="text" name="txtUsuario" id="txtUsuario" class="form-control"  required="true" disabled />
                        </div>
                        <div class="form-group col-lg-12">
                          <label class="control-label">Nombre
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <input type="text" name="EtxtNombre" id="EtxtNombre" class="form-control"  required="true" disabled/>
                        </div>

                        <div class="form-group col-lg-12">
                          <label class="control-label">E-Mail
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <input type="text" name="EtxtEmail" id="EtxtEmail" class="form-control"  required="true" />
                        </div>

                        <div class="form-group col-lg-12">
                          <label class="control-label">Perfil
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <select id="EsPerfil" name="EsPerfil" class="form-control"  required="true"></select>
                        </div>

                        <div class="form-group col-lg-12 divpsicologocat">
                          <label class="control-label">Psicólogo CAT
                            <span class="required">
                                 *
                            </span>
                          </label>
                          <select id="EsPsicologoCat" name="EsPsicologoCat" class="form-control"  required="true"></select>
                        </div>

                    </div>
                </form>
                <!-- END FORM-->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" onclick="fEditarItem()">Guardar cambios</button>
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

    combobox('EsPerfil',"<?php url('Lopersa/sloadPerfiles'); ?>",'Seleccione...');
    combobox('nPerfil',"<?php url('Lopersa/sloadPerfiles'); ?>",'Seleccione...');
    
    loadPsicologosCAT();
    
    $('#EsPsicologoCat').change(function() {
      if($(this).val() == ''){
        $("#EtxtEmail").val('');
      }else{
        $("#EtxtEmail").val($("option[value="+$(this).val()+"]").attr('ema'));
      }
    });

    $('#nsPsicologoCat').change(function() {
      if($(this).val() == ''){
        $("#ntxtEmail").val('');
      }else{
        $("#ntxtEmail").val($("option[value="+$(this).val()+"]").attr('ema'));
      }
    });


    floadClientes();
    
    $('#EsPerfil, #nPerfil').change(function() {
      if($(this).val() != 3)
        $(".divpsicologocat").hide();
      else
        $(".divpsicologocat").show();
    });

    $('#estado').change(function() {
      var est = $('#estado').val();
      var url = "<?php url('Lopersa/loadUsuarios');?>?estado="+est;
      var cb = function (){ $('.tooltips').tooltip() };
      $('#tbl_usuarios').DataTable().ajax.url( url ).load( cb );
    });
  });

  function loadPsicologosCAT(){
    $.ajax({
      url : "<?php url('Lopersa/sloadPsicologoCAT'); ?>",
      type : "POST",
      jsonpCallback : 'EsPsicologoCat',
      dataType : "JSON",
      success : function (json){
        var option="<option value=''>NO APLICA</option>";
        $.each(json,function(k,v){
          option+="<option value='"+v.cod+"' ema='"+v.email+"'>"+v.nombre+"</option>";
        });
        $("#EsPsicologoCat").html(option);
        $("#nsPsicologoCat").html(option);
      }
    });
  }


  function floadClientes(){
   
    $('#tbl_usuarios').dataTable({
        ajax : "<?php url('Lopersa/loadUsuarios'); ?>",
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
            { "orderable": false },//column 4
            { "orderable": false },//column 5
            { "orderable": false },//column 6
            { "orderable": false },//column 7
            { "class": "center", "orderable": false }//column 8
            
        ],
        initComplete: function(oSettings, json) {
            $('[data-rel="tooltip"]').tooltip(); 
        },
        "iDisplayLength" : 10,
        'autoWidth'   : false
    });
  }

  //functions update item
  function fmodalEditar(cod, usuario, nombre, email, perfil, isfan, codpsico){
    $("#txtCodigoUsu").val(cod);
    $("#txtUsuario").val(usuario);
    $("#EtxtNombre").val(nombre);
    $("#EtxtEmail").val(email);
    $("#EsPerfil").val(perfil);
    $("#EsPsicologoCat").val(codpsico);
    if(perfil != 3){
      $(".divpsicologocat").hide();
    }else{
      $(".divpsicologocat").show();
    }
    
    $("#mEditar").modal('show');
  }

  function fEditarItem(){
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var txtCodigoUsu = $("#txtCodigoUsu").val();
    var txtUsuario = $.trim($("#txtUsuario").val());
    var EtxtNombre = $.trim($("#EtxtNombre").val());
    var EtxtEmail = $.trim($("#EtxtEmail").val());
    var EsPerfil = $("#EsPerfil").val();
    var divpsicologocat = $('.divpsicologocat').css('display');
    var EsPsicologoCat = $("#EsPsicologoCat").val();

    if(EtxtEmail == ''){
      toastr.error('Por favor, ingrese E-Mail.');
      $("#EtxtEmail").focus();
    }
    else if(!regex.test($("#EtxtEmail").val())) {
      toastr.error('Formato de E-Mail inválido.');
      $("#EtxtEmail").focus();
    }
    else if(EsPerfil == ''){
      toastr.error('Por favor, seleccione Perfil.');
      $("#EsPerfil").focus();
    }
    else{

      $.ajax({
        url : "<?php url('Lopersa/editItemUsuario'); ?>",
        type : "POST",
        data : {
          'codusuario' : txtCodigoUsu,
          'usuario' : txtUsuario,
          'email' : EtxtEmail,
          'codperfil' : EsPerfil,
          'codpsicologocat' : EsPsicologoCat
        },
        dataType : "JSON",
        success : function (json){
          if(json.success == true){
            loadPsicologosCAT();
            toastr.success("Item Actualizado exitosamente");
            $("#frmEditar")[0].reset();
            
            $("#mEditar").modal('hide');
            $('#tbl_usuarios').DataTable().ajax.reload();

          }else{
            toastr.error(json.mensaje);
          }
        }
      });
    }

  }


  function feditEstado(cod,est){
    var palabreo;
    if(est == 'off'){
        palabreo = "¿Está seguro de Inhabilitar este Usuario?";
    }else{
        palabreo = "¿Está seguro de Habilitar este Usuario?";   
    }
    bootbox.confirm(palabreo, function(result) {
        if (result) {
            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "<?php url('Lopersa/editEstadoCliente'); ?>",
                type: "POST",
                data: {codusuario : cod, estado : est}
            })
            .done(function(data) {
                if(data.success == true){
                    var cb = function (){ $('.tooltips').tooltip() };
                    $('#tbl_usuarios').DataTable().ajax.reload(cb);
                    $('.desactivarC').fadeOut(500);
                    toastr.success("Acción realizada exitosamente", "Maestro de Usuarios");
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

  function consultarFuncionario(){
    var regexname = /^[0-9]*$/;
    var ntxtUsuario = $.trim($("#ntxtUsuario").val());
    if(ntxtUsuario == '' ){
      toastr.error('Por favor, ingrese Usuario de Funcionario a buscar.');
      $("#ntxtUsuario").focus();
    }
    else if(!regexname.test($("#ntxtUsuario").val())){
      toastr.error('Por favor, ingrese solo números.');
      $("#ntxtUsuario").focus();
    }else{
      $('.desactivarC').fadeIn(500);
      $.ajax({
        url : "<?php url('Lopersa/consultarFuncionario'); ?>",
        data : {
          'documento' : ntxtUsuario,
        },
        type: 'POST',
        dataType:"JSON",
        success:function(json){
  
          if(json.success==true){
            $("#ccpsicologo").val(json.cc);
            $("#ntxtNombre").val(json.nombre);
            $("#ntxtEmail").val(json.email);
          }else{
            $("#ccpsicologo").val('');
            $("#ntxtNombre").val('');
            $("#ntxtEmail").val('');
            toastr.error(json.message);
          }
  
        }, complete: function(){
          $('.desactivarC').fadeOut(500);
        }
      });
    }
  }

  function fNuevoItem(){
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    var ccpsicologo = $.trim($("#ccpsicologo").val());
    var ntxtNombre = $.trim($("#ntxtNombre").val());
    var ntxtEmail = $.trim($("#ntxtEmail").val());
    var nPerfil = $("#nPerfil").val();
    var divpsicologocat = $('.divpsicologocat').css('display');
    var nsPsicologoCat = $("#nsPsicologoCat").val();
    var nestado = $.trim($("#nestado").val());
    

    if(ntxtNombre == ''){
      toastr.error('Por favor, ingrese C.C de funcionario y presione el botón buscar.');
      $("#ntxtNombre").focus();
    }else if(ntxtEmail == ''){
      toastr.error('Por favor, ingrese E-Mail.');
      $("#ntxtEmail").focus();
    }
    else if(!regex.test($("#ntxtEmail").val())) {
      toastr.error('Formato de E-Mail inválido.');
      $("#ntxtEmail").focus();
    }
    else if(nPerfil == ''){
      toastr.error('Por favor, seleccione su Perfil.');
      $("#nPerfil").focus();
    }
    else if(nestado == ''){
      toastr.error('Por favor, seleccione Estado.');
      $("#nestado").focus();
    }
    else{

      $.ajax({
        url : "<?php url('Lopersa/insertItemUsuario'); ?>",
        type : "POST",
        data : {
          'usuario' : ccpsicologo,
          'nombre' : ntxtNombre,
          'email' : ntxtEmail,
          'codperfil' : nPerfil,
          'codpsicologocat' : nsPsicologoCat,
          'estado' : nestado
        },
        dataType : "JSON",
        success : function (json){
          if(json.success == true){
            loadPsicologosCAT();
            toastr.success("Usuario agregado exitosamente");
            $("#frmNuevo")[0].reset();
            $("#mNuevo").modal('hide');
            $('#tbl_usuarios').DataTable().ajax.reload();

          }else{
            toastr.error(json.message);
          }
        }
      });
    }
  }

  $("#frmBusqueda").submit(function(event){
      event.preventDefault();
  });




</script>
<!-- /.content --> 