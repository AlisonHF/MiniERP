<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="login-wrapper">
            <form id="loginForm" class="auth-form">

                <div class="login-header mb-4">
                    <i class="bi bi-person-circle"></i>
                    <h1>Login</h1>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-4">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Entrar
                </button>

                <a id="link-create" href="<?= base_url('usuario/create') ?>">
                    Não tem uma conta? Cadastre-se agora
                </a>

            </form>
        </div>

    </div>
</div>
