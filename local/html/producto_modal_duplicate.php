<div id="duplicateProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="duplicate_product" id="duplicate_product">
					<div class="modal-header">
						<h4 class="modal-title">duplicar Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Codigo</label>
							<input type="text" name="duplicate_code"  id="duplicate_code" class="form-control" required>
							<input type="hidden" name="duplicate_id" id="duplicate_id" >
							<input type="hidden" name="duplicate_recargo" id="duplicate_recargo" >
						</div>
						<div class="form-group">
							<label>Producto</label>
							<input type="text" name="duplicate_name" id="duplicate_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Empaque</label>
							<input type="text" name="duplicate_empaque" id="duplicate_empaque" class="form-control">
						</div>
						<div class="form-group">
							<label>Cantidad Unidades por Empaque</label>
							<input type="number" name="duplicate_cantidad_empaque" id="duplicate_cantidad_empaque" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Codigo Barra</label>
							<input type="text" name="duplicate_barCode" id="duplicate_barCode" class="form-control">
						</div>
						<div class="form-group">
							<label>Precio Costo</label>
							<input type="text" name="duplicate_price" id="duplicate_price" class="form-control" required>
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
