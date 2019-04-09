<?php
if ($_SESSION && $_SESSION['userId'] > 0){
    $maxOrden = $total + 1;
?>
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alta Categor&iacute;a</h4>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formaCategoria" id="validateFormCategoria" autocomplete="off" data-toogle="validator" role="form">
                <input type="hidden" name="idT" id="idT" value="<?=$idT?>">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
							    <label class="control-label mb-10">Nombre de la Categorias</label>
								<input type="text" id="nombreC" name="nombreC" tabindex="1" class="form-control required letras" placeholder="Nombre de la Categorias" maxlength="80"/>
							</div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
							    <label class="control-label mb-10">Orden</label>		
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
                </div>
                <div class="modal-footer">
                    <button type="button" tabindex="3" class="btn btn-success" id="nuevoCategoria" name="nuevoCategoria"> <i class="fa fa-check"></i> <span>Crear</span></button>
                    <button type="button" tabindex="4" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>