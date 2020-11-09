<!--Este es el archivo de la ventana modal para la eliminación de registros-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$pro->id_proveedor}}">
	<!--Llamado a la función de eliminación en el controlador-->
	{{Form::Open(array('action'=>array('ProveedorController@destroy',$pro->id_proveedor), 'method'=>'delete'))}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Proveedor</h4>
			</div>
			<div class="modal-body">
				<p>¿Desea eliminar el proveedor?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Eliminar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>