<ul class="rd-navbar-nav">
    <li class="rd-nav-item active"><a class="rd-nav-link" href="<?$pathWeb?>">Inicio</a></li>
    <li class="rd-nav-item"><a class="rd-nav-link" href="#">Productos</a>
	<?php
			if(count($categs)  > 0){
		?>
			<ul class="rd-menu rd-navbar-dropdown">
		<?php
				foreach($categs as $catId => $dataCat){
		?>
					<li class="rd-dropdown-item">
						<a class="rd-dropdown-link" href="<?=$pathWeb?>productos.php?idCat=<?=($catId+1)?>&<?=$db->url()?>">
							<?=$dataCat['nombre']?>
						</a>
					</li>
		<?php
				}
		?>
			</ul>
		<?php
			}
		?>
        

	</li>
    <li class="rd-nav-item"><a class="rd-nav-link" href="grid-shop.html">Arma tu plato</a></li>
</ul>
