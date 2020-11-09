<!--Este es el archivo para la búsqueda de registros-->
{!! Form::open(array('url'=>'almacen/proveedor','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="form-group">
	<!--Activar o desactivar botón de búsqueda dependiendo de la selección de filtro mediante ajax-->
	<script type="text/javascript">
		$( function() {
		    $("#id_busqueda").change( function(){
			    if ($(this).val() === "0"){
			    	$("#btnBuscar").prop("disabled", true);
		 		}
			    if ($(this).val() === "1"){
			    	$("#pro1").prop("style", "display:hidden");
			    	$("#btnBuscar").prop("disabled", false);
		 		}else {
			        $("#pro1").prop("style", "display:none");
			    }
			    if ($(this).val() === "2"){
			    	$("#pro2").prop("style", "display:hidden");
			    	$("#btnBuscar").prop("disabled", false);
			    }else {
			        $("#pro2").prop("style", "display:none");   
				}
	    	});
	    });
	</script>

	<!--Formulario para establecer los filtros de búsqueda-->
	<div class="form-row">
		<div class="form-group col-sm-2">
			Establecer filtros:
		</div>
		<div class="form-group col-sm-8">
			<select id='id_busqueda' name="select_busqueda" class="form-control">
				<option value="0" selected>Seleccione el parámetro de búsqueda </option>
				<option value="1">Empresa</option>
				<option value="2">Documento</option>
			</select><br>
		</div>
		<div class="form-group col-sm-2">
			<span class="input-group-btn">
				<button id="btnBuscar" type="submit" disabled="" class="btn btn-primary">Buscar</button>
			</span>
		</div>
	</div>

	<div class="form-row" align="center">
		<div class="form-group col-sm-12" align="center">
			<span class="input-group-btn">
				<input id="pro1" type="text" class="form-control" name="searchText0" placeholder="Buscar por empresa..." style="display:none">
				<input id="pro2" type="text" class="form-control" name="searchText1" placeholder="Buscar por documento..." style="display:none">
			</span>
		</div>
	</div>

</div>

{{Form::close()}}