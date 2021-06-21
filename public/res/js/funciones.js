//Funcion para mostrar datos dependiendo del opcion  de titulacion
function mostrar(id) {

    if (id == "4") {

		var midiv = document.createElement("div");
		var midiv3 = document.createElement("div");
		midiv.setAttribute("id","con1");
		midiv3.setAttribute('id','cont_a');
		midiv.innerHTML = '<br><div align="center"><h5 class="">Propuesta de Sinodales</h5></div><div class=" form-label-group"><label for="inputPresidente">Presidente</label> <select id="slt-profesor" name="presidente" class="form-control"></select></div> <div class=" form-label-group"> <label  for="inputSecretario">Secretario</label><select id="slt-profesor2" name="secretario" class="form-control"></select> </div> <div class=" form-label-group"> <label  for="inputVocal">Vocal</label> <select id="slt-profesor3" name="v_propietario" class="form-control"></select>  </div> <div class=" form-label-group">  <label  for="inputSuplente">Suplente</label> <select id="slt-profesor4" name="v_suplente" class="form-control"></select> </div>';
		midiv3.innerHTML='<div id="cont_a"></div>';
		document.getElementById('con1').replaceWith(midiv);
		document.getElementById('cont_a').replaceWith(midiv3);
    }else{
		var midiv2 = document.createElement("div");
		var midiv3 = document.createElement("div");
		midiv2.setAttribute("id","con1");
		midiv3.setAttribute('id','cont_a');
		midiv2.innerHTML = '<br><div align="center"><h5 class="">Datos del proyecto</h5></div> <div class=" form-label-group" > <label  for="inputacesor">Asesor</label> <select id="slt-profesor" name="id_asesor" class="form-control"></select> </div> <div class=" form-label-group" > <label  for="inputProyecto">Nombre del proyecto</label> <input id="inputProyecto" name="n_proyecto" type="text" class="form-control" placeholder="Nombre del proyecto" required /></div>';
		midiv3.innerHTML='<div id="cont_a"><div class="form-group"><div class="input-group image-preview"><input placeholder="" type="text" class="form-control carga-archivo-filename" disabled="disabled"><span class="input-group-btn"><div class="btn btn-default carga-archivo-input"><span class="glyphicon glyphicon-folder-open"></span><span class="carga-archivo-input-title">Seleccionar archivo</span><input type="file" accept="application/pdf" name="proy_archivo" /></div></span></div></div></div>';
		document.getElementById('con1').replaceWith(midiv2);
		document.getElementById('cont_a').replaceWith(midiv3);
    }


}


