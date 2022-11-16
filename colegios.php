<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Colegios</h1>
  <ol class="breadcrumb">
    <li><a>Gestión de Datos</a></li>
    <li><i class="fa fa-angle-right"></i> Colegios</li>
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
                      <fieldset class="form-group">
                        <label>Municipio:</label>
                        <select id="sbMunicipio" name="sbMunicipio" class="form-control">
                          <option value="">Seleccione...</option>
                        </select>
                      </fieldset>
                    </div>
                    <div class="col-lg-3">
                      <div class="form-group">
                        <label style="width:100%">Acciones</label>
                        <div class="btn-group" role="group" >
                          <button type="button" class="btn btn-primary" onclick="buscar();"><i class="fa fa-search"></i> Buscar</button>
                          <button type="button" class="btn btn-danger tooltips" data-rel="tooltip" data-placement="bottom" title="Limpiar búsqueda" onclick="realoadTable('tbl_colegios', '<?php url("Lopersa/loadColegios"); ?>'); $('#sbDepartamento').val('');$('#sbMunicipio').val('');"><i class="fa fa-trash-o"></i></button>
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
              <a style="float:right;" class="btn btn-success" data-toggle="modal" data-target="#mNuevo"><i class="fa fa-plus-square-o"></i> Nuevo Colegio</a>
              <a style="float:right;margin-right:5px;" class="btn btn-success" onclick="fModalExcel();"><i class="fa fa-file-excel-o"></i> Registro masivo</a>
              <table id="tbl_colegios" class="table table-bordered table-hover" data-name="cool-table">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th style="width: 120px;">Departamento</th>
                    <th style="width: 90PX;">Municipio</th>
                    <th style="width: 333px;">Nombre Colegio</th>
                    <th>Propiedad <br> Planta Física</th>
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
                  <input type="hidden" id="txtCodColegio" name="txtCodColegio">
                  <h4 class="modal-title"><strong>Editar Colegio</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmEditar" method="POST" class="form-horizontal">
                      <div class="form-body row">
                          <div class="form-group col-lg-12" >
                              <label>Departamento: </label>
                              <select id="bDepartamento" name="bDepartamento" class="form-control">
                                <option value="" selected="">seleccione</option>
                              </select>
                          </div>

                          <div class="form-group col-lg-12" >
                              <label>Municipio: </label>
                              <select id="bMunicipio" name="bMunicipio" class="form-control">
                                <option value="" selected="">seleccione</option>
                              </select>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="control-label ">Nombre Colegio
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="txtNombreColegio" id="txtNombreColegio" class="form-control"  required="true" />
                          </div>
                          
                          <div class="form-group col-lg-12">
                            <label>Propiedad planta física: </label>
                            <select id="bpropiedadplantafisica" name="bpropiedadplantafisica" class="form-control">
                              <option value="" selected="">Todos</option>
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
                  <h4 class="modal-title"><strong>Nuevo Colegio</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmNuevo" method="POST" class="form-horizontal">
                      <div class="form-body row">

                          <div class="form-group col-lg-12" >
                            <label>Departamento: </label>
                            <select id="nbDepartamento" name="nbDepartamento" class="form-control">
                              <option value="" selected="">seleccione</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-12" >
                            <label>Municipio: </label>
                            <select id="nbMunicipio" name="nbMunicipio" class="form-control">
                              <option value="" selected="">seleccione</option>
                            </select>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="control-label">Nombre
                                  <span class="required">
                                       *
                                  </span>
                              </label>
                              <input type="text" name="ntxtNombreColegio" id="ntxtNombreColegio" class="form-control" required="true" />
                          </div>
                          
                          <div class="form-group col-lg-12">
                            <label>Propiedad planta física: </label>
                            <select id="nbpropiedadplantafisica" name="nbpropiedadplantafisica" class="form-control">
                              <option value="" selected="">Todos</option>
                            </select>
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


  <div class="modal fade" id="mExcel" tabindex="-1" role="dialog" aria-labelledby="mExcel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  <h4 class="modal-title"><strong>Registro masivo de colegios</strong></h4>
              </div>
              <div class="modal-body">
                  <!-- BEGIN FORM-->
                  <form id="frmDatosExcel" method="POST" class="form-horizontal">
                      <div class="form-body row">

                          <div class="form-group col-lg-12" >
                            <label>Departamento: </label>
                            <select id="mbDepartamento" name="mbDepartamento" class="form-control">
                              <option value="" selected="">seleccione</option>
                            </select>
                          </div>

                          <!-- <div class="form-group col-lg-12" >
                            <label>Municipio: </label>
                            <select id="mbMunicipio" name="mbMunicipio" class="form-control">
                              <option value="" selected="">seleccione</option>
                            </select>
                          </div> -->
                          <div class="form-group col-lg-12">
                              <label class="control-label">Estado
                                <span class="required">
                                  *
                                </span>
                              </label>
                              <select id="mestado" name="mestado" class="form-control">
                                  <option value="on" selected>Habilitado</option>
                                  <option value="off">Inhabilitado</option>
                              </select>
                          </div>
                        </form> 

                        <form id="frmExcel" method="POST" class="form-horizontal">
                          <!-- estructura de excel  -->
                          <div class="form-group col-lg-12">
                            <label class="control-label">Estructura de los datos en Excel
                              <span class="required">
                                *
                              </span>
                            </label>
                            <table class="table">
                              <thead class="thead-dark table-bordered">
                                <tr>
                                  <th class="text-center">A</th>
                                  <th class="text-center">B</th>
                                  <th class="text-center">C</th>
                                </tr>
                              </thead>
                              <tbody>
                                <tr>
                                  <td>Nombre Municipio</td>
                                  <td>Nombre Colegio</td>
                                  <td>Propiedad Planta Física</td>
                                </tr>
                              </tbody>
                            </table>
                          </div>

                          <div class="form-group col-lg-12">
                              <label class="control-label">Archivo Excel
                                <span class="required">
                                  *
                                </span>
                              </label>
                              <input type="file" class="form-control-file" id="fexcel" name="fexcel" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                          </div>
                        
                          <div class="alert alert-success" role="alert" id="total" style="display:none;">
                            </div>

                          <div class="alert alert-danger" role="alert" id="resultado"  style="display:none;max-height: 236px;overflow: hidden;overflow-y: scroll;padding: 5px;">
                          </div>
                          
                      </div>
                    </form>
                 
                  <!-- END FORM-->
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-success" onclick="fMasivo();">Subir masivo</button>
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
    combobox('mbDepartamento',"<?php url('Lopersa/sloadDepartamentos'); ?>",'Seleccione...');

    combobox('nbpropiedadplantafisica',"<?php url('Lopersa/sloadPropiedadPlantaFisica'); ?>",'Seleccione...');
    combobox('bpropiedadplantafisica',"<?php url('Lopersa/sloadPropiedadPlantaFisica'); ?>",'Seleccione...');
    
    $("#sbDepartamento").change(function(){
      combobox('sbMunicipio',"<?php url('Lopersa/sloadMunicipios'); ?>?coddepartamento="+$(this).val(),'Seleccione...');
    });

    $("#nbDepartamento").change(function(){
      combobox('nbMunicipio',"<?php url('Lopersa/sloadMunicipios'); ?>?coddepartamento="+$(this).val(),'Seleccione...');
    });

    $("#mbDepartamento").change(function(){
      // combobox('mbMunicipio',"<?php url('Lopersa/sloadMunicipios'); ?>?coddepartamento="+$(this).val(),'Seleccione...');
    });


    floadColegios();


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


  function floadColegios(){
    $('#tbl_colegios').dataTable({
        ajax : "<?php url('Lopersa/loadColegios'); ?>",
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
            { "class": "center", "orderable": true },//column 2
            { "orderable": true },//column 3
            { "orderable": true },//column 4
            { "orderable": true },//column 4
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
  function fmodalEditar(coddepartamento, codmunicipio, codcolegio, nombre, codpropiedad){
    comboboxSelected('bMunicipio',"<?php url('Lopersa/sloadMunicipios'); ?>?coddepartamento="+coddepartamento,'Seleccione...',codmunicipio);
    $("#bDepartamento").val(coddepartamento);
    $("#txtCodColegio").val(codcolegio);
    $("#txtNombreColegio").val(nombre);
    $("#bpropiedadplantafisica").val(codpropiedad);
    $("#mEditar").modal('show');
  }

  function fEditarItem(){
    var txtCodColegio = $("#txtCodColegio").val();
    var bMunicipio = $("#bMunicipio").val();
    var txtNombreColegio = $("#txtNombreColegio").val();
    var bpropiedadplantafisica = $("#bpropiedadplantafisica").val();


    if($.trim(bMunicipio) == ''){
        toastr.error('Por favor, seleccione el Municipio.');
        $("#bMunicipio").focus();

    }else if($.trim(txtNombreColegio) == ''){
        toastr.error('Por favor, ingrese nombre de Colegio.');
        $("#txtNombreColegio").focus();

    }else if($.trim(bpropiedadplantafisica) == ''){
        toastr.error('Por favor, seleccione Propiedad planta física.');
        $("#bpropiedadplantafisica").focus();
    }else{

      $.ajax({
          url : "<?php url('Lopersa/editItemColegio'); ?>",
          type : "POST",
          data : {
              'codcolegio' : txtCodColegio,
              'codmunicipio' : bMunicipio,
              'nombre_colegio' : txtNombreColegio,
              'codpropiedad' : bpropiedadplantafisica
          },
          dataType : "JSON",
          success : function (json){
              if(json.success == true){
                  toastr.success("Item Actualizado exitosamente");
                  $("#frmEditar")[0].reset();
                  
                  $("#mEditar").modal('hide');
                  $('#tbl_colegios').DataTable().ajax.reload();
                 
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
        palabreo = "¿Está seguro de Inhabilitar este Colegio?";
    }else{
        palabreo = "¿Está seguro de Habilitar este Colegio?";   
    }
    bootbox.confirm(palabreo, function(result) {
        if (result) {
            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "<?php url('Lopersa/editEstadoColegio'); ?>",
                type: "POST",
                data: {codcolegio : cod, estado : est}
            })
            .done(function(data) {
                if(data.success == true){
                    var cb = function (){ $('.tooltips').tooltip() };
                    $('#tbl_colegios').DataTable().ajax.reload(cb);
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
    var nbMunicipio = $("#nbMunicipio").val();
    var ntxtNombreColegio = $("#ntxtNombreColegio").val();
    var nbpropiedadplantafisica = $("#nbpropiedadplantafisica").val();
    var nestado = $("#nestado").val();

    if($.trim(nbMunicipio) == ''){
      toastr.error('Por favor, ingrese Departamento.');
      $("#nbMunicipio").focus();

    }else if($.trim(ntxtNombreColegio) == ''){
      toastr.error('Por favor, ingrese Nombre de Colegio.');
      $("#ntxtNombreColegio").focus();

    }else if($.trim(nbpropiedadplantafisica) == ''){
      toastr.error('Por favor, ingrese Propiedad Planta Física.');
      $("#nbpropiedadplantafisica").focus();

    }else if($.trim(nestado) == ''){
      toastr.error('Por favor, seleccione Estado de Colegio.');
      $("#nestado").focus();

    }else{
      $.ajax({
          url : "<?php url('Lopersa/insertItemColegio'); ?>",
          type : "POST",
          data : {
              'codmunicipio' : nbMunicipio,
              'nombre_colegio' : ntxtNombreColegio,
              'codpropiedad' : nbpropiedadplantafisica,
              'estado' : nestado
          },
          dataType : "JSON",
          success : function (json){
            if(json.success == true){
              toastr.success("Item agregado exitosamente");
              $("#frmNuevo")[0].reset();
              $("#mNuevo").modal('hide');
              $('#tbl_colegios').DataTable().ajax.reload();
            }else{
              toastr.error(json.mensaje);
            }
          }
      });
    }

  }

  function buscar(){
    var codmunicipio = $("#sbMunicipio").val();
    var url = "<?php url('Lopersa/loadColegios'); ?>?codmunicipio="+codmunicipio;
    realoadTable('tbl_colegios', url);
  }


  function fModalExcel(){
    $("#mbDepartamento").val('');
    $("#resultado").html('');
    $("#total").hide();
    $("#resultado").hide();
    $("#mExcel").modal('show');
  }
  function fMasivo(){
    $("#total").hide();
    $("#resultado").hide();
    $("#resultado").html('');
    var coddepartamento  = $("#mbDepartamento").val();
    var nombredepartamento  = $('#mbDepartamento option:selected').html();
    var excel  = $("#fexcel").val();

    if(coddepartamento == ''){
      toastr.error('Por favor, seleccione el Departamento');
    }else if(excel == ''){
      toastr.error("Por favor, seleccione el archivo Excel a importar.")
    }else{
      $('.desactivarC').fadeIn(500);
      var formData = new FormData($("#frmExcel")[0]);
      $.ajax({
        url: "<?php url('Lopersa/insertMasivoColegios'); ?>?coddepartamento="+coddepartamento+"&nombredepartamento="+nombredepartamento,
        type:"POST",
        data:formData,
        contentType: false,
        processData: false,
        dataType:"JSON",
        success: function(json){

          if(json.success){
            $("#fexcel").val('');
            $("#total").html("<br/><b>Total de registros cargados: </b>" + json.total + "<br/>").show();
            if(json.resultado != ""){
              $("#resultado").html("<br/><b>Se han presentado las siguientes novedades:</b> <br/>" + json.resultado).show();
            }
          }else{
            toastr.error("Ocurrio un error al subir archivo "+json);
          }
        }, complete: function(){
          $('.desactivarC').fadeOut(500);
          toastr.success("Archivo cargado correctamente.");
          $('#tbl_colegios').DataTable().ajax.reload();
        }
      });
    }

  }

  

  


  




</script>
<!-- /.content --> 