<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="venda-wrapper venda-edit">

            <form id="<?= isset($venda['id']) ? 'edit' : 'create' ?>Form" class="auth-form">
                <div class="row g-4">
                    <div class="venda-header mb-2">
                        <i class="bi bi-receipt"></i>
                        <h1><?= isset($venda['id']) ? 'Editar venda' : 'Cadastrar venda' ?></h1>
                        <hr/>
                    </div>

                    <?php if (isset($venda['id'])): ?>
                        <input type="hidden" id="id" name="id" value="<?= $venda['id'] ?>">
                    <?php endif; ?>

                    <div class="row mb-1">
                        <div class="col-md-3">
                            <label for="numero" class="form-label">Número</label>
                            <input
                                type="text"
                                class="form-control"
                                id="numero"
                                name="numero"
                                value="<?= $venda['numero'] ?? ($numero ?? '') ?>"
                                <?= isset($venda['id']) ? 'readonly' : '' ?>
                            />
                        </div>

                        <div class="col-md-6">
                            <label for="id_cliente" class="form-label">Cliente</label>
                            <select class="form-control" id="id_cliente" name="id_cliente">
                                <option value="">Selecione</option>
                                <?php foreach ($clientes ?? [] as $cliente): ?>
                                    <?php
                                        $nome = $cliente['tipo_pessoa'] === 'F'
                                            ? ($cliente['nome'] ?? '')
                                            : ($cliente['razao_social'] ?? '');
                                    ?>
                                    <option value="<?= $cliente['id'] ?>"
                                        <?= (isset($venda['id_cliente']) && (int) $venda['id_cliente'] === (int) $cliente['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($nome) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="aberta"     <?= (($venda['status'] ?? 'aberta') === 'aberta') ? 'selected' : '' ?>>Aberta</option>
                                <option value="finalizada" <?= (($venda['status'] ?? '') === 'finalizada') ? 'selected' : '' ?>>Finalizada</option>
                                <option value="cancelada"  <?= (($venda['status'] ?? '') === 'cancelada')  ? 'selected' : '' ?>>Cancelada</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-12">
                            <label for="observacao" class="form-label">Observação</label>
                            <textarea class="form-control" id="observacao" name="observacao" rows="2"><?= $venda['observacao'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <hr/>

                    <div class="venda-itens">
                        <h3 class="mb-3"><i class="bi bi-box-seam"></i> Itens da venda</h3>

                        <div class="row mb-2">
                            <div class="col-md-6">
                                <label for="produto_select" class="form-label">Produto</label>
                                <select class="form-control" id="produto_select">
                                    <option value="">Selecione um produto</option>
                                    <?php foreach ($produtos ?? [] as $produto): ?>
                                        <option
                                            value="<?= $produto['id'] ?>"
                                            data-codigo="<?= htmlspecialchars($produto['codigo']) ?>"
                                            data-descricao="<?= htmlspecialchars($produto['descricao']) ?>"
                                            data-unidade="<?= htmlspecialchars($produto['unidade'] ?? '') ?>"
                                            data-preco="<?= (float) ($produto['preco'] ?? 0) ?>">
                                            <?= htmlspecialchars($produto['codigo'] . ' - ' . $produto['descricao']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="quantidade_input" class="form-label">Quantidade</label>
                                <input type="number" step="0.001" min="0" class="form-control" id="quantidade_input" value="1">
                            </div>

                            <div class="col-md-2">
                                <label for="preco_input" class="form-label">Preço Unit.</label>
                                <input type="number" step="0.01" min="0" class="form-control" id="preco_input" value="0.00">
                            </div>

                            <div class="col-md-2 d-flex align-items-end">
                                <button type="button" id="addItem" class="btn btn-success w-100">
                                    <i class="bi bi-plus-lg"></i> Adicionar
                                </button>
                            </div>
                        </div>

                        <div class="user-list-wrapper mt-2">
                            <div class="user-list-header itens-header">
                                <span>Produto</span>
                                <span>Qtd</span>
                                <span>Preço Unit.</span>
                                <span>Subtotal</span>
                                <span class="text-center">Ações</span>
                            </div>
                            <div class="user-list-body" id="itensTable">
                                <?php if (!empty($itens)): ?>
                                    <?php foreach ($itens as $item): ?>
                                        <div class="user-row item-row"
                                             data-id-produto="<?= $item['id_produto'] ?>"
                                             data-quantidade="<?= $item['quantidade'] ?>"
                                             data-preco="<?= $item['preco_unitario'] ?>"
                                             data-subtotal="<?= $item['subtotal'] ?>">
                                            <span data-label="Produto">
                                                <?= htmlspecialchars(($item['codigo'] ?? '') . ' - ' . ($item['descricao'] ?? '')) ?>
                                            </span>
                                            <span data-label="Qtd"><?= rtrim(rtrim(number_format((float) $item['quantidade'], 3, ',', '.'), '0'), ',') ?></span>
                                            <span data-label="Preço Unit.">R$ <?= number_format((float) $item['preco_unitario'], 2, ',', '.') ?></span>
                                            <span data-label="Subtotal">R$ <?= number_format((float) $item['subtotal'], 2, ',', '.') ?></span>
                                            <span class="actions" data-label="Ações">
                                                <a href="#" class="btn btn-sm btn-danger removeItem" title="Remover">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </span>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-md-12 text-end">
                                <h4>Total: <span id="totalVenda">R$ 0,00</span></h4>
                            </div>
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
