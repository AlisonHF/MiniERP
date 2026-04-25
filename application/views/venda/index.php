<div class="container-fluid auth-page">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">

            <div class="page-header mb-3">
                <h1>
                    <i class="bi bi-receipt"></i> Lista de Vendas
                </h1>
                <a href="<?= base_url('venda/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Nova Venda
                </a>
            </div>

            <form class="row mb-3" method="post" action="<?= base_url('venda/index') ?>">
                <div class="col-md-3">
                    <label class="form-label" for="numero">Número</label>
                    <input class="form-control" id="numero" name="numero">
                </div>

                <div class="col-md-3">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-control" id="status" name="status">
                        <option value="">Todos</option>
                        <option value="aberta">Aberta</option>
                        <option value="finalizada">Finalizada</option>
                        <option value="cancelada">Cancelada</option>
                    </select>
                </div>

                <div class="col-md-1">
                    <label class="form-label" for="limite">Limite</label>
                    <select class="form-control" id="limite" name="limite">
                        <?php for ($i = 15; $i <= 100; $i += 15): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>

                <div class="col-md-3">
                    &nbsp;
                </div>

                <div class="col-md-2">
                    <label>&nbsp;</label>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Buscar
                    </button>
                </div>
            </form>

            <hr />

            <div class="user-list-wrapper">
                <div class="user-list-header">
                    <span>Número</span>
                    <span>Cliente</span>
                    <span>Status</span>
                    <span>Total</span>
                    <span>Data</span>
                    <span class="text-center">Ações</span>
                </div>

                <div class="user-list-body">
                    <?php if (empty($vendas)): ?>
                        <div class="empty-row">
                            Sem vendas cadastradas
                        </div>
                    <?php else: ?>
                        <?php foreach ($vendas as $venda): ?>
                            <div class="user-row">
                                <span class="desc" data-label="Número">
                                    <?= htmlspecialchars($venda['numero']) ?>
                                </span>
                                <span data-label="Cliente">
                                    <?php
                                    $clienteNome = ($venda['tipo_pessoa'] ?? 'F') === 'F'
                                        ? ($venda['nome'] ?? '-')
                                        : ($venda['razao_social'] ?? '-');
                                    echo htmlspecialchars($clienteNome ?? '-');
                                    ?>
                                </span>
                                <span data-label="Status">
                                    <span
                                        class="badge bg-<?= ($venda['status'] === 'finalizada' ? 'success' : ($venda['status'] === 'cancelada' ? 'danger' : 'warning text-dark')) ?>">
                                        <?= ucfirst($venda['status']) ?>
                                    </span>
                                </span>
                                <span class="price" data-label="Total">
                                    R$ <?= number_format((float) $venda['total'], 2, ',', '.') ?>
                                </span>
                                <span class="date" data-label="Data">
                                    <?= date('d/m/Y', strtotime($venda['created_at'])) ?>
                                </span>
                                <span class="actions" data-label="Ações">
                                    <a href="<?= base_url('venda/edit/' . $venda['id']) ?>" class="btn btn-sm btn-primary"
                                        title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="#" id="<?= $venda['id'] ?>" class="btn btn-sm btn-danger delete" title="Excluir">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="list-footer mt-3">
                <?= $links ?>
            </div>

        </div>
    </div>
</div>