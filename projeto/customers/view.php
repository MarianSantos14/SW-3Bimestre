<?php
include "functions.php";
view($_GET['id']);
include HEADER_TEMPLATE;

/** @var array $customer */
?>

<h2>Cliente <?= $customer['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])) : ?>
	<div class="alert alert-<?= $_SESSION['type']; ?>"><?= $_SESSION['message']; ?></div>
<?php endif; ?>

<dl class="dl-horizontal">
	<dt>Nome / Razão Social:</dt>
	<dd><?= $customer['name']; ?></dd>

	<dt>CPF / CNPJ:</dt>
	<dd><?= $customer['cpf_cnpj']; ?></dd>

	<dt>Data de Nascimento:</dt>
	<dd><?= formatarData($customer['birthdate']) ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Endereço:</dt>
	<dd><?= $customer['address']; ?></dd>

	<dt>Bairro:</dt>
	<dd><?= $customer['hood']; ?></dd>

	<dt>CEP:</dt>
	<dd><?= $customer['zip_code']; ?></dd>

	<dt>Data de Cadastro:</dt>
	<dd><?= formatarData($customer['created'], 'd/m/Y - h:m:s') ?></dd>

	<dt>Data da última alteração:</dt>
	<dd><?= formatarData($customer['modified'], 'd/m/Y - h:m:s') ?></dd>
</dl>

<dl class="dl-horizontal">
	<dt>Cidade:</dt>
	<dd><?= $customer['city']; ?></dd>

	<dt>Telefone:</dt>
	<dd><?= formatPhone($customer['phone']); ?></dd>

	<dt>Celular:</dt>
	<dd><?= formatPhone($customer['mobile']); ?></dd>

	<dt>UF:</dt>
	<dd><?= $customer['state']; ?></dd>

	<dt>Inscrição Estadual:</dt>
	<dd><?= $customer['ie']; ?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
		<a href="edit.php?id=<?= $customer['id']; ?>" class="btn btn-secondary"><i class="fa-solid fa-pencil me-2"></i>Editar</a>
		<a href="index.php" class="btn btn-danger"><i class="fa-solid fa-arrow-rotate-left me-2"></i>Voltar</a>
	</div>
</div>

<?php include FOOTER_TEMPLATE; ?>