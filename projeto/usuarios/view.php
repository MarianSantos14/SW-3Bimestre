
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "functions.php";

if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    $_SESSION['message'] = "Você precisa estar logado e ser administrador!";
    $_SESSION['type'] = "danger";

    header("Location: " . BASEURL . "index.php");
    exit;
}

view($_GET['id'] ?? null);

include HEADER_TEMPLATE;
?>


<?php if (empty($user)): ?>

	<div class="alert alert-warning" role="alert">
		Usuário não encontrado.
	</div>

	<a href="index.php" class="btn bg-pink3">
		<i class="fa-solid fa-arrow-left me-2"></i>Voltar
	</a>

<?php else: ?>

	<h2 class="colordeco">
		Usuário <?= (int) $user['id']; ?>
	</h2>

	<hr>

	<?php if (!empty($_SESSION['message'])): ?>
		<div class="alert alert-<?= htmlspecialchars($_SESSION['type'] ?? 'info', ENT_QUOTES, 'UTF-8'); ?>">
			<?= htmlspecialchars($_SESSION['message'], ENT_QUOTES, 'UTF-8'); ?>
		</div>
	<?php endif; ?>

	<div class="row">

		<!-- Dados do usuário -->
		<div class="col-md-6">
			<dl class="dl-horizontal">

				<dt>Nome completo:</dt>
				<dd>
					<?= htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8'); ?>
				</dd>

				<dt>Nome de usuário (login):</dt>
				<dd>
					<?= htmlspecialchars($user['user'], ENT_QUOTES, 'UTF-8'); ?>
				</dd>

				<dt>Senha:</dt>
				<dd>
					<?= str_repeat('•', strlen($user['password'])); ?>
				</dd>

				<dt>ID do usuário:</dt>
				<dd>
					<?= (int) $user['id']; ?>
				</dd>

			</dl>
		</div>

		<!-- Foto do usuário -->
		<div class="col-md-6">
			<div class="text-center mb-4">

				<?php
				$caminhoImagem = !empty($user['foto'])
					? '/SW-3Bimestre/projeto/' . ltrim($user['foto'], '/')
					: '/SW-3Bimestre/projeto/img/no-image.png';
				?>

				<img src="<?= htmlspecialchars($caminhoImagem, ENT_QUOTES, 'UTF-8'); ?>"
					alt="Foto de <?= htmlspecialchars($user['nome'], ENT_QUOTES, 'UTF-8'); ?>" style="width: 350px; height: 350px; object-fit: cover;
					border-radius: 50%; border: 6px solid #b44a7f;"
					onerror="this.onerror=null; this.src='/SW-3Bimestre/projeto/img/no-image.png';">

			</div>
		</div>

	</div>

	<!-- Ações -->
	<div id="actions" class="row">
		<div class="col-md-12">

			<a href="edit.php?id=<?= (int) $user['id']; ?>" class="btn bg-pink2">
				<i class="fa-solid fa-pencil me-2"></i>Editar
			</a>

			<a href="index.php" class="btn bg-pink3">
				<i class="fa-solid fa-arrow-left me-2"></i>Voltar
			</a>

		</div>
	</div>

<?php endif; ?>

<?php include FOOTER_TEMPLATE; ?>