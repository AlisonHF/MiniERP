<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="register-wrapper">
            <form id="createForm" class="auth-form">

                <div class="register-header mb-4">
                    <i class="bi bi-person-circle"></i>
                    <h1>Criar conta</h1>
                    <span>WorkUp</span>
                </div>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha">
                </div>

                <div class="mb-4">
                    <label for="confirmarSenha" class="form-label">
                        Confirmar senha
                    </label>
                    <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha">
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Criar conta
                </button>

                <a id="link-login" href="<?= base_url('/') ?>">
                    Já tem uma conta? Entrar
                </a>

            </form>
        </div>

    </div>
</div>
