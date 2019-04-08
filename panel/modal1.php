<?php
if ($_SESSION && $_SESSION['userId'] > 0){
?>
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Alta Usuario</h4>
            </div>
            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" name="formaUsuario" id="validateFormUsuario" autocomplete="off" data-toogle="validator" role="form">
                <input type="hidden" name="idT" id="idT" value="<?=$idT?>">    
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Nombre Completo</label>                                    
                                <input type="text" id="name" name="name" tabindex="1" class="form-control required letras" placeholder="Nombre Completo" maxlength="80">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Correo Electr&oacute;nico</label>
                                <input type="text" id="email" name="email" tabindex="2" class="form-control required email" placeholder="Correo Electr&oacute;nico" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Contrase&ntilde;a</label>
                                <input type="password" id="passwordS" name="passwordS" tabindex="4" class="form-control required alfa" placeholder="Contrase&ntilde;a" maxlength="20">
                            </div>
                        </div>                                         
                    </div>                                       
                </div>
                <div class="row">
                    <div class="col-md-12 tdCenter">
                        <span id="procesando"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="nuevoUsuario" name="nuevoUsuario"> <i class="fa fa-check"></i> <span>Crear</span></button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}
?>