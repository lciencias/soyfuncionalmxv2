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
                                <select name="orden" id="orden" class="form-control">
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
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cargar imagen Web</label>		
                                <input type="file" id="imagen" name="imagen" class="form-control upload" tabindex="4" accept="image/gif, image/jpeg , image/png" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Cargar imagen Movil</label>		
                                <input type="file" id="imagenM" name="imagenM" class="form-control upload" tabindex="4" accept="image/gif, image/jpeg , image/png" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="crearSlider" name="crearSlider"> <i class="fa fa-check"></i> <span>Crear</span></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>