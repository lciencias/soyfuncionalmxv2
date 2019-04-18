<?php
  include_once("include.php");
  include_once($pathCla."Conexion.class.php");
  include_once($pathCla."Comunes.class.php");
  include_once($pathCla."Slider.class.php");
  include_once($pathCla."Categoria.class.php");
  include_once($pathCla."Producto.class.php");
  include_once($pathCla."Testimonial.class.php");
  include_once($pathCla."Preguntas.class.php");
  include_once($pathSis."panel/DBconfig.php");
  $db     = new Conexion ( $_dbhost, $_dbuname, $_dbpass, $_dbname, $_port );
  $slide  = new Slider($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB,Comunes::LISTAR);
  $sliders= $slide->obtenRegistros();
  $categ  = new Categoria($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $categs = $categ->obtenRegistros();
  $prod   = new Producto($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $prods  = $prod->obtenRegistros();
  $testi  = new Testimonial($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $testim = $testi->obtenRegistros();
  $preg   = new Preguntas($db,$_SESSION,$_REQUEST,Comunes::LISTAR,Comunes::WEB);
  $pregun = $preg->obtenRegistros();
  include_once("header.php");
?>
	<body>
		<input type="hidden" id="baseUrl" name="baseUrl" value="<?=$pathWeb?>" />
		<input type="hidden" id="sessionId" name="sesionId" value="<?=$_SESSION['visitante']?>" />
		<div class="preloader">
			<div class="preloader-body">
				<div class="cssload-bell">
					<div class="cssload-circle">
						<div class="cssload-inner"></div>
					</div>
					<div class="cssload-circle">
						<div class="cssload-inner"></div>
					</div>
					<div class="cssload-circle">
						<div class="cssload-inner"></div>
					</div>
					<div class="cssload-circle">
						<div class="cssload-inner"></div>
					</div>
					<div class="cssload-circle">
						<div class="cssload-inner"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="page">
			<header class="section page-header">
			<?php
				require_once($pathSis."superior.php");
			?>
			</header>
			<!-- Swiper-->
			<section class="section swiper-container swiper-slider swiper-slider-1" data-loop="false">
			<?php
				require_once($pathSis."banners.php");
			?>
			</section>
			<!-- About -->
			<section class="section bg-default text-md-left section-md-inset">
			<?php
				require_once($pathSis."about.php");
			?>
			</section>
			<!-- Services-->
			<section class="section parallax-container" data-parallax-img="<?=$pathWeb?>images/parallax-3.jpg">
			<?php
				require_once($pathSis."servicios.php");
			?>
			</section>
			<!-- New Products-->
			<section class="section section-xxl bg-default">
			<?php
				require_once($pathSis."productos.php");
			?>
			</section>
			<!-- Testimoniales -->
			<section class="section section-xxl" style="background: url('<?=$pathWeb?>images/bg-image-5.jpg') no-repeat; background-position: center; background-size:cover;">
			<?php
				require_once("testimoniales.php");
			?>
			</section>
			<!-- Testimoniales -->
			<section class="section section-sm section-first bg-default text-md-left">
			<?php
				require_once($pathSis."preguntas.php");
			?>
			</section>
			<!-- Mapa -->
			<section class="section">
			<?php
				require_once($pathSis."mapa.php");
			?>
			</section>
			<!-- Page Footer-->
			<?php
				require_once("footer.php");
				require_once($pathSis."mtestimonial.php");
				require_once($pathSis."mpregunta.php");
			?>
		</div>
		<div class="snackbars" id="form-output-global"></div>
<?php
	#require_once($pathSis."mtestimonial.php");
	#require_once($pathSis."mpregunta.php");
	require_once($pathSis."scripts.php");
?>