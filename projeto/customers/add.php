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
                    Clientes
                </a>
            </li>

            <li class="breadcrumb-item active" aria-current="page">
                Adicionar Cliente
            </li>
        </ol>
    </nav>

<h2 class="colordeco">Novo Cliente</h2>

<form action="add.php" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
    <!-- area de campos do form -->
    <hr />

    <div class="row">

        <div class="col-md-8">
            <div class="row">

                <div class="col-md-10 mb-3">
                    <label for="name" class="form-label">Nome / Razão Social</label>
                    <input type="text" class="form-control" id="name" name="customer[name]" required>
                    <div class="invalid-feedback">
                        Por favor, preencha o nome ou a razão social.
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="cpf_cnpj" class="form-label">CNPJ / CPF</label>
                    <input type="text" class="form-control" id="cpf_cnpj" name="customer[cpf_cnpj]" inputmode="numeric"
                        pattern="([0-9]{11}|[0-9]{14})" maxlength="14" placeholder="Digite 11 ou 14 números" required>
                    <div class="invalid-feedback">
                        O CPF deve ter 11 números ou o CNPJ deve ter 14 números.
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label for="birthdate" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="birthdate" name="customer[birthdate]" required>
                    <div class="invalid-feedback">
                        Por favor, preencha o endereço.
                    </div>
                </div>

                <div class="col-md-10 mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="customer[email]" maxlength="255"
                        placeholder="exemplo@email.com">
                    <div class="invalid-feedback">
                        Informe um e-mail válido.
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mt-3">
            <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
                <div class="col-12  mb-3">
                    <div class="text-center">
                        <img id="image-preview" src="/SW-3Bimestre/projeto/img/no-image.png" alt="Foto do cliente"
                            style="width: 150px; height: 150px; object-fit: cover;
                       border-radius: 50%; border: 6px solid #b44a7f; cursor: pointer;"
                            onclick="document.getElementById('img').click()">
                    </div>

                    <label for="img" class="form-label mt-2">
                        Foto do cliente
                    </label>

                    <input type="file" name="img" id="img" class="form-control"
                        accept="image/png,image/jpeg,image/webp">
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-5 mb-3">
            <label for="address" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="address" name="customer[address]" required>
            <div id="validationServerAddressInvalid" class="invalid-feedback">Por favor, coloque um email válido</div>

        </div>

        <div class="col-md-3 mb-3">
            <label for="hood" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="hood" name="customer[hood]" required>
            <div class="invalid-feedback">
                Por favor, preencha o bairro.
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <label for="zip_code" class="form-label">CEP</label>
            <input type="text" class="form-control" id="zip_code" name="customer[zip_code]" inputmode="numeric"
                pattern="[0-9]{8}" maxlength="8" placeholder="8 números" required>
            <div class="invalid-feedback">
                O CEP deve conter exatamente 8 números.
            </div>
        </div>
        <div class="col-md-2 mb-3">
            <label for="mobile" class="form-label">Celular</label>
            <input type="text" class="form-control" id="mobile" name="customer[mobile]" inputmode="numeric"
                pattern="[0-9]{11}" maxlength="11" placeholder="DDD + celular" required>
            <div class="invalid-feedback">
                Informe o celular com DDD e 11 números.
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-5 mb-3">
            <label for="city" class="form-label">Município</label>
            <input type="text" class="form-control" id="city" name="customer[city]" required>
            <div class="invalid-feedback">
                Por favor, informe o município.
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="phone" name="customer[phone]" inputmode="numeric"
                pattern="[0-9]{10,11}" maxlength="11" placeholder="DDD + número" required>
            <div class="invalid-feedback">
                Informe o telefone com DDD e 10 ou 11 números.
            </div>
        </div>

        <div class="col-md-1 mb-3">
            <label for="state" class="form-label">UF</label>
            <input type="text" class="form-control text-uppercase" id="state" name="customer[state]" minlength="2"
                maxlength="2" pattern="[A-Za-z]{2}" required>
            <div class="invalid-feedback">
                Informe a UF com exatamente 2 letras.
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <label for="ie" class="form-label">Inscrição Estadual</label>
            <input type="text" class="form-control" id="ie" name="customer[ie]" inputmode="numeric"
                pattern="[0-9]{8,14}" minlength="8" maxlength="14" required>
            <div class="invalid-feedback">
                Informe a Inscrição Estadual com 8 a 14 números.
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <label for="created" class="form-label">Data de Cadastro</label>
            <input type="text" class="form-control" id="created" name="customer[created]" disabled>
        </div>
    </div>


    <div class="row mt-3">

        <div class="col-12 mt-3">
            <button type="submit" class="btn bg-pink2"><i class="fa-solid fa-floppy-disk me-2"></i>Salvar</button>
            <a href="index.php" class="btn bg-pink3"><i class="fa-solid fa-ban me-2"></i>Cancelar</a>
        </div>
    </div>
</form>

<script>
    const input = document.getElementById('img');
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