<?php
include "functions.php";
index();
include HEADER_TEMPLATE;
?>

<header>

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/SW-3Bimestre/projeto/index.php">
                    <i class="fa-solid fa-house"></i> Início
                </a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                Usuários
            </li>
        </ol>
    </nav>

    <div>
        <h2 class="colordeco">Usuários</h2>
    </div>

    <div class="row">

        <div class="col-md-6">
            <form action="index.php" method="GET" class="mb-3">
                <div class="d-flex align-items-center justify-content-start gap-2">

                    <div class="flex-grow-1" style="min-width: 180px; max-width: 350px;">
                        <input type="text" name="search" class="form-control"
                            placeholder="Pesquisar usuário pelo nome..."
                            value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>

                    <button type="submit" class="btn bg-pink2">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        Pesquisar
                    </button>

                    <a href="index.php" class="btn bg-pink3">
                        <i class="fa-solid fa-eraser me-2"></i>
                        Limpar
                    </a>

                </div>
            </form>
        </div>

        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <div class="d-flex align-items-center gap-2">

                    <a href="add.php" class="btn bg-pink2 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-user-plus"></i>
                        Novo Usuário
                    </a>

                    <a href="index.php" class="btn bg-pink3 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-arrows-rotate"></i>
                        Atualizar
                    </a>

                </div>
            </div>
        </div>

    </div>

</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?= htmlspecialchars($_SESSION['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?> alert-dismissible"
        role="alert">

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>

        <?= htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); ?>

    </div>
    <?php  clear_messages(); ?>

<?php endif; ?>

<hr>

<table class="table table-hover tabela-clientes">

    <thead>
        <tr>
            <th>ID</th>
            <th width="30%">Nome</th>
            <th>Nome de usuário</th>
            <th>Senha</th>
            <th>Foto</th>
            <th>Opções</th>
        </tr>
    </thead>

    <tbody>

        <?php if (!empty($users)): ?>

            <?php foreach ($users as $user): ?>

                <tr>

                    <td>
                        <?= (int) $user['id']; ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>

                    <td>
                        <?= htmlspecialchars($user['user'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>

                    <td>
                        <?= str_repeat('•', strlen($user['password'])); ?>
                    </td>

                    <td>
                        <?php
                        $caminhoImagem = !empty($user['foto'])
                            ? '/SW-3Bimestre/projeto/' . ltrim($user['foto'], '/')
                            : '/SW-3Bimestre/projeto/img/no-image.png';
                        ?>

                        <img src="<?= htmlspecialchars($caminhoImagem, ENT_QUOTES, 'UTF-8') ?>"
                            alt="Foto de <?= htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8') ?>" style="width: 80px; height: 80px; object-fit: cover;
               border: 3px solid #b44a7f; display: block;" onerror="this.style.display='none';">
                    </td>
                    <!-- Opções -->
                    <td class="actions text-end">

                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">

                            <a href="view.php?id=<?= (int) $user['id']; ?>" class="btn btn-sm bg-pink1">
                                <i class="fa-solid fa-eye"></i>
                                Visualizar
                            </a>

                            <a href="edit.php?id=<?= (int) $user['id']; ?>" class="btn btn-sm bg-pink2">
                                <i class="fa-solid fa-pencil"></i>
                                Editar
                            </a>

                            <a href="#" class="btn btn-sm bg-pink3" data-bs-toggle="modal" data-bs-target="#delete-modal"
                                data-customer="<?= (int) $user['id']; ?>">
                                <i class="fa-solid fa-trash"></i>
                                Excluir
                            </a>

                        </div>

                    </td>

                </tr>

            <?php endforeach; ?>

        <?php else: ?>

            <tr>
                <td colspan="5" class="text-center">
                    Nenhum usuário encontrado.
                </td>
            </tr>

        <?php endif; ?>

    </tbody>

</table>

<?php
include "modal.php";
include FOOTER_TEMPLATE;
?>