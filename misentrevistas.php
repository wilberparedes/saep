<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<script src="<?php url('assets/js/calendar-init.js'); ?>"></script>

<!-- Content Header (Page header) -->
<div class="content-header sty-one">
  <h1>Mis entrevistas</h1>
  <ol class="breadcrumb">
    <li><a>Cronograma de entrevistas</a></li>
    <li><i class="fa fa-angle-right"></i> Mis entrevistas</li>
  </ol>
</div>

<style>
  
  .table {
    margin-bottom: 0px;
  }
  b{
    color: #fff;
  }
  .table-bordered > tbody > tr > th, .table-bordered > tbody > tr > td {
    vertical-align: middle;
  }
  .fc-content-col, .fc-content{
    padding: 2px 0px;
  }
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
  .list-group-item{
    cursor:pointer;
  }
  b.gray{
    color:#333 !important;
  }
  .gp{
    margin-right: 0 !important;
    margin-left: 0 !important;
    border-top: 1px solid rgba(0,0,0,.1);
    padding-top: 1rem;
    /* border-bottom: 1px solid rgba(0,0,0,.1); */
    /* margin-bottom: 1rem; */
    position: relative;
    margin-top: 10px;
  }
  #btnaddgp{
    position: absolute;
    right: 0;
    top: -16px;
    background: white;
  }
  #btnaddgp:hover{
    color: #fff;
    background-color: #28a745;
    border-color: #28a745;
  }
  .grupo{
    width: 100%
  }
  .dropify-wrapper{
    height: 145px !important;
  }
</style>


<!-- Main content -->
<div class="content">

    <div class="row" id="divcalendar">
        <div class="col-md-12">

          <div style="margin: 0 auto;">
            <div class="info-box">
              <div class="col-12">
                <div class="d-flex flex-wrap">
                  <div>
                    <h5 class="m-b-15">Estadística</h5>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 m-auto m-top-40 m-bot-10">
                <div id="donut" style="margin-top: 20px"></div>
              </div>
              <div class="row" style="margin-top: 20px; display: flex;justify-content: space-around;">
                
                <div class="text-center">
                  <h6 class="f-14">Gestionadas</h6>
                  <h4 id="gestionadas"></h4>
                </div>
                <div class=" text-center">
                  <h6 class="f-14">Pendientes</h6>
                  <h4 id="pendientes"></h4>
                </div>
                <div class=" text-center">
                  <h6 class="f-14">Vencidas</h6>
                  <h4 id="vencidas"></h4>
                </div>
                <div class="text-center">
                  <h6 class="f-14">Canceladas</h6>
                  <h4 id="canceladas"></h4>
                </div>
                
                <div class="text-center">
                  <h6 class="f-14">TOTAL</h6>
                  <h4 id="totalentrevistas"></h4>
                </div>
              </div>
            </div>
          </div>

          <!-- <div class="card">
            <div class="card-body">
              <h4 class="text-black">Gestión rápida</h4><br>
              <p>ingrese documento de identificación del estudiante:</p>

            </div>
          </div> -->

          <div class="card">
            <div class="card-body">
              <h4 class="text-black">Calendario</h4><br>
              <!-- THE CALENDAR -->
              <div id="calendar1"></div>
            </div>
          </div>

        </div>
    </div>

    <div style="display:none;" class="row" id="divEntrevista">
        <div class="col-12 m-t-3"  style="margin-top: 0px !important"> 

            <div class="card">

            <div class="card-body">

                <h4 class="text-black">Entrevista para aspirante</h4><br>
                <div style="overflow:hidden; display:block; width:100%" class="row">
                  <div class="col-6" style="float: left;"> 
                    <img src="<?php url('assets/img/logo-americana-blue.png')?>" class="img-responsive" alt="Logo Corporación Universitaria Americana">
                  </div>
                  <div class="col-6" style="float: right;">
                    <img src="<?php url('assets/img/logo_bienestar.png')?>" style="text-align: right;float: right;" class="img-responsive" alt="Logo Bienestar Institucional">
                  </div>
                </div>
                <div style="max-width: 155px;display: block;overflow: hidden;margin: 0 auto;">
                  <img id="img-student" src="" class="img-responsive img-circle" alt="Student profile picture">
                </div>
                <div style="max-width: 215px;display: block;overflow: hidden;margin: 0 auto;display:none" id="divLink">
                <br>
                  <a id="linkVideo" target="_blank" class="btn btn-outline-primary"><i class="icon-camrecorder"></i> Entrar a videollamada</a>
                  
                  <div class="alert alert-danger alert-dismissible fade show" id="msgErrorLink" style="display:none" role="alert">
                    <span id="sMessageLink"></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                  </div>
                  <br>
                </div>
                <div style="text-align:center;display:none;" class="divuser">
                  <span style="width: 100%;display: block;"><b style="color: #666f73;">E-Mail: </b><span class="correolink"></span><br/></span>
                  <span style="width: 100%;display: block;"><b style="color: #666f73;">Contraseña: </b><span class="passlink"></span><br/><br/></span>
                </div>

                <button class="btn btn-success" id="btnUpdateNota" onclick="updateNota()" style="display:none;font-size: 12px;padding: 8px;margin-bottom: 10px;">Actualizar calificación de entrevista</button><br>


                <form id="frmNuevaEntrevista" role="form">

                <div class="row">

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Fecha entrevista:</label>
                          <input class="form-control" id="txtFechaEntrevista" name="txtFechaEntrevista" type="date" readonly>
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <input type="hidden" id="IDDETRESADMISION">
                          <label>Identificación:</label>
                          <div style="overflow: hidden;position: relative;" >
                          <input class="form-control tooltips" id="txtIdentificacion" name="txtIdentificacion" type="number" data-rel="tooltip" data-placement="bottom" data-original-title="Digite el número de identificación y luego presione la tecla <Enter>" onkeypress="if (event.which == 13 || event.keyCode == 13) {consultarEstudiante();}" readonly>
                          <!-- <div onclick="consultarEstudiante();" style="position: absolute;right: 0px;top: 0px;background: #0185ff;padding: 6px 16px;color: white;border-radius: 0px 4px 4px 0px;">
                              <i class="fa fa-search"></i>
                          </div> -->
                          </div>
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Nombre completo:</label>
                          <input class="form-control" id="txtNombreCompleto" name="txtNombreCompleto" type="text">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>E-Mail:</label>
                          <input class="form-control" id="txtEmail" name="txtEmail" type="text">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6 bgcolor">
                      <label>Nombre del colegio:</label>
                      <input type="hidden" id="selectuser_id" name="selectuser_id">
                      <input type="text" name="txtColegio" id="txtColegio" class="typeahead form-control"/>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Tipo de colegio:</label>
                          <select class="form-control" id="sTipoColegio" name="sTipoColegio" disabled >
                          </select>
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                        <label>Fecha presentación ICFES:</label>
                        <input class="form-control" id="txtFechaIcfes" name="txtFechaIcfes" type="date">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Registro AC ICFES:</label>
                          <input class="form-control" id="txtAcIcfes" name="txtAcIcfes" type="text" onkeyup="mayus(this);">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Sexo:</label>
                          <select id="sSexo" name="sSexo" class="form-control">
                          <option value="">Seleccione</option>
                          <option value="F">Femenino</option>
                          <option value="M">Masculino</option>
                          </select>
                      </fieldset>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Edad:</label>
                          <select class="form-control" id="sEdad" name="sEdad">
                          <option value="">Seleccione</option>
                          <option value="9">9</option>
                          <option value="10">10</option>
                          <option value="11">11</option>
                          <option value="12">12</option>
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
                    
                    <div class="col-lg-4 col-md-6">
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

                    <div class="col-lg-4 col-md-6">
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

                    <!-- grupo priorizado init -->

                    <div class="grupo">

                      <div class="row gp_1 gp">
                        <div class="col-lg-4 col-md-6">
                          <fieldset class="form-group">
                              <label>Grupo priorizado 1:</label>
                              <select id="sGrupoPriorizado_1" name="sGrupoPriorizado_1" data="1" class="form-control grupopriorizado">
                              </select>
                          </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6">
                          <fieldset class="form-group">
                              <label>Tipo de población 1:</label>
                              <select id="sTipoPoblacion_1" name="sTipoPoblacion_1" data="1" class="form-control tipopoblacion">
                              <option value="">Seleccione</option>
                              </select>
                          </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6 divRUV_1"  style="display:none;">
                          <fieldset class="form-group"> 
                            <label>RUV 1:</label>
                            <input class="form-control" id="txtRUV_1" data="1" name="txtRUV_1" type="text">
                          </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6 divtipodiscapacidad_1"  style="display:none;">
                          <fieldset class="form-group"> 
                            <label id="labeltipotalento_1">Tipo de discapacidad y/o Talento excepcional 1:</label>
                            <select id="sTipoDiscapacidadTalento_1"  data="1"name="sTipoDiscapacidadTalento_1" class="form-control tipodiscapacidad">
                            </select>
                          </fieldset>
                        </div>

                        <div class="col-lg-4 col-md-6 divsubtipodiscapacidad_1"  style="display:none;">
                          <fieldset class="form-group"> 
                            <label>Subtipo de discapacidad 1:</label>
                            <select id="sSubTipoDiscapacidadTalento_1" data="1" name="sSubTipoDiscapacidadTalento_1" class="form-control subtipodiscapacidad">
                            </select>
                          </fieldset>
                        </div>

                        <a class="btn btn-sm btn-rounded btn-outline-success" id="btnaddgp" onclick="addgp()"><i class="fa fa-plus"></i>Añadir</a>
                      </div>

                    </div>


                    <!-- grupo priorizado fin -->
                    
                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                        <label>Teléfono móvil:</label>
                        <input type="number" id="txtTelefono" name="txtTelefono" class="form-control">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Otro Teléfono:</label>
                          <input type="number" id="txtTelefonoOtro" name="txtTelefonoOtro" class="form-control">
                      </fieldset>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Teléfono fijo:</label>
                          <input type="number" id="txtTelefonoFijo" name="txtTelefonoFijo" class="form-control">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Dirección de residencia:</label>
                          <input type="text" id="txtDireccion" name="txtDireccion" class="form-control">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Estrato socioeconómico:</label>
                          <select class="form-control" name="sEstrato" id="sEstrato" title="seleccione...">
                            <option value="">seleccione...</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                          </select>
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Lugar de residencia:</label>
                          <input type="text" id="txtLugarResidencia" name="txtLugarResidencia" class="form-control">
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                        <label>Barrio de residencia:</label>
                        <input type="text" id="txtBarrio" name="txtBarrio" class="form-control">
                      </fieldset>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                      <fieldset class="form-group">
                          <label>Carrera a cual aspira:</label>
                          <input type="hidden" id="txtCodPrograma" name="txtCodPrograma" class="form-control" readonly >
                          <input type="text" id="txtCarreraAspira" name="txtCarreraAspira" class="form-control" readonly >
                      </fieldset>
                    </div>

                    <div class="col-lg-4 col-md-6 divmodvirtual" style="display:none;">
                      <fieldset class="form-group">
                          <label style="display: block;">Requerimiento modalidad virtual:</label>
                          <select class="selectpicker multiselectchulo" multiple name="sRequerimientoVirtual[]" title="seleccione...">
                            <option value="Banda ancha">Banda ancha</option>
                            <option value="Audífonos">Audífonos</option>
                            <option value="Micrófono">Micrófono</option>
                            <option value="Camara web">Camara web</option>
                          </select>
                      </fieldset>
                      <input type="hidden" id="IDPARADMISION">
                    </div>

                  </div>

                </form>

              </div>
            </div>
        </div>

      <form id="frmaspectos" style="width: 100%;">
        <div class="aspectos" style="width: 100%;display: block;overflow: hidden;"></div>

        
        <div class="col-lg-12 m-t-3">
          <div class="card card-outline">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">ASPECTOS EVALUATIVOS PRUEBAS SABER</h5>
            </div>
            <div class="card-body" id="icfes">
            </div>
          </div>
        </div>
      </form>


        <div class="col-lg-12 m-t-3">
          <div class="card card-outline">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">CONCEPTO FINAL ENTREVISTA</h5>
            </div>
            <div class="card-body" styel="padding-left: 0px; padding-right: 0px">
              <div  style="display: flex;width: 100%;justify-content: center;align-items: center;">
                  <div class="col-lg-2" style="text-align: center;">
                      <b style="color:#333">ADMITIDO:</b> <span id="admitido"></span>
                  </div>
                  <div class="col-lg-7" style="border-right: 1px solid rgba(0,0,0,.125); border-left: 1px solid rgba(0,0,0,.125); text-align: center;">
                    <b style="color:#333">ADMITIDO CON ACOMPAÑAMIENTO</b>  <br> <b style="color:#333">Académico: </b><span id="academico"></span> <br> <b style="color:#333">Psicológico: </b> <span id="psicologico"></span>
                    <br>
                    <p class="textopsico" style="display:none;font-weight:bold;text-align: justify;">Nota: Los acompañamientos descritos en este instrumento obedecen a una impresión diagnostica del proceso de entrevista, que requerirá validar con un profesional especialista.</p>
                    <div class="acompanamientodiscapacidad" style="display:none;">
                      <b style="color:#333">Discapacidad: </b> <span id="discapacidad">SÍ</span>
                      <p class="descripciondiscapacidad" style="none;font-weight:bold;text-align: justify;"></p>
                    </div>
                  </div>
  
                  <div class="col-lg-3 " style="text-align: center;">
                    <fieldset class="form-group codigoacompanamientoacademico" style="display:none;">
                      <label><b style="color:#333">Acompañamiento Académico:</b></label>
                      <select multiple title="Seleccione..." name="codigoacompanamientoacademico[]"  class="form-control multipleselect multipleAcomAcade">
                      </select>
                    </fieldset>
                    <fieldset class="form-group codigoacompanamientopsicologico" style="display:none;">
                      <label><b style="color:#333">Acompañamiento Psicológico:</b></label>
                      <select multiple title="Seleccione..." name="codigoacompanamientopsicologico[]"  class="form-control multipleselect multipleAcomPsico">
                      </select>
                    </fieldset>
                  </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 m-t-3">
          <div class="card card-outline">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">APLICACIÓN DE PRUEBAS PSICOTECNICAS</h5>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-lg-12">
                  <fieldset class="form-group col-lg-12 div">
                    <label><b style="color:#333">Seleccione una opción</b></label>
                    <select multiple title="Seleccione..." name="sPruebaspsicotecnicas[]"  class="form-control multipleselect multiplePruebaPsico">
                    </select>
                  </fieldset>
                  <form role="form" id="frm-FilesPruebasPsico">
                    <div id="divInputFilePruebasPsico" class="row" style="padding: 0px 15px;">
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-12 m-t-3">
          <div class="card card-outline">
            <div class="card-header bg-blue">
              <h5 class="text-white m-b-0">CONCLUSIONES DE ADMISIÓN E IMPRESIÓN DIAGNOSTICA DE ASPECTOS EN EL ACOMPAÑAMIENTO DETERMINADO</h5>
            </div>
            <div class="card-body">
              <!-- <ul class="list-group"> -->
                <!-- <li class="list-group-item"> -->
                  <div class="row">
                    <div class="col-lg-12">
                      <fieldset class="form-group col-lg-12 div">
                        <label><b style="color:#333">Escriba sus conclusiones</b></label>
                        <textarea name="txaConclusiones" id="txaConclusiones" class="form-control" cols="20" rows="5"></textarea>
                      </fieldset>
                    </div>
                  </div>
                <!-- </li> -->
              <!-- </ul> -->
            </div>
          </div>
        </div>

        <div class="col-lg-12 m-t-3 puntaje" style="display:none;">
          <div class="card card-outline">
            <div class="card-body table-responsive">
              <table class=" table table-bordered">
                <tbody style="display: block;">
                  <tr style="display: block;">
                    <th scope="col" class=" text-right" colspan="3" style="background: rgb(51, 51, 51) none repeat scroll 0% 0%; color: white;width: 50%;float: left;">ENTREVISTA GESTIONADA POR: </th>
                    <td style="float: left;width: 50%;">
                      <span id="psicologoentrevista" style="font-weight:bold;"></span>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
         </div>

        <div class="col-12 m-t-3" style="position: fixed;bottom: 0;width: 100%;left: 0;right: 0;box-shadow: 20px 25px 10px 23px;background: #fff;">
            <div class="">
                <div class="card-body text-center" style="padding: 6px;">
                  <button type="button" onclick="volta();" class="btn btn-danger"><i class="fa fa-chevron-left"></i> Volver</button>
                  <button type="button" onclick="fsaveTemp();" id="btnBorrador" class="btn btn-outline-primary"><i class="fa fa-eraser"></i> Guardar como Borrador</button>
                  <button type="button" onclick="nuevEncuesta();" id="btnGuardar" class="btn btn-primary"><i class="fa fa-check"></i> Guardar</button>
                </div>
            </div>
        </div>
    </div>
  
</div>

<!-- MODALS  -->
  <div class="modal" id="calendarModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 550px;">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Detalle de entrevista</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <!-- <p><b style="color:#333 !important">Seccional: </b><span id="sSeccional" style="color:#333 !important"></span></p> -->
          <p><b style="color:#333 !important">Sede: </b><span id="sSede" style="color:#333 !important"></span></p>
          <p><b style="color:#333 !important"><span id="cedulaEstudiante" style="color:#333 !important"></span></b></p>
          <p><b style="color:#333 !important">Estudiante: </b><span id="sEstudiante" style="color:#333 !important"></span></p>
          <p><b style="color:#333 !important">Nro. teléfono: </b><span id="sCelular" style="color:#333 !important"></span></p>
          <p><b style="color:#333 !important">Programa acádemico: </b><span id="sPrograma" style="color:#333 !important"></span></p>
          <p><b style="color:#333 !important">Fecha: </b><span id="modalDate" style="color:#333 !important"></span></p>
          <p><b style="color:#333 !important">Hora inicio: </b><span style="color:#333 !important" id="modalStart"></span></p>
          <p><b style="color:#333 !important">Hora fin: </b><span style="color:#333 !important" id="modalEnd"></span></p>
          <p><b style="color:#333 !important">Notificado: </b><span style="color:#333 !important" id="notif"></span></p>
          <p><b style="color:#333 !important">Estado: </b><span style="color:#333 !important" id="est"></span></p>
          <hr class="pGestion">
          <p class="pGestion"><b style="color:#333 !important">Fecha de ejecución de entrevista: </b><span style="color:#333 !important" id="sFechaGestion"></span></p>
          <p class="pBorrador"><b style="color:#333 !important">E-Mail: </b><span style="color:#333 !important" class="correolink"></span></p>
          <p class="pBorrador"><b style="color:#333 !important">Contraseña: </b><span style="color:#333 !important" class="passlink"></span></p>
          <p class="pBorrador"><b style="color:#333 !important">Guardado en borrador: </b><span style="color:#333 !important" id="borr"></span></p>

          <hr class="pCancelacion">
          <p class="pCancelacion"><b style="color:#333 !important">Fecha de cancelación de entrevista: </b><span style="color:#333 !important" id="sFechaCancelacion"></span></p>
          <p class="pCancelacion"><b style="color:#333 !important">Motivo de cancelación de entrevista: </b><span style="color:#333 !important" id="motivosCancelacion"></span></p>
          

          <input type="hidden" id="eventID" />
          <input type="hidden" id="codest" />
          
          <input type="hidden" id="codperiodotemp" />
          <input type="hidden" id="codprogramatemp" />
          <input type="hidden" id="nombreprogramatemp" />

          <div class="observaciones">
            <hr />
            <div style="display:block; overflow:hidden;">
              <h6 style="float:left;">Observaciones:</h6>
              <a onclick="newObservation();" style="cursor:pointer;float:right;">Nueva</a>
            </div>
              <div class="list-group" id="listobservaciones"> 
                
              </div>
            </div>

        </div>
          <div class="modal-footer" id="btnGes">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger" onclick="fModalCancelar()">Cancelar Entrevista</button>
            <button type="button" class="btn btn-warning" id="btnNoti" style="color:#fff;"><i class="fa fa-bell-o"></i> Notificar </button>
            <button type="button" class="btn btn-primary" onclick="gestionarEntrevista()">Gestionar</button>
          </div>
          <div class="modal-footer" id="btnVis">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-success" onclick="verEntrevista()"><i class="fa fa-eye"></i> Ver entrevista </button>
          </div>
          <div class="modal-footer" id="btnBorr">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-primary" onclick="contGestion()"><i class="fa fa-eye"></i> Continuar gestión </button>
          </div>
          <div class="modal-footer" id="btnCanc">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          </div>
        </div>
    </div>
  </div>

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


  <div class="modal" id="ModalCancelar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document" style="max-width: 550px;">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Cancelar entrevista</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <fieldset class="form-group">
            <label>¿Según el seguimiento efectuado al estudiante en proceso de entrevista, cuál es el motivo relacionado con su retiro voluntario del proceso?</label>
            <select name="txamotivoscancelacion" id="txamotivoscancelacion"  class="form-control">
              <option value="">Seleccione</option>
              <option value="1">Aplazamiento</option>
              <option value="2">Cambio de Institución Privada</option>
              <option value="3">Cambio de Institución Pública</option>
              <option value="4">Cambio de Residencia</option>
              <option value="5">Desconocido</option>
              <option value="7">Dificultades Económicas</option>
              <option value="8">Falta de Apoyo Familiar</option>
              <option value="10">Falta de herramientas tecnológicas</option>
              <option value="6">Incompatibilidad de horarios</option>
              <option value="11">No admitido</option>
              <option value="9">Orientación Vocacional</option>
              <option value="12">Otro</option>
            </select>
          </fieldset>
        </div>
          <div class="modal-footer" >
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="button" class="btn btn-danger" onclick="fCancelarEntrevista()">Cancelar</button>
          </div>
        </div>
    </div>
  </div>
<!-- FIN MODALS -->

<script>

  var idcomponent = 0;
  var lengp = 1;
  let noti = true;

  function mayus(e) {
    e.value = e.value.toUpperCase();
  }

  var gestionada = false;

  function volta(){
    gestionada = false;
    lengp = 1;
    var html = addHTMLgp(1);
    evidencesPruebasPsico = [];
    pruebasPsicoSelected = [];
    $('#divInputFilePruebasPsico').html('')
    $(".grupo").html(html);
    setcomboboxGP('sGrupoPriorizado_1');
    $("#btnUpdateNota").hide();
    $(".form-group").removeClass("has-error");
    $('#IDDETRESADMISION').val('');
    $('#IDPARADMISION').val('');

    $('.puntaje').hide().css('display', 'none');
    $('#academico').html('');
    $('#psicologico').html('');
    $('.textopsico').hide();
    
    $('#admitido').html('');
    $('.codigoacompanamientoacademico').hide();
    $('.multipleAcomAcade').selectpicker('val', []);
    $('.codigoacompanamientopsicologico').hide();
    $('.multipleAcomPsico').selectpicker('val', []);
    $('.multiplePruebaPsico').selectpicker('val', []);
    $("#txaConclusiones").val('');
    $("#frmNuevaEntrevista")[0].reset();


    $("#frmaspectos")[0].reset();
    $('#divcalendar').show();
    $('#divEntrevista').hide();
    $(".multiselectchulo").attr('disabled',false);
    $('.multiselectchulo').selectpicker('val', []);
    $("#txtNombreCompleto").attr('readonly',false);
    $("#txtEmail").attr('readonly',false);
    $('#selectuser_id').attr('readonly',false);
    $('#txtColegio').attr('readonly',false);
    $("#sTipoColegio").attr('readonly',false);
    $("#txtFechaIcfes").attr('readonly',false);
    $("#txtAcIcfes").attr('readonly',false);
    $("#sSexo").attr('disabled',false);
    $("#sEdad").attr('disabled',false);
    $("#sEstadoCivil").attr('disabled',false);
    $("#sSituacionLaboral").attr('disabled',false);
    $("#sGrupoPriorizado_1").attr('disabled',false);
    $("#sTipoPoblacion_1").attr('disabled',false);
    $("#sTipoDiscapacidadTalento_1").attr('disabled',false);
    $("#txtRUV_1").attr('disabled',false);
    $("#sSubTipoDiscapacidadTalento_1").attr('disabled',false);
    $("#txtTelefono").attr('readonly',false);
    $("#txtTelefonoOtro").attr('readonly',false);
    $("#txtTelefonoFijo").attr('readonly',false);
    $("#txtDireccion").attr('readonly',false);
    $("#sEstrato").attr('readonly',false);
    $("#txtLugarResidencia").attr('readonly',false);
    $("#txtBarrio").attr('readonly',false);
    $("#txtCodPrograma").attr('readonly',false);
    $(".multiplePruebaPsico").attr('disabled',false);
    $('.puntaje').hide().css('display', 'none');
    $.each(aspectos,function(k,v){
      $.each(v.conceptos, function(k1, v1){
        $("#concepto"+v.codigo+"C"+v1.codigoce).attr('disabled',false);
        $("#observacion"+v.codigo+"C"+v1.codigoce).attr('readonly',false);
      });
    });
    $(".multipleAcomAcade").attr('disabled',false);
    $(".multipleAcomPsico").attr('disabled',false);
    $("#txaConclusiones").attr('readonly',false);
    $('.acompanamientodiscapacidad').hide();
    $('.descripciondiscapacidad').html('');
    $("#btnGuardar").show();
    $("#btnBorrador").show();
    $(".button-help").show();
    
  }

  function loaa(){
  }

  var pruebasPsicoSelected = [];
  var evidencesPruebasPsico = [];
  $(function(){
    floadStatistics();

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

    // combobox('sGrupoPriorizado',"<?php url('Lopersa/loadGrupoPriorizado'); ?>",'Seleccione');
    comboboxGP('sGrupoPriorizado_'+lengp,"<?php url('Lopersa/loadGrupoPriorizado'); ?>",'Seleccione');
    // comboboxGP('grupopriorizado',"<?php url('Lopersa/loadGrupoPriorizado'); ?>",'Seleccione');

    combobox('sTipoColegio', "<?php url('Lopersa/sloadPropiedadPlantaFisica'); ?>", '');

    comboboxClass('multipleAcomAcade', "<?php url('Lopersa/sLoadPlanAcompanamiento'); ?>", '', 1);

    comboboxClass('multipleAcomPsico', "<?php url('Lopersa/sLoadPlanAcompanamiento'); ?>", '', 2);

    
    floadPruebasPsico();

    floadRequerimientoVirtual();


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

    

    $('.multiplePruebaPsico').on("change", function () {
      var val = $(this).val();
      var e = val.indexOf("10");

      if((gestionada && evidencesPruebasPsico.length > 0) || (!gestionada)){

        if(e != -1){
          $('#divInputFilePruebasPsico').html('')
          pruebasPsicoSelected = ["10"]
          $('.multiplePruebaPsico').selectpicker('val', ["10"]);
        }else {
          var difference = val.filter(x => !pruebasPsicoSelected.includes(x));
          if(difference.length > 0){
            difference.forEach(element => {
              var item = pruebasPsico.find(x => x.cod == element);
              var html = '';
              html += '<div class="col-lg-3" id="divPruebaPsico' + element + '">';
              html += '<div class="card bg-light mb-3">';
              html += '<div class="card-header" style="height: 68px;">' + item.nombre + ' ' + element + '</div>';
              if(evidencesPruebasPsico.length){
                var evidence = evidencesPruebasPsico.find(x => x.codpruebapsico == element);
                html += '<div class="card-body divInputFile" style="padding: 10px;z-index: 0;" data-default-file="'+evidence['urlevidence']+'">';
                html += '<div class="dropify-wrapper disabled has-preview"><div class="dropify-message"><span class="file-icon"></span> </div><div class="dropify-loader" style="display: none;"></div><div class="dropify-errors-container"><ul></ul></div><div class="dropify-preview" style="display: block;"><span class="dropify-render"><i class="dropify-font-file"></i><span class="dropify-extension">pdf</span></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-filename"><span class="file-icon"></span> </p></div></div></div></div>'
              }else{
                html += '<div class="card-body" style="padding: 10px;z-index: 0;" >';
                html += '<input type="file" id="file-Pruebapsico_' + element + '" name="file-Pruebapsico_' + element + '" data-allowed-file-extensions="pdf" class="dropify" />';
              }
              html += '</div>';
              html += '</div>';
              html += '</div>';
              $('#divInputFilePruebasPsico').append(html);
            });
            pruebasPsicoSelected = val;
          } else {
            var deletes = pruebasPsicoSelected.filter(x => !val.includes(x));
            deletes.forEach(element => {
              $('#divPruebaPsico'+element).remove();
            });
            pruebasPsicoSelected = val;
          }
        }
        
        $('.dropify').dropify({
          messages: {
            default: 'Arrastre y suelte un archivo aquí o haga clic',
            replace: 'Arrastra y suelta un archivo o haz clic para reemplazarlo',
            remove:  'Borrar',
            error:   'Lo siento, el archivo es demasiado grande'
            
          },
          tpl: {
            preview:         '<div class="dropify-preview"><span class="dropify-render"></span><div class="dropify-infos"><div class="dropify-infos-inner"><p class="dropify-infos-message">{{ replace }}</p></div></div></div>',
          }
        });

        $(".divInputFile").click(function (event) {
          var file = $(this).attr('data-default-file');
          window.open('<?php url('Evidence/'); ?>'+file, '_blank');
        });

      }


    });

    


    


    //---------------
  });

  function addgp() {

    var sGrupoPriorizado = $.trim($("#sGrupoPriorizado_"+lengp).val());
    var sTipoPoblacion = $.trim($("#sTipoPoblacion_"+lengp).val());
    var sTipoDiscapacidadTalento = $.trim($("#sTipoDiscapacidadTalento_"+lengp).val());
    var divtipodiscapacidad = $('.divtipodiscapacidad_'+lengp).css('display');

    var divsubtipodiscapacidad = $('.divsubtipodiscapacidad_'+lengp).css('display');
    var sSubtipoDiscapacidadTalento = $.trim($("#sSubTipoDiscapacidadTalento_"+lengp).val());

    if(sGrupoPriorizado == ''){
      toastr.error("Por favor, seleccione Grupo priorizado");
      $("#sGrupoPriorizado_"+lengp).focus();
      $("#sGrupoPriorizado_"+lengp).parent().addClass("has-error");
    }
    else if(sTipoPoblacion == ''){
      toastr.error("Por favor, seleccione Tipo poblacion");
      $("#sTipoPoblacion_"+lengp).focus();
      $("#sTipoPoblacion_"+lengp).parent().addClass("has-error");
    }
    else if(divtipodiscapacidad == 'block' && sTipoDiscapacidadTalento == ''){
      toastr.error("Por favor, seleccione Tipo de discapacidad y/o talento");
      $("#sTipoDiscapacidadTalento_"+lengp).focus();
      $("#sTipoDiscapacidadTalento_"+lengp).parent().addClass("has-error");
    }
    else if(divsubtipodiscapacidad == 'block' && sSubtipoDiscapacidadTalento == ''){
      toastr.error("Por favor, seleccione Subtipo de discapacidad");
      $("#sSubTipoDiscapacidadTalento_"+lengp).focus();
      $("#sSubTipoDiscapacidadTalento_"+lengp).parent().addClass("has-error");
    }
    else{

      lengp++;
      var html = '<div class="row gp_'+lengp+' gp">';
      html += ' <div class="col-lg-4 col-md-6">';
      html += '<fieldset class="form-group">';
      html += '<label>Grupo priorizado '+lengp+':</label>';
      html += '<select id="sGrupoPriorizado_'+lengp+'" name="sGrupoPriorizado_'+lengp+'" data="'+lengp+'" class="form-control grupopriorizado">';
      html += '</select>';
      html += '</fieldset>';
      html += '</div>';
  
      html += '<div class="col-lg-4 col-md-6">';
      html += '<fieldset class="form-group">';
      html += '<label>Tipo de población '+lengp+':</label>';
      html += '<select id="sTipoPoblacion_'+lengp+'" name="sTipoPoblacion_'+lengp+'" data="'+lengp+'" class="form-control tipopoblacion">';
      html += '<option value="">Seleccione</option>';
      html += '</select>';
      html += '</fieldset>';
      html += '</div>';

      html += '<div class="col-lg-4 col-md-6 divRUV_'+lengp+'"  style="display:none;">';
      html += '<fieldset class="form-group">';
      html += '<label>RUV '+lengp+':</label>';
      html += '<input class="form-control" id="txtRUV_'+lengp+'" data="'+lengp+'" name="txtRUV_'+lengp+'" type="text" />';
      html += '</fieldset>';
      html += '</div>';
      
      html += '<div class="col-lg-4 col-md-6 divtipodiscapacidad_'+lengp+'" style="display:none;">';
      html += '<fieldset class="form-group">';
      html += '<label id="labeltipotalento_'+lengp+'">Tipo de discapacidad y/o Talento excepcional '+lengp+':</label>';
      html += '<select id="sTipoDiscapacidadTalento_'+lengp+'" name="sTipoDiscapacidadTalento_'+lengp+'" data="'+lengp+'" class="form-control tipodiscapacidad">';
      html += '</select>';
      html += '</fieldset>';
      html += '</div>';


      html += '<div class="col-lg-4 col-md-6 divsubtipodiscapacidad_'+lengp+'" style="display:none;">';
      html += '<fieldset class="form-group">';
      html += '<label>Subtipo de discapacidad '+lengp+':</label>';
      html += '<select id="sSubTipoDiscapacidadTalento_'+lengp+'" name="sSubTipoDiscapacidadTalento_'+lengp+'" data="'+lengp+'" class="form-control subtipodiscapacidad">';
      html += '</select>';
      html += '</fieldset>';
      html += '</div>';
      
      

      

      
      html += '<a class="btn btn-sm btn-rounded btn-outline-success" id="btnaddgp" onclick="addgp()"><i class="fa fa-plus"></i>Añadir</a>';
      html += '</div>';
      
      $("#btnaddgp").remove();
      $(".grupo").append(html);
      comboboxGP('sGrupoPriorizado_'+lengp,"<?php url('Lopersa/loadGrupoPriorizado'); ?>",'Seleccione');

    }


    };

  /*//////////////////////////////////////////////////////////////////////////////*/
  var contentGP = '';
  function comboboxGP(id,url){
    var localurl=url;
    $.ajax({
      url:localurl,
      type:"POST",
      jsonpCallback:id,
      dataType:"JSON",
      success:function (json){
        var option="<option value=''>Seleccione</option>";
        $.each(json,function(k,v){
          option+="<option value='"+v.cod+"'>"+v.nombre+"</option>";
        });
        contentGP = option;
        $("#"+id).html(option);
        
      }, complete: function(){

        $("#"+id).on("change", function () {
          var sGrupoPriorizado = $(this).val();
          var data = $(this).attr('data');
          comboboxEntrevista('sTipoPoblacion_'+data,"<?php url('Lopersa/loadTipoPoblacion'); ?>?codgp="+sGrupoPriorizado,'Seleccione');

          if(sGrupoPriorizado == '1'){
            $(".divtipodiscapacidad_"+data).show();
            $(".divRUV_"+data).hide();
          }
          else if(sGrupoPriorizado == '4') {
            if(noti == true){
              toastr.warning("Recuerde digitar el RUV");
            }
            $(".divRUV_"+data).show();
            $(".divtipodiscapacidad_"+data).hide();
          }
          else {
            $(".divRUV_"+data).hide();
            $(".divtipodiscapacidad_"+data).hide();
          }
        });
        // aqui
        $("#sTipoPoblacion_"+ $("#"+id).attr('data')).on("change", function(){
          var sTipoPoblacion = $(this).val();
          if(sTipoPoblacion == 1){
            $("#labeltipotalento_"+ $("#"+id).attr('data')).text('Tipo de discapacidad '+$("#"+id).attr('data')+':')
          }else{
            $("#labeltipotalento_"+ $("#"+id).attr('data')).text('Talento excepcional '+$("#"+id).attr('data')+':')
          }
          var data = $(this).attr('data');
          comboboxwithDescripcion('sTipoDiscapacidadTalento_'+data, "<?php url('Lopersa/sLoadTipoDiscapacidad'); ?>?codtp="+sTipoPoblacion, 'Seleccione');
          setTimeout(() => {
            $("#sTipoDiscapacidadTalento_" + data).on("change", function(){
              var sTipoPoblacion = $("#sTipoPoblacion_" + data).val();
              var sTipoDiscapacidadTalento = $(this).val();
              getDescription();
              if(sTipoPoblacion == 1 && (sTipoDiscapacidadTalento == 22 || sTipoDiscapacidadTalento == 23 || sTipoDiscapacidadTalento == 25 || sTipoDiscapacidadTalento == 26) ){
                $('.divsubtipodiscapacidad_'+data).show()
                comboboxwithDescripcion('sSubTipoDiscapacidadTalento_'+data, "<?php url('Lopersa/sLoadSubTipoDiscapacidad'); ?>?codstp="+sTipoDiscapacidadTalento, 'Seleccione');
                $("#sSubTipoDiscapacidadTalento_" + data).on("change", function(){
                  getDescription();
                });
              }else{
                $('.divsubtipodiscapacidad_'+data).hide()
              }
            });
          }, 500);
        });
      }
    });
  }

  function getDescription(){
    var allDescript = '';
    for (let index = 1; index <= lengp; index++) {
      const tipopoblacion = $("#sTipoPoblacion_" + index).val();
      if(tipopoblacion == 1){

        var divsubtipodiscapacidad = $('.divsubtipodiscapacidad_' + index).css('display');
        if(divsubtipodiscapacidad == 'block'){

          var sel = $("#sSubTipoDiscapacidadTalento_" + index);
          if(sel[0].options[sel[0].options.selectedIndex]){
            var name = sel[0].options[sel[0].options.selectedIndex].text;
            if(sel[0].options[sel[0].options.selectedIndex].attributes['descripcion']){
              var des = sel[0].options[sel[0].options.selectedIndex].attributes['descripcion'].textContent;
              allDescript += (des != 'null' ? '\u2022 '+name + ': ' + des + (index < lengp ? '<br/>' : '') : '')
            }
          }

        }else{
          var sel = $("#sTipoDiscapacidadTalento_" + index);
          var name = sel[0].options[sel[0].options.selectedIndex].text;
          if(sel[0].options[sel[0].options.selectedIndex].attributes['descripcion']){
            var des = sel[0].options[sel[0].options.selectedIndex].attributes['descripcion'].textContent;
            allDescript += (des != 'null' ? '\u2022 '+name + ': ' + des + (index < lengp ? '<br/>' : '') : '')
          }
        }

      }
    }
    if(allDescript != ''){
      $('.acompanamientodiscapacidad').show();
      $('.descripciondiscapacidad').html('Nota: <br/> '+allDescript);
    }else{
      $('.acompanamientodiscapacidad').hide();
      $('.descripciondiscapacidad').html('');
    }
  }

  function setcomboboxGP(id){
    $("#"+id).html(contentGP);
    $("#"+id).on("change", function () {
      var sGrupoPriorizado = $(this).val();
      var data = $(this).attr('data');
      comboboxEntrevista('sTipoPoblacion_'+data,"<?php url('Lopersa/loadTipoPoblacion'); ?>?codgp="+sGrupoPriorizado,'Seleccione');
      if(sGrupoPriorizado == '1'){
        $(".divtipodiscapacidad_"+data).show();
        $(".divRUV_"+data).hide();
      }
      else if(sGrupoPriorizado == '4') {
        if(noti == true){
          toastr.warning("Recuerde digitar el RUV");
        }
        $(".divRUV_"+data).show();
        $(".divtipodiscapacidad_"+data).hide();
      }
      else {
        $(".divRUV_"+data).hide();
        $(".divtipodiscapacidad_"+data).hide();
      }
    });
    $("#sTipoPoblacion_"+ $("#"+id).attr('data')).on("change", function(){
      var sTipoPoblacion = $(this).val();
      if(sTipoPoblacion == 1){
        $("#labeltipotalento_"+ $("#"+id).attr('data')).text('Tipo de discapacidad '+$("#"+id).attr('data')+':')
      }else{
        $("#labeltipotalento_"+ $("#"+id).attr('data')).text('Talento excepcional '+$("#"+id).attr('data')+':')
      }
      var data = $(this).attr('data');
      comboboxwithDescripcion('sTipoDiscapacidadTalento_'+data, "<?php url('Lopersa/sLoadTipoDiscapacidad'); ?>?codtp="+sTipoPoblacion, 'Seleccione');
      setTimeout(() => {
      $("#sTipoDiscapacidadTalento_" + data).on("change", function(){
        var sTipoPoblacion = $("#sTipoPoblacion_" + data).val();
        var sTipoDiscapacidadTalento = $(this).val();
        getDescription();
        if(sTipoPoblacion == 1 && (sTipoDiscapacidadTalento == 22 || sTipoDiscapacidadTalento == 23 || sTipoDiscapacidadTalento == 25 || sTipoDiscapacidadTalento == 26) ){
          comboboxwithDescripcion('sSubTipoDiscapacidadTalento_'+data, "<?php url('Lopersa/sLoadSubTipoDiscapacidad'); ?>?codstp="+sTipoDiscapacidadTalento, 'Seleccione');
          $('.divsubtipodiscapacidad_'+data).show()
          $("#sSubTipoDiscapacidadTalento_" + data).on("change", function(){
            getDescription();
          });
        }else{
          $('.divsubtipodiscapacidad_'+data).hide()
        }
      });
    }, 500);
    });
  }

  function updateNota(){
    $.ajax({
      url: "<?php url('Lopersa/sendPuntaje'); ?>",
      type : "POST",
      data : {
        IDDETRESADMISION : $("#IDDETRESADMISION").val(),
        IDPARADMISION : $("#IDPARADMISION").val(),
        NOTA :  $("#totalentrevista").text()
      },
      dataType : "JSON", 
      success : function (json){
        if(json.success){

          toastr.success("Nota actualizada exitosamente!");
          // window.location.reload();

        }else{
          $('.desactivarC').fadeOut(500);
          toastr.error(json.message);
        }
      }
    });
  }

  function floadStatistics(){
    $('.desactivarC').fadeIn(500);
    $("#donut").empty();
    var moment = $('#calendar1').fullCalendar('getDate');
    var month =  moment.format('MM');
    var year =  moment.format('YYYY');
    // ======
    // Donut Chart Starts
    // ======
    $.ajax({
      url: "<?php url('Lopersa/loadDonut'); ?>",
      type: 'POST',
      dataType: "JSON",
      data: {
        year,
        month
      },
      success: function( json ) {
        if(json.success){
          $("#totalentrevistas").text(json.total);
          $("#vencidas").text(json.vencidas);
          $("#pendientes").text(json.pendientes);
          $("#gestionadas").text(json.gestionadas);
          $("#canceladas").text(json.canceladas);
          Morris.Bar({
            element: 'donut',
            data: [
                {y: 'Gestionadas', a: json.porges},
                {y: 'Pendientes', a: json.porpen},
                {y: 'Vencidas', a: json.porven,},
                {y: 'Canceladas', a: json.porcan},
            ],
            xkey: 'y',
            ykeys: ['a'],
            labels: ['Porcentaje'],
            hideHover: false,
            barColors: function (row, series, type) {
              if(row.label == "Vencidas") return "#f45959";
              else if(row.label == "Pendientes") return "#ffac64";
              else if(row.label == "Gestionadas") return "#3ace43";
              else if(row.label == "Canceladas") return "#868E96";
            },
            formatter: function (x) { console.log(x)}
          }).on('click', function(i, row){
            resize: true
          });
        }else{
          toastr.error(json.message);
        }
      }, complete: function(){
        $('.desactivarC').fadeOut(500);
      }
    });
    // ======
    // Donut chart End
    // ======
  }

  function loadObservaciones(id){
    // alert(id);
    var loading = '<div class="list-group-item list-group-item-action flex-column align-items-start"><p class="mb-1">Cargando...</p></div>';
    $("#listobservaciones").html(loading);
    $.ajax({
      url: "<?php url('Lopersa/loadObservaciones'); ?>",
      type: 'POST',
      dataType: "JSON",
      data: {
        documento: id,
        codprograma: $("#codprogramatemp").val(),
        codperiodo : $('#codperiodotemp').val()
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
            html += '<h5 class="mb-1" style="font-size: 15px;"><i><b class="gray">'+v.nombrepsicologo+' - '+v.nombreperfil.toUpperCase() +'</b></i></h5>';
            html += '<small>'+v.fechahora+'</small> ';
            html += '</div>';
            html += '<p class="mb-1">'+v.novedad.toLowerCase()+'</small>';
            html += '</div>';
          });
        }
        $("#listobservaciones").html(html);
      }
    });
  }

  function newObservation(){
    $("#observationModal").modal();
  }

  function saveObservacion(){
    var txaObservacion = $("#txaObservacion").val();
    var id = $("#eventID").val();
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
          novedad: txaObservacion.toLowerCase(),
          documento: id,
          estado: $('#est').text(),
          snp: 'NO',
          nombre: $("#sEstudiante").text(),
          codprograma : $("#codprogramatemp").val(),
          programa : $("#sPrograma").text(),
          fecha: $("#modalDate").text(),
          horainicio: $("#modalStart").text()
        },
        success: function( json ) {
          if(json.success){
            loadObservaciones(id);
            $("#ob"+id).text('SÍ');
            $("#fa"+id).removeClass('fa-comment-o');
            $("#fa"+id).addClass('fa-comment');
            $("#observationModal").modal('hide');
            $("#txaObservacion").val('');
            toastr.success("Observación guardada con exito!");
            $('.desactivarC').fadeOut(500);
          }else{
            toastr.error(json.message);
            $('.desactivarC').fadeOut(500);
          }
        }
      });
    }
  }

  var nroGruposPriorizado = 1;
  function gestionarEntrevista(){
    noti = true;
    idcomponent = 0;
    icfes = new Array();
    $("#txtIdentificacion").val($("#eventID").val());
    $("#img-student").attr("src","http://aplicaciones.americana.edu.co:8080/sgacampus/images/dynamic/foto/1/"+$("#eventID").val()+"/"+$("#eventID").val()+".jpg?width=300&cut=1");
    consultarEstudiante();
    consultarLink();
    $("#btnaddgp").show();
  }

  function consultarLink(){
    $.ajax({
      url : "<?php url('Lopersa/linkEntrevista'); ?>",
      type: 'POST',
      dataType:"JSON",
      success:function(json){
        if(json.success==true){
          $("#msgErrorLink").hide();
          $("#divLink").show();
          $("#msgErrorLink").hide();
          
          $(".correolink").text(json.correo);
          $(".passlink").text(json.pass);
          
          $(".divuser").show();
          $("#linkVideo").show().attr('href', json.link);
        }else{
          $(".divuser").show();
          $("#divLink").show();
          $(".correolink").text('');
          $(".passlink").text('');
          $("#linkVideo").hide().attr('href', '');
          $("#sMessageLink").text(json.message);
          $("#msgErrorLink").show();
        }
      }
    });
  }

  
  function verEntrevista(){
    idcomponent = 0;
    noti = false;
    
    icfes = new Array();
    $(".divuser").hide();
    $("#divLink").hide();
    $("#btnaddgp").hide();
    
    $("#btnUpdateNota").show();
    $("#img-student").attr("src","http://aplicaciones.americana.edu.co:8080/sgacampus/images/dynamic/foto/1/"+$("#eventID").val()+"/"+$("#eventID").val()+".jpg?width=300&cut=1");
    $("#txtIdentificacion").val($("#eventID").val());
    $.ajax({
      url : "<?php url('Lopersa/VerEntrevista'); ?>",
      data : {
        'documento' : $("#txtIdentificacion").val(),
        'codperiodo' : $("#codperiodotemp").val(),
        'codprograma' : $("#codprogramatemp").val(),
      },
      type: 'POST',
      dataType:"JSON",
      success:function(json){

        if(json.success==true){
          $('#calendarModal').modal('hide');
          $('#divcalendar').hide();
          $('#divEntrevista').show();

          if($("#txtIdentificacion").parent().hasClass("has-error")){
            $("#txtIdentificacion").parent().removeClass("has-error");
          }

          $("#txtNombreCompleto").val(json.entrevista.nombrecompleto).attr('readonly',true);
          $("#txtEmail").val(json.entrevista.emailper).attr('readonly',true);
          $('#selectuser_id').val(json.entrevista.codcolegio).attr('readonly',true);
          $('#txtColegio').val(json.entrevista.nombrecolegio).attr('readonly',true);
          $("#sTipoColegio").val(json.entrevista.codpropiedadplantafisica).attr('readonly',true);
          $("#txtFechaIcfes").val(json.entrevista.fechaicfes).attr('readonly',true);
          $("#txtAcIcfes").val(json.entrevista.registroac).attr('readonly',true);
          $("#sSexo").val(json.entrevista.sexo).attr('disabled',true);
          $("#sEdad").val(json.entrevista.edad).attr('disabled',true);
          $("#sEstadoCivil").val(json.entrevista.estadocivil).attr('disabled',true);
          $("#sSituacionLaboral").val(json.entrevista.situacionlaboral).attr('disabled',true);
          
          // ------------------------------------------------------------------------------------
          lengp =  json.lengp;
          setValGP(1, json.gp[0].codagrupacion, json.gp[0].codtipopoblacion, json.gp[0].codtipodiscapacidad, 'SI', json.gp[0].ruv, json.gp[0].codsubtipodiscapacidad);
          if(lengp > 1){
            for (let index = 2; index <= lengp; index++) {
              var html = addHTMLgp(index, 'SI');
              $(".grupo").append(html);
              setcomboboxGP('sGrupoPriorizado_'+index);
              setValGP(index, json.gp[index-1].codagrupacion, json.gp[index-1].codtipopoblacion, json.gp[index-1].codtipodiscapacidad, 'SI', json.gp[index-1].ruv, json.gp[index-1].codsubtipodiscapacidad);
            }
          }
          // --------------------------------------------------------------------------------------

          $("#txtTelefono").val(json.entrevista.telefono).attr('readonly',true);
          $("#txtTelefonoOtro").val(json.entrevista.otrotelefono).attr('readonly',true);
          $("#txtTelefonoFijo").val(json.entrevista.fijo).attr('readonly',true);
          $("#txtDireccion").val(json.entrevista.direccion).attr('readonly',true);
          $("#sEstrato").val(json.entrevista.estrato).attr('readonly',true);
          $("#txtLugarResidencia").val(json.entrevista.lugarresidencia).attr('readonly',true);
          $("#txtBarrio").val(json.entrevista.barrioresidencia).attr('readonly',true);
          $("#txtCodPrograma").val(json.entrevista.codprograma).attr('readonly',true);
          $("#txtCarreraAspira").val(json.entrevista.nombreprograma).attr('readonly',true);
          
          if(isCarreraVirtual(json.entrevista.codprograma)){
            $(".divmodvirtual").show();
            var values = json.entrevista.requisitosmv;
            if(values != null){
              $('.multiselectchulo').selectpicker('val', values.split(","));
              $(".multiselectchulo").attr('disabled',true);
              $.each(values.split(","), function(i,e){
                $(".multiselectchulo option[value='" + e + "']").prop("selected", true);
              });
            }
          }else{
            $(".divmodvirtual").hide();
          }

          $('.puntaje').show();
          var count = 0;
          var sumgen = 0;
          $.each(aspectos,function(k,v){
            count = 0;
            $.each(json.respuestas, function(k2, v2){
              if(v2.codaspecto == v.codigo){
                count = count + parseFloat(v2.valor);
              }
              $("#concepto"+v2.codaspecto+"C"+v2.codconcepto).val(v2.codrespesta).attr('disabled',true);
              $("#observacion"+v2.codaspecto+"C"+v2.codconcepto).val(v2.observacion).attr('readonly',true);
              $("#puntaje"+v2.codaspecto+"C"+v2.codconcepto).text(v2.valor);
            });
            sumgen = sumgen + count;
            $("#total"+v.codigo).text(count.toFixed(2));
          });
          $("#totalentrevista").text(sumgen.toFixed(2));

          $('#admitido').html('SI');
          
          var codacomacademico = json.entrevista.codacomacademico;
          if(json.entrevista.codacomacademico != null){
            $('#academico').html('SI');
            $('.codigoacompanamientoacademico').show();
            $('.multipleAcomAcade').selectpicker('val', codacomacademico.split(","));
            $(".multipleAcomAcade").attr('disabled',true);
            $.each(codacomacademico.split(","), function(i,e){
              $(".multipleAcomAcade option[value='" + e + "']").prop("selected", true);
            });
          }else{
            $('.multipleAcomAcade').selectpicker('val', []);
            $('#academico').html('NO');
          }
          var codacompsicologico = json.entrevista.codacompsicologico;
          if(codacompsicologico != null){
            $('#psicologico').html('SI');
            $('.textopsico').show();
            $('.codigoacompanamientopsicologico').show();
            $('.multipleAcomPsico').selectpicker('val', codacompsicologico.split(","));
            $(".multipleAcomPsico").attr('disabled',true);
            $.each(codacompsicologico.split(","), function(i,e){
              $(".multipleAcomPsico option[value='" + e + "']").prop("selected", true);
            });

          }else{
            $('.textopsico').hide();
            $('.multipleAcomPsico').selectpicker('val', []);
            $('#psicologico').html('NO');
          }
          var html1 = '<div class="table-responsive"><table class="table table-bordered">';
          html1 += '<tr>';
          html1 += '<th scope="col"style="width:60%;">COMPONENTES SABER 11</th>';
          html1 += '<th scope="col">PUNTAJE ICFES</th>';
          html1 += '</tr>';
          html1 += '<tr>';
          $.each(json.icfes, function(k1, v1){
            idcomponent++;
            html1 += '<tr>';
            html1 += '<td>'+v1.nombre+'</td>';
            html1 += '<td>';
            html1 += '<input id="resp_icfes_'+idcomponent+'" name="resp_icfes_'+idcomponent+'" value="'+v1.puntaje+'" class="form-control" readonly/>';
            html1 += '</td>';
            html1 += '</tr>';
            icfes.push({codigo: idcomponent, nombre: v1.nombre});
          });
          html1 += '</tr>';
          html1 += '</table></div>';
          $("#icfes").html(html1);


          gestionada = true;
          
          var valuesPsico = json.entrevista.pruebapsico;
          if(valuesPsico != null){
            $('.multiplePruebaPsico').selectpicker('val', valuesPsico.split(","));
            $(".multiplePruebaPsico").attr('disabled',true);
            $.each(valuesPsico.split(","), function(i,e){
              $(".multiplePruebaPsico option[value='" + e + "']").prop("selected", true);
            });
            evidencesPruebasPsico = json.evidenciasPruebaPsico
            $(".multiplePruebaPsico").trigger('change');
          }


          $("#txaConclusiones").val(json.entrevista.conclusionesentrevista).attr('readonly',true);
          $("#psicologoentrevista").text(json.entrevista.nombrepsicologo);
          $("#btnGuardar").hide();
          $("#btnBorrador").hide();
          $(".button-help").hide();
        }else{
          $("#txtNombreCompleto").val('');
          $("#txtEmail").val('');
          toastr.error(json.msg);
        }


      }, complete: function(){
        // loadDataICFES();
      }
    });
  }

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
        $('.multiselectchulo').html(op);
      }, complete: function(){
        $('.multiselectchulo').selectpicker();
      }
    })
  }

  var pruebasPsico = [];
  function floadPruebasPsico(){
    $.ajax({
      url: "<?php url('Lopersa/sLoadPruebasPsicotecnicas'); ?>",
      type : "POST",
      dataType: "JSON",
      success: function(data){
        pruebasPsico = data
        var op = '';
        $.each(data, function(k,v){
          op += '<option value="'+v.cod+'">'+v.nombre+'</option>';
        });
        $('.multiplePruebaPsico').html(op);
      }, complete: function(){
        $('.multiplePruebaPsico').selectpicker();
        $('.multiplePruebaPsico').on("change", function () {
          var e = $(this).val().indexOf("10");
          if(e != -1){
            $('.multiplePruebaPsico').selectpicker('val', ["10"]);
          }
        });
      }
    })
  }
  

  var totalAspectos = 0;
  var aspectos = new Array();
  var componentesxi = new Array();
  var conceptosResp = new Array();
  function floadAspectos(){
    $.ajax({
      url : "<?php url('Lopersa/loadAspectos'); ?>",
      type : "POST" ,
      dataType: "JSON",
      success: function(data){

        if(data.length != 0){
          // var html = '<form id="frmaspectos">';
          var html = '';
          $.each(data,function(k,v){
            html+='<div class="col-lg-12 m-t-3">';
            html+='<div class="card card-outline">';
            html+='<div class="card-header bg-blue">';
            html+='<h5 class="text-white m-b-0">'+v.nombre_ae+'</h5>';
            html+='</div>';
            
            totalAspectos++;

            if(v.conceptos.length != 0){
              var html1 = '<div class="card-body table-responsive">';
              html1 += '<table class=" table table-bordered">';
              html1 += '<tr>';
              html1 += '<th scope="col" style="width:50%;">CONCEPTO A EVALUAR</th>';
              html1 += '<th scope="col">RANGO DE EVALUACIÓN</th>';
              html1 += '<th scope="col">OBSERVACIONES ESPECIFICAS</th>';
              html1 += '<th scope="col" class="puntaje" style="display:none;background: #333;color: white;">PUNTAJE</th>';
              html1 += '</tr>';

              var conceptos = new Array();
              $.each(v.conceptos, function(k1, v1){

                html1 += '<tr id="'+v1.codigo_ce+'">';
                html1 += '<td>'+v1.nombre_ce+'';
                html1 += '<button type="button" class="button-help btn btn-rounded btn-outline-info" data-toggle="popover-x" data-target="#myPopover'+v1.codigo_ce+'a" data-placement="top top-left">?</button>';
                html1 += '<div id="myPopover'+v1.codigo_ce+'a" class="popover popover-x popover-default">';
                html1 += '<div class="arrow"></div>';
                html1 += '<h3 class="popover-header popover-title"><span class="close pull-right" data-dismiss="popover-x">&times;</span>Sugerencias</h3>';
                html1 += '<div class="popover-body popover-content">';
                html1 += '<p>'+v1.sugerencias+'</p>';
                html1 += '</div>';
                html1 += '</div>';
                html1 += '</td>';
                html1 += '<td>';
                html1 += '<select name="concepto'+v.codigo_ae+'C'+v1.codigo_ce+'" id="concepto'+v.codigo_ae+'C'+v1.codigo_ce+'" class="form-control">';
                html1 += '<option value="">Seleccione</option>';
                $.each(v1.respuestas, function(k2, v2){
                  html1 += '<option value="'+v2.codigo_rc+'" data="'+v2.val_respuesta+'">'+v2.nombre_rc+'</option>';
                });
                
                html1 += '</select>';
                html1 += '</td>';
                html1 += '<td>';
                html1 += '<textarea name="observacion'+v.codigo_ae+'C'+v1.codigo_ce+'" id="observacion'+v.codigo_ae+'C'+v1.codigo_ce+'" cols="30" rows="2" class="form-control"></textarea>';
                html1 += '</td>';
                html1 += '<td class="puntaje" style="display:none;text-align:center;">';
                html1 += '<span id="puntaje'+v.codigo_ae+'C'+v1.codigo_ce+'" style="font-weight:bold;"></span';
                html1 += '</td>';
                html1 += '</tr>';
 
                conceptos.push({codigoce: v1.codigo_ce, nombre: v1.nombre_ce, resp: v1.respuestas});
                componentesxi.push({codigoce: v1.codigo_ce, nombre: v1.nombre_ce});

              });
              html1 += '<tr class="puntaje">';
              html1 += '<th scope="col" class="puntaje" colspan="3" style="display:none;background: #333;color: white;">PUNTAJE TOTAL: '+v.nombre_ae+'</th>';
              html1 += '<td class="puntaje" style="display:none;text-align:center;">';
              html1 += '<span id="total'+v.codigo_ae+'" style="font-weight:bold;"></span';
              html1 += '</td>';
              html1 += '</tr>';
              html1 += '</table>';
              html1 += '</div>';
              html += html1;
            }
            aspectos.push({codigo:v.codigo_ae, nombre: v.nombre_ae, conceptos: conceptos});
           
            html+='</div>';
            html+='</div>';
           
          });
          
          html+='<div class="col-lg-12 m-t-3 puntaje" style="display:none;">';
          html+='<div class="card card-outline">';
          // html+='<div class="card-header bg-blue">';
          // html+='<h5 class="text-white m-b-0">'+v.nombre_ae+'</h5>';
          // html+='</div>';
          html += '<div class="card-body table-responsive">';
          html += '<table class=" table table-bordered">';
          html += '<tbody style="display: block;"><tr style="display: block;"><th scope="col" colspan="3" style="background: rgb(51, 51, 51) none repeat scroll 0% 0%; color: white;width: 50%;float: left;text-align:right;">PUNTAJE TOTAL DE LA ENTREVISTA</th><td class="puntaje" style="text-align: left;width: 50%;float:left;"><span id="totalentrevista" style="font-weight:bold;"></span></td></tr></tbody>';
          html += '</table>';
          html += '</div>';
          html += '</div>';
          html += '</div>';
          // html += '</form>';
          $(".aspectos").html(html);

        }

      }, complete: function(){

        var $btns = $("[data-toggle='popover-x']");
        if ($btns.length) {
          $btns.popoverButton();
        }
        // Sumatoria para ACOMPAÑAMIENTO ACADEMICO 1
        $("#concepto2C4, #concepto2C5, #concepto2C6, #concepto3C7, #concepto3C8, #concepto3C9, #concepto3C10, #concepto3C11, #concepto3C12, #concepto3C13").on("change", function () {
          var c4 = (Number.isNaN(parseFloat($('#concepto2C4 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto2C4 option:selected').attr('data')));
          var c5 = (Number.isNaN(parseFloat($('#concepto2C5 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto2C5 option:selected').attr('data')));
          var c6 = (Number.isNaN(parseFloat($('#concepto2C6 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto2C6 option:selected').attr('data')));
          var total1 = c4 + c5 + c6;
          var c7 = (Number.isNaN(parseFloat($('#concepto3C7 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C7 option:selected').attr('data')));
          var c8 = (Number.isNaN(parseFloat($('#concepto3C8 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C8 option:selected').attr('data')));
          var c9 = (Number.isNaN(parseFloat($('#concepto3C9 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C9 option:selected').attr('data')));
          var c10 = (Number.isNaN(parseFloat($('#concepto3C10 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C10 option:selected').attr('data')));
          var c11 = (Number.isNaN(parseFloat($('#concepto3C11 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C11 option:selected').attr('data')));
          var c12 = (Number.isNaN(parseFloat($('#concepto3C12 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C12 option:selected').attr('data')));
          var c13 = (Number.isNaN(parseFloat($('#concepto3C13 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C13 option:selected').attr('data')));

          var total2 = c7 + c8 + c9 + c10 + c11 + c12 + c13;
          var total3 = total1 + total2;
          var total4 = c10 + c11;
          
          var idconcepto2C6 = $('#concepto2C6').children(":selected").attr("value");
          
          if(total3<=117){
            $('#academico').html('SI');
            $('#admitido').html('SI');
            $('.codigoacompanamientoacademico').show();
          }
          else if(total4 == 17.85 || total4 == 11.9){
            $('#academico').html('SI');
            $('#admitido').html('SI');
            $('.codigoacompanamientoacademico').show();
          }
          else if(idconcepto2C6 == 18){
            $('#academico').html('SI');
            $('#admitido').html('SI');
            $('.codigoacompanamientoacademico').show();
          }
          else if(idconcepto2C6 == 18){
            $('#academico').html('SI');
            $('#admitido').html('SI');
            $('.codigoacompanamientoacademico').show();
          }
          else{
            $('#academico').html('NO');
            $('.multipleAcomAcade').selectpicker('val', []);
            $('#admitido').html('SI');
            $('.codigoacompanamientoacademico').hide();
          }

        });

        $("#concepto4C14, #concepto4C15, #concepto4C16, #concepto4C17, #concepto4C18, #concepto5C24 ").on("change", function (){

          var c14 = (Number.isNaN(parseFloat($('#concepto4C14 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C14 option:selected').attr('data')));
          var c15 = (Number.isNaN(parseFloat($('#concepto4C15 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C15 option:selected').attr('data')));
          var c16 = (Number.isNaN(parseFloat($('#concepto4C16 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C16 option:selected').attr('data')));
          var c17 = (Number.isNaN(parseFloat($('#concepto4C17 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C17 option:selected').attr('data')));
          var c18 = (Number.isNaN(parseFloat($('#concepto4C18 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C18 option:selected').attr('data')));
          var total1 = (c14 + c15 + c16 + c17 + c18);
          var id = $('#concepto5C24').children(":selected").attr("value");
          var idc15 = $('#concepto4C15').children(":selected").attr("value");

          if(total1 <=60.01){
            $('#psicologico').html('SI');
            $('#admitido').html('SI');
            $('.codigoacompanamientopsicologico').show();
            $('.textopsico').show();
          }
          else if(id == 77 || id == 78){
            $('#psicologico').html('SI');
            $('#admitido').html('SI');
            $('.textopsico').show();
            $('.codigoacompanamientopsicologico').show();
          }
          else if(idc15 == 45){
            $('#psicologico').html('SI');
            $('#admitido').html('SI');
            $('.textopsico').show();
            $('.codigoacompanamientopsicologico').show();
          }
          else {
            $('.textopsico').hide();
            $('.multipleAcomPsico').selectpicker('val', []);
            $('#psicologico').html('NO'); 
            $('#admitido').html('SI');
            $('.codigoacompanamientopsicologico').hide();
          }

        });
      }
    });
  }

  function consultarEstudiante(){
    $.ajax({
      url : "<?php url('Lopersa/consultarEstudiante'); ?>",
      data : {
        'documento' : $("#txtIdentificacion").val(),
        'codprograma' : $("#codprogramatemp").val(),
        'nombreprograma' : $("#nombreprogramatemp").val(),
        'codperiodo_' : $("#codperiodotemp").val()
      },
      type: 'POST',
      dataType:"JSON",
      success:function(json){

        if(json.success==true){
          
          $("#codest").val();
          $('#calendarModal').modal('hide');
          $('#divcalendar').hide();
          $('#divEntrevista').show();

          if($("#txtIdentificacion").parent().hasClass("has-error")){
            $("#txtIdentificacion").parent().removeClass("has-error");
          }

          $("#txtNombreCompleto").val(json.nombres);
          $("#txtEmail").val(json.email);
          $("#sEdad").val(json.edad);
          $("#txtCarreraAspira").val(json.programa);
          $("#txtDireccion").val(json.direccion);
          // $("#sEstrato").val(json.estrato);
          $("#txtCodPrograma").val(json.codprograma);
          $("#txtTelefono").val(json.celular);
          $("#txtTelefonoFijo").val(json.fijo);
          $("#txtLugarResidencia").val(json.lugarresidencia);
          $("#txtBarrio").val(json.nombarrio);
          
          if(isCarreraVirtual(json.codprograma)){
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

  var icfes = new Array();
  function loadDataICFES(){
    $.ajax({
      url : "<?php url('Lopersa/consultarResultadosIcfes'); ?>",
      data : {
        'documento' : $("#txtIdentificacion").val(),
      },
      type: 'POST',
      dataType:"JSON",
      success:function(json){

        if(json.success==true){

          $("#txtFechaIcfes").attr("value", json.fecharealizacion);
          $("#txtAcIcfes").val(json.registroac);

              var html1 = '<div class="table-responsive"><table class="table table-bordered">';
              html1 += '<tr>';
              html1 += '<th scope="col" style="width:60%;">COMPONENTES SABER 11</th>';
              html1 += '<th scope="col">PUNTAJE ICFES</th>';
              html1 += '</tr>';
              html1 += '<tr>';

              $.each(json.componentes, function(k1, v1){
                  idcomponent++;
                  html1 += '<tr>';
                  html1 += '<td>'+v1.nombre+'</td>';
                  html1 += '<td>';
                  html1 += '<input id="resp_icfes_'+idcomponent+'" name="resp_icfes_'+idcomponent+'" value="'+v1.puntaje+'" class="form-control" />';
                  html1 += '</td>';
                  html1 += '</tr>';
                  icfes.push({codigo: idcomponent, nombre: v1.nombre});

              });

              html1 += '</tr>';
              html1 += '</table></div>';
              $("#icfes").html(html1);

        }else{

          $("#txtFechaIcfes").val('');
          $("#txtAcIcfes").val('');
          $("#icfes").html('');
          toastr.error(json.msg);

        }

      }
    });
  }

  function isExistIcfes(data){
    var a = 0;
    if(icfes.length != 0){
      icfes.forEach(element => {
        if(element.nombre == data){
          a = -1;
        }
      });
    }
    return a;
  }

  function validateFilePruebaPsico(){
    var empty = 0;
    pruebasPsicoSelected.forEach(element => {
      if(element == 10) return false;
      else {
        var value = $('#file-Pruebapsico_' + element).val();
        if(!value || value.length === 0 ) empty++;
      }
    });
    if(empty > 0)
      return true;
    else
      return false
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
    var sGrupoPriorizado = $.trim($("#sGrupoPriorizado_"+lengp).val());
    var sSituacionLaboral = $.trim($("#sSituacionLaboral").val());
    var sTipoPoblacion = $.trim($("#sTipoPoblacion_"+lengp).val());
    var sTipoDiscapacidadTalento = $.trim($("#sTipoDiscapacidadTalento_"+lengp).val());
    var sSubTipoDiscapacidadTalento = $.trim($("#sSubTipoDiscapacidadTalento_"+lengp).val());
    var txtTelefono = $.trim($("#txtTelefono").val());
    var txtTelefonoOtro = $.trim($("#txtTelefonoOtro").val());
    var txtTelefonoFijo = $.trim($("#txtTelefonoFijo").val());
    var txtCarreraAspira = $.trim($("#txtCarreraAspira").val());
    var txtDireccion = $.trim($("#txtDireccion").val());
    var sEstrato = $.trim($("#sEstrato").val());

    var txtLugarResidencia = $.trim($("#txtLugarResidencia").val());
    var txtBarrio = $.trim($("#txtBarrio").val());

    var sRequerimientoVirtual = $('.multiselectchulo').selectpicker('val');

    var divtipodiscapacidad = $('.divtipodiscapacidad_'+lengp).css('display');
    var divsubtipodiscapacidad = $('.divsubtipodiscapacidad_'+lengp).css('display');
    var divmodvirtual = $('.divmodvirtual').css('display');

    var codigoacompanamientoacademico = $('.multipleAcomAcade').selectpicker('val');
    var codigoacompanamientopsicologico = $('.multipleAcomPsico').selectpicker('val');

    var divcodigoacompanamientoacademico = $('.codigoacompanamientoacademico').css('display');
    var divcodigoacompanamientopsicologico = $('.codigoacompanamientopsicologico').css('display');

    var sPruebaspsicotecnicas = $('.multiplePruebaPsico').selectpicker('val');
    
    var txaConclusiones = $.trim($("#txaConclusiones").val());

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
    else if (!regex.test(txtEmail)) {
      toastr.error("E-Mail invalido");
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
    else if(sSexo == ''){
      toastr.error("Por favor, seleccione Sexo");
      $("#sSexo").focus();
      $("#sSexo").parent().addClass("has-error");
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
    
    else if(sSituacionLaboral == ''){
      toastr.error("Por favor, seleccione Situacion laboral");
      $("#sSituacionLaboral").focus();
      $("#sSituacionLaboral").parent().addClass("has-error");
    }

    else if(sGrupoPriorizado == ''){
      toastr.error("Por favor, seleccione Grupo priorizado");
      $("#sGrupoPriorizado_"+lengp).focus();
      $("#sGrupoPriorizado_"+lengp).parent().addClass("has-error");
    }
    else if(sTipoPoblacion == ''){
      toastr.error("Por favor, seleccione Tipo poblacion");
      $("#sTipoPoblacion_"+lengp).focus();
      $("#sTipoPoblacion_"+lengp).parent().addClass("has-error");
    }
    else if(divtipodiscapacidad == 'block' && sTipoDiscapacidadTalento == ''){
      toastr.error("Por favor, seleccione Tipo de discapacidad y/o talento");
      $("#sTipoDiscapacidadTalento_"+lengp).focus();
      $("#sTipoDiscapacidadTalento_"+lengp).parent().addClass("has-error");
    }
    else if(divsubtipodiscapacidad == 'block' && sSubTipoDiscapacidadTalento == ''){
      toastr.error("Por favor, seleccione Subipo de discapacidad");
      $("#sSubTipoDiscapacidadTalento_"+lengp).focus();
      $("#sSubTipoDiscapacidadTalento_"+lengp).parent().addClass("has-error");
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
    else if( sEstrato == ''){
      toastr.error("Por favor, seleccione Estrato socioeconómico");
      $("#sEstrato").focus();
      $("#sEstrato").parent().addClass("has-error");
    }

    else if( txtLugarResidencia == ''){
      toastr.error("Por favor, ingrese Lugar de residencia");
      $("#txtLugarResidencia").focus();
      $("#txtLugarResidencia").parent().addClass("has-error");
    }
    else if( txtBarrio == ''){
      toastr.error("Por favor, ingrese Lugar de residencia");
      $("#txtBarrio").focus();
      $("#txtBarrio").parent().addClass("has-error");
    }
    else if(txtCarreraAspira == ''){
      toastr.error("Por favor, ingrese Carrera aspira");
      $("#txtCarreraAspira").focus();
      $("#txtCarreraAspira").parent().addClass("has-error");
    }
    else if(divmodvirtual == 'block' && sRequerimientoVirtual.length == 0){
      toastr.error("Por favor, seleccione Requerimiento modalidad virtual");
      $(".multiselectchulo").focus();
      $(".multiselectchulo").parent().addClass("has-error");
    }
    else if(divcodigoacompanamientoacademico == 'block' && codigoacompanamientoacademico.length == 0){
      toastr.error("Por favor, seleccione Código de Acompañamiento Académico");
      $(".multipleAcomAcade").focus();
      $(".multipleAcomAcade").parent().addClass("has-error");
    }
    else if(divcodigoacompanamientopsicologico == 'block' && codigoacompanamientopsicologico.length == 0 ){
      toastr.error("Por favor, seleccione Código de Acompañamiento Psicológico");
      $(".multipleAcomPsico").focus();
      $(".multipleAcomPsico").parent().addClass("has-error");
    }

    else if(sPruebaspsicotecnicas.length == 0){
      toastr.error("Por favor, Seleccione prueba psicotécnica");
      $(".multiplePruebaPsico").focus();
      $(".multiplePruebaPsico").parent().addClass("has-error");
    }

    else if(validateFilePruebaPsico()){
      toastr.error("Por favor, Añadir los documentos de todas las Pruebas psicotécnicas");
      $(".multiplePruebaPsico").focus();
      $(".multiplePruebaPsico").parent().addClass("has-error");
    }

    else if(txaConclusiones == ''){
      toastr.error("Por favor, ingrese Conclusiones");
      $("#txaConclusiones").focus();
      $("#txaConclusiones").parent().addClass("has-error");
    }


    else{
      $('tr').removeClass('bg-red');

      var count = 0;
      var sumgen = 0;

      $.each(aspectos,function(k,v){
        count = 0;
        $.each(v.conceptos, function(k1, v1){
          $.each(v1.resp, function(k2, v2){
            if(v2.codigo_rc == $("#concepto"+v.codigo+"C"+v1.codigoce).val()){
              var respval = parseFloat(v2.val_respuesta);
              count = count + respval;
              $("#puntaje"+v.codigo+"C"+v1.codigoce).text(respval);
            }
          });
        });
        sumgen = sumgen + count;
        $("#total"+v.codigo).text(count.toFixed(2));
      });
      $("#totalentrevista").text(sumgen.toFixed(2));

      var datosEncuesta = $("#frmNuevaEntrevista").serialize();
      var datosAspectos = $("#frmaspectos").serialize();
      $('.desactivarC').fadeIn(500);
      $.ajax({
        url: "<?php url('Lopersa/nuevaEncuesta'); ?>",
        type : "POST",
        data : datosEncuesta+"&"+datosAspectos+"&aspectos="+JSON.stringify(aspectos)+"&icfes="+JSON.stringify(icfes)+"&codacomaca="+codigoacompanamientoacademico+"&codacompsi="+codigoacompanamientopsicologico+"&pruebapsico="+sPruebaspsicotecnicas+"&con="+txaConclusiones+"&lengp="+lengp+"&codperiodo_="+$("#codperiodotemp").val(),
        dataType : "JSON", 
        success : function (json){
          if(json.success){

            $.ajax({
              url: "<?php url('Lopersa/sendPuntaje'); ?>",
              type : "POST",
              data : {
                IDDETRESADMISION : $("#IDDETRESADMISION").val(),
                IDPARADMISION : $("#IDPARADMISION").val(),
                NOTA :  $("#totalentrevista").text()
              },
              dataType : "JSON", 
              success : function (json2){
                if(json2.success){

                  var formData = new FormData($("#frm-FilesPruebasPsico")[0]);
                  formData.append("id", json.codentrevista);
                  $.ajax({
                    url: "<?php url('Lopersa/uploadFilePsico'); ?>",
                    type: "POST",
                    data : formData,
                    processData: false,
                    contentType: false,
                    success: function(data){
                      toastr.success("Entrevista registrada exitosamente!");
                      window.location.reload();
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                      console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                    }
                  });

                }else{
                  $('.desactivarC').fadeOut(500);
                  toastr.error(json2.message);
                }
              }
            });

          }else{

            $('.desactivarC').fadeOut(500);
            toastr.error(json.message);
            
            $("#concepto"+json.asp[0].cod1+"C"+json.asp[0].cod2).focus();
            $.each(json.asp, function(k, v){
              $("#"+v.cod2).addClass('bg-red');
            });

          }
        }, complete:function(){
        }
      });
    }
  } 

  function notifEntre(id, ema, prog){
    bootbox.confirm({
      message: "¿Está seguro de notificar la entrevista al estudiante a su Correo Electrónico: <b style='color:#333 !important'>"+ema+"</b> ?",
      buttons: {
        confirm: {
            label: 'Notificar',
        },
        cancel: {
            label: 'Cancelar',
        }
      },
      callback: function(result) {
        if (result) {
            $('.desactivarC').fadeIn(500);
            $.ajax({
                url: "<?php url('Lopersa/NotificarEntrevista'); ?>",
                type: "POST",
                data: { codperiodo : $('#codperiodotemp').val(), codprograma: $("#codprogramatemp").val(), documento : id, sede : $('#sSede').text(), idestudiante : $('#cedulaEstudiante').text(), ema : ema, nombre: $('#sEstudiante').text(), programa: prog, fecha: $('#modalDate').text(), horaini: $('#modalStart').text(), horafin: $('#modalEnd').text()}
            })
            .done(function(data) {
              if(data.success == true){
                $('#calendar1').fullCalendar('refetchEvents');
                $('.desactivarC').fadeOut(500);
                toastr.success(data.message, "Notificación");
                $('#notif').html('Sí');
              }else{
                toastr.error( "Request failed: " + data.message); 
              }
              $('.desactivarC').fadeOut(500);
            })
            .fail(function( jqXHR, textStatus ) {
              $('.desactivarC').fadeOut(500);
              toastr.error( "Request failed: " + jqXHR.responseText);
            });
        }
    }});
  }


  function fsaveTemp(){
    $('.desactivarC').fadeIn(500);
    var sRequerimientoVirtual = $('.multiselectchulo').selectpicker('val');
    var divtipodiscapacidad = $('.divtipodiscapacidad').css('display');
    var divmodvirtual = $('.divmodvirtual').css('display');

    var codigoacompanamientoacademico = $('.multipleAcomAcade').selectpicker('val');
    var codigoacompanamientopsicologico = $('.multipleAcomPsico').selectpicker('val');

    var divcodigoacompanamientoacademico = $('.codigoacompanamientoacademico').css('display');
    var divcodigoacompanamientopsicologico = $('.codigoacompanamientopsicologico').css('display');
    
    var sPruebaspsicotecnicas =  $('.multiplePruebaPsico').selectpicker('val');
    var txaConclusiones = $.trim($("#txaConclusiones").val());

    $("#sTipoColegio").attr('disabled', false);
    var datosEncuesta = $("#frmNuevaEntrevista").serialize();
    var datosAspectos = $("#frmaspectos").serialize();
    $("#sTipoColegio").attr('disabled', true);

    $.ajax({
      url: "<?php url('Lopersa/saveTemp'); ?>",
      type : "POST",
      data : datosEncuesta+"&"+datosAspectos+"&aspectos="+JSON.stringify(aspectos)+"&icfes="+JSON.stringify(icfes)+"&codacomaca="+codigoacompanamientoacademico+"&codacompsi="+codigoacompanamientopsicologico+"&pruebapsico="+sPruebaspsicotecnicas+"&con="+txaConclusiones+"&lengp="+lengp+"&codperiodo_="+$("#codperiodotemp").val(),
      dataType : "JSON", 
      success : function (json){
        if(json.success){
          
          toastr.success("Borrador guardado exitosamente!");
          window.location.reload();
          
        }else{
          $('.desactivarC').fadeOut(500);
          toastr.error(json.message);
        }
      }, complete:function(){
        
      }
    });
  } 

  function contGestion(){
    noti = true;
    $('.desactivarC').fadeIn(500);
    idcomponent = 0;
    icfes = new Array();
    $(".multiselectchulo").attr('disabled',false);
    $("#divLink").hide();
    $(".divuser").hide();
    $("#btnaddgp").show();
    $("#img-student").attr("src","http://aplicaciones.americana.edu.co:8080/sgacampus/images/dynamic/foto/1/"+$("#eventID").val()+"/"+$("#eventID").val()+".jpg?width=300&cut=1");
    $("#txtIdentificacion").val($("#eventID").val());
    $.ajax({
      url: "<?php url('Lopersa/loadTemp'); ?>",
      type : "POST",
      data : {
        'documento' : $("#eventID").val(),
        'codprograma' : $("#codprogramatemp").val(),
        'nombreprograma' : $("#nombreprogramatemp").val()
      },
      dataType : "JSON", 
      success : function (json){
        if(json.success){
          consultarLink()
          var e = json.entrevista;
          $(".puntaje").hide();
          $('#calendarModal').modal('hide');
          $('#divcalendar').hide();
          $('#divEntrevista').show();

          if($("#txtIdentificacion").parent().hasClass("has-error")){
            $("#txtIdentificacion").parent().removeClass("has-error");
          }

          $("#txtNombreCompleto").val(json.entrevista.nombrecompleto);
          $("#txtEmail").val(json.entrevista.emailper);
          $('#selectuser_id').val(json.entrevista.codcolegio);
          $('#txtColegio').val(json.entrevista.nombrecolegio);
          $("#sTipoColegio").val(json.entrevista.codpropiedadplantafisica);
          $("#txtFechaIcfes").val(json.entrevista.fechaicfes);
          $("#txtAcIcfes").val(json.entrevista.registroac);
          $("#sSexo").val(json.entrevista.sexo);
          $("#sEdad").val(json.entrevista.edad);
          $("#sEstadoCivil").val(json.entrevista.estadocivil);
          $("#sSituacionLaboral").val(json.entrevista.situacionlaboral);

          // ------------------------------------------------------------------------------------
          if(json.entrevista.gp != undefined){
            if(json.entrevista.gp.length > 0){
              lengp =  json.entrevista.lengp;
              setValGP(1, json.entrevista.gp[0].codagrupacion, json.entrevista.gp[0].codtipopoblacion, json.entrevista.gp[0].codtipodiscapacidad, 'NO', json.entrevista.gp[0].ruv, json.entrevista.gp[0].codsubtipodiscapacidad);
              if(lengp > 1){
                for (let index = 2; index <= lengp; index++) {
                  var html = addHTMLgp(index);
                  $(".grupo").append(html);
                  setcomboboxGP('sGrupoPriorizado_'+index);
                  setValGP(index, json.entrevista.gp[index-1].codagrupacion, json.entrevista.gp[index-1].codtipopoblacion, json.entrevista.gp[index-1].codtipodiscapacidad, 'NO', json.entrevista.gp[index-1].ruv, json.entrevista.gp[index-1].codsubtipodiscapacidad);
                }
              }
            }else{
              lengp =  1;
              setValGP(1, "", "", "");
            }
          }else{
            lengp =  1;
            setValGP(1, json.entrevista.codagrupacion, json.entrevista.codtipopoblacion, json.entrevista.codtipodiscapacidad);
          }
          // --------------------------------------------------------------------------------------
          $("#txtTelefono").val(json.entrevista.telefono);
          $("#txtTelefonoOtro").val(json.entrevista.otrotelefono);
          $("#txtTelefonoFijo").val(json.entrevista.fijo);
          $("#txtDireccion").val(json.entrevista.direccion);
          $("#sEstrato").val(json.entrevista.estrato);
          $("#txtLugarResidencia").val(json.entrevista.lugarresidencia);
          $("#txtBarrio").val(json.entrevista.barrioresidencia);
          $("#txtCodPrograma").val(json.codprograma);
          $("#txtCarreraAspira").val(json.nombreprograma).attr('readonly', true);
          
          if(isCarreraVirtual(json.entrevista.codprograma)){
            $(".divmodvirtual").show();
            var values = json.entrevista.requisitos_mv;
            if(values != null){
              $('.multiselectchulo').selectpicker('val', values.split(","));
              $.each(values.split(","), function(i,e){
                $(".multiselectchulo option[value='" + e + "']").prop("selected", true);
              });
            }
          }else{
            $(".divmodvirtual").hide();
          }
          
          $.each(aspectos,function(k,v){
            $.each(json.entrevista.respuestas, function(k2, v2){
              $("#concepto"+v2.codaspecto+"C"+v2.codconcepto).val(v2.codrespuesta);
              $("#observacion"+v2.codaspecto+"C"+v2.codconcepto).val(v2.observacion);
            });
          });

          $('#admitido').html('SI');
          var codacomacade = json.entrevista.codacomacade;
          if(json.entrevista.codacomacade != null){

            $('#academico').html('SI');
            $('.codigoacompanamientoacademico').show();
            if(codacomacade != null){
              $('.multipleAcomAcade').selectpicker('val', codacomacade.split(","));
              $.each(codacomacade.split(","), function(i,e){
                $(".multipleAcomAcade option[value='" + e + "']").prop("selected", true);
              });
            }

          }else{
            $("#codigoacompanamientoacademico").val('');
            // Sumatoria para ACOMPAÑAMIENTO ACADEMICO 2
              var c4 = (Number.isNaN(parseFloat($('#concepto2C4 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto2C4 option:selected').attr('data')));
              var c5 = (Number.isNaN(parseFloat($('#concepto2C5 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto2C5 option:selected').attr('data')));
              var c6 = (Number.isNaN(parseFloat($('#concepto2C6 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto2C6 option:selected').attr('data')));
              var total1 = c4 + c5 + c6;
              var c7 = (Number.isNaN(parseFloat($('#concepto3C7 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C7 option:selected').attr('data')));
              var c8 = (Number.isNaN(parseFloat($('#concepto3C8 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C8 option:selected').attr('data')));
              var c9 = (Number.isNaN(parseFloat($('#concepto3C9 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C9 option:selected').attr('data')));
              var c10 = (Number.isNaN(parseFloat($('#concepto3C10 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C10 option:selected').attr('data')));
              var c11 = (Number.isNaN(parseFloat($('#concepto3C11 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C11 option:selected').attr('data')));
              var c12 = (Number.isNaN(parseFloat($('#concepto3C12 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C12 option:selected').attr('data')));
              var c13 = (Number.isNaN(parseFloat($('#concepto3C13 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto3C13 option:selected').attr('data')));

              var total2 = c7 + c8 + c9 + c10 + c11 + c12 + c13;
              var total3 = total1 + total2;
              var total4 = c10 + c11;
              var idconcepto2C6 = $('#concepto2C6').children(":selected").attr("value");
              if(total3 != 0){
                if(total3<=117){
                  $('#academico').html('SI');
                  $('#admitido').html('SI');
                  $('.codigoacompanamientoacademico').show();
                }else{
                  $('#admitido').html('SI');
                  $('#academico').html('NO');
                }
              }else if(total4 != 0){
                if(total4 == 17.85 || total4 == 11.9){
                  $('#academico').html('SI');
                  $('#admitido').html('SI');
                  $('.codigoacompanamientoacademico').show();
                }else{
                  $('#admitido').html('SI');
                  $('#academico').html('NO');
                }
              }
              else if(idconcepto2C6 == 18){
                $('#academico').html('SI');
                $('#admitido').html('SI');
                $('.codigoacompanamientoacademico').show();
              }
              else{
                $('.multipleAcomAcade').selectpicker('val', []);
                $('#academico').html('');
                $('#admitido').html('');
                $('.codigoacompanamientoacademico').hide();
              }
          }
          var codacompsico = json.entrevista.codacompsico;
          if(codacompsico != null){
            $('#psicologico').html('SI');
            $('.textopsico').show();
            $('.codigoacompanamientopsicologico').show();
            if(codacompsico != null){
              $('.multipleAcomPsico').selectpicker('val', codacompsico.split(","));
              $.each(codacompsico.split(","), function(i,e){
                $(".multipleAcomPsico option[value='" + e + "']").prop("selected", true);
              });
            }
          }else{
            
              var c14 = (Number.isNaN(parseFloat($('#concepto4C14 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C14 option:selected').attr('data')));
              var c15 = (Number.isNaN(parseFloat($('#concepto4C15 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C15 option:selected').attr('data')));
              var c16 = (Number.isNaN(parseFloat($('#concepto4C16 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C16 option:selected').attr('data')));
              var c17 = (Number.isNaN(parseFloat($('#concepto4C17 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C17 option:selected').attr('data')));
              var c18 = (Number.isNaN(parseFloat($('#concepto4C18 option:selected').attr('data'))) ? 0 : parseFloat($('#concepto4C18 option:selected').attr('data')));
              var total1 = (c14 + c15 + c16 + c17 + c18);
              var id = $('#concepto5C24').children(":selected").attr("value");
              var idc15 = $('#concepto4C15').children(":selected").attr("value");
              if(total1 != 0){
                if(total1 <=60.01){
                  $('#psicologico').html('SI');
                  $('#admitido').html('SI');
                  $('.textopsico').show();
                  $('.codigoacompanamientopsicologico').show();
                }else{
                  $('#admitido').html('SI');
                  $('#psicologico').html('NO');
                }
              }else{
                if(id == 77 || id == 78){
                  $('#psicologico').html('SI');
                  $('#admitido').html('SI');
                  $('.textopsico').show();
                  $('.codigoacompanamientopsicologico').show();
                }
                else if(idc15 == 45){
                  $('#psicologico').html('SI');
                  $('#admitido').html('SI');
                  $('.textopsico').show();
                  $('.codigoacompanamientopsicologico').show();
                }
                else{
                  $('.multipleAcomPsico').selectpicker('val', []);
                  $('#psicologico').html(''); 
                  $('#admitido').html('');
                  $('.textopsico').hide();
                  $('.codigoacompanamientopsicologico').hide();
                }
              }
            
          }
          var html1 = '<div class="table-responsive"><table class="table table-bordered">';
          html1 += '<tr>';
          html1 += '<th scope="col"style="width:60%;">COMPONENTES SABER 11</th>';
          html1 += '<th scope="col">PUNTAJE ICFES</th>';
          html1 += '</tr>';
          html1 += '<tr>';
          $.each(json.entrevista.icfes, function(k1, v1){
            idcomponent++;
            html1 += '<tr>';
            html1 += '<td>'+v1.nombre+'</td>';
            html1 += '<td>';
            html1 += '<input id="resp_icfes_'+idcomponent+'" name="resp_icfes_'+idcomponent+'" value="'+v1.puntaje+'" class="form-control"/>';
            html1 += '</td>';
            html1 += '</tr>';
            icfes.push({codigo: idcomponent, nombre: v1.nombre});
          });
          html1 += '</tr>';
          html1 += '</table></div>';
          $("#icfes").html(html1);


          var valuesPsico = json.entrevista.pruebapsico;
          if(valuesPsico != null){
            var arrval = valuesPsico.split(",");
            $('.multiplePruebaPsico').selectpicker('val', arrval);
            $.each(arrval, function(i,e){
              $(".multiplePruebaPsico option[value='" + e + "']").prop("selected", true);
            });
            $(".multiplePruebaPsico").trigger('change');
          }

          $("#txaConclusiones").val(json.entrevista.conclusiones);
        }
      }, complete:function(){
        $('.desactivarC').fadeOut(500);
      }
    });
  }

  function addHTMLgp(id, des){
    $("#btnaddgp").remove();
    var html = '<div class="row gp_'+id+' gp">';
    html += ' <div class="col-lg-4 col-md-6">';
    html += '<fieldset class="form-group">';
    html += '<label>Grupo priorizado '+id+':</label>';
    html += '<select id="sGrupoPriorizado_'+id+'" name="sGrupoPriorizado_'+id+'" data="'+id+'" class="form-control grupopriorizado">';
    html += '</select>';
    html += '</fieldset>';
    html += '</div>';

    html += '<div class="col-lg-4 col-md-6">';
    html += '<fieldset class="form-group">';
    html += '<label>Tipo de población '+id+':</label>';
    html += '<select id="sTipoPoblacion_'+id+'" name="sTipoPoblacion_'+id+'" data="'+id+'" class="form-control tipopoblacion">';
    html += '<option value="">Seleccione</option>';
    html += '</select>';
    html += '</fieldset>';
    html += '</div>';

    html += '<div class="col-lg-4 col-md-6 divRUV_'+id+'" style="display:none;">';
    html += '<fieldset class="form-group">';
    html += '<label>RUV '+id+':</label>';
    html += '<input class="form-control" id="txtRUV_'+id+'" name="txtRUV_'+id+'" data="'+id+'" type="text">';
    html += '</fieldset>';
    html += '</div>';

    html += '<div class="col-lg-4 col-md-6 divtipodiscapacidad_'+id+'"  style="display:none;">';
    html += '<fieldset class="form-group">';
    html += '<label id="labeltipotalento_'+id+'">Tipo de discapacidad y/o Talento excepcional '+id+':</label>';
    html += '<select id="sTipoDiscapacidadTalento_'+id+'" name="sTipoDiscapacidadTalento_'+id+'" data="'+id+'" class="form-control tipodiscapacidad">';
    html += '</select>';
    html += '</fieldset>';
    html += '</div>';

    html += '<div class="col-lg-4 col-md-6 divsubtipodiscapacidad_'+id+'"  style="display:none;">';
    html += '<fieldset class="form-group">';
    html += '<label>Subipo de discapacidad '+id+':</label>';
    html += '<select id="sSubTipoDiscapacidadTalento_'+id+'" name="sSubTipoDiscapacidadTalento_'+id+'" data="'+id+'" class="form-control subtipodiscapacidad">';
    html += '</select>';
    html += '</fieldset>';
    html += '</div>';

    

    html += (des != 'SI' ? '<a class="btn btn-sm btn-rounded btn-outline-success" id="btnaddgp" onclick="addgp()"><i class="fa fa-plus"></i>Añadir</a>' : '');
    html += '</div>';
    return html;
  }

  function setValGP(index, codagrupacion, codtipopoblacion, codtipodiscapacidad, des, ruv, subtipo){
    
    if(des == 'SI'){
      $("#sGrupoPriorizado_"+index).val(codagrupacion).trigger('change').attr('disabled',true);
      setTimeout(() => {
        $("#sTipoPoblacion_"+index).val(codtipopoblacion).trigger('change').attr('disabled',true);
        if(codtipopoblacion == 1){
          $("#labeltipotalento_"+ index).text('Tipo de discapacidad '+index+':')
        }else{
          $("#labeltipotalento_"+ index).text('Talento excepcional '+index+':')
        }
        if(codtipodiscapacidad != 0){
          setTimeout(() => {
            $("#sTipoDiscapacidadTalento_"+index).val(codtipodiscapacidad).trigger('change').attr('disabled',true);
            setTimeout(() => {
              $("#sSubTipoDiscapacidadTalento_"+index).val(subtipo).trigger('change').attr('disabled',true);
            }, 500);
          }, 500);
        }
        $("#txtRUV_"+index).val(ruv).attr('disabled',true);
      }, 500);
    }else{
      $("#sGrupoPriorizado_"+index).val(codagrupacion).trigger('change');
      setTimeout(() => {
        $("#sTipoPoblacion_"+index).val(codtipopoblacion).trigger('change');
        if(codtipopoblacion == 1){
          $("#labeltipotalento_"+ index).text('Tipo de discapacidad '+index+':')
        }else{
          $("#labeltipotalento_"+ index).text('Talento excepcional '+index+':')
        }
        if(codtipodiscapacidad != 0){
          setTimeout(() => {
            $("#sTipoDiscapacidadTalento_"+index).val(codtipodiscapacidad).trigger('change');
            setTimeout(() => {
              $("#sSubTipoDiscapacidadTalento_"+index).val(subtipo).trigger('change');
            }, 500);
          }, 500);
        }
        $("#txtRUV_"+index).val(ruv);
        if(ruv == '' || ruv == null){
          // toastr.warning("Recuerde digitar el RUV");
        }
      }, 500);
    }
  }

  function isCarreraVirtual(cod){
    var regexname = /^[0-9]*$/;
    var letra1 = cod.substring(0,1);
    var letra2 = cod.substring(1,2);
    var letra = (!regexname.test(letra2) ? letra1+""+letra2 : letra1);

    if(letra == 'V' || letra=='O' || letra=='A' || letra=='C' || letra=='I' || letra=='P' || letra=='S' || letra=='U' || letra=='Y' || letra=='K' || letra=='G' || letra=='AN' || letra=='AP'  || letra=='BA'  || letra=='BE'  || letra=='BO' || letra=='BU'  || letra=='CA'  || letra=='CH'  || letra=='CR' || letra=='CS' || letra=='IB' || letra=='IT' || letra=='LD' || letra=='MA' || letra=='PE'  || letra=='PT' || letra=='RH' || letra=='RI'  || letra=='SE' || letra=='SF' || letra=='TA' || letra=='VA' || letra=='YA' || letra=='PI'){
      return true;
    }else{
      return false;
    }
  }


  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)

  function initcalendar(){
    var date = new Date();
    var month =  date.getMonth()+1;
    var year =  date.getFullYear();
    var moment = $('#calendar1').fullCalendar('getDate');
    
    $('#calendar1').fullCalendar({
      locale: 'es',
      allDaySlot: false, //seccion todo el día
      header    : {
        left  : 'prev,next',
        center: 'title',
        right : ''
      },
      buttonText: {
        today: 'Hoy',
        month: 'Mes',
        week : 'Semana',
        day  : 'Día'
      },
      //Random default events
      showNonCurrentDates: false,
      events    : "../Lopersa/MisEntrevistas?month="+month+"&"+"year="+year,
      editable  : false,
      droppable : false, // this allows things to be dropped onto the calendar !!!
      eventClick:  function(event, jsEvent, view) {  // when some one click on any event
        //observaciones
        //fin observaciones
        fh = $.fullCalendar.moment(event.start).format('DD/MMMM/YYYY');
        endtime = $.fullCalendar.moment(event.end).format('h:mm a ');
        starttime = $.fullCalendar.moment(event.start).format('h:mm a');
        $('#modalTitle').html(event.title);
        $('#modalDate').html(fh);
        $('#modalStart').html(starttime);
        $('#modalEnd').html(endtime);
        
        $('#codperiodotemp').val(event.codperiodo);
        $('#sSeccional').html(event.extraData.seccional);
        $('#sSede').html(event.extraData.sede);
        $('#sPrograma').html(event.extraData.codprograma + ' - ' + event.extraData.programa);
        $('#codprogramatemp').val(event.extraData.codprograma);
        $('#nombreprogramatemp').val(event.extraData.programa);
        
        $('#sEstudiante').html(event.extraData.nombreestudiante);
        $('#sCelular').html(event.extraData.celestudiante);
        $('#cedulaEstudiante').html(event.title);
        $('#eventID').val(event.id);
        $('#notif').html((event.estNoti == 0 ? 'No' : 'Sí'));
        $('#borr').html(event.borrador);
        $('#est').html(event.estado);

        $('#codest').val(event.aas);
        
        $('#IDDETRESADMISION').val(event.iddetresadmision);
        $('#IDPARADMISION').val(event.idadmision);
        
        $('#sFechaGestion').html(event.fechaejecucion);

        $("#btnNoti").attr("onClick", 'notifEntre(\''+event.id+'\', \''+event.extraData.emailestudiante+'\', \''+event.extraData.programa+'\')' );

        if(event.aas == 1){
          $("#btnVis").show(); 
          $("#btnGes").hide();
          $("#btnBorr").hide();
          $(".pBorrador").hide();
          $(".pGestion").show();
          $("#btnCanc").hide();
          $(".pCancelacion").hide();
        }else if(event.aas == 2 || event.aas == 3){
          if(event.borrador == 'NO'){
            $("#btnVis").hide(); 
            $("#btnGes").show();
            $("#btnBorr").hide();
          }else{
            $("#btnVis").hide(); 
            $("#btnGes").hide();
            $("#btnBorr").show();
          }
          $(".pBorrador").show();
          $(".pGestion").hide();
          $("#btnCanc").hide();
          $(".pCancelacion").hide();
        }else if(event.aas == 4){
          
          $("#btnGes").hide();
          $("#btnVis").hide();
          $("#btnBorr").hide();
          $(".pBorrador").hide();
          $(".pGestion").hide();
          $("#sFechaCancelacion").text(event.fechaCancelacion);
          $("#motivosCancelacion").text(event.motivos);
          $(".pCancelacion").show();
          $("#btnCanc").show();
        }

        loadObservaciones(event.id);
        consultarLink();
        
        $('#calendarModal').modal();
  
      },
      loading: function( isLoading ) {
        if(isLoading) {// isLoading gives boolean value
          //show your loader here 
          $('.desactivarC').fadeIn(500);
        } else {
          //hide your loader here
          $('.desactivarC').fadeOut(500);
        }
    }
      
    })
  }


  function fModalCancelar(){
    bootbox.confirm("¿Está seguro de Cancelar la Entrevista?", function(result) {
      if (result) {
        $('#calendarModal').modal('hide');
        $("#ModalCancelar").modal();
      }
    });
  }

  function fCancelarEntrevista(){
    var motivoscancelacion = $.trim($("#txamotivoscancelacion").val().toUpperCase());

    if(motivoscancelacion == ''){
      toastr.error("Por favor, seleccione el motivo de Cancelación de entrevista");
    }else{
      $.ajax({
        url: "<?php url('Lopersa/cancelarEntrevista'); ?>",
        type : "POST",
        data : {
          'documento' : $("#eventID").val(),
          'codperiodo' : $("#codperiodotemp").val(),
          'codprograma' : $("#codprogramatemp").val(),
          'nombreprograma' : $("#nombreprogramatemp").val(),
          'motivoscancelacion' : motivoscancelacion
        },
        dataType : "JSON", 
        success : function (json){
          if(json.success){
            toastr.success('Entrevista cancelada exitosamente!');
            $("#ModalCancelar").modal('hide'); 
            window.location.reload();

          }else{
            toastr.error(json.message);
          }
        }
      });
    }
  }

</script>

<!-- /.content --> 
