<?php
include "functions.php";
index();
include HEADER_TEMPLATE;
?>

<header>
    <div class="d-flex align-items-center justify-content-between">
        <div>
            <h2>Clientes</h2>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="add.php" class="btn btn-primary d-flex align-items-center gap-2">
                <i class="fa-solid fa-user-plus"></i>Novo Cliente
            </a>
            <a href="index.php" class="btn btn-secondary d-flex align-items-center gap-2">
                <i class="fa fa-users"></i>Atualizar
            </a>
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

<table class="table table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th width="30%">Nome</th>
            <th>CPF/CNPJ</th>
            <th>Telefone</th>
            <th>Atualizado em</th>
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
                        <?= $customer['cpf_cnpj']; ?>
                    </td>
                    <td>
                        <?= $customer['mobile']; ?>
                    </td>
                    <td>
                        <?php 
                        $dt = new DateTime( $customer['modified'], new DateTimeZone("-0300"));
                        echo $dt->format("d/m/y - H:i:s")
                        ?>
                    </td>
                    <td class="actions text-end d-flex justify-content-center gap-2 flex-wrap">
                        <a href="view.php?id=<?= $customer['id']; ?>" class="btn btn-sm btn-secondary text-white">
                            <i class="fa-solid fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?= $customer['id']; ?>" class="btn btn-sm btn-primary text-white">
                            <i class="fa-solid fa-pencil"></i> Editar</a>
                        <a href="#" data-toggle="modal" data-target="#delete-modal" class="btn btn-sm btn-danger text-white"
                            data-customer="<?= $customer['id']; ?>">
                            <i class="fa-solid fa-trash"></i> Excluir
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum registro encontrado.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include FOOTER_TEMPLATE; ?>