
<div class="modal fade" id="mtestimonial" tabindex="10000000000" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel"><br>A&ntilde;adir Testimonial</h4>
            </div>
            <form name="formaUsuario" id="validateFormTestimonialUser" autocomplete="off" data-toogle="validator" role="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">                                
                                <input type="text" id="nombre" name="nombre" tabindex="1" class="form-control required letras" placeholder="Nombre Completo" maxlength="80">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                                <textarea class="form-control" rows="4" id="testimonial" name="testimonial" tabindex="2"  class="alfa" placeholder="Testimonio" maxlength="300"></textarea>
                        </div>
                    </div>      
                    <div class="row">
                        <div class="col-md-12 tdCenter">
                            <span id="tprocesando"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" tabindex="3" id="guardaTestimonial" name="guardaTestimonial"> 
                            <i class="fa fa-check"></i> <span id="titBtn">Enviar testimonial</span>
                        </button>
                        <button type="button" tabindex="4" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>