<?php
require_once 'functions.php';
edit();
?>

<?php include(HEADER_TEMPLATE); ?>

<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/SW-3Bimestre/projeto/index.php">
                <i class="fa-solid fa-house"></i> Início
            </a>
        </li>

        <li class="breadcrumb-item">
            <a href="index.php">
                Usuários
            </a>
        </li>

        <li class="breadcrumb-item active" aria-current="page">
            Editar
        </li>
    </ol>
</nav>

<h2 class="colordeco">Editar Usuário</h2>

<form action="edit.php?id=<?= (int) $user['id']; ?>" method="post"
    enctype="multipart/form-data" class="needs-validation" novalidate>

    <hr />

    <div class="row">
        <div class="col-md-8">
            <div class="row">

                <div class="col-md-10 mb-3">
                    <label for="nome" class="form-label">Nome completo</label>
                    <input type="text" class="form-control" id="nome"
                        name="user[nome]" maxlength="50"
                        value="<?= htmlspecialchars($user['nome'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        required>
                    <div class="invalid-feedback">
                        Por favor, preencha o nome completo.
                    </div>
                </div>

                <div class="col-md-10 mb-3">
                    <label for="username" class="form-label">Nome de usuário (login)</label>
                    <input type="text" class="form-control" id="username"
                        name="user[user]" maxlength="50"
                        value="<?= htmlspecialchars($user['user'] ?? '', ENT_QUOTES, 'UTF-8'); ?>"
                        required>
                    <div class="invalid-feedback">
                        Por favor, preencha o nome de usuário.
                    </div>
                </div>

                <div class="col-md-10 mb-3">
                    <label for="password" class="form-label">Nova senha</label>
                    <input type="password" class="form-control" id="password"
                        name="user[password]" maxlength="100"
                        autocomplete="new-password"
                        placeholder="Deixe em branco para manter a senha atual">
                    <div class="form-text">
                        Preencha somente se desejar alterar a senha atual.
                    </div>
                </div>

            </div>
        </div>

        <!-- Foto à direita -->
        <div class="col-md-4 mt-3">
            <div class="d-flex align-items-center justify-content-center flex-wrap">
                <div class="col-12 mb-3">

                    <div class="text-center">
                        <?php
                        $caminhoImagem = !empty($user['foto'])
                            ? '/SW-3Bimestre/projeto/' . ltrim($user['foto'], '/')
                            : '/SW-3Bimestre/projeto/img/no-image.png';
                        ?>

                        <img id="image-preview"
                            src="<?= htmlspecialchars($caminhoImagem, ENT_QUOTES, 'UTF-8'); ?>"
                            alt="Foto de <?= htmlspecialchars($user['nome'] ?? 'usuário', ENT_QUOTES, 'UTF-8'); ?>"
                            style="width: 150px; height: 150px; object-fit: cover;
                            border-radius: 50%; border: 6px solid #b44a7f;
                            cursor: pointer;"
                            onclick="document.getElementById('img').click()"
                            onerror="this.onerror=null; this.src='/SW-3Bimestre/projeto/img/no-image.png';">
                    </div>

                    <label for="img" class="form-label mt-2">
                        Alterar foto do usuário
                    </label>

                    <input type="file" name="img" id="img" class="form-control"
                        accept="image/png,image/jpeg,image/webp">

                    <small class="text-muted">
                        Se não selecionar outra foto, a foto atual será mantida.
                    </small>

                </div>
            </div>
        </div>
    </div>

    <!-- Botões -->
    <div class="row mt-3">
        <div class="col-12 mt-3">
            <button type="submit" class="btn bg-pink2">
                <i class="fa-solid fa-floppy-disk me-2"></i>Salvar
            </button>

            <a href="index.php" class="btn bg-pink3">
                <i class="fa-solid fa-ban me-2"></i>Cancelar
            </a>
        </div>
    </div>

</form>

<script>
    const input = document.getElementById('img');
    const preview = document.getElementById('image-preview');

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) return;
        if (!file.type.startsWith('image/')) return;

        preview.src = URL.createObjectURL(file);
    });
</script>

<?php include FOOTER_TEMPLATE; ?>