<?php
include "functions.php";
view($_GET['id']);
include HEADER_TEMPLATE;

/** @var array $customer */
?>

<h2 class="colordeco">Cliente <?= $customer['id']; ?></h2>
<hr>

<?php if (!empty($_SESSION['message'])): ?>
	<div class="alert alert-<?= $_SESSION['type']; ?>"><?= $_SESSION['message']; ?></div>
<?php endif; ?>

<div class="row">
	<div class="col-md-6">
		<dl class="dl-horizontal">
			<dt>Nome / Razão Social:</dt>
			<dd><?= $customer['name']; ?></dd>

			<dt>CPF / CNPJ:</dt>
			<dd><?= formatarCpfCnpj($customer['cpf_cnpj']); ?></dd>

			<dt>Data de Nascimento:</dt>
			<dd><?= formatarData($customer['birthdate']) ?></dd>

			<dt>Endereço:</dt>
			<dd><?= $customer['address']; ?></dd>

			<dt>Bairro:</dt>
			<dd><?= $customer['hood']; ?></dd>

			<dt>CEP:</dt>
			<dd><?= formatarCEP($customer['zip_code']); ?></dd>

			<dt>Data de Cadastro:</dt>
			<dd><?= formatarData($customer['created'], 'd/m/Y - h:m:s') ?></dd>

			<dt>Data da última alteração:</dt>
			<dd><?= formatarData($customer['modified'], 'd/m/Y - h:m:s') ?></dd>
		</dl>


	</div>
	<div class="col-md-6">
		<div class="text-center mb-4">
			<img src="<?= !empty($customer['img'])
				? '/SW-3Bimestre/projeto/' . ltrim($customer['img'], '/')
				: '/SW-3Bimestre/projeto/img/no-image.png' ?>" alt="Foto do cliente" style="width: 350px; height: 350px; object-fit: cover;
				   border-radius: 50%; border: 6px solid #b44a7f;">
		</div>
	</div>
</div>

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
	<dd><?= number_format($customer['ie'], 0, '', '.'); ?></dd>
</dl>

<div id="actions" class="row">
	<div class="col-md-12">
		<a href="edit.php?id=<?= $customer['id']; ?>" class="btn bg-pink2"><i
				class="fa-solid fa-pencil me-2"></i>Editar</a>
		<a href="index.php" class="btn bg-pink3"><i class="fa-solid fa-arrow-left me-2"></i>Voltar</a>
	</div>
</div>

<?php include FOOTER_TEMPLATE; ?>