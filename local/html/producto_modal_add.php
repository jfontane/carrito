<div id="addProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="add_product" id="add_product">
					<div class="modal-header">
						<h4 class="modal-title">Ver Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
					   <div class="form-group">
							<label>Codigo</label>
							<input type="text" name="add_code" id="add_code" class="form-control" >
						</div>
						<div class="form-group">
							<label>Producto</label>
							<input type="text" name="add_name" id="add_name" class="form-control" >
						</div>
						<div class="form-group">
							<label>Categoria</label>
							<select class="form-control" name="add_categoria" name="add_categoria" >
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
							<input type="text" name="add_empaque" id="add_empaque" class="form-control" >
						</div>
						<div class="form-group">
							<label>Codigo Barra</label>
							<input type="text" name="add_barCode" id="add_barCode" class="form-control" >
						</div>
						<div class="form-group">
							<label>Precio Costo</label>
							<input type="text" name="add_price" id="add_price" class="form-control" >
						</div>
						<div class="form-group">
							<label>Recargo</label>
							<input type="text" name="add_recargo" id="add_recargo"  class="form-control"  >
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
