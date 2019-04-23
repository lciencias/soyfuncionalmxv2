<?php
    $idCatTmp = 0;
    if(isset($_REQUEST['idCat'])){
        $idCatTmp = (int) $_REQUEST['idCat'] -1;
    }
    $titulo   = trim($categs[$idCatTmp]['nombre']);
?>
<div class="container">
    <h2 class="title-style-1 wow fadeInLeft">Productos</h2>
    <h4 class="title-style-1 wow fadeInRight"><?=$titulo?></h4>
	<div class="isotope-wrap ">
        <div class="isotope-filters-list-wrap">   
            <?php
            $tmp = "";
            if(count($categs) > 0){
                echo'<ul class="isotope-filters-list nav nav-tabs">';
                foreach($categs as $idC => $dataC){
                    $tmp = "";
                    if($idC == $idCatTmp){
                        $tmp = "active";
                        echo'<li role="presentation" class="'.$tmp.'">
                            <a href="#tab'.$dataC['id'].'" data-isotope-filter="tab'.$dataC['id'].'" aria-controls="tab'.$dataC['id'].'" role="tab" data-toggle="tab">
                            <span class="product-price" style=" text-transform:uppercase;">'.$dataC['nombre'].'</span>
                            </a>
                        </li>';
                    }else{
                        echo'<li role="presentation" class="'.$tmp.'">
                            <a href="#tab'.$dataC['id'].'" data-isotope-filter="tab'.$dataC['id'].'" aria-controls="tab'.$dataC['id'].'" role="tab" data-toggle="tab">
                            '.$dataC['nombre'].'
                            </a>
                        </li>';
                    }
                }
                echo'</ul>
                <div class="tab-content">';
                foreach($categs as $idC => $dataC){
                    $tmp = "";
                    if($idC == $idCatTmp){
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