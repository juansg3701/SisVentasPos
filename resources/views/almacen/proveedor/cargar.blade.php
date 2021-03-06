<!--Este es el archivo de la ventana modal para carga de excel-->
<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-proveedor">

	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
                <h4 class="modal-title">Cargar Archivo xlsx/xls</h4>
			</div>
			
			<div id="formulario">
				<form method="post" id="addproduct" action="/importProveedor.php" enctype="multipart/form-data" role="form">
					<!--Activar o desactivar botón de carga dependiendo de la selección de archivo mediante ajax-->
					<script type="text/javascript">
						$(function(){
				   			$("#inpCargar").change( function(){
							    if ($(this).val() === ""){
							    	$("#btnCargar").prop("disabled", true);
						 		}
						 		if ($(this).val() != ""){
							    	$("#btnCargar").prop("disabled", false);
						 		}
					    	});
					    });
					</script>
		  			<div align="center" class="form-row">
		    			<h4>Seleccione un archivo (.xlsx/xls)*</h4><br>
		     			<input id="inpCargar" type="file" name="name" placeholder="Archivo (.xlsx)"><br>
		     			<a><button id="btnCargar" type="submit" class="btn btn-success" disabled="">Cargar archivo</button></a>
		  			</div>
				</form>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>

		</div>
	</div>
</div>