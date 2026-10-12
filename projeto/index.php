<?php
include "config.php";
include DBAPI;
include HEADER_TEMPLATE;
$db = open_database(); 
?>

<h1 class="colordeco">Dashboard</h1>

<hr>

<?php if ($db): ?>

	<div class="d-flex align-items-center botoes-clientes justify-content-start  gap-3">
		<div>
			<a href="customers/add.php" class="btn bg-pink2">
				<div class="d-flex align-content-center justify-content-center flex-column gap-1 p-2">
					<div class="text-center">
						<i class="fa-solid fa-user-plus fa-7x"></i>
					</div>
					<div class="text-center">Novo Cliente</div>
				</div>
			</a>
		</div>

		<div>
			<a href="customers" class="btn bg-pink3">
				<div class="d-flex align-content-center justify-content-center flex-column gap-1 p-2">
					<div class="text-center">
						<i class="fa fa-users fa-7x"></i>
					</div>
					<div class="text-center">Clientes</div>
				</div>
			</a>
		</div>
	</div>
<?php else: ?>
	<div class="alert alert-danger" role="alert">
		<p><strong>ERRO:</strong> Não foi possível Conectar ao Banco de Dados!</p>
	</div>
<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>