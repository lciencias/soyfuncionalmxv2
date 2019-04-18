<div class="container">
	<h4 class="title-style-1 wow fadeInLeft"></h4>
	<h2 class="wow fadeScale">Productos</h2>
	
	<div class="isotope-wrap">
		
		<div class="isotope-filters">
			<button class="isotope-filters-toggle button button-sm button-icon button-icon-right button-default-outline" data-custom-toggle=".isotope-filters-list" data-custom-toggle-hide-on-blur="true">
				<span class="icon mdi mdi-chevron-down"></span>Filter
			</button>
			<div class="isotope-filters-list-wrap">
				<ul class="isotope-filters-list">
					<?php
						$arrayType = array();
						if(count($categs) > 0){
							foreach($categs as $idC => $dataC){
								$id = $dataC['id'];
								$arrayType[$id] = $dataC['nombre'];
					?>
						<li>
							<a href="#" data-isotope-filter="<?=$id?>">
								<?=$dataC['nombre']?>
							</a>
						</li>	
					<?php
					
							}
						}
					?>
				</ul>
			</div>
		</div>



		<div class="row row-30 row-lg-50 isotope">
		<?php
			foreach($arrayType as $idCat => $categoria){
				if($idCat > 0 && array_key_exists($idCat, $prods) ){
				$prodCategoria = $prods[$idCat];
		?>
			<div class="col-sm-3 col-md-3 col-lg-3 isotope-item" data-filter="<?=$idCat?>">
				<article class="product wow fadeInRight">
				<?php
					foreach($prodCategoria as $idProd => $dataP){
				?>
					<div class="product-body" style="height:320px;border:2px solid #777;">
						<br/>
						<div class="product-figure" style="border:0px;background-color:#ffffff;">
							<img src="<?=$dataP['web']?>" alt="<?=$dataP['producto']?>" width="180" height="150"/>
						</div>
						<h6 class="product-title" ><a href="<?=$pathWeb?>single-product.php"><?=$dataP['producto']?></a></h6>
						<div class="product-price-wrap">
							<div class="product-price product-price">Calor&iacute;as: <?=$dataP['caloria']?></div>
							<br/>
							<div class="product-price">Precio: <?=$dataP['precio']?></div>
						</div>
					</div>
				<?php
					}
				?>
				</article>
			</div>
			<?php
				
				}
			}
			?>					
			<div class="col-1"></div>
		</div>
	</div>
</div>