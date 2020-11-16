<div id="editClienteModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_cliente" id="edit_cliente">
				<div class="modal-header">
					<h4 class="modal-title">Editar Cliente</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Apellido</label>
						<input type="text" name="edit_apellido" id="edit_apellido" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Nombre</label>
						<input type="text" name="edit_nombre" id="edit_nombre" class="form-control" >
					</div>
					<div class="form-group">
						<label>Documento</label>
						<input type="text" name="edit_dni" id="edit_dni" class="form-control" >
						<input type="hidden" name="edit_id" id="edit_id" >
					</div>
					<div class="form-group">
						<label>Direccion</label>
						<input type="text" name="edit_direccion" id="edit_direccion" class="form-control" >
					</div>
					<div class="form-group">
						<label>Telefono</label>
						<input type="text" name="edit_telefono" id="edit_telefono" class="form-control" >
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" name="edit_email" id="edit_email" class="form-control" >
					</div>
					<div class="form-group">
						<label>Observacion</label>
						<textarea name="edit_observacion" id="edit_observacion" rows="3" cols="50" class="form-control"></textarea>
					</div>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="submit" class="btn btn-info" value="Guardar datos">
				</div>
			</form>
		</div>
	</div>
</div>
