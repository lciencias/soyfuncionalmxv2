<?php 
include_once("include.php");
$path_web = "http://www.amivtac.org/spanelWeb/";
$path_sys = "/home/amivtac/public_html/spanelWeb/";
$path_cla = "/home/amivtac/public_html/spanelWeb/clases/";
$path_psis= "/home/amivtac/public_html/";
include_once($path_cla."Comunes.class.php");
include_once($path_cla."Conexion.class.php");
include_once($path_cla."Slider.class.php");
include_once($path_cla."Evento.class.php");
include_once($path_cla."Revista.class.php");
include_once($path_cla."BiblotecaAmivtac.class.php");
$_dbhost   = "localhost";
$_dbuname  = "amivtac_sitioweb";
$_dbpass   = "Am1vt4c#_W3b";
$_dbname   = "amivtac_sitioweb";
$persistency = true;
$db      = new Conexion($_dbhost, $_dbuname, $_dbpass, $_dbname, $persistency);
$slide   = new Slider  ($db,$_SESSION,$_POST,Comunes::LISTAR,Comunes::WEB);
$evento  = new Evento  ($db,$_SESSION,$_POST,Comunes::LISTAR,Comunes::WEB);
$revista = new Revista ($db,$_SESSION,$_POST,Comunes::LISTAR,Comunes::LISTAR, Comunes::WEB2);
$publica = new BiblotecaAmivtac($db,$_SESSION,$_POST,Comunes::LISTAR,Comunes::WEB,$path_sys,$path_web);
$buffer       = $slide->obtenBuffer();
$bufferEvento = $evento->obtenBuffer();
$arrayRevista = $revista->obtenRegistros();
$bufferPublica= $publica->obtenRegistros();
$meses        = $publica->obtenMeses();
include_once($path_psis."header.php");
?>
<body class="header-sticky page-loading">   
    <div class="loading-overlay">
    </div>
    
    <!-- Boxed -->
    <div class="boxed">
        <div class="site-header">
            <div class="flat-top">
                <div class="container">
                <?php 
            		include_once($path_psis."contacto.php");
            	?>
                </div><!-- /.container -->
            </div><!-- /.flat-top -->           
            <header id="header" class="header clearfix">
			<?php 
            	include_once($path_psis."menu.php");
            ?>             
             </header><!-- /.header -->
        </div><!-- /.site-header -->        
        <!-- Header Wrap End --> 
	    <!-- Home page Slider Wrap Start -->    
    	<div class="full home_slider">
      		<div id="myCarousel" class="carousel slide" data-ride="carousel">         
        		<!-- Wrapper for slides -->        
        		<div class="carousel-inner" role="listbox">
        			<?=$buffer?>
		        </div>
    		</div>
    		<!-- End Slider A -->        
        	<div class="padding-100"></div>
		        <!-- AMIVTAC Section -->
				<!-- Container -->
				<div class="container">
					<!-- Section Header -->
					<div class="section-header">
					  <div class="section-title-border-amivtac">
					    <div class="section-title-border">
					      <h2>AMIVTAC</h2>
				        </div>
					  </div>
					</div><!-- Section Header /- -->
					<!-- Row -->
					<div class="row">								
								  <div class="col-md-12 col-sm-12 content-block">
										<p align="justify">La <b>Asociaci&oacute;n Mexicana de Ingenier&iacute;a de V&iacute;as Terrestres, Asociaci&oacute;n Civil, AMIVTAC</b>, tiene como objetivo promover y desarrollar la ciencia y tecnolog&iacute;a de las v&iacute;as terrestres desde los puntos de vista t&eacute;cnico, administrativo y operativo en relaci&oacute;n con las distintas modalidades del transporte en beneficio de la colectividad y el pa&iacute;s.<br> <a style="color:#32BFC0" href="historia.php">Leer m&aacute;s ></a></p>
									</div>
                                    
                                    <div class="promobox style1 style2 clearfix">
                            <a class="button black sm" href="#">Membres&iacute;as<i class="fa fa-chevron-right"></i></a>
                        </div>
					</div><!-- Row /- -->
				</div><!-- Container /- -->
                <!-- AMIVTAC Section -->
                <div class="padding-50"></div>
                
                
        <!-- Calendario de Eventos -->
			<div class="container-fluid no-padding upcoming-event">
				<div class="section-padding"></div>
				<!-- Container -->
					<?=$bufferEvento?>				
				<div class="section-padding"></div>
			</div><!-- Upcoming Events /- -->
            
			<!-- Magazine  -->		
			<div class="flat-row parallax parallax2 pad-top120px pad-bottom120px">
				<div class="overlay bg-scheme1"></div>
           		<div class="container">
               		<div class="row">
                		<div class="col-md-9">
                       		<div class="make-quote">
                           		<h1 class="revista-title">Revista AMIVTAC</h1>
                           		<h5 class="desc-revista">Conoce la nueva secci&oacute;n especializada donde podr&aacute;s encontrar los &uacute;ltimos n&uacute;meros.</h5>
                           		<div class="group-btn">
                               		<a class="button lg" href="revista.php">Ver revistas<i class="fa fa-chevron-right"></i></a>
                           		</div>
                           		<h6 class="desc-revista">En este n&uacute;mero: 
								<?php if ((int) $arrayRevista['idcurriculum'] > 0){ ?>
									<a href="revistas/revista-view.php?idrevista=<?=$arrayRevista['idrevista']?>" target="new"><b><?=$arrayRevista['titulo']?></b></a></h6>
								<?php } else {  ?>
									<a href="<?=$arrayRevista['url']?>" target="new"><b><?=$arrayRevista['titulo']?></b></a></h6>
								<?php } ?>
								<?php if(trim($arrayRevista['resena']) != ''){?>
	                           		<h6 class="desc-revista"><?=$arrayRevista['resena']?></h6>
								<?php } ?>
                       		</div><!-- /.make-quote -->
                   		</div><!-- /.col-md-9 -->
                   		<div class="col-md-3">
                    		<div class="revista_portada">
								<?php if ((int) $arrayRevista['idcurriculum'] > 0){ ?>
                       			<a href="revistas/revista-view.php?idrevista=<?=$arrayRevista['idrevista']?>" target="new" title="Ver último número"><img src="<?=$arrayRevista['imagen']?>"></a>
								<?php } else {  ?>
									<a href="<?=$arrayRevista['url']?>" target="new" title="Ver último número"><img src="<?=$arrayRevista['imagen']?>"></a>
								<?php } ?>
                    		</div>
                   		</div>
               		</div><!-- /.row -->
           		</div><!-- /.container -->
       		</div><!-- /.flat-row -->        
        <!-- &uacute;ltimas Noticias -->
        <div class="flat-row blog-shortcode blog-home pad-top60px pad-bottom0px">
            <div class="container">
                <div class="row">
                    <div class="section-header">
                      <div class="section-title-border-unoticias">
                       <div class="section-title-border">
					      <h2>&uacute;LTIMAS NOTICIAS</h2>
				        </div>
                      </div>
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->

                <div class="row">
                    <div class="content-wrap">                   
                        <div class="main-content">
                            <div class="main-content-wrap">
                                <div class="content-inner clearfix">
                                    <article class="flat-item item-four-column blog-post">
                                        <div class="entry-wrapper">
                                            <div class="entry-cover">
                                                    <img src="images/noticias/noticia-1.jpg" alt="images">
                                            </div><!-- /.entry-cover --> 
                                            <div class="entry-header">                                                
                                                <div class="entry-header-content">                                                    
                                                    <h4 class="entry-title">
                                                        <a href="noticia-1.php">Ciclo de Conferencias: &quot;Evoluci&oacute;n de las ingenier&iacute;as civil y geom&aacute;tica en 225 a&ntilde;os de ingenier&iacute;a en M&eacute;xico&quot;</a>
                                                    </h4>                                                    
                                                </div><!-- /.entry-header-content -->
                                            </div><!-- /.entry-header -->

                                            <div class="entry-content">
                                                <p>La Facultad de Ingenier&iacute;a de la UNAM llev&oacute; a cabo del 20 al 24 de febrero de 2017.</p>
                                            </div><!-- /.entry-content -->
                                            <div class="entry-footer">
                                                    <a class="button lg" href="noticia-1.php">Ver noticia<i class="fa fa-chevron-right"></i></a>
                                            </div>
                                        </div><!-- /.entry-wrapper -->
                                    </article><!-- /.blog-post -->

                                    <article class="flat-item item-four-column blog-post">
                                        <div class="entry-wrapper">
                                            <div class="entry-cover">
                                                    <img src="images/noticias/noticia-2.jpg" alt="images">
                                            </div><!-- /.entry-cover --> 
                                            <div class="entry-header">                                                
                                                <div class="entry-header-content">
                                                    <h4 class="entry-title">
                                                        <a href="noticia-2.php">Curso-Taller Dise&ntilde;o con Geosint&eacute;ticos</a>
                                                    </h4>                                                    
                                                </div><!-- /.entry-header-content -->
                                            </div><!-- /.entry-header -->

                                            <div class="entry-content">
                                                <p>El Viernes 27 y S&aacute;bado 28 de Enero del 2017, tuvo lugar en la sala de capacitaci&oacute;n del Centro SCT Sonora, el Curso â€“ Taller Dise&ntilde;o con Geosint&eacute;ticos.</p>
                                            </div><!-- /.entry-content -->
                                            <div class="entry-footer">
                                                    <a class="button lg" href="noticia-2.php">Ver noticia<i class="fa fa-chevron-right"></i></a>
                                            </div>
                                        </div><!-- /.entry-wrapper -->
                                    </article><!-- /.blog-post -->

                                    <article class="flat-item item-four-column blog-post">
                                        <div class="entry-wrapper">
                                            <div class="entry-cover">
                                                    <img src="images/noticias/noticia-3.jpg" alt="images">
                                            </div><!-- /.entry-cover --> 
                                            <div class="entry-header">                                                
                                                <div class="entry-header-content">
                                                    <h4 class="entry-title">
                                                        <a href="noticia-3.php">Asamblea General Ordinaria</a>
                                                    </h4>                                                    
                                                </div><!-- /.entry-header-content -->
                                            </div><!-- /.entry-header -->

                                            <div class="entry-content">
                                                <p>El Asamblea general ordinaria, que tendr&aacute; lugar el d&iacute;a mi&eacute;rcoles 22 de febrero del 2016.</p>
                                            </div><!-- /.entry-content -->
                                            <div class="entry-footer">
                                                    <a class="button lg" href="noticia-3.php">Ver noticia<i class="fa fa-chevron-right"></i></a>
                                            </div>
                                        </div><!-- /.entry-wrapper -->
                                    </article><!-- /.blog-post -->
                                    
                                    <article class="flat-item item-four-column blog-post">
                                        <div class="entry-wrapper">
                                            <div class="entry-cover">
                                                    <img src="images/blog/b3.jpg" alt="images">
                                            </div><!-- /.entry-cover --> 
                                            <div class="entry-header">                                                
                                                <div class="entry-header-content">
                                                    <h4 class="entry-title">
                                                        <a href="#">PIARC consolida su estrategia para el periodo 2017-2020</a>
                                                    </h4>                                                    
                                                </div><!-- /.entry-header-content -->
                                            </div><!-- /.entry-header -->

                                            <div class="entry-content">
                                                <p>Claude Van Rooten, Presidente de la Asociaci&oacute;n Mundial de la Carretera para el periodo 2017-2020.</p>
                                            </div><!-- /.entry-content -->
                                            <div class="entry-footer">
                                                    <a class="button lg" href="#">Ver noticia<i class="fa fa-chevron-right"></i></a>
                                            </div>
                                        </div><!-- /.entry-wrapper -->
                                    </article><!-- /.blog-post -->
                                    
                                </div><!-- /.content-inner -->                                
                            </div><!-- /.main-content-wrap -->
                        </div><!-- /.main-content -->
                    </div><!-- /.content-wrap  -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.flat-row -->
        
            

        <!-- Publicaciones Destacadas -->
        <div class="flat-row pad-bottom70px bg-f2f4f8">
            <div class="container">
                <!-- Section Header -->
					<div class="section-header">
                      <div class="section-title-border-pubdestacadas">
						<div class="section-title-border">
							<h2>Publicaciones Destacadas</h2>
						</div>
                      </div>
					</div><!-- Section Header /- -->

                <div class="flat-divider d48px"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="flat-testimonial-owl">
                        <?php 
                       
                        $bufferPublica= $publica->obtenRegistros();
                        $meses        = $publica->obtenMeses();
                        
                        if(count($bufferPublica) > 0){
                        	foreach($bufferPublica as $publicacion){
                        		
								echo'<div class="flat-testimonial">
                                		<div class="testimonial-meta">';
								if(trim($publicacion['imagen']) != ''){
                                			echo'<a href="#" target="new"><img src="'.$publicacion['imagen'].'" width="100%" height="100%"></a>';
                        		}
                                echo'	</div>
                                		<div class="testimonial-author">';
                                
                                if($publicacion['tipo'] == 1){
                                	echo '<p align="center"><strong><a href="'.$path_pweb.'biblioteca-amivtac.php?idbiblioteca='.$publicacion['idbiblioteca'].'&'.$db->url().'" >'.$publicacion['subcarpeta'].'</a></strong><br>';
                                }else{
                                	echo '<p align="center"><strong><a href="'.$path_pweb.'biblioteca-piarc.php?idbiblioteca='.$publicacion['idbiblioteca'].'&'.$db->url().'" >'.$publicacion['subcarpeta'].'</a></strong><br>';
                                }
                                if(trim($publicacion['autor']) != ''){
                                	echo 'Autor: '.$publicacion['autor'].'<br>';
    							}
    							if(trim($publicacion['fecha_material']) != '' && trim($publicacion['fecha_material']) != '00-00-00 00:00:00'){
                                	echo'Fecha: '.substr($publicacion['fecha_material'],0,2)."  ".$meses[(int)substr($publicacion['fecha_material'],3,2)].'</p>';
    							}
                                echo'</div></div>';                        		
                        	}
                        }
                        ?>
                        </div><!-- /.flat-testimonial -->
                    </div><!-- /.col-md-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.flat-row -->


        <!-- Vinculos relacionados -->
        <div class="flat-row">
            <div class="container">
            <!-- Section Header -->
					<div class="section-header">
						<div class="section-title-border">
							<h2>Vinculos relacionados</h2>
						</div>
                    </div>
            <!-- Section Header /- -->
            
                <div class="row">
                
                    <div class="col-md-2">
                        <div class="vinculos-image style">
                            <div class="item-img">
                                <img src="images/vinculos/vinculos-1.jpg" alt="Vinculo 1">
                            </div>
                            <p class="tooltip">5to. Seminario Internacional de Puentes</p>
                        </div>
                    </div><!-- /.col-md-2 -->
                    
                    <div class="col-md-2">
                        <div class="vinculos-image style">
                            <div class="item-img">
                                <img src="images/vinculos/vinculos-2.jpg" alt="Vinculo 2">
                            </div>
                            <p class="tooltip">X Seminario de Ingenier&iacute;a Vial</p>
                        </div>
                    </div><!-- /.col-md-2 -->

                    <div class="col-md-2">
                        <div class="vinculos-image style">
                            <div class="item-img">
                                <img src="images/vinculos/vinculos-3.jpg" alt="Vinculo 3">
                            </div>
                            <p class="tooltip">XXI Reuni&oacute;n Nacional</p>
                        </div>
                    </div><!-- /.col-md-2 -->

                    <div class="col-md-2">
                        <div class="vinculos-image style">
                            <div class="item-img">
                                <img src="images/vinculos/vinculos-4.jpg" alt="Vinculo 4">
                            </div>
                            <p class="tooltip">Seminario Internacional</p>
                        </div>
                    </div><!-- /.col-md-2 -->
                    
                    <div class="col-md-2">
                        <div class="vinculos-image style">
                            <div class="item-img">
                                <img src="images/vinculos/vinculos-5.jpg" alt="Vinculo 5">
                            </div>
                            <p class="tooltip">Material de Cursos 2015-2016</p>
                        </div>
                    </div><!-- /.col-md-2 -->
                    
                    <div class="col-md-2">
                        <div class="vinculos-image style">
                            <div class="item-img">
                                <img src="images/vinculos/vinculos-6.jpg" alt="Vinculo 6">
                            </div>
                            <p class="tooltip">Publicaciones</p>
                        </div>
                    </div><!-- /.col-md-2 -->

                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.flat-row -->
        <div class="padding-100"></div>
       
        
        <!-- Footer -->
        <?php include_once($path_psis."footer.php")?>
		<!-- Footer Section /- -->

        <!-- Go Top -->
        <a class="go-top">
            <i class="fa fa-chevron-up"></i>
        </a>   
    </div>
     <?php include_once($path_psis."scripts.php")?>
</body>
</html>