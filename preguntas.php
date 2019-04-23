<?php
if(count($pregun) > 0){
	$accordion = 1;
?>
	<div class="container">
		<div class="row row-30 justify-content-center align-items-md-center">
			<div class="col-md-7 col-xl-6">
				<h3 class="title-style-1 wow fadeInRight">Preguntas Frecuentes 
					<span>
						<a href="#" id="anadirPregunta" data-toggle="modal" data-target="#mpregunta">
							<i class="fa fa-plus"></i>
						</a>
					</span>
				</h3>
				<!--<h6 class="text-spacing-20 wow fadeInRight tdCenter" data-wow-delay=".1s">Realizar pregunta </h6>-->
				<div class="card-group-custom card-group-custom-1 card-group-corporate" id="accordion<?=$accordion?>" role="tablist" aria-multiselectable="false">
				<?php
					$conP = 2;
					foreach($pregun as $idP => $dataP){
						$tmp = "false";
					if($conP == 2){
						$tmp = "true";
					}
				?>
					<article class="card card-custom card-corporate wow fadeInRight" data-wow-delay=".<?=$contP?>s">
						<div class="card-header" role="tab">
							<div class="card-title">
								<a id="accordion<?=$accordion?>-card-head-<?=$conP?>" data-toggle="collapse" data-parent="#accordion<?=$accordion?>" href="#accordion<?=$accordion?>-card-body-<?=$conP?>" aria-controls="accordion<?=$accordion?>-card-body-<?=$conP?>" aria-expanded="<?=$tmp?>" role="button"><?=utf8_encode($dataP['pregunta'])?>
									<div class="card-arrow">
										<div class="icon"></div>
									</div>
								</a>
							</div>
						</div>
						<div class="collapse" id="accordion<?=$accordion?>-card-body-<?=$conP?>" aria-labelledby="accordion<?=$accordion?>-card-head-<?=$conP?>" data-parent="#accordion<?=$accordion?>" role="tabpanel">
							<div class="card-body">
								<p><?=utf8_encode($dataP['respuesta'])?></p>
							</div>
						</div>
					</article>
				 <?php
					$conP++;
					}
				?>
				</div>
			</div>
            <div class="col-12">
				<div class="custom-border"></div>
            </div>
		</div>
	</div>
<?php
}
?>