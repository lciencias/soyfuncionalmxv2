<?php
if ($_SESSION && $_SESSION['userId'] > 0 && $_SESSION['pendientesT'] > 0){
?>
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?=$_SESSION['pendientesT']?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">Tienes <?=$_SESSION['pendientesT']?> sin entregar</li>
              <li>
                <ul class="menu">
                <?php
                foreach($_SESSION['pendientes'] as $ind => $data){
                ?>
                  <li><!-- start message -->
                    <a href="#">
                      <h4>Pedido <?=str_pad($data['id'],6,'0',STR_PAD_LEFT)?>
                        <small><i class="fa fa-clock-o"></i><?=$data['fecha_entrega']?></small>
                      </h4>
                      <p><?=$data['nombre']?><br><?=$data['celular']?></p>
                    </a>
                  </li>
                <?php
                }
                ?>
                </ul>
              </li>
              <li class="footer"><a href="<?=$pathWeb?>admin.php?idT=5&idS=0">Ver Todos</a></li>
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