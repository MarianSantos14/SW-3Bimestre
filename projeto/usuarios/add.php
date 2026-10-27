<?php
require_once 'functions.php';
add();
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
            Adicionar Usuário
        </li>
    </ol>
</nav>

<h2 class="colordeco">Novo Usuário</h2>

<form action="add.php" method="post" enctype="multipart/form-data"
    class="needs-validation" novalidate>

    <hr />

    <div class="row">

        <div class="col-md-8">
            <div class="row">

                <!-- Nome completo -->
                <div class="col-md-10 mb-3">
                    <label for="nome" class="form-label">Nome completo</label>
                    <input type="text" class="form-control"
                        id="nome" name="user[nome]"
                        maxlength="50" required>

                    <div class="invalid-feedback">
                        Por favor, preencha o nome do usuário.
                    </div>
                </div>

                <!-- Nome de usuário -->
                <div class="col-md-10 mb-3">
                    <label for="usuario" class="form-label">
                        Nome de usuário (login)
                    </label>

                    <input type="text" class="form-control"
                        id="usuario" name="user[user]"
                        maxlength="50" required>

                    <div class="invalid-feedback">
                        Por favor, informe o nome de usuário.
                    </div>
                </div>

                <!-- Senha -->
                <div class="col-md-10 mb-3">
                    <label for="password" class="form-label">Senha</label>

                    <input type="password" class="form-control"
                        id="password" name="user[password]"
                        maxlength="100" required>

                    <div class="invalid-feedback">
                        Por favor, informe uma senha.
                    </div>
                </div>

            </div>
        </div>

        <!-- Foto do usuário -->
        <div class="col-md-4 mt-3">
            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                <div class="col-12 mb-3">

                    <div class="text-center">
                        <img id="image-preview"
                            src="/SW-3Bimestre/projeto/img/no-image.png"
                            alt="Foto do usuário"
                            style="width: 150px; height: 150px;
                            object-fit: cover; border-radius: 50%;
                            border: 6px solid #b44a7f; cursor: pointer;"
                            onclick="document.getElementById('foto').click()">
                    </div>

                    <label for="foto" class="form-label mt-2">
                        Foto do usuário
                    </label>

                    <input type="file" name="img" id="foto"
                        class="form-control"
                        accept="image/png,image/jpeg,image/webp">
                </div>
            </div>
        </div>

    </div>

    <!-- Botões -->
    <div class="row mt-3">
        <div class="col-12 mt-3">

            <button type="submit" class="btn bg-pink2">
                <i class="fa-solid fa-floppy-disk me-2"></i>
                Salvar
            </button>

            <a href="index.php" class="btn bg-pink3">
                <i class="fa-solid fa-ban me-2"></i>
                Cancelar
            </a>

        </div>
    </div>

</form>

<script>
    const input = document.getElementById('foto');
    const preview = document.getElementById('image-preview');

    input.addEventListener('change', function () {
        const file = this.files[0];

        if (!file) {
            return;
        }

        if (!file.type.startsWith('image/')) {
            return;
        }

        preview.src = URL.createObjectURL(file);
    });
</script>

<?php include FOOTER_TEMPLATE; ?>
