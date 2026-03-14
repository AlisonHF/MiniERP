<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="cliente-wrapper cliente-edit">

            <form id="" class="auth-form">
                <div class="row g-4">
                    <div class="cliente-header mb-2">
                        <i class="bi bi-person"></i>
                        <h1>Cadastrar cliente</h1>
                        <hr/>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-6">
                            <label for="tipo_pessoa" class="form-label">Tipo de pessoa</label>
                            <select type="text" class="form-control" id="tipo_pessoa" name="tipo_pessoa">
                                <option value="F" selected>Fisica</option>
                                <option value="J">Juridica</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-12" id="div_nome">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="nome" name="nome"/>
                        </div>

                        <div class="col-md-12" class="div_razao">
                            <label for="razao_social" class="form-label">Razão social</label>
                            <input type="text" class="form-control" id="razao_social" name="razao_social"/>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-6" id="div_cpf">
                            <label for="cpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpf" name="cpf"/>
                        </div>
                        <div class="col-md-6" id="div_cnpj">
                            <label for="cnpj" class="form-label">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj" name="cnpj"/>
                        </div>

                        <div class="col-md-6" id="div_rg">
                            <label for="rg" class="form-label">RG</label>
                            <input type="text" class="form-control" id="rg" name="rg"/>
                        </div>
                        <div class="col-md-6" id="div_inscricao">
                            <label for="inscricao_estadual" class="form-label">Inscrição estadual</label>
                            <input type="text" class="form-control" id="inscricao_estadual" name="inscricao_estadual"/>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-12" id="div_apelido">
                            <label for="apelido" class="form-label">Apelido</label>
                            <input type="text" class="form-control" id="apelido" name="apelido"/>
                        </div>

                        <div class="col-md-12" id="div_nome_fantasia">
                            <label for="nome_fantasia" class="form-label">Nome fantasia</label>
                            <input type="text" class="form-control" id="nome_fantasia" name="nome_fantasia"/>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-6" id="div_data_nascimento">
                            <label for="data_nascimento" class="form-label">Data de nascimento</label>
                            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"/>
                        </div>
                        <div class="col-md-6" id="div_data_abertura">
                            <label for="data_abertura" class="form-label">Data de abertura</label>
                            <input type="date" class="form-control" id="data_abertura" name="data_abertura"/>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100 form-control">
                            Salvar
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>