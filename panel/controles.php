<?php
if ($_SESSION && $_SESSION['userId'] > 0){
?>
    <aside class="control-sidebar control-sidebar-dark">
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Cr&eacute;ditos</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:void(0)">
                        <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                        <div class="menu-info">
                            <h4 class="control-sidebar-subheading">CubeSoftware</h4>
                            <p>Ing. Luis Antonio Hern&aacute;ndex Nieto</p>
                        </div>
                        </a>
                    </li>       
                </ul>
            </div>
            <div class="tab-pane" id="control-sidebar-stats-tab">Contenidos</div>
        </div>
    </aside>
<?php
}
?>