<div id="editPedidoModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form name="edit_pedido" id="edit_pedido">
				<div class="modal-header">
					<h4 class="modal-title">Editar Pedido</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">
					<div class="form-group">
						<label>Estado</label>
						<select name="edit_estado" id="edit_estado" class="form-control">
							<option value="No Preparado">No Preparado</option>
							<option value="Preparado">Preparado</option>
							<option value="Entregado">Entregado</option>
						</select>
						<input type="hidden" name="edit_id" id="edit_id" >
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
