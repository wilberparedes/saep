


$(function() {
  toastr.options.closeButton = true;
  toastr.options.positionClass = 'toast-top-center';

    $(document).on('focus', 'input[type=number]', function (e) {
      $(this).on('wheel.disableScroll', function (e) {
        e.preventDefault()
      })
    })
    $(document).on('blur', 'input[type=number]', function (e) {
      $(this).off('wheel.disableScroll')
    })
});


function loadpag(data,id,codsup){
  localStorage.setItem('paginaSAEP',data);
  localStorage.setItem('idpaginaSAEP',id);
  localStorage.setItem('codsuppagSAEP',codsup);
  $("#contenido").load(data);
  reloadmenu();
}

function reloadmenu(){
  $( "#menuu" ).load('../Menu', function() {
      $('.sidebar-menu').tree();
      $("#main-menu li").removeClass("menu-open active ");
      if(localStorage.codsuppagSAEP != 'undefined'){
    		$("#m"+localStorage.codsuppagSAEP).addClass("menu-open active");
    		$("#m"+localStorage.codsuppagSAEP+ " ul").show();
    		$("#m"+localStorage.idpaginaSAEP).addClass("active");
      }else{
		    $("#m"+localStorage.idpaginaSAEP).addClass("active");
      }
  });
}

/*//////////////////////////////////////////////////////////////////////////////*/
function combobox(id,url,inival,params){
  var localurl=url;
  $.ajax({
    url:localurl,
    type:"POST",
    data:{params:params},
    jsonpCallback:id,
    dataType:"JSON",
    success:function (json){
       var option="<option value=''>"+inival+"</option>";
       $.each(json,function(k,v){
        option+="<option value='"+v.cod+"'>"+v.nombre+"</option>";
       });
        // console.log(option);
       $("#"+id).html(option);
       
    }
  });
}
function comboboxwithDescripcion(id,url,inival,params){
  var localurl=url;
  $.ajax({
    url:localurl,
    type:"POST",
    data:{params:params},
    jsonpCallback:id,
    dataType:"JSON",
    success:function (json){
       var option="<option value=''>"+inival+"</option>";
       $.each(json,function(k,v){
        option+="<option value='"+v.cod+"' descripcion='"+v.descripcion+"'>"+v.nombre+"</option>";
       });
        // console.log(option);
       $("#"+id).html(option);
       
    }
  });
}
function comboboxClass(id,url,inival,params){
  var localurl=url;
  $.ajax({
    url:localurl,
    type:"POST",
    data:{params:params},
    jsonpCallback:id,
    dataType:"JSON",
    success:function (json){
      var option="";
      if(inival != '')
        option += "<option value=''>"+inival+"</option>";

      $.each(json,function(k,v){
        option+="<option value='"+v.cod+"'>"+v.nombre+"</option>";
      });
      $("."+id).html(option);
    }, complete: function(){
      $('.'+id).selectpicker();
    }
  });
}

function comboboxSelected(id,url,inival,data){
 var localurl=url;
  $.ajax({
    url:localurl,
    type:"POST",
    jsonpCallback:id,
    dataType:"JSON",
    success:function (json){
        var option="<option value=''>"+inival+"</option>";
        $.each(json,function(k,v){
        option+="<option value='"+v.cod+"'>"+v.nombre+"</option>";
        });
        // console.log(option);
        $("#"+id).html(option);
        
    }, complete: function(){
        $("#"+id).val(data);
    }
  });
}

function comboboxEntrevista(id,url,inival,params){
 var localurl=url;
  $.ajax({
        url:localurl,
        type:"POST",
        data:{params:params},
        jsonpCallback:id,
        dataType:"JSON",
        success:function (json){
            if(json.length == 0){
                var option="<option value='10' selected>No aplica</option>";
            }else{
                var option="<option value=''>"+inival+"</option>";
                $.each(json,function(k,v){
                    option+="<option value='"+v.cod+"'>"+v.nombre+"</option>";
                });
            }
            // console.log(option);
           $("#"+id).html(option);
           
        }
  });
}

/*//////////////////////////////////////////////////////////////////////////////*/
 function doSearch(val,table) {
    /*var tableReg = document.getElementById('table');*/
    var tableReg = document.getElementById(""+table);
    var searchText = $("#"+val).val().toLowerCase();
    /*var searchText = document.getElementById('buscar').value.toLowerCase();*/
    for (var i = 1; i < tableReg.rows.length; i++) {
        var cellsOfRow = tableReg.rows[i].getElementsByTagName('td');
        var found = false;
        for (var j = 0; j < cellsOfRow.length && !found; j++) {
            var compareWith = cellsOfRow[j].innerHTML.toLowerCase();
            if (searchText.length == 0 || (compareWith.indexOf(searchText) > -1)) {
                found = true;
            }
        }
        if (found) {
            tableReg.rows[i].style.display = '';
        } else {
            tableReg.rows[i].style.display = 'none';
        }
    }
}


/*//////////////////////////////////////////////////////////////////////////////*/
function realoadTable(id, url){
  // $('#'+id).DataTable().ajax.url(url).load();
  $('#'+id).DataTable().ajax.url(url).reload();
}