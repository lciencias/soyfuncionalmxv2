<?php
if ($_SESSION && $_SESSION['userId'] > 0){
?>
<div class="modal fade" id="modal7" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alta Pregunta</h4>
            </div>
            <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formaPregunta" id="validateFormPregunta" autocomplete="off" data-toogle="validator" role="form"> 
                <input type="hidden" name="idT" id="idT" value="<?=$idT?>">
                <input type="hidden" name="id" id="id" value="0">    
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Pregunta</label>
							    <input type="text" id="pregunta" name="pregunta" tabindex="1" class="form-control required letras" placeholder="Pregunta" maxlength="98">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Respuesta</label>
                                <textarea class="form-control" name="respuesta" tabindex="2" id="respuesta" placeholder="Respuesta" rows="8"  maxlength="300"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-icon" tabindex="3"  id="nuevoPregunta" name="nuevoPregunta"> 
                    <i class="fa fa-check"></i> <span id="titBtn">Crear</span>
                    </button>
                    <button type="button" class="btn btn-danger" tabindex="4" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>