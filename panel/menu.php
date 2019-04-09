<?php
if ($_SESSION && $_SESSION['userId'] > 0){
?>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="treeview">
          <a href="#">
            <i class="glyphicon glyphicon-list-alt"></i>
            <span>Men&uacute; Principal</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?=$pathWeb?>admin.php?idT=0&idS=0&<?=$ext?>"><i class="glyphicon glyphicon-folder-close"></i> Inicio</a></li>
            <li><a href="<?=$pathWeb?>admin.php?idT=1&idS=1&<?=$ext?>"><i class="glyphicon glyphicon-user"></i> Usuarios</a></li>
            <li><a href="<?=$pathWeb?>admin.php?idT=2&idS=0&<?=$ext?>"><i class="glyphicon glyphicon-picture"></i> Banners</a></li>
            <li><a href="<?=$pathWeb?>admin.php?idT=3&idS=0&<?=$ext?>"><i class="glyphicon glyphicon-list"></i> Categorias</a></li>
            <li><a href="<?=$pathWeb?>admin.php?idT=4&idS=0&<?=$ext?>"><i class="glyphicon glyphicon-cutlery"></i> Productos</a></li>
            <li><a href="<?=$pathWeb?>admin.php?idT=5&idS=0&<?=$ext?>"><i class="glyphicon glyphicon-edit"></i> Pedidos</a></li>
            <li><a href="<?=$pathWeb?>admin.php?idT=6&idS=0&<?=$ext?>"><i class="glyphicon glyphicon-pencil"></i> Testimoniales</a></li>
          </ul>
        </li>
      </ul>
<?php
}
?>