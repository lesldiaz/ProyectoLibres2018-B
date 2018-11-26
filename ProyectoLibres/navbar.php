<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php">Sistema de Gestión de Objetos de Aprendizaje</a>

    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarResponsive">
        <?php
            if ( isset($_SESSION["user"]) ) {
        ?>
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <?php
                if ( $_SESSION["userType"] == 'prof' ) {
            ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
                    <a class="nav-link" href="exe.php">
                        <i class="fa fa-fw fa-file-text-o"></i>
                        <span class="nav-link-text">Crear Objetos de Aprendizaje</span>
                    </a>
                </li>
            <?php } ?>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                    <i class="fa fa-fw fa-github"></i>
                    <span class="nav-link-text">Repositorio de Objetos de Aprendizaje</span>
                </a>
                <ul class="sidenav-second-level collapse" id="collapseComponents">
                    <?php
                        if ( $_SESSION["userType"] == 'prof' ) {
                    ?>
                        <li>
                            <a href="importar.php">Importar y catalogar Objetos de Aprendizaje</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="buscar.php">Buscar Objetos de Aprendizaje</a>
                    </li>
                </ul>
            </li>
            <?php
                if ( $_SESSION["userType"] != 'admin' ) {
            ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
                    <a class="nav-link" href="tools.php">
                        <i class="fa fa-external-link"></i>
                        <span class="nav-link-text">Herramientas Adicionales</span>
                    </a>
                </li>
            <?php } ?>
            <?php
                if ( $_SESSION["userType"] == 'admin' ) {
            ?>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="users.php">
                        <i class="fa fa-fw fa-address-book"></i>
                        <span class="nav-link-text">Usuarios</span>
                    </a>
                </li>
            <?php } ?>
        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <?php } else { ?>
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Crear">
                <a class="nav-link" href="login.php">
                    <i class="fa fa-fw fa-sign-in"></i>
                    <span class="nav-link-text">Por favor ingrese para poder usar el sistema.</span>
                </a>
            </li>

        </ul>
        <?php } ?>

        <ul class="navbar-nav ml-auto">
            <?php
                if ( ! isset($_SESSION["user"]) ) {
            ?>
            <li class="nav-item">
                <a class="nav-link" href="login.php">
                    <i class="fa fa-fw fa-sign-in"></i>Login</a>
            </li>
            <?php } else { ?>
                <li class="nav-item">
                <a class="nav-link" href="userprof.php">
                    <i class="fa fa-fw fa-user"></i>
                    <?php
                        if ( $_SESSION["userType"] == "admin" ) {
                            echo 'Administrador';
                        } else {
                            echo $_SESSION["userName"];
                        } 
                    ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            <?php } ?>
        </ul>

    </div>

</nav>