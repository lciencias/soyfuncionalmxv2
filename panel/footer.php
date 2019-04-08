<?php
if ($_SESSION && $_SESSION['userId'] > 0){
?>
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2019 <a href="<?=$pathWeb?>">Soy Funcional MX</a>.</strong> Derechos reservados.
    </footer>
<?php
}
?>