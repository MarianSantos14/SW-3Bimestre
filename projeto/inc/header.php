<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD com Bootstrap</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link rel="stylesheet" href="<?= BASEURL; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>css/all.min.css">
    <link rel="stylesheet" href="<?= BASEURL; ?>css/styles.css">

    <style>
        body {
            padding-top: 70px;
        }

        .btn-light {
            background-color: #ccc;
            border-color: #ccc;
            color: #fff;
        }

        .btn-light:houver {
            background-color: #aaa;
            border-color: #aaa;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-1 colordeco1" href="<?= BASEURL; ?>"><i
                    class="fa-solid fa-house"></i>CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarproj"
                aria-controls="navbarproj" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarproj">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-users"></i>
                            Clientes
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?= BASEURL; ?>customers">
                                    <i class="fa-solid fa-users me-2"></i>Gerenciar Clientes
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= BASEURL; ?>customers/add.php">
                                    <i class="fa-solid fa-user-plus me-2"></i>Novo Cliente
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-book"></i>
                            Livros
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?= BASEURL; ?>livros">
                                    <i class="fa-solid fa-book me-2"></i>Gerenciar Livros
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?= BASEURL; ?>livros/add.php">
                                    <i class="fa-solid fa-plus me-2"></i>Novo Livro
                                </a>
                            </li>
                        </ul>
                    </li>

                    <?php if (isset($_SESSION['user']) && $_SESSION['user'] == "admin"): ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <i class="fa-solid fa-user-gear"></i>
                                Usuários
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?= BASEURL; ?>usuarios">
                                        <i class="fa-solid fa-user-gear me-2"></i>Gerenciar Usuários
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="<?= BASEURL; ?>usuarios/add.php">
                                        <i class="fa-solid fa-user-plus me-2"></i>Novo Usuário
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>

                </ul>

                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>inc/logout.php">
                                <i class="fa-solid fa-person-walking-arrow-right"></i>
                                Desconectar
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= BASEURL; ?>inc/login.php">
                                <i class="fa-solid fa-right-to-bracket"></i>
                                Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container container-top">