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
					<li><a class="active" href="#" data-isotope-filter="*">Todos</a></li>
					<?php
						$arrayType = array();
						if(count($categs) > 0){
							foreach($categs as $idC => $dataC){
								$arrayType[$idC] = "Type".$dataC['id'];
					?>
						<li><a href="#" data-isotope-filter="<?=$arrayType[$idC]?>"><?=$dataC['nombre']?></a></li>	
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
				$prodCategoria = $prods[$idCat];
		?>
			<div class="col-sm-6 col-md-4 col-lg-3 isotope-item" data-filter="<?=$categoria?>">
				<article class="product wow fadeInRight">
				<?php
					foreach($prodCategoria as $idProd => $dataP){
				?>
					<div class="product-body">
						<div class="product-figure">
							<img src="<?=$dataP['web']?>" alt="<?=$dataP['producto']?>" width="220" height="160"/>
						</div>
						<h5 class="product-title"><a href="<?=$pathWeb?>single-product.php"><?=$dataP['producto']?></a></h5>
						<div class="product-price-wrap">
							<div class="product-price product-price-old"><?=$dataP['caloria']?></div>
								<div class="product-price"><?=$dataP['precio']?></div>
							</div>
						</div>
						<!--<span class="product-badge product-badge-sale">Sale</span>-->
						<div class="product-button-wrap">
							<div class="product-button">
								<a class="button button-secondary button-zakaria fl-bigmug-line-search74" href="single-product.html"></a>
							</div>
							<div class="product-button">
								<a class="button button-primary button-zakaria fl-bigmug-line-shopping202" href="cart-page.html"></a>
							</div>
						</div>
				<?php
					}
				?>
				</article>
			</div>
			<?php
			}
			?>					
			<div class="col-1"></div>
		</div>
	</div>
</div>