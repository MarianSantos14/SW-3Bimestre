<?php
// Esse é o login.php
require_once __DIR__ . "/../config.php";
include HEADER_TEMPLATE;
?>

<h1 class="colordeco">Login</h1>

<hr>

<div class="row justify-content-center my-5">
    <div class="col-12 col-md-6 col-lg-4">
        
        <div class="card shadow-sm rounded-5">
            <div class="card-body p-4">

                <div class="text-center mb-4">
                    <i class="fa-solid fa-user-lock fa-3x mb-3" style="color:#c33b80"></i>
                    <h3>Entrar</h3>
                    <p class="text-muted">Acesse sua conta</p>
                </div>

                <form action="valida.php" method="post">

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control"
                            id="log" placeholder="Usuário" name="login" required>
                        <label for="log">Usuário</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control"
                            id="pass" placeholder="Senha" name="senha" required>
                        <label for="pass">Senha</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn bg-pink2">
                            <i class="fa-solid fa-user-check me-1"></i>
                            Conectar
                        </button>

                        <a href="<?php echo BASEURL; ?>" class="btn bg-pink3">
                            <i class="fa-solid fa-arrow-left me-1"></i>
                            Cancelar
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

<?php include FOOTER_TEMPLATE; ?>
