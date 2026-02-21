<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="user-wrapper user-edit">

            <form id="<?= isset($usuario) ? 'edit' : 'create' ?>Form" class="auth-form">
                <div class="row g-4">
                    <div class="user-header mb-2">
                        <i class="bi bi-person"></i>
                        <h1><?= isset($usuario) ? 'Editar usuário' : 'Cadastrar usuário' ?></h1>
                    </div>

                    <?php if (isset($usuario)): ?>
                        <input id="id" name="id" value="<?= $usuario['id'] ?>" hidden>
                    <?php endif; ?>

                    <div>
                        <label for="nome" class="form-label">Nome</label>
                        <input
                            type="text"
                            class="form-control"
                            name="nome"
                            value="<?= $usuario['nome'] ?? '' ?>"
                            required
                        >
                    </div>

                    <div>
                        <label for="email" class="form-label">E-mail</label>
                        <input
                            type="email"
                            class="form-control"
                            name="email"
                            value="<?= $usuario['email'] ?? '' ?>"      
                        >
                    </div>

                    <div>
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="senha" class="form-control">
                    </div>

                    <div>
                        <label for="tipo" class="form-label">Tipo usuário</label>
                        <select name="tipo" class="form-control">
                            <option selected>Selecione</option>
                        </select>
                    </div>

                    <div>
                        <button type="submit" class="btn btn-primary w-100 form-control">
                            <?= isset($usuario) ? 'Salvar alterações' : 'Cadastrar usuário' ?>
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>