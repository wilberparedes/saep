<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Nueva entrevista</h1>
  <ol class="breadcrumb">
    <!-- <li><a href="#">Nueva entrevista</a></li> -->
    <li><i class="fa fa-angle-right"></i> Nueva entrevista</li>
  </ol>
</div>

<style>
  .custom-combobox {
    width: 100%;
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
    width: 100%;
  }
  .ui-state-default{
    background: none !important;
    border-color: #d2d6de !important;
    border-radius: 4px !important;
  }
  .ui-state-default:focus{
    border-color: #3c8dbc !important;
  }

  .tt-menu { width:300px; }
  ul.typeahead{ margin:0px; padding:10px 0px; }
  ul.typeahead.dropdown-menu li a { padding: 10px !important;  border-bottom:#CCC 1px solid;color:#333; }
  ul.typeahead.dropdown-menu li:last-child a { border-bottom:0px !important;  }
  .dropdown-menu>.active>a, .dropdown-menu>.active>a:focus, .dropdown-menu>.active>a:hover {
    text-decoration: none;
    background-color: #1f3f41;
    color: #fff !important;
    outline: 0;
  }

  .popover-x{
    border-color: #E6D178 !important;
  }
  .popover-default > .popover-title {
    color: #3c4146 !important;
    background-color: #E6D178 !important;
  }
  .popover-body{
    color: #3c4146 !important;
    background: #FDF7E3 !important;
  }
  
  .popover-x.top > .arrow::after {
    border-top-color: #FDF7E3 !important;
  }
  .button-help{
    font-size: 18px !important;
    padding: 0px !important;
    height: 28px !important;
    width: 28px !important;
    overflow: hidden;
    margin-left: 15px !important;
    color: #0073b7 !important;
    border-color: #0073b7 !important;
  }
  .button-help:hover{
    background-color: #0073b7 !important;
    color: #fff !important;
  }
</style>


<!-- Main content -->
<div class="content">
  <div class="row">

      <div class="col-12 m-t-3"  style="margin-top: 0px !important"> 
        <div class="card">
          <div class="card-body">

            <h4 class="text-black">Entrevista para aspirantes</h4><br>
            <form id="frmNuevaEntrevista" role="form">

              <div class="row">

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Fecha entrevista:</label>
                    <input class="form-control" id="txtFechaEntrevista" name="txtFechaEntrevista" type="date">
                  </fieldset>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Identificación:</label>
                    <div style="overflow: hidden;position: relative;" >
                      <input class="form-control tooltips" id="txtIdentificacion" name="txtIdentificacion" type="number" data-rel="tooltip" data-placement="bottom" data-original-title="Digite el número de identificación y luego presione la tecla <Enter>" onkeypress="if (event.which == 13 || event.keyCode == 13) {consultarEstudiante();}">
                      <div onclick="consultarEstudiante();" style="position: absolute;right: 0px;top: 0px;background: #0185ff;padding: 6px 16px;color: white;border-radius: 0px 4px 4px 0px;">
                        <i class="fa fa-search"></i>
                      </div>
                    </div>
                  </fieldset>
                </div>

              </div>

              <div class="row">

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Nombre completo:</label>
                    <input class="form-control" id="txtNombreCompleto" name="txtNombreCompleto" type="text">
                  </fieldset>
                </div>
                
                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>E-Mail:</label>
                    <input class="form-control" id="txtEmail" name="txtEmail" type="text">
                  </fieldset>
                </div>

              </div>

              <div class="row">

                <div class="col-lg-6 bgcolor">
                  <label>Nombre del colegio:</label>
                  <input type="hidden" id="selectuser_id" name="selectuser_id">
                  <input type="text" name="txtColegio" id="txtColegio" class="typeahead form-control"/>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Tipo de colegio:</label>
                    <select class="form-control" id="sTipoColegio" name="sTipoColegio" disabled >
                    </select>
                  </fieldset>
                </div>
                
              </div>

              <div class="row">

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Fecha presentación ICFES:</label>
                    <input class="form-control" id="txtFechaIcfes" name="txtFechaIcfes" type="date">
                  </fieldset>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Registro AC ICFES:</label>
                    <input class="form-control" id="txtAcIcfes" name="txtAcIcfes" type="text" onkeyup="mayus(this);">
                  </fieldset>
                </div>

              </div>


              <div class="row">
                
                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Edad:</label>
                    <select class="form-control" id="sEdad" name="sEdad">
                      <option value="">Seleccione</option>
                      <option value="13">13</option>
                      <option value="14">14</option>
                      <option value="15">15</option>
                      <option value="16">16</option>
                      <option value="17">17</option>
                      <option value="18">18</option>
                      <option value="19">19</option>
                      <option value="20">20</option>
                      <option value="21">21</option>
                      <option value="22">22</option>
                      <option value="23">23</option>
                      <option value="24">24</option>
                      <option value="25">25</option>
                      <option value="26">26</option>
                      <option value="27">27</option>
                      <option value="28">28</option>
                      <option value="29">29</option>
                      <option value="30">30</option>
                      <option value="31">31</option>
                      <option value="32">32</option>
                      <option value="33">33</option>
                      <option value="34">34</option>
                      <option value="35">35</option>
                      <option value="36">36</option>
                      <option value="37">37</option>
                      <option value="38">38</option>
                      <option value="39">39</option>
                      <option value="40">40</option>
                      <option value="41">41</option>
                      <option value="42">42</option>
                      <option value="43">43</option>
                      <option value="44">44</option>
                      <option value="45">45</option>
                      <option value="46">46</option>
                      <option value="47">47</option>
                      <option value="48">48</option>
                      <option value="49">49</option>
                      <option value="50">50</option>
                      <option value="51">51</option>
                      <option value="52">52</option>
                      <option value="53">53</option>
                      <option value="54">54</option>
                      <option value="55">55</option>
                      <option value="56">56</option>
                      <option value="57">57</option>
                      <option value="58">58</option>
                      <option value="59">59</option>
                      <option value="60">60</option>
                      <option value="61">61</option>
                      <option value="62">62</option>
                      <option value="63">63</option>
                      <option value="64">64</option>
                      <option value="65">65</option>
                      <option value="66">66</option>
                      <option value="67">67</option>
                      <option value="68">68</option>
                      <option value="69">69</option>
                      <option value="70">70</option>
                      <option value="71">71</option>
                      <option value="72">72</option>
                      <option value="73">73</option>
                      <option value="74">74</option>
                      <option value="75">75</option>
                      <option value="76">76</option>
                      <option value="77">77</option>
                      <option value="78">78</option>
                      <option value="79">79</option>
                      <option value="80">80</option>
                      <option value="81">81</option>
                      <option value="82">82</option>
                      <option value="83">83</option>
                      <option value="84">84</option>
                      <option value="85">85</option>
                      <option value="86">86</option>
                      <option value="87">87</option>
                      <option value="88">88</option>
                      <option value="89">89</option>
                      <option value="90">90</option>
                      <option value="91">91</option>
                      <option value="92">92</option>
                      <option value="93">93</option>
                      <option value="94">94</option>
                      <option value="95">95</option>
                      <option value="96">96</option>
                      <option value="97">97</option>
                      <option value="98">98</option>
                      <option value="99">99</option>
                    </select>
                  </fieldset>
                </div>
                
                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Estado civil:</label>
                    <select id="sEstadoCivil" name="sEstadoCivil" class="form-control">
                      <option value="">Seleccione</option>
                      <option value="CA">Casado/a</option>
                      <option value="DI">Divorciado/a</option>
                      <option value="SO">Soltero/a</option>
                      <option value="UL">Unión libre</option>
                      <option value="CO">Viudo/a</option>
                    </select>
                  </fieldset>
                </div>

              </div>



              <div class="row">

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Sexo:</label>
                    <select id="sSexo" name="sSexo" class="form-control">
                      <option value="">Seleccione</option>
                      <option value="F">Femenino</option>
                      <option value="M">Masculino</option>
                    </select>
                  </fieldset>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Situación laboral:</label>
                    <select id="sSituacionLaboral" name="sSituacionLaboral" class="form-control">
                      <option value="">Seleccione</option>
                      <option value="Desempleado">Desempleado</option>
                      <option value="Empleado">Empleado</option>
                      <option value="Independiente">Independiente</option>
                      <option value="Emprendedor">Emprendedor</option>
                    </select>
                  </fieldset>
                </div>

              </div>

              <div class="row">

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Grupo priorizado:</label>
                    <select id="sGrupoPriorizado" name="sGrupoPriorizado" class="form-control">
                    </select>
                  </fieldset>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Tipo de población:</label>
                    <select id="sTipoPoblacion" name="sTipoPoblacion" class="form-control">
                      <option value="">Seleccione</option>
                    </select>
                  </fieldset>
                </div>

              </div>

              <div class="row">

                <div class="col-lg-6 divtipodiscapacidad" style="display:none;">
                  <fieldset class="form-group">
                    <label>Tipo de discapacidad y/o Talento excepcional:</label>
                    <select id="sTipoDiscapacidadTalento" name="sTipoDiscapacidadTalento" class="form-control">
                    </select>
                  </fieldset>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Teléfono móvil:</label>
                    <input type="number" id="txtTelefono" name="txtTelefono" class="form-control">
                  </fieldset>
                </div>

              </div>


              <div class="row">

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Otro Teléfono:</label>
                    <input type="number" id="txtTelefonoOtro" name="txtTelefonoOtro" class="form-control">
                  </fieldset>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Teléfono fijo:</label>
                    <input type="number" id="txtTelefonoFijo" name="txtTelefonoFijo" class="form-control">
                  </fieldset>
                </div>

              </div>

              <div class="row">
                
                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Dirección de residencia:</label>
                    <input type="text" id="txtDireccion" name="txtDireccion" class="form-control">
                  </fieldset>
                </div>

                <div class="col-lg-6">
                  <fieldset class="form-group">
                    <label>Carrera a cual aspira:</label>
                    <input type="hidden" id="txtCodPrograma" name="txtCodPrograma" class="form-control" readonly >
                    <input type="text" id="txtCarreraAspira" name="txtCarreraAspira" class="form-control" readonly >
                  </fieldset>
                </div>
                
              </div>

              <div class="row">

                <div class="col-lg-6 divmodvirtual" style="display:none;">
                  <fieldset class="form-group">
                    <label>Requerimiento modalidad virtual:</label>
                    <select multiple class="form-control" id="sRequerimientoVirtual" name="sRequerimientoVirtual[]">
                      <option value="Banda ancha">Banda ancha</option>
                      <option value="Audífonos">Audífonos</option>
                      <option value="Micrófono">Micrófono</option>
                      <option value="Camara web">Camara web</option>
                    </select>
                  </fieldset>
                </div>

              </div>

            </form>

          </div>
        </div>
      </div>

      <style>
        .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td {
          vertical-align: middle;
        }
      </style>
  
      <div class="aspectos" style="width: 100%;display: block;overflow: hidden;"></div>

      <div class="col-lg-12 m-t-3">
        <div class="card card-outline">
          <div class="card-header bg-blue">
            <h5 class="text-white m-b-0">CONCEPTO FINAL ENTREVISTA</h5>
          </div>
          <div class="card-body">

            <ul class="list-group">
              <li class="list-group-item">

                <div class="row" style="display: inline-table;width: 100%;">

                  <div class="col-lg-4" style="vertical-align: middle;display: table-cell;overflow: hidden; border-right: 1px solid rgba(0,0,0,.125); text-align: center;">
                    <b>ADMITIDO:</b> <span id="admitido">...</span>
                  </div>

                  <div class="col-lg-4" style="vertical-align: middle;display: table-cell;overflow: hidden; border-right: 1px solid rgba(0,0,0,.125); text-align: center;">
                    <b>ADMITIDO CON ACOMPAÑAMIENTO</b>  <br> <b>Académico: </b><span id="academico">...</span> <br> <b>Psicológico: </b> <span id="psicologico">...</span>
                  </div>
  
                  <div class="col-lg-4 divcodacompanamiento" style="display:none;vertical-align: middle;overflow: hidden; text-align: center;">
                    <fieldset class="form-group">
                      <label><b>Código de acompañamiento:</b></label>
                      <input type="text" id="txtCodigoAcompanamiento" name="txtCodigoAcompanamiento" class="form-control">
                    </fieldset>
                  </div>

                </div>

              </li>
            </ul>

          </div>
        </div>
      </div>

      <div class="col-12 m-t-3" style="position: fixed;bottom: 0;width: 100%;left: 0;right: 0;box-shadow: 20px 25px 10px 23px;background: #fff;">
        <div class="">
          <div class="card-body text-center" style="padding: 6px;">
            <button type="button" onclick="nuevEncuesta();" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button>
          </div>
        </div>
      </div>


  </div>
</div>

<!-- MODALS  -->

<!-- FIN MODALS -->

<script>

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }

  $(function(){

    /* ------- combobox autocomplete code -----*/
    $( "#txtColegio" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "<?php url('Lopersa/sLoadColegios'); ?>",
          type: 'post',
          dataType: "json",
          data: {
            query: request.term
          },
          success: function( data ) {
            response( data );
          }
        });
      },
      select: function (event, ui) {
        $('#txtColegio').val(ui.item.label); // display the selected text
        $('#selectuser_id').val(ui.item.value); // save selected id to input
        $("#sTipoColegio").val(ui.item.codpropiedad);
        return false;
      }
    });


    $('[data-rel="tooltip"]').tooltip(); 

    combobox('sGrupoPriorizado',"<?php url('Lopersa/loadGrupoPriorizado'); ?>",'Seleccione');

    combobox('sTipoColegio', "<?php url('Lopersa/sloadPropiedadPlantaFisica'); ?>", '');

    floadRequerimientoVirtual();

    $("#sGrupoPriorizado").on("change", function () {
      var sGrupoPriorizado = $("#sGrupoPriorizado").val();
      comboboxEntrevista('sTipoPoblacion',"<?php url('Lopersa/loadTipoPoblacion'); ?>?codgp="+sGrupoPriorizado,'Seleccione');

      if(sGrupoPriorizado == '1'){
        $(".divtipodiscapacidad").show();
      }else{
        $(".divtipodiscapacidad").hide();
      }
    });

    $("#sTipoPoblacion").on("change", function(){
      combobox('sTipoDiscapacidadTalento', "<?php url('Lopersa/sLoadTipoDiscapacidad'); ?>?codtp="+$(this).val(), 'Seleccione');
    });

    var date = new Date();

    var day = date.getDate();
    var month = date.getMonth() + 1;
    var year = date.getFullYear();

    if (month < 10) month = "0" + month;
    if (day < 10) day = "0" + day;

    var today = year + "-" + month + "-" + day;       
    $("#txtFechaEntrevista").attr("value", today);
    $("#txtFechaIcfes").attr("max", today);

    floadAspectos();

    //---------------
  });

  function floadRequerimientoVirtual(){
    $.ajax({
      url: "<?php url('Lopersa/sLoadRequerimientos'); ?>",
      type : "POST",
      dataType: "JSON",
      success: function(data){
        var op = '';
        $.each(data, function(k,v){
          op += '<option value="'+v.nombre_rc+'">'+v.nombre_rc+'</option>';
        });
        $('#sRequerimientoVirtual').html(op);
      }
    })
  }
  

  var totalAspectos = 0;
  var aspectos = new Array();
  function floadAspectos(){
    $.ajax({
      url : "<?php url('Lopersa/loadAspectos'); ?>",
      type : "POST" ,
      dataType: "JSON",
      success: function(data){

        if(data.length != 0){
          var html = '<form id="frmaspectos">';
          $.each(data,function(k,v){
            html+='<div class="col-lg-12 m-t-3">';
            html+='<div class="card card-outline">';
            html+='<div class="card-header bg-blue">';
            html+='<h5 class="text-white m-b-0">'+v.nombre_ae+'</h5>';
            html+='</div>';
            
            totalAspectos++;

            if(v.conceptos.length != 0){
              var html1 = '<div class="card-body">';
              html1 += '<table class="table-responsive table table-bordered">';
              html1 += '<tr>';
              html1 += '<th scope="col" style="width:50%;">CONCEPTO A EVALUAR</th>';
              html1 += '<th scope="col">RANGO DE EVALUACIÓN</th>';
              html1 += '<th scope="col">OBSERVACIONES ESPECIFICAS</th>';
              html1 += '</tr>';
              html1 += '<tr>';
              var conceptos = new Array();
              $.each(v.conceptos, function(k1, v1){

                html1 += '<tr>';
                html1 += '<td>'+v1.nombre_ce+'';
                html1 += '<button type="button" class="button-help btn btn-rounded btn-outline-info" data-toggle="popover-x" data-target="#myPopover'+v.codigo_ae+'a" data-placement="top top-left">?</button>';
                html1 += '<div id="myPopover'+v.codigo_ae+'a" class="popover popover-x popover-default">';
                html1 += '<div class="arrow"></div>';
                html1 += '<h3 class="popover-header popover-title"><span class="close pull-right" data-dismiss="popover-x">&times;</span>Title</h3>';
                html1 += '<div class="popover-body popover-content">';
                html1 += '<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.</p>';
                html1 += '</div>';
                html1 += '</div>';
                html1 += '</td>';
                html1 += '<td>';
                html1 += '<select name="concepto'+v.codigo_ae+'C'+v1.codigo_ce+'" id="concepto'+v.codigo_ae+'C'+v1.codigo_ce+'" class="form-control">';
                html1 += '<option value="">Seleccione</option>';
                $.each(v1.respuestas, function(k2, v2){
                  html1 += '<option id="'+v2.codigo_rc+'" value="'+v2.val_respuesta+'">'+v2.nombre_rc+'</option>';
                });
                html1 += '</select>';
                html1 += '</td>';
                html1 += '<td>';
                html1 += '<textarea name="observacion'+v.codigo_ae+'C'+v1.codigo_ce+'" id="observacion'+v.codigo_ae+'C'+v1.codigo_ce+'" cols="30" rows="2" class="form-control"></textarea>';
                html1 += '</td>';
                html1 += '</tr>';
 
                conceptos.push({codigoce: v1.codigo_ce, nombre: v1.nombre_ce});

              });

              html1 += '</tr>';
              html1 += '</table>';
              html1 += '</div>';
              html += html1;
            }

            aspectos.push({codigo:v.codigo_ae, nombre: v.nombre_ae, conceptos: conceptos});

            html+='</div>';
            html+='</div>';
          });
          
          html += '</form>';
          $(".aspectos").html(html);

        }

      }, complete: function(){

        var $btns = $("[data-toggle='popover-x']");
        console.log($btns);
        if ($btns.length) {
          $btns.popoverButton();
        }
        // Sumatoria para ACOMPAÑAMIENTO ACADEMICO
        $("#concepto2C4, #concepto2C5, #concepto2C6, #concepto3C7, #concepto3C8, #concepto3C9, #concepto3C10, #concepto3C11, #concepto3C12, #concepto3C13").on("change", function () {

          var c4 = (Number.isNaN(parseFloat($('#concepto2C4').val())) ? 0 : parseFloat($('#concepto2C4').val()));
          var c5 = (Number.isNaN(parseFloat($('#concepto2C5').val())) ? 0 : parseFloat($('#concepto2C5').val()));
          var c6 = (Number.isNaN(parseFloat($('#concepto2C6').val())) ? 0 : parseFloat($('#concepto2C6').val()));
          var total1 = c4 + c5 + c6;

          var c7 = (Number.isNaN(parseFloat($('#concepto3C7').val())) ? 0 : parseFloat($('#concepto3C7').val()));
          var c8 = (Number.isNaN(parseFloat($('#concepto3C8').val())) ? 0 : parseFloat($('#concepto3C8').val()));
          var c9 = (Number.isNaN(parseFloat($('#concepto3C9').val())) ? 0 : parseFloat($('#concepto3C9').val()));
          var c10 = (Number.isNaN(parseFloat($('#concepto3C10').val())) ? 0 : parseFloat($('#concepto3C10').val()));
          var c11 = (Number.isNaN(parseFloat($('#concepto3C11').val())) ? 0 : parseFloat($('#concepto3C11').val()));
          var c12 = (Number.isNaN(parseFloat($('#concepto3C12').val())) ? 0 : parseFloat($('#concepto3C12').val()));
          var c13 = (Number.isNaN(parseFloat($('#concepto3C13').val())) ? 0 : parseFloat($('#concepto3C13').val()));

          var total2 = c7 + c8 + c9 + c10 + c11 + c12 + c13;
          var total3 = total1 + total2;
          var total4 = c10 + c11;
          
          if(total3<=117){
            $('#academico').html('SI');
            $('#admitido').html('SI');
            $('.divcodacompanamiento').css('display', 'table-cell');
          }
          else if(total4 == 11.9 ){
            $('#academico').html('SI');
            $('#admitido').html('SI');
            $('.divcodacompanamiento').css('display', 'table-cell');
          }
          else{
            $('#academico').html('NO');
            $('#admitido').html('SI');
            $('.divcodacompanamiento').css('display', 'none');
          }
        });

        $("#concepto4C14, #concepto4C15, #concepto4C16, #concepto4C17, #concepto4C18, #concepto5C24 ").on("change", function (){

          var c14 = (Number.isNaN(parseFloat($('#concepto4C14').val())) ? 0 : parseFloat($('#concepto4C14').val()));
          var c15 = (Number.isNaN(parseFloat($('#concepto4C15').val())) ? 0 : parseFloat($('#concepto4C15').val()));
          var c16 = (Number.isNaN(parseFloat($('#concepto4C16').val())) ? 0 : parseFloat($('#concepto4C16').val()));
          var c17 = (Number.isNaN(parseFloat($('#concepto4C17').val())) ? 0 : parseFloat($('#concepto4C17').val()));
          var c18 = (Number.isNaN(parseFloat($('#concepto4C18').val())) ? 0 : parseFloat($('#concepto4C18').val()));
          var total1 = (c14 + c15 + c16 + c17 + c18);
          var id = $('#concepto5C24').children(":selected").attr("id");

          if(total1 <=60.01){
            $('#psicologico').html('SI');
            $('#admitido').html('SI');
            $('.divcodacompanamiento').css('display', 'table-cell');
          }
          else if(id == 77 || id == 78){
            $('#psicologico').html('SI');
            $('#admitido').html('SI');
            $('.divcodacompanamiento').css('display', 'table-cell');
          }
          else {
            $('#psicologico').html('NO'); 
            $('#admitido').html('SI');
            $('.divcodacompanamiento').css('display', 'none');
          }

        });
      }
    });
  }

  function fNuevoItem(){

    var ntxtRol = $("#ntxtRol").val();
    var ntxtNombrePerfil = $("#ntxtNombrePerfil").val();
    var nestado = $("#nestado").val();

    if($.trim(ntxtRol) == ''){
      toastr.error('Por favor, ingrese Rol.');
      $("#ntxtRol").focus();

    }else if($.trim(ntxtNombrePerfil) == ''){
      toastr.error('Por favor, ingrese Nombre de Perfil.');
      $("#ntxtNombrePerfil").focus();

    }else if($.trim(nestado) == ''){
      toastr.error('Por favor, seleccione Estado de Perfil.');
      $("#nestado").focus();

    }else{

        $.ajax({
          url : "<?php url('Lopersa/insertItemPerfil'); ?>",
          type : "POST",
          data : {
            'nombre_perfil' : ntxtNombrePerfil,
            'rol': ntxtRol,             
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





  function consultarEstudiante(){
    $.ajax({
      url : "<?php url('Lopersa/consultarEstudiante'); ?>",
      data : {
        'documento' : $("#txtIdentificacion").val(),
      },
      type: 'POST',
      dataType:"JSON",
      success:function(json){

        if(json.success==true){

          if($("#txtIdentificacion").parent().hasClass("has-error")){
            $("#txtIdentificacion").parent().removeClass("has-error");
          }

          $("#txtNombreCompleto").val(json.nombres);
          $("#txtEmail").val(json.email);
          $("#sEdad").val(json.edad);
          $("#txtCarreraAspira").val(json.programa);
          $("#txtDireccion").val(json.direccion);
          $("#txtCodPrograma").val(json.codprograma);

          var letra = json.codprograma.substring(0,1);
          if(letra == 'V'){
            $(".divmodvirtual").show();
          }else{
            $(".divmodvirtual").hide();
          }

        }else{
          $("#txtNombreCompleto").val('');
          $("#txtEmail").val('');
          toastr.error(json.msg);
        }

      }, complete: function(){
        loadDataICFES();
      }
    });
  }

  function loadDataICFES(){
    $.ajax({
      url : "<?php url('Lopersa/consultarIcfes'); ?>",
      data : {
        'documento' : $("#txtIdentificacion").val(),
      },
      type: 'POST',
      dataType:"JSON",
      success:function(json){

        if(json.success==true){

          $("#txtFechaIcfes").attr("value", json.fecharealizacion);
          $("#txtAcIcfes").val(json.registroac);

        }else{

          $("#txtFechaIcfes").val('');
          $("#txtAcIcfes").val('');
          toastr.error(json.msg);

        }

      }
    });
  }


  function nuevEncuesta(){

    var regexname = /^[0-9]*$/;
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    var txtFechaEntrevista = $.trim($("#txtFechaEntrevista").val());
    var txtIdentificacion = $.trim($("#txtIdentificacion").val());
    var txtNombreCompleto = $.trim($("#txtNombreCompleto").val());
    var txtColegio = $.trim($("#txtColegio").val());
    var txtEmail = $.trim($("#txtEmail").val());
    var sColegio = $.trim($("#sColegio").val());
    var sEdad = $.trim($("#sEdad").val());
    var txtFechaIcfes = $.trim($("#txtFechaIcfes").val());
    var sEstadoCivil = $.trim($("#sEstadoCivil").val());
    var txtAcIcfes = $.trim($("#txtAcIcfes").val());
    var sSexo = $.trim($("#sSexo").val());
    var sGrupoPriorizado = $.trim($("#sGrupoPriorizado").val());
    var sSituacionLaboral = $.trim($("#sSituacionLaboral").val());
    var sTipoPoblacion = $.trim($("#sTipoPoblacion").val());
    var txtTelefono = $.trim($("#txtTelefono").val());
    var sTipoDiscapacidadTalento = $.trim($("#sTipoDiscapacidadTalento").val());
    var txtTelefonoOtro = $.trim($("#txtTelefonoOtro").val());
    var txtTelefonoFijo = $.trim($("#txtTelefonoFijo").val());
    var txtCarreraAspira = $.trim($("#txtCarreraAspira").val());
    var txtDireccion = $.trim($("#txtDireccion").val());
    var sRequerimientoVirtual = $.trim($("#sRequerimientoVirtual").val());

    var divtipodiscapacidad = $('.divtipodiscapacidad').css('display');
    var divmodvirtual = $('.divmodvirtual').css('display');

    var txtCodigoAcompanamiento = $.trim($("#txtCodigoAcompanamiento").val());
    var divcodacompanamiento = $('.divcodacompanamiento').css('display');

    $(".form-group").removeClass("has-error");

    if(txtFechaEntrevista == ''){
      toastr.error("Por favor, seleccione Fecha entrevista");
      $("#txtFechaEntrevista").focus();
    }
    else if(txtIdentificacion == ''){
      toastr.error("Por favor, ingrese Identificación");
      $("#txtIdentificacion").focus();
      $("#txtIdentificacion").parent().addClass("has-error");
    }
    else if(!regexname.test(txtIdentificacion)){
      toastr.error("Ingrese solo números en Identificación");
      $("#txtIdentificacion").focus();
      $("#txtIdentificacion").parent().addClass("has-error");
    }
    else if(txtNombreCompleto == ''){
      toastr.error("Por favor, ingrese Nombre completo");
      $("#txtNombreCompleto").focus();
      $("#txtNombreCompleto").parent().addClass("has-error");
    }
    else if(txtEmail == ''){
      toastr.error("Por favor, ingrese Email");
      $("#txtEmail").focus();
      $("#txtEmail").parent().addClass("has-error");
    }
    if (!regex.test(txtEmail)) {
      $toastr.error("E-Mail invalido");
      $("#txtEmail").focus();
      $("#txtEmail").parent().addClass("has-error");
    }
    else if(txtColegio == ''){
      toastr.error("Por favor, ingrese Colegio");
      $("#txtColegio").focus();
      $("#txtColegio").parent().addClass("has-error");
    }
    else if(txtFechaIcfes == ''){
      toastr.error("Por favor, seleccione Fecha Icfes");
      $("#txtFechaIcfes").focus();
      $("#txtFechaIcfes").parent().addClass("has-error");
    }
    else if(txtAcIcfes == ''){
      toastr.error("Por favor, ingrese AC Icfes");
      $("#txtAcIcfes").focus();
      $("#txtAcIcfes").parent().addClass("has-error");
    }
    else if(sEdad == ''){
      toastr.error("Por favor, seleccione Edad");
      $("#sEdad").focus();
      $("#sEdad").parent().addClass("has-error");
    }
    else if(sEstadoCivil == ''){
      toastr.error("Por favor, seleccione Estado civil");
      $("#sEstadoCivil").focus();
      $("#sEstadoCivil").parent().addClass("has-error");
    }
    else if(sSexo == ''){
      toastr.error("Por favor, seleccione Sexo");
      $("#sSexo").focus();
      $("#sSexo").parent().addClass("has-error");
    }
    else if(sSituacionLaboral == ''){
      toastr.error("Por favor, seleccione Situacion laboral");
      $("#sSituacionLaboral").focus();
      $("#sSituacionLaboral").parent().addClass("has-error");
    }
    else if(sGrupoPriorizado == ''){
      toastr.error("Por favor, seleccione Grupo priorizado");
      $("#sGrupoPriorizado").focus();
      $("#sGrupoPriorizado").parent().addClass("has-error");
    }
    else if(sTipoPoblacion == ''){
      toastr.error("Por favor, seleccione Tipo poblacion");
      $("#sTipoPoblacion").focus();
      $("#sTipoPoblacion").parent().addClass("has-error");
    }
    else if(divtipodiscapacidad == 'block' && sTipoDiscapacidadTalento == ''){
      toastr.error("Por favor, seleccione Tipo de discapacidad y/o talento");
      $("#sTipoDiscapacidadTalento").focus();
      $("#sTipoDiscapacidadTalento").parent().addClass("has-error");
    }
    else if(txtTelefono == ''){
      toastr.error("Por favor, ingrese Teléfono móvil");
      $("#txtTelefono").focus();
      $("#txtTelefono").parent().addClass("has-error");
    }
    else if(!regexname.test(txtTelefono)){
      toastr.error("Ingrese solo números en Teléfono móvil");
      $("#txtTelefono").focus();
      $("#txtTelefono").parent().addClass("has-error");
    }
    else if(txtTelefonoOtro == ''){
      toastr.error("Por favor, ingrese Otro Teléfono de contacto");
      $("#txtTelefonoOtro").focus();
      $("#txtTelefonoOtro").parent().addClass("has-error");
    }
    else if(!regexname.test(txtTelefonoOtro)){
      toastr.error("Ingrese solo números en ingrese Otro Teléfono");
      $("#txtTelefonoOtro").focus();
      $("#txtTelefonoOtro").parent().addClass("has-error");
    }
    else if(txtTelefonoFijo == ''){
      toastr.error("Por favor, ingrese Teléfono fijo");
      $("#txtTelefonoFijo").focus();
      $("#txtTelefonoFijo").parent().addClass("has-error");
    }
    else if(!regexname.test(txtTelefonoFijo)){
      toastr.error("Ingrese solo números en Teléfono fijo:");
      $("#txtTelefonoFijo").focus();
      $("#txtTelefonoFijo").parent().addClass("has-error");
    }
    else if( txtDireccion == ''){
      toastr.error("Por favor, ingrese Dirección");
      $("#txtDireccion").focus();
      $("#txtDireccion").parent().addClass("has-error");
    }
    else if(txtCarreraAspira == ''){
      toastr.error("Por favor, ingrese Carrera aspira");
      $("#txtCarreraAspira").focus();
      $("#txtCarreraAspira").parent().addClass("has-error");
    }
    else if(divmodvirtual == 'block' && sRequerimientoVirtual == ''){
      toastr.error("Por favor, seleccione Requerimiento modalidad virtual");
      $("#sRequerimientoVirtual").focus();
      $("#sRequerimientoVirtual").parent().addClass("has-error");
    }
    else if(divcodacompanamiento == 'table-cell' && txtCodigoAcompanamiento == ''){
      toastr.error("Por favor, ingrese Código de acompañamiento");
      $("#txtCodigoAcompanamiento").focus();
      $("#txtCodigoAcompanamiento").parent().addClass("has-error");
    }
    else{

      var datosEncuesta = $("#frmNuevaEntrevista").serialize();
      var datosAspectos = $("#frmaspectos").serialize();
      $('.desactivarC').fadeIn(500);
      $.ajax({
        url: "<?php url('Lopersa/nuevaEncuesta'); ?>",
        type : "POST",
        data : datosEncuesta+"&"+datosAspectos+"&aspectos="+JSON.stringify(aspectos)+"&codacom="+txtCodigoAcompanamiento,
        dataType : "JSON", 
        success : function (json){
          if(json.success){

            $('#txtCodigoAcompanamiento').val('');
            $('#academico').html('');
            $('#psicologico').html('');
            $('#admitido').html('');
            $('.divcodacompanamiento').hide();

            $("#frmNuevaEntrevista")[0].reset();
            $("#frmaspectos")[0].reset();
            toastr.success("Entrevista registrada exitosamente!");

          }else{

            toastr.error(json.message);

          }
        }, complete:function(){
          $('.desactivarC').fadeOut(500);
        }
      });
    }
  } 

</script>


<!-- /.content --> 
