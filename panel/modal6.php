<?php
if ($_SESSION && $_SESSION['userId'] > 0){
?>
<div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alta Testimonial</h4>
            </div>
            <form enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formaTestimonial" id="validateFormTestimonial" autocomplete="off" data-toogle="validator" role="form"> 
                <input type="hidden" name="idT" id="idT" value="<?=$idT?>">
                <input type="hidden" name="id" id="id" value="0">    
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nombre del visitante</label>
							    <input type="text" id="nombreVisitante" name="nombreVisitante" tabindex="1" class="form-control required letras" placeholder="Nombre del visitante" maxlength="70">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Testimonial</label>
                                <textarea class="form-control" name="testimonial" tabindex="2" id="testimonial" placeholder="Testimonial" rows="8"  maxlength="118"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-icon" tabindex="3"  id="nuevoTestimonial" name="nuevoTestimonial"> 
                    <i class="fa fa-check"></i> <span id="titBtn">Crear</span></button>
                    <button type="button" class="btn btn-danger" tabindex="4" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>