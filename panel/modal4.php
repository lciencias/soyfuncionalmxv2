<?php
if ($_SESSION && $_SESSION['userId'] > 0){
    $maxOrden = $total + 1;
?>
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"  style="width:75%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alta de Producto</h4>
            </div>
            <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formaProducto" id="validateFormProducto" autocomplete="off" data-toogle="validator" role="form">
                <input type="hidden" name="idT" id="idT" value="<?=$idT?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
							    <label class="control-label">Categor&iacute;a</label>
								<select class="form-control" id="idcategoria" name="idcategoria" tabindex="1" data-style="form-control required  btn-default btn-outline">
								<?php 
									if(count($categorias) > 0){
									    foreach ($categorias as $key => $value){
								?>
											<option value="<?=$key?>"><?=$value?></option>
								<?php 
										}
									}
								?>
								</select>
							</div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label">Productos</label>
							<input type="text" id="producto" maxlength="100"  name="producto" tabindex="2" maxlength="80" value="<?=$registro['producto']?>" class="form-control required letras" placeholder="Nombre del Producto">											
							</div>
                        </div>                                            
                    </div>                                       
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Calorias</label>
                                <input type="text" id="caloria" name="caloria" tabindex="3" maxlength="20" class="form-control required alfa" placeholder="calor&iacute;as">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Precio</label>
                                <input type="text" id="precio" name="precio" tabindex="4" maxlength="8" class="form-control required decimales" placeholder="Precio">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Orden</label>
                                <select name="orden" id="orden" class="form-control"  tabIndex="5">
								<?php 
									for( $j=1; $j <= $maxOrden; $j++){
								?>
										<option value="<?=$j?>"><?=$j?></option>
								<?php 
									}
								?>
								</select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Imagen</label>
                                <input type="file" id="fileImgProd" name="fileImgProd" class="form-control upload" tabindex="8" accept="image/gif, image/jpeg , image/png" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-icon" id="nuevoProducto" name="nuevoProducto"> <i class="fa fa-check"></i> <span>Crear</span></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>