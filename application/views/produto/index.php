<div class="container-fluid auth-page product-list-page">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <div class="page-header mb-3">
                <h1>
                    <i class="bi bi-box-seam"></i> Lista de Produtos
                </h1>
                <a href="<?= base_url('produto/create') ?>" class="btn btn-primary">
                    <i class="bi bi-plus-lg"></i>
                    Novo Produto
                </a>
            </div>

            <div class="product-list-wrapper">

                <div class="product-list-header">
                    <span>Descrição</span>
                    <span>Código</span>
                    <span>Unidade</span>
                    <span>Preço</span>
                    <span>Criado em</span>
                    <span>Ações</span>
                </div>

                <div class="product-list-body">

                    <?php if (empty($produtos)): ?>
                        <div class="empty-row">
                            Nenhum produto cadastrado
                        </div>
                    <?php else: ?>
                        <?php foreach ($produtos as $produto): ?>
                            <div class="product-row">
                                <span class="desc">
                                    <?= $produto['descricao'] ?>
                                </span>
                                <span>
                                    <?= $produto['codigo'] ?>
                                </span>
                                <span>
                                    <?= $produto['unidade'] ?? '-' ?>
                                </span>
                                <span class="price">
                                    R$ <?= number_format($produto['preco'] ?? 0, 2, ',', '.') ?>
                                </span>
                                <span class="date">
                                    <?= date('d/m/Y', strtotime($produto['created_at'])) ?>
                                </span>
                                <span>
                                    
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
