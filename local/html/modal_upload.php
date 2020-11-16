<div id="uploadArchivoModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content" style='text-align: center'>
				<form name="upload_products" id="upload_products" enctype="multipart/form-data" method="post">
					<div class="modal-header">
						<h4 class="modal-title">Importar Archivo desde "Once Mayorista"</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<form id="subirArchivo">
					<div class="modal-body">
						<div class="form-group">
							<label>Archivo</label>
							<input type="file" name="archivo" id="archivo" class="form-control" required value="... Ingresa El archivo a Subir" />
							<input type="hidden" name="MAX_FILE_SIZE" value="30000">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Salir" id="btnCerrar">
						<input type="submit" class="btn btn-success" value="Guardar datos" name="botonAdjuntar" id="botonAdjuntar">
					</div>
				</form>
				<div id="ress" style='width:90%;'>

				</div>
			</div>
		</div>
	</div>
