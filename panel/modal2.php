<?php
if ($_SESSION && $_SESSION['userId'] > 0){
    $maxOrden = $total + 1;
?>
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:75%;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alta Banner</h4>
            </div>
            <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formaSlider" id="validateFormSlider" autocomplete="off" data-toogle="validator" role="form"> 
                <input type="hidden" name="idT" id="idT" value="<?=$idT?>"> 
                <input type="hidden" name="id" id="id" value="0">    
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Nombre de Banner</label>
                                <input type="text" id="nombre" name="nombre" maxlength="100" tabIndex="1" class="form-control required letras" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Orden</label>		
                                <select name="orden" id="orden" class="form-control" tabindex="2">
                                <?php 
                                for( $j=$maxOrden; $j >= 1; $j--){
                                ?>
                                    <option value="<?=$j?>"><?=$j?></option>
                                <?php 
                                }
                                ?>
                                </select>													
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
						    <div class="form-group">
							    <label class="control-label mb-10">Texto 1 (tama&ntilde;o peque&ntilde;o)</label>
								<input type="text" id="texto_corto" name="texto_corto" tabindex="3" maxlength="150" tabIndex="2" class="form-control alfa" placeholder="Texto 1">
							</div>
						</div>
						<div class="col-md-6">
						    <div class="form-group">
							    <label class="control-label mb-10">Texto 2 (tama&ntilde;o grande)</label>
								<input type="text" id="texto_grande" name="texto_grande" tabindex="4" maxlength="150" tabIndex="3" class="form-control alfa" placeholder="Texto 2">
							</div>
						</div>
					</div>
                    <div class="row">
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label mb-10">Texto 3</label>
								<input type="text" id="texto_url" name="texto_url" maxlength="60" tabIndex="5" class="form-control alfa" placeholder="Texto 3">
                            </div>
                        </div>
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label mb-10">Texto Bot&oacute;n</label>
								<input type="text" id="texto_boton" name="texto_boton" maxlength="60" tabIndex="6" class="form-control alfa" placeholder="Texto Bot&oacute;n">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cargar imagen Web</label>		
                                <input type="file" id="imagen" name="imagen" class="form-control upload" tabindex="7" accept="image/gif, image/jpeg , image/png" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cargar imagen Movil</label>		
                                <input type="file" id="imagenM" name="imagenM" class="form-control upload" tabindex="8" accept="image/gif, image/jpeg , image/png" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="crearSlider" name="crearSlider" tabindex="9"> 
                        <i class="fa fa-check"></i> <span id="titBtn">Crear</span>
                    </button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal" tabindex="10">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>