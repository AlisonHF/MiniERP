<div class="container-fluid empresa-create">
    <div class="row h-100">

        <!-- LADO ESQUERDO -->
        <div class="col-md-3 left-divisor d-flex flex-column justify-content-center align-items-center">
            <i class="bi bi-person-badge"></i>
            <h1>Cadastro</h1>
            <span>Conta & Empresa</span>
        </div>

        <!-- LADO DIREITO -->
        <div class="col-md-9 right-divisor d-flex justify-content-center align-items-center">
            
            <div class="form-wrapper">
                <form id="createForm" class="empresa-form">

                    <!-- DADOS DO USUÁRIO -->
                    <fieldset>
                        <legend class="section-divider">
                            <span>Dados do Usuário</span>
                        </legend>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>

                            <div class="col-md-6">
                                <label for="confirmarSenha" class="form-label">
                                    Confirmar senha
                                </label>
                                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
                            </div>
                        </div>
                    </fieldset>

                    <!-- DADOS DA EMPRESA -->
                    <fieldset>
                        <legend class="section-divider">
                            <span>Dados da Empresa</span>
                        </legend>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="razaoSocial" class="form-label">Razão social</label>
                                <input type="text" class="form-control" id="razaoSocial" name="razaoSocial" required>
                            </div>

                            <div class="col-md-6">
                                <label for="nomeFantasia" class="form-label">Nome fantasia</label>
                                <input type="text" class="form-control" id="nomeFantasia" name="nomeFantasia">
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="cnpj" class="form-label">CNPJ</label>
                                <input type="text" class="form-control" id="cnpj" name="cnpj" required>
                            </div>

                            <div class="col-md-6">
                                <label for="inscricaoEstadual" class="form-label">Inscrição estadual</label>
                                <input type="text" class="form-control" id="inscricaoEstadual" name="inscricaoEstadual">
                            </div>
                        </div>
                    </fieldset>

                    <!-- ENDEREÇO -->
                    <fieldset>
                        <legend class="section-divider">
                            <span>Endereço</span>
                        </legend>

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" class="form-control" id="cep" name="cep" required>
                            </div>

                            <div class="col-md-9">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" required>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-4">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" required>
                            </div>

                            <div class="col-md-2">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" required>
                            </div>

                            <div class="col-md-4">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" required>
                            </div>

                            <div class="col-md-2">
                                <label for="uf" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="uf" name="uf" maxlength="2" required>
                            </div>
                        </div>
                    </fieldset>

                    <button type="submit" class="btn btn-primary w-100 mt-4">
                        Criar conta
                    </button>

                    <a class="d-block text-center mt-3" href="<?= base_url('/') ?>">
                        Já tem uma conta? Entrar
                    </a>

                </form>
            </div>

        </div>
    </div>
</div>
