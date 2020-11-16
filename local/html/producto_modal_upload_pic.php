<div id="subirFotosProductModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form name="upload_pic_product" id="upload_pic_product">
					<div class="modal-header">
						<h4 class="modal-title">Subir Fotos Producto</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">
					   <div class="form-group">
							<label>Codigo</label>
							<input type="text" name="upload_pic_id" id="upload_pic_id" class="form-control" >
						</div>
						<div class="form-group">
  						<label>Choose Images</label>
		          <input type="file" name="images[]" id="fileInput" multiple >
						</div>
						<!-- Gallery view of uploaded images -->
						<div class="gallery"></div>

 					</div>
						<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="submit" class="btn btn-info" value="Guardar datos">
						<div id="uploadStatus"></div>
					</div>
				</form>
			</div>
		</div>
	</div>
