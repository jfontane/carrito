<div id="viewProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="view_product" id="view_product">
					<div class="modal-header">
						<h4 class="modal-title">Ver Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
					    <div class="form-group">
							<label>Codigo</label>
							<input type="hidden" name="view_id" id="view_id" >
							<input type="text" name="view_code" id="view_code" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Producto</label>
							<input type="text" name="view_name" id="view_name" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Categoria</label>
							<select class="form-control" name="view_categoria" name="view_categoria" readonly>
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
							<input type="text" name="view_empaque" id="view_empaque" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Codigo Barra</label>
							<input type="text" name="view_barCode" id="view_barCode" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Precio Costo</label>
							<input type="text" name="view_price" id="view_price" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label>Recargo</label>
							<input type="text" name="view_recargo" id="view_recargo"  class="form-control" readonly >
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					</div>
				</form>
			</div>
		</div>
	</div>
