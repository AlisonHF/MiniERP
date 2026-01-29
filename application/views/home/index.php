<div class="container-fluid dashboard home-dashboard">
    <div class="row min-vh-100">

        <div class="col-md-3 left-divisor d-flex flex-column align-items-center justify-content-center">
            <i class="bi bi-speedometer2 display-4 mb-2"></i>
            <h2>WorkUp</h2>
            <p class="text-center">Painel de Controle</p>
        </div>

        <div class="col-md-9 p-4 right-divisor">

            <h1 class="mb-4">Dashboard</h1>

            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-body text-center">
                            <i class="bi bi-people display-6 mb-2"></i>
                            <h5 class="card-title">Clientes</h5>
                            <h2></h2>
                            <a href="#" class="btn btn-outline-primary btn-sm mt-2">
                                Gerenciar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-body text-center">
                            <i class="bi bi-box-seam display-6 mb-2"></i>
                            <h5 class="card-title">Produtos</h5>
                            <h2></h2>
                            <a href="<?= base_url("produto") ?>" class="btn btn-outline-primary btn-sm mt-2">
                                Gerenciar
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card dashboard-card">
                        <div class="card-body text-center">
                            <i class="bi bi-person-badge display-6 mb-2"></i>
                            <h5 class="card-title">Usuários</h5>
                            <h2></h2>
                            <a href="#" class="btn btn-outline-primary btn-sm mt-2">
                                Gerenciar
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <hr class="my-4">

            <h4>Ações rápidas</h4>

            <div class="d-flex gap-2 flex-wrap">
                <a href="#" class="btn btn-primary">
                    Novo cliente
                </a>
                <a href="<?= base_url('produto/create') ?>" class="btn btn-primary">
                    Novo Produto
                </a>
                <a href="#" class="btn btn-secondary">
                    Vincular Usuário
                </a>
            </div>

        </div>
    </div>
</div>
