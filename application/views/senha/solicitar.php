<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="login-wrapper">
            <form id="solicitarForm" class="auth-form">

                <div class="login-header mb-4">
                    <i class="bi bi-key"></i>
                    <h1>Recuperar senha</h1>
                </div>

                <p class="text-muted text-center mb-4" style="font-size: .9rem;">
                    Informe seu e-mail e enviaremos um link para você redefinir a senha.
                </p>

                <div class="mb-4">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Enviar link
                </button>

                <a id="link-create" href="<?= base_url('auth/') ?>">
                    Voltar para o login
                </a>

            </form>
        </div>

    </div>
</div>
