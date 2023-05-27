function OnlyNumbers(evt)
{
    var charCode = (evt.which) ? evt.which : event.keyCode		

    if ((charCode>47 && charCode<60))
    {
        return true;
    }

    return false;
}

/**
this function find any checkboxes by criteria
@param criteria: this is the criteria for find checkboxes
*/
function SelectAllNoneChecks(criteria)
{
	var check_one = $(criteria)[0];
	var checked =  false;
	if(check_one.checked == false)
		checked = true;

	$(criteria).each(function(){this.checked = checked});
}

/*
  Constructs a modal alert with bootstrap style, from popup modal.
  how to use:
  data_items = {
      modal_id:'modal_id', 
      mensaje:'<div class="alert alert-warning fade in">Please first type a name.</div>', 
      mensaje_wrapper:'modal_id_wrapper',
  };
  //new BuildBootstrapModalAlert(data_items);
  new BuildBootstrapModalAlert(data_items).modal('show');
*/
var BootstrapModalAlert = function(data_items, confirm) {
    params = [{id:data_items.modal_id, title:'Mensaje',body_id:'', mensaje:data_items.mensaje,
    // buttons:[{id:'btn_cerrar', value:'Cerrar', },]
    }];

    params=params[0];
    var modal = '';

    modal+='<div class="modal fade bs-example-modal-lg" style="z-index:2000;" id="'+params.id+'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">';
    modal+='<div class="modal-dialog modal-lg">';
    modal+='<div class="modal-content">';
    modal+='<div class="modal-header">';
    modal+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
    modal+='<h4 class="modal-title" id="myModalLabel">'+params.title+'</h4>';
    modal+='</div>';
    modal+='<div id="'+params.body_id+'"" class="modal-body">';
    modal+='<div style="width:100%; overflow:auto;">' + params.mensaje + '</div>';
    modal+='</div>';
    modal+='<div id="'+params.body_id+'_footer" class="modal-footer">';

    if(confirm == true)
    {
      modal+='<input type="button" class="btn btn-default" value="Aceptar" data-dismiss="modal" onclick="return true;"/>';
      modal+='<input type="button" value="Cancelar" data-dismiss="modal" onclick="return false;"/>';
    }
    else
    {
      for (var i = 0; i < params.buttons.length; i++) {
          modal+='<button type="button" id="'+params.buttons[i].id+'" ';
          modal+=' class="btn btn-default" onclick="$(\'.modal-backdrop\').remove();" data-dismiss="modal">'+params.buttons[i].value+'</button>';
      };
    }

    modal+='</div>';//footer
    modal+='</div>';
    modal+='</div>';
    modal+='</div>';

    $('#' + data_items.mensaje_wrapper).remove();
    $('#' + data_items.mensaje_wrapper).remove();
    $("body").append("<div id=" + data_items.mensaje_wrapper + "></div>");

    $('#' + data_items.mensaje_wrapper).html( modal );
    
    return $('#' + data_items.modal_id);
};