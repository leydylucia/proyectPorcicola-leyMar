//function paginador(objeto, url) {
//  window.location.href = url + '?page=' + $(objeto).val();
//}

function paginador(objeto, url) {
  var first = url.indexOf("?");
  window.location.href = url + ((first === -1) ? '?' : '&') + 'page=' + $(objeto).val();
}
//function confirmarEliminar(id) {
//  var rsp = confirm("seguro de Eliminar registro");
//  if (rsp === true) {
//    $('#idDelete').val(id);
//    $('frmDelete').submit();
//  }
//}

function eliminarMasivo(){
  $('#myModalDeleteMasivo').modal('toggle');
}

function eliminar(id, variable, url) {
  $.ajax({
    url: url,
    data: variable + '=' + id,
    dataType: 'json',
    type: 'POST',
    success: function () {
      location.reload();
    },
    error: function (objeto, quepaso, otrobj) {
      alert("estas viendo esto por que algo fallo");
      alert("paso lo siguiente: " + quepaso);
    }
  });

}

$(document).ready(function () {
  $('#chkAll').click(function () {
    $('input[name="chk[]"]').each(function (index, element) {
      if ($('#chkAll').is(':checked') == true && $(element).is(':checked') == false) {
        $(element).prop('checked', true);
      } else if ($('#chkAll').is(':checked') == false && $(element).is(':checked') == true) {
        $(element).prop('checked', false);
      }
    });
  });  
});