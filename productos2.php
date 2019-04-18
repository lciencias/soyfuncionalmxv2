<div class="container">
	<h4 class="title-style-1 wow fadeInLeft"></h4>
	<h2 class="wow fadeScale">Productos</h2>
	<div class="isotope-wrap">
        <div class="isotope-filters-list-wrap">   
            <?php
            $tmp = "";
            if(count($categs) > 0){
                echo'<ul class="isotope-filters-list nav nav-tabs">';
                foreach($categs as $idC => $dataC){
                    $tmp = "";
                    if($idC == 0){
                        $tmp = "active";
                    }
                    $arrayType[$id] = $dataC['nombre'];
                    echo'<li role="presentation" class="'.$tmp.'">
                            <a href="#tab'.$dataC['id'].'" aria-controls="tab'.$dataC['id'].'" role="tab" data-toggle="tab">
                            '.$dataC['nombre'].'
                            </a>
                        </li>';
                }
                echo'</ul>
                <div class="tab-content">';
                foreach($categs as $idC => $dataC){
                    $tmp = "";
                    if($idC == 0){
                        $tmp = " active ";
                    }
                    $prodCategoria = $prods[$dataC['id']];
                    echo'<div role="tabpanel" class="tab-pane'.$tmp.'" id="tab'.$dataC['id'].'">
                        <div class="row">';
					foreach($prodCategoria as $idProd => $dataP){
                        echo'
                        <div class="col-md-3">
                            <div class="product-body">
						        <br/>
						        <div class="product-figure" style="border:0px;background-color:#ffffff;">
							        <img src="'.$dataP['web'].'" alt="'.$dataP['producto'].'" width="180" height="150"/>
						        </div>
						        <h6 class="product-title" ><a href="'.$pathWeb.'single-product.php">'.$dataP['producto'].'</a></h6>
						        <div class="product-price-wrap">
							        <div class="product-price product-price">Calor&iacute;as: '.$dataP['caloria'].'</div>
							        <br/>
							        <div class="product-price">Precio: '.$dataP['precio'].'</div>
						        </div>
                            </div>
                        </div>';
					}
                    echo'</div></div>';
                }
                echo'</div>';
            }
            ?>
        </div>
	</div>
</div>