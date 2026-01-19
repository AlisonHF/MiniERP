<div class="container login">
    <form id="loginForm" class="w-100 p-3">

        <div class="mb-3 d-flex flex-column">
            <h1 class="text-center">Login</h1>
            <i class="bi bi-person-circle fs-1"></i>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Entrar</button>
        </div>
        <a id="link-create" href="<?= base_url('usuario/create') ?>" class="btn btn-link d-block text-center">Não tem uma conta? cadastre-se agora!</a>
    </form>
</div>