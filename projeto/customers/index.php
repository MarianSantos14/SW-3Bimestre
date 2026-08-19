<?php
include "functions.php";
index();
include HEADER_TEMPLATE;
?>

<header>
    <div class="row">
        <div class="col-4">
            <h2>Clientes</h2>
        </div>
        <div class="col-8 text-end h2">
            <a class="btn btn-secondary" href="add.php"><i class="fa-solid fa-user-plus"></i> Novo Cliente</a>
            <a class="btn btn-light text-light" href="index.php"><i class="fa fa-users"></i> Atualizar</a>
        </div>
    </div>
</header>

<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['type']; ?> alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
        <?php echo $_SESSION['message']; ?>
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
                        <?php echo $customer['id']; ?>
                    </td>
                    <td>
                        <?php echo $customer['name']; ?>
                    </td>
                    <td>
                        <?php echo $customer['cpf_cnpj']; ?>
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
                    <td class="actions text-end">
                        <a href="view.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-light text-white">
                            <i class="fa-solid fa-eye"></i> Visualizar</a>
                        <a href="edit.php?id=<?php echo $customer['id']; ?>" class="btn btn-sm btn-secondary">
                            <i class="fa-solid fa-pencil"></i> Editar</a>
                        <a href="#" class="btn btn-sm btn-dark" data-toggle="modal" data-target="#delete-modal"
                            data-customer="<?php echo $customer['id']; ?>">
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