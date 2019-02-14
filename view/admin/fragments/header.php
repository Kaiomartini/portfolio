<?php

if(!isset($_SESSION['usuario'])){
header('Location: entrar');
}


?>
<!doctype html>
<html lang="pt">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Admin</title>
    <base href="http://<?= $_SERVER['SERVER_NAME'] . ($_SERVER['SERVER_NAME'] <> 'kaique.tech' ? "/portifolio/view/admin/" : '/admin/'); ?>">
    <link href="css/pace.css" rel="stylesheet">
    <script data-pace-options='{"ajax": false}' src="js/pace.min.js"></script>
    <link rel="icon" href="favicon.ico">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/material-dashboard.css" rel="stylesheet">
    <link href="css/datatables.min.css" rel="stylesheet">
    <link href="css/select2.min.css" rel="stylesheet">
    <script src="js/jquery-3.3.1.min.js"></script

</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="sair"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar h5 text-center">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#projetosNav" data-toggle="collapse" aria-expanded="false">
                           
                            Projetos
                        </a>
                        <div class="collapse<?= ($_GET['Pagina'] == 'projeto' or $_GET['Pagina'] == 'projetoListar') ? ' show' : '' ?>" id="projetosNav">
                            <ul class="nav flex-column h6">
                                <li class="nav-item<?= $_GET['Pagina'] == 'projeto' ? ' active' : '' ?>">
                                    <a class="nav-link" href="projeto/">
                                         Novo
                                    </a>
                                </li>
                                <li class="nav-item<?= $_GET['Pagina'] == 'projetoListar' ? ' active' : '' ?>">
                                    <a class="nav-link" href="projeto/listar">
                                         Lista
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#categoriasNav" data-toggle="collapse" aria-expanded="false">
                            
                            Categorias
                        </a>
                        <div class="collapse<?= ($_GET['Pagina'] == 'categoria' or $_GET['Pagina'] == 'categoriaListar') ? ' show' : '' ?>" id="categoriasNav">
                            <ul class="nav flex-column h6">
                                <li class="nav-item<?= $_GET['Pagina'] == 'categoria' ? ' active' : '' ?>">
                                    <a class="nav-link" href="categoria/">
                                        Novo
                                    </a>
                                </li>
                                <li class="nav-item<?= $_GET['Pagina'] == 'categoriaListar' ? ' active' : '' ?>">
                                    <a class="nav-link" href="categoria/listar">
                                         Lista
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#materiasNav" data-toggle="collapse" aria-expanded="false">
                            
                            Matérias
                        </a>
                        <div class="collapse<?= ($_GET['Pagina'] == 'materia' or $_GET['Pagina'] == 'materiaListar') ? ' show' : '' ?>" id="materiasNav">
                            <ul class="nav flex-column h6">
                                <li class="nav-item<?= $_GET['Pagina'] == 'materia' ? ' active' : '' ?>">
                                    <a class="nav-link" href="materia/">
                                         Novo
                                    </a>
                                </li>
                                <li class="nav-item<?= $_GET['Pagina'] == 'materiaListar' ? ' active' : '' ?>">
                                    <a class="nav-link" href="materia/listar">
                                         Lista
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#professoresNav" data-toggle="collapse" aria-expanded="false">
                            
                            Professores
                        </a>
                        <div class="collapse<?= ($_GET['Pagina'] == 'professor' or $_GET['Pagina'] == 'professorListar') ? ' show' : '' ?>" id="professoresNav">
                            <ul class="nav flex-column h6">
                                <li class="nav-item<?= $_GET['Pagina'] == 'professor' ? ' active' : '' ?>">
                                    <a class="nav-link" href="professor/">
                                         Novo
                                    </a>
                                </li>
                                <li class="nav-item<?= $_GET['Pagina'] == 'professorListar' ? ' active' : '' ?>">
                                    <a class="nav-link" href="professor/listar">
                                        Lista
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-toggle" href="#semestresNav" data-toggle="collapse" aria-expanded="false">
                            
                            Semestres
                        </a>
                        <div class="collapse<?= ($_GET['Pagina'] == 'semestre' or $_GET['Pagina'] == 'semestreListar') ? ' show' : '' ?>" id="semestresNav">
                            <ul class="nav flex-column h6">
                                <li class="nav-item<?= $_GET['Pagina'] == 'semestre' ? ' active' : '' ?>">
                                    <a class="nav-link" href="semestre/">
                                       Novo
                                    </a>
                                </li>
                                <li class="nav-item<?= $_GET['Pagina'] == 'semestreListar' ? ' active' : '' ?>">
                                    <a class="nav-link" href="semestre/listar">
                                         Lista
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">