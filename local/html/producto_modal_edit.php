<div id="editProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="edit_product" id="edit_product">
					<div class="modal-header">
						<h4 class="modal-title">Editar Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
					    <div class="form-group">
							<label>Codigo</label>
							<input type="hidden" name="edit_id" id="edit_id" >
							<input type="text" name="edit_code" id="edit_code" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Producto</label>
							<input type="text" name="edit_name" id="edit_name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Categoria</label>
							<select class="form-control" name="edit_categoria" id="edit_categoria">

								<?php
										$res=$db->query("select * from categorias ");
										if ($res->num_rows>0) {
											while ($fila=$res->fetch_assoc()) {
												 echo '<option value="'.$fila['id'].'">'.$fila['descripcion'].'</option>';
											}
										}
								?>
							</select>
						</div>
						<div class="form-group">
							<label>Empaque</label>
							<input type="text" name="edit_empaque" id="edit_empaque" class="form-control">
						</div>
						<div class="form-group">
							<label>Codigo Barra</label>
							<input type="text" name="edit_barCode" id="edit_barCode" class="form-control">
						</div>
						<div class="form-group">
							<label>Precio Costo</label>
							<input type="text" name="edit_price" id="edit_price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Recargo</label>
							<input type="text" name="edit_recargo" id="edit_recargo" class="form-control" required>
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
