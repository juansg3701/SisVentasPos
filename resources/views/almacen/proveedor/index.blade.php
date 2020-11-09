@extends ('layouts.admin')
@section ('contenido')
<!--Este archivo maneja la vista principal del módulo proveedores-->		
<head>
	<title>Proveedores</title>
	<!--importar ajax para el manejo de algunos campos del formulario-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div class="row" align="center">
		<div class="col-sm-12" align="center">
			<h2>PROVEEDORES</h2>
		</div>
	</div>

	<div id=formulario>
		<div class="form-group">
			<!--Incluir la ventana modal de búsqueda y carga de excel-->	
			@include('almacen.proveedor.search')
			@include('almacen.proveedor.cargar')
			<div  align="center">
				<!--Enlaces y botones para llamar las funciones de registro, descarga de excel y la ventana modal para carga de excel-->
				<a href="{{URL::action('ProveedorController@create',0)}}"><button class="btn btn-info">Registrar Proveedor</button></a>	
				<a href="{{URL::action('ProveedorController@show',0)}}"><button class="btn btn-success">Descargar xls</button></a>
				<a href="" data-target="#modal-proveedor" data-toggle="modal"><button class="btn btn-warning">Cargar xlsx/xls</button></a>
				<a href="{{url('/')}}" class="btn btn-danger">Volver</a>
			</div>
		</div>
	</div>
	
</body>
@stop

@section('tabla')
<!--Tabla de registros realizados en la tabla de proveedor en la base de datos-->	
<div class="row" align="center">
	<div class="col-sm-12" align="center">
		<h3>PROVEEDORES REGISTRADOS</h3>
	</div>
</div><br>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>EMPRESA</th>
					<th>CONTACTO</th>
					<th>DIRECCIÓN</th>
					<th>TELÉFONO</th>
					<th>CORREO</th>				
					<th>NO. DOCUMENTO</th>
					<th>DÍGITO NIT</th>
					<th>OPCIONES</th>
				</thead>
				@foreach($proveedores as $pro)
				<tr>
					<td>{{ $pro->nombre_empresa}}</td>
					<td>{{ $pro->nombre_proveedor}}</td>
					<td>{{ $pro->direccion}}</td>
					<td>{{ $pro->telefono}}</td>
					<td>{{ $pro->correo}}</td>					
					<td>{{ $pro->documento}}</td>
					<td>{{ $pro->verificacion_nit}}</td>
					<td>
						<!--Enlaces y botones para llamar las funciones de edición y la ventana modal de eliminación de registros-->	
						<a href="{{URL::action('ProveedorController@edit',$pro->id_proveedor)}}"><button class="btn btn-info">Editar</button></a>
						<a href="" data-target="#modal-delete-{{$pro->id_proveedor}}" data-toggle="modal"><button class="btn btn-danger">Eliminar</button></a>
					</td>
				</tr>
				<!--Incluir el archivo de eliminación de registros-->	
				@include('almacen.proveedor.modal')
				@endforeach
			</table>
		</div>
		{{$proveedores->render()}}
	</div>
</div>
@stop