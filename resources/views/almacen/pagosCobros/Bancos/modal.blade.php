<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-delete-{{$ban->id_banco}}">
	
	{{Form::Open(array('action'=>array('BancoController@destroy',$ban->id_banco), 'method'=>'delete'))}}

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Eliminar Banco</h4>
			</div>
			<div class="modal-body">
				<p>¿Desea eliminar el banco?</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="submit" class="btn btn-primary">Eliminar</button>
			</div>
		</div>
	</div>
	{{Form::Close()}}

</div>