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
                Clientes
            </li>
        </ol>
    </nav>

    <div>
        <h2 class="colordeco">Clientes</h2>
    </div>

    <div class="row">
        <div class="col-md-6">
            <form action="index.php" method="GET" class="mb-3">
                <div class="d-flex align-items-center justify-content-start gap-2 ">

                    <div class="flex-grow-1" style="min-width: 180px; max-width: 350px;">
                        <input type="text" name="search" class="form-control"
                            placeholder="Pesquisar cliente pelo nome..."
                            value="<?= htmlspecialchars($_GET['search'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
                    </div>
                    <button type="submit" class="btn bg-pink2">
                        <i class="fa-solid fa-magnifying-glass"></i> Pesquisar
                    </button>

                    <a href="index.php" class="btn bg-pink3">
                        <i class="fa-solid fa-eraser me-2"></i>Limpar
                    </a>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <div class="d-flex justify-content-end">
                <div class="d-flex align-items-center gap-2">
                    <a href="add.php" class="btn bg-pink2 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-user-plus"></i>Novo Cliente
                    </a>
                    <a href="index.php" class="btn bg-pink3 d-flex align-items-center gap-2">
                        <i class="fa-solid fa-arrows-rotate"></i> Atualizar
                    </a>
                </div>
            </div>
        </div>

    </div>

</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?= $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?= $_SESSION['message']; ?>
    </div>
<?php // clear_messages(); ?>
<?php endif; ?>

<hr>

<table class="table table-hover tabela-clientes">
    <thead>
        <tr>
            <th>ID</th>
            <th width="25%">Nome</th>
            <th>E-mail</th>
            <th class="col-cpf">CPF/CNPJ</th>
            <th class="col-mobile">Telefone</th>
            <th class="col-modified">Atualizado em</th>
            <th>Foto</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($customers): ?>
            <?php foreach ($customers as $customer): ?>
                <tr>
                    <td>
                        <?= $customer['id']; ?>
                    </td>
                    <td>
                        <?= $customer['name']; ?>
                    </td>
                    <td>
                        <?= $customer['email']; ?>
                    </td>
                    <td class="col-cpf">
                        <?= formatarCpfCnpj($customer['cpf_cnpj']); ?>
                    </td>
                    <td class="col-mobile">
                        <?= formatPhone($customer['mobile']); ?>
                    </td>
                    <td class="col-modified">
                        <?php
                        $dt = new DateTime($customer['modified'], new DateTimeZone("-0300"));
                        echo $dt->format("d/m/y - H:i:s")
                            ?>
                    </td>
                    <td>
                        <?php
                        $caminhoImagem = !empty($customer['img'])
                            ? '/SW-3Bimestre/projeto/' . ltrim($customer['img'], '/')
                            : '/SW-3Bimestre/projeto/img/no-image.png';
                        ?>

                        <img src="<?= htmlspecialchars($caminhoImagem, ENT_QUOTES, 'UTF-8') ?>"
                            alt="Foto de <?= htmlspecialchars($customer['name'], ENT_QUOTES, 'UTF-8') ?>" style="width: 80px; height: 80px; object-fit: cover;
               border: 3px solid #b44a7f; display: block;" onerror="this.style.display='none';">
                    </td>

                    <td class="actions text-end">
                        <div class="d-flex justify-content-center align-items-center gap-2 flex-wrap">
                            <a href="view.php?id=<?= $customer['id']; ?>" class="btn btn-sm bg-pink1">
                                <i class="fa-solid fa-eye"></i> Visualizar
                            </a>

                            <a href="edit.php?id=<?= $customer['id']; ?>" class="btn btn-sm bg-pink2">
                                <i class="fa-solid fa-pencil"></i> Editar
                            </a>

                            <a href="#" class="btn btn-sm bg-pink3" data-bs-toggle="modal" data-bs-target="#delete-modal"
                                data-customer="<?= $customer['id']; ?>">
                                <i class="fa-solid fa-trash"></i> Excluir
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php
include "modal.php";
include FOOTER_TEMPLATE;
?>