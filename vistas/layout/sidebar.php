<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            <form class="form-inline mr-auto">
                <ul class="navbar-nav mr-3">
                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
                    <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
                </ul>

            </form>
            <ul class="navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="nav-link nav-link-lg nav-link-user">
                        <div class="d-sm-none d-lg-inline-block">Bienvenido, <?= $_SESSION['nombre'] ?></div>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="main-sidebar sidebar-style-2">
            <aside id="sidebar-wrapper">
                <?php $ex = $_SESSION['tipo'] == 'adm' ? 'homeAdmin.php' : 'homeEst.php' ?>
                <div class="sidebar-brand">
                    <a href="<?= $ex ?>">Cursos</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                    <a href="<?= $ex ?>">Cu</a>
                </div>
                <ul class="sidebar-menu">
                    <?php if ($_SESSION['tipo'] == 'adm') : ?>
                        <li id="menuHomeAdmin">
                            <a class="nav-link" href="homeAdmin.php">
                                <i class="far fa-square"></i>
                                <span>Inicio</span>
                            </a>
                        </li>
                        <li id="menuAlumnos">
                            <a class="nav-link" href="alumnos.php">
                                <i class="fas fa-user-graduate"></i>
                                <span>Alumnos</span>
                            </a>
                        </li>
                        <li id="menuCursos">
                            <a class="nav-link" href="cursos.php">
                                <i class="fas fa-sitemap"></i>
                                <span>Cursos</span>
                            </a>
                        </li>
                        <li id="menuTiposArchivos">
                            <a class="nav-link" href="tiposArchivos.php">
                                <i class="fas fa-clipboard"></i>
                                <span>Tipos de archivos</span>
                            </a>
                        </li>
                    <?php elseif ($_SESSION['tipo'] == 'est') : ?>
                        <li id="menuCursoEstudiantes">
                            <a class="nav-link" href="cursosEstudiante.php">
                                <i class="far fa-square"></i>
                                <span>Cursos</span>
                            </a>
                        </li>
                    <?php endif; ?>
                    <li>
                        <a class="nav-link" href="../ajax/loginAjax.php?op=salir">
                            <i class="far fa-times-circle"></i>
                            <span>Salir</span>
                        </a>
                    </li>
                </ul>
            </aside>
        </div>