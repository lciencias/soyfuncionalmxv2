<?php
if ($_SESSION && $_SESSION['userId'] > 0){
?>
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes 4 pedidos</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=$pathWeb?>img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Pedido No. 23345
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Pedido 1</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=$pathWeb?>img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                      Pedido No. 23346
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Pedido 2</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=$pathWeb?>img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                      Pedido No. 23347
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Pedido 3</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?=$pathWeb?>img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                      Pedido No. 23348
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Pedido 4</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">Ver Todos</a></li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=$pathWeb?>img/user2-160x160.jpg" class="user-image" alt="Imagen Usuario">
              <span class="hidden-xs"><?=$_SESSION ['userNm']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=$pathWeb?>img/user2-160x160.jpg" class="img-circle" alt="Imagen Usuario">

                <p>
                <?=$_SESSION ['userNm']?> 
                  <small><?=$_SESSION ['fechaMov']?></small>
                </p>
              </li>
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Editar Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="<?=$pathWeb?>logout.php" class="btn btn-default btn-flat">Cerrar Sesi&oacute;n</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
<?php
}
?>