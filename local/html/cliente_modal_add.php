<div id="addClienteModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_cliente" id="add_cliente">
					<div class="modal-header">
						<h4 class="modal-title">Agregar Cliente</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Apellido</label>
							<input type="text" name="apellido" id="apellido" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Nombre</label>
							<input type="text" name="nombre" id="nombre" class="form-control" required>
						</div>
						<div class="form-group">
							<label>DNI</label>
							<input type="text" name="dni" id="dni" class="form-control">
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" id="email" class="form-control">
						</div>
						<div class="form-group">
							<label>Telefono</label>
							<input type="text" name="telefono" id="telefono" class="form-control">
						</div>
						<div class="form-group">
							<label>Direccion</label>
							<input type="text" name="direccion" id="direccion" class="form-control">
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-success" value="Guardar datos">
					</div>
				</form>
			</div>
		</div>
	</div>
