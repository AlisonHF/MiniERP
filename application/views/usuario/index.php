<div class="container-fluid auth-page">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            
            <div class="page-header mb-3">
                <h1>
                    <i class="bi bi-person"></i> Lista de Usuários
                </h1>
                <a href="<?= base_url('usuario/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Novo Usuário
                </a>
            </div>

            <form class="row mb-3" method="post" action="#">
                <div class="col-md-3">
                    <label class="form-label" for="nome">Nome</label>
                    <input class="form-control" id="nome" name="nome">
                </div>
                
                <div class="col-md-3">
                    <label class="form-label" for="email">E-mail</label>
                    <input class="form-control" id="email" name="email">
                </div>
                
                <div class="col-md-1">
                    <label class="form-label" for="limite">Limite</label>
                    <select class="form-control" id="limite" name="limite">
                    </select>
                </div>

                <div class="col-md-3">
                    &nbsp;
                </div>

                <div class="col-md-2" >
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>

            </form>

            <hr/>

            <div class="user-list-wrapper">
                <div class="user-list-header">
                    <span>Nome</span>
                    <span>E-mail</span>
                    <span>Tipo de usuário</span>
                    <span>Criado em</span>                    
                    <span>Ações</span>
                </div>

                <div class="user-list-body">
                    
                        <!-- <div class="empty-row">
                            Nenhum usuário cadastrado
                        </div> -->
                    
                            <div class="user-row">
                                <span class="desc" data-label="Nome">
   
                                </span>
                                <span data-label="E-mail">
                                  
                                </span>
                                <span data-label="Tipo de usuário">
                               
                                </span>
                            
                                <span class="date" data-label="Criado em">

                                </span>
                                <span class="actions" data-label="Ações">
                                    <a href="#" class="btn btn-sm btn-primary" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="#" id="#" class="btn btn-sm btn-danger delete" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </span>
                            </div>

                </div>
            </div>

            <div class="list-footer mt-3">

            </div>

        </div>
    </div>
</div>