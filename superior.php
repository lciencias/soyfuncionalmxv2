<div class="rd-navbar-wrap">
	<nav class="rd-navbar rd-navbar-classic" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="100px" data-xl-stick-up-offset="100px" data-xxl-stick-up-offset="100px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
		<div class="rd-navbar-main-outer">
			<div class="rd-navbar-main">      
				<div class="rd-navbar-panel">
					<button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
					<div class="rd-navbar-brand">
						<a class="brand" href="<?=$pathWeb?>">
							<p>
								<span style="font-family: kalam, cursive;font-size: 45px;color:#e7e76a;">Soy</span>
							 	<span style="font-family: kalam, cursive;font-size: 45px;color:#002857;">Funcional MX</span></p> 
							<!--img class="brand-logo-dark"  src="<?=$pathWeb?>images/soyfuncionalmx.png" alt=""/>-->
							<!--<img class="brand-logo-light" src="<?=$pathWeb?>images/logo-inverse-249x52.png" alt="" width="500" height="52"/>-->
						</a>
					</div>
				</div>
                <div class="rd-navbar-nav-wrap">
					<?php require_once($pathSis."menu.php"); ?>
                </div>
                <div class="rd-navbar-main-element">
					<div class="rd-navbar-basket-wrap">
						<button class="rd-navbar-basket fl-bigmug-line-shopping202" data-rd-navbar-toggle=".cart-inline"><span>2</span></button>
						<div class="cart-inline">
							<div class="cart-inline-header">
								<h5 class="cart-inline-title">In cart:<span> 2</span> Products</h5>
								<h6 class="cart-inline-title">Total price:<span> $43</span></h6>
							</div>
							<div class="cart-inline-body">
								<div class="cart-inline-item">
									<div class="unit unit-spacing-sm align-items-center">
										<div class="unit-left">
											<a class="cart-inline-figure" href="<?=$pathWeb?>single-product.html">
												<img src="<?=$pathWeb?>images/product-mini-6-100x90.png" alt="" width="100" height="90"/>
											</a>
										</div>
										<div class="unit-body">
											<h6 class="cart-inline-name"><a href="single-product.html">Oranges</a></h6>
											<div>	
												<div class="group-xs group-middle">
													<div class="table-cart-stepper">
														<input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000"/>
													</div>
													<h6 class="cart-inline-title">$20.00</h6>
												 </div>
											</div>
										</div>
									</div>
								</div>
								<div class="cart-inline-item">
									<div class="unit unit-spacing-sm align-items-center">
										<div class="unit-left">
											<a class="cart-inline-figure" href="<?=$pathWeb?>single-product.html">
												<img src="<?=$pathWeb?>images/product-mini-7-100x90.png" alt="" width="100" height="90"/>
											</a>
										</div>
										<div class="unit-body">
											<h6 class="cart-inline-name"><a href="single-product.html">Bananas</a></h6>
											<div>
												<div class="group-xs group-middle">
													<div class="table-cart-stepper">
														<input class="form-input" type="number" data-zeros="true" value="1" min="1" max="1000"/>
													</div>
													<h6 class="cart-inline-title">$23.00</h6>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="cart-inline-footer">
								<div class="group-sm">
									<a class="button button-default-outline-2 button-zakaria" href="<?=$pahWeb?>cart-page.html">Go to cart</a>
									<a class="button button-primary button-zakaria" href="checkout.html">Checkout</a>
								</div>
							</div>
						</div>
					</div>
					<a class="rd-navbar-basket rd-navbar-basket-mobile fl-bigmug-line-shopping202 rd-navbar-fixed-element-2" href="cart-page.html">
						<span>2</span>
					</a>
					<button class="rd-navbar-project-hamburger rd-navbar-project-hamburger-open rd-navbar-fixed-element-1" type="button" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate="data-multitoggle-isolate">
						<span class="project-hamburger">
							<span class="project-hamburger-line"></span>
							<span class="project-hamburger-line"></span>
							<span class="project-hamburger-line"></span>
							<span class="project-hamburger-line"></span>
						</span>
					</button>
				</div>
				<div class="rd-navbar-project">
					<div class="rd-navbar-project-header">
						<button class="rd-navbar-project-hamburger rd-navbar-project-hamburger-close" type="button" data-multitoggle=".rd-navbar-main" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate>
							<span class="project-close">
								<span></span>
								<span></span>
							</span>
						</button>
						<h5 class="rd-navbar-project-title">CONTACTO</h5>
					</div>
					<div class="rd-navbar-project-content">
						<div>
							<div>
								<div class="owl-carousel" data-items="1" data-dots="true" data-autoplay="true">
									<img src="<?=$pathWebb?>images/about-5-350x269.jpg" alt="" width="350" height="269"/>
									<img src="<?=$pathWebb?>images/about-6-350x269.jpg" alt="" width="350" height="269"/>
									<img src="<?=$pathWebb?>images/about-7-350x269.jpg" alt="" width="350" height="269"/>
								</div>
								<ul class="contacts-modern">
									<li>
										Plaza Toltecas. Calle 10 # 83<br>
										San Pedro de los Pinos<br>
										&Aacute;lvaro Obreg&oacute;n</a><br/>
										Tel: 55 51 31 86 96<br/>
										<a href="mailto:hola@soyfuncionalmx.com"><span class="">hola@soyfuncionalmx.com</span></a>
									</li>
								</ul>
							</div>
							<div>
								<ul class="list-inline list-social list-inline-xl">
									<li><a class="icon mdi mdi-facebook" href="https://www.facebook.com/soyfuncionalmx/"></a></li>
									<li><a class="icon mdi mdi-instagram" href="#"></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>
</div>