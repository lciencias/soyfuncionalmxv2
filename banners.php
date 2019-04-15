<div class="swiper-wrapper context-dark text-center">
<?php
if(count($sliders) > 0){
	foreach($sliders as $id => $data){
?>
	<div class="swiper-slide" data-slide-bg="<?=$data['web']?>">
		<div class="swiper-slide-caption section-md">
			<div class="container">
				<div class="row justify-content-start text-left">
					<div class="col-12">
					<?php
						if(trim($data['texto_corto']) != ""){
					?>
							<h4 class="swiper-title-3" data-caption-animate="fadeInLeft" data-caption-delay="200"><?=$data['texto_corto']?></h4>
					<?php
						}	
						if(trim($data['texto_grande']) != ""){
					?>
							<h1 class="swiper-title-1" data-caption-animate="fadeScale" data-caption-delay="100"><?=$data['texto_grande']?></h1>
					<?php
						}	
						if(trim($data['url']) != ""){
					?>
							<h3 class="swiper-title-2" data-caption-animate="fadeInRight" data-caption-delay="200"><?=$data['url']?></h3>
					<?php
						}
						if(trim($data['texto_boton']) != ""){
					?>
							<div class="button-wrap" data-caption-animate="fadeInUp" data-caption-delay="300">
								<a class="button button-lg button-primary button-zakaria" href="grid-shop.html"><?=$data['texto_boton']?></a>
							</div>
					<?php
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}
}
?>
<div class="swiper-pagination"></div>
<div class="swiper-button-prev"></div>
<div class="swiper-button-next"></div>