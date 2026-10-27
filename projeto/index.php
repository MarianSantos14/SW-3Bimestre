<?php
include "config.php";
include DBAPI;
include HEADER_TEMPLATE;
if (!isset($_SESSION)) session_start();
$db = open_database();
?>

<h1 class="colordeco">Dashboard</h1>

<hr>

<?php if ($db): ?>

    <div class="row g-3 justify-content-center">

        <!-- Novo Cliente -->
        <div class="col-6 col-lg-2">
            <a href="customers/add.php" class="btn bg-pink2 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center flex-column gap-1 p-2">
                    <i class="fa-solid fa-user-plus fa-3x fa-lg-4x"></i>
                    <span>Novo Cliente</span>
                </div>
            </a>
        </div>

        <!-- Clientes -->
        <div class="col-6 col-lg-2">
            <a href="customers" class="btn bg-pink3 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center flex-column gap-1 p-2">
                    <i class="fa-solid fa-users fa-3x"></i>
                    <span>Clientes</span>
                </div>
            </a>
        </div>

        <!-- Novo Produto -->
        <div class="col-6 col-lg-2">
            <a href="produtos/add.php" class="btn bg-pink2 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center flex-column gap-1 p-2">
                    <i class="fa-solid fa-plus fa-3x"></i>
                    <span>Novo Livro</span>
                </div>
            </a>
        </div>

        <!-- Produtos -->
        <div class="col-6 col-lg-2">
            <a href="produtos" class="btn bg-pink3 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center flex-column gap-1 p-2">
                    <i class="fa-solid fa-book fa-3x"></i>
                    <span>Livros</span>
                </div>
            </a>
        </div>

        <!-- Novo Usuário -->
        <div class="col-6 col-lg-2">
            <a href="usuarios/add.php" class="btn bg-pink2 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center flex-column gap-1 p-2">
                    <i class="fa-solid fa-user-gear fa-3x"></i>
                    <span>Novo Usuário</span>
                </div>
            </a>
        </div>

        <!-- Usuários -->
        <div class="col-6 col-lg-2">
            <a href="usuarios" class="btn bg-pink3 w-100 h-100">
                <div class="d-flex align-items-center justify-content-center flex-column gap-1 p-2">
                    <i class="fa-solid fa-user-tie fa-3x"></i>
                    <span>Usuários</span>
                </div>
            </a>
        </div>

    </div>

<?php else: ?>

    <div class="alert alert-danger" role="alert">
        <p><strong>ERRO:</strong> Não foi possível conectar ao banco de dados!</p>
    </div>

<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>
