<?php
	if(count($testim) > 0){
?>
<div class="container">
	<h4 class="title-style-1 wow fadeInRight">&Uacute;ltimos testimoniales</h4>
    <h2 class="wow fadeScale">Nuestros Clientes</h2>
         
    <div class="owl-carousel owl-style-3" data-items="1" data-margin="200" data-autoplay="true" data-nav="true" data-dots="true" data-smart-speed="400" data-animation-in="fadeIn" data-animation-out="fadeOut">
            
		<?php
		foreach($testim as $idT => $dataT){
		?>
			<article class="quote-modern quote-modern-2">
				<div class="quote-modern-text">
					<div class="q"><?=$dataT['testimonial']?></div>
				</div>
				<div class="unit unit-spacing-sm flex-column flex-md-row align-items-center">
					<div class="unit-left">
						<div class="quote-modern-figure">
							<img src="<?=$pathWeb?>images/user-11-62x62.jpg" alt="" width="62" height="62"/>
						</div>
					</div>
					<div class="unit-body">
						<div class="quote-modern-author"><?=$dataT['nombre']?></div>
						<div class="quote-modern-status"><?=$dataT['cliente']?></div>
					</div>
				</div>
			</article>
		<?php
		}
		?>
	</div>
</div>
<?php
}
?>