<div id="publicarProductModal" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog" id="mdialTamanio" style="width: 80% !important;">
			<div class="modal-content">
				<form name="publicar_product" id="publicar_product">
					<div class="modal-header">
						<h4 class="modal-title">Publicar Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body" id='modalbody'>
						<div class="form-group">
							<label>Titulo</label>
							<input type="hidden" name="publicar_id" id="publicar_id" class="form-control" readonly>
							<input type="text" name="publicar_titulo" id="publicar_titulo" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Descripcion</label><br>
							<textarea name="publicar_descripcion" id="publicar_descripcion" style="width: 540px; height: 100px;" placeholder="Descripcion">
							</textarea>
						</div>
						<div class="form-group">
							<label>Categoria</label>
							<select class="form-control" name="publicar_categoria" id="publicar_categoria">
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
							<label>Precio Costo</label>
							<input type="text" name="publicar_price" id="publicar_price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Porcentaje Recargo</label>
							<input type="text" name="publicar_porcentaje" id="publicar_porcentaje" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Promocion</label>
						Si <input id='r1' type='radio' name="publicar_promocion" value="Si"/>&nbsp;&nbsp;No <input id='r2' type='radio' name="publicar_promocion" value="No"/>
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
