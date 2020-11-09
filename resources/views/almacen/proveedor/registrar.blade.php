@extends ('layouts.admin')
@section ('contenido')
<!--Este archivo maneja la vista de registro del proveedor-->
<head>
	<title>Registro de proveedor</title>
	<!--importar ajax para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<!--Validar los campos del formulario antes de enviarlos-->
	<div class="row" align="center">
		<div class="col-sm-12" align="center">
			<h4>REGISTRAR PROVEEDOR</h4>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
	</div><br>

	{!!Form::open(array('url'=>'almacen/proveedor','method'=>'POST','autocomplete'=>'off'))!!}
    {{Form::token()}}

    <!--Activar o desactivar campos dependiendo de la selección en el tipo de documento mediante ajax-->
	<script type="text/javascript">
		$(function(){
	    	$("#id_tipo_documento").change( function(){
	       	if ($(this).val() === "1") {
		        $("#id_cedula").prop("disabled", false);
		        $("#id_falso").prop("disabled", false);
	        }else {
		        $("#id_cedula").prop("disabled", true);
		        $("#id_falso").prop("disabled", true);
	        }
	        if ($(this).val() === "2") {
		        $("#id_nit").prop("disabled", false);
		        $("#id_digito").prop("disabled", false);
	        }else{
		        $("#id_nit").prop("disabled", true);
		        $("#id_digito").prop("disabled", true);
	        }
	    	});
		});
	</script>

	<!--Formulario de registro del proveedor-->
	<div id="formulario" class="form-row">
		<div class="form-row">
			<div class="form-group col-sm-4">
				Nombre Empresa:
			</div>
			<div class="form-group col-sm-8">
				<input type="text" class="form-control" name="nombre_empresa">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-4">
				Nombre Contacto:
			</div>
			<div class="form-group col-sm-8">
				<input type="text" class="form-control" name="nombre_proveedor">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-4">
				Dirección:
			</div>
			<div class="form-group col-sm-8">
				<input type="text" class="form-control" name="direccion">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-4">
				Correo:
			</div>
			<div class="form-group col-sm-8">
				<input type="email" class="form-control" name="correo">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm-4">
				Teléfono:
			</div>
			<div class="form-group col-sm-8">
				<input type="number" class="form-control" name="telefono">
			</div>
		</div>
		<div class="form-row">		
			<div class="form-group col-sm-4">
				Documento:
			</div>
			<div class="form-group col-sm-8">
				<select id='id_tipo_documento' name="tipo_documento" class="form-control">
					<option value="1" selected>Cédula</option>
					<option value="2">NIT</option>
				</select><br>
			</div>
		</div>

		<div class="form-row">
			<div class="form-group col-sm-2">
				Cédula:
			</div>
			<div class="form-group col-sm-3">
				<input id='id_cedula' type="number"  class="form-control"  name="documento" placeholder="- - - - - - - - - -" min="0" required enabled>
				<input id='id_falso'  class="form-control" type="number" name="verificacion_nit" placeholder="---------" style="display:none">
			</div>
			<div class="form-group col-sm-1">
				NIT:
			</div>
			<div class="form-group col-sm-3">
				<input id='id_nit' type="number" class="form-control"  name="documento" placeholder="- - - - - - - - - -" min="0" required disabled>
			</div>
			<div class="form-group col-sm-1">
				-
			</div>
			<div class="form-group col-sm-2">
				<input id='id_digito' type="number" class="form-control" name="verificacion_nit" placeholder="-" size="1" min="0" max="9" title="Ingrese un dígito" required disabled><br>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-sm" align="center">
				<button class="btn btn-info">Registrar</button>
				<a href="{{url('almacen/proveedor')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>
	{!!Form::close()!!}	
</body>
@stop