
<div class="modal fade" id="mpregunta" tabindex="999999999999999999" role="dialog" aria-labelledby="myModalLabelPregunta">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabelPregunta"><br>A&ntilde;adir Pregunta</h4>
            </div>
            <form name="formaUsuario" id="validateFormPreguntaUser" autocomplete="off">  
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 tdCenter">                                 
                             <input type="text" id="pregunta" name="pregunta" tabindex="1" 
                             class="form-control required alfanum" placeholder="Realiza tu pregunta?" 
                             maxlength="180" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 tdCenter">
                            <span id="pprocesando"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" tabindex="2"  id="guardaPregunta" name="guardaPregunta"> 
                      <i class="fa fa-check"></i> <span id="titBtn">Enviar pregunta</span></button>
                      <button type="button" tabindex="3" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>