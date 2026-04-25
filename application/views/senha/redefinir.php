<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="login-wrapper">

            <?php if (!empty($tokenInvalido)): ?>

                <div class="login-header mb-4">
                    <i class="bi bi-x-circle"></i>
                    <h1>Link inválido</h1>
                </div>

                <p class="text-muted text-center mb-4" style="font-size: .9rem;">
                    Este link de recuperação é inválido ou expirou.
                </p>

                <a href="<?= base_url('senha/recuperar') ?>" class="btn btn-primary w-100 mb-3">
                    Solicitar novo link
                </a>

                <a id="link-create" href="<?= base_url('auth/') ?>">
                    Voltar para o login
                </a>

            <?php else: ?>

                <form id="redefinirForm" class="auth-form">

                    <div class="login-header mb-4">
                        <i class="bi bi-shield-lock"></i>
                        <h1>Nova senha</h1>
                    </div>

                    <input type="hidden" id="token" name="token" value="<?= htmlspecialchars($token) ?>">

                    <div class="mb-3">
                        <label for="senha" class="form-label">Nova senha</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>

                    <div class="mb-4">
                        <label for="confirmar_senha" class="form-label">Confirmar nova senha</label>
                        <input type="password" class="form-control" id="confirmar_senha" name="confirmar_senha" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        Atualizar senha
                    </button>

                    <a id="link-create" href="<?= base_url('auth/') ?>">
                        Voltar para o login
                    </a>

                </form>

            <?php endif; ?>

        </div>

    </div>
</div>
