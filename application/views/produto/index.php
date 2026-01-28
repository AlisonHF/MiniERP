<h2>Lista de Produtos</h2>

<table class="table table-dark table-hover table-striped" style="width: 90%;">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Descrição</th>
            <th scope="col">Código</th>
            <th scope="col">Unidade</th>
            <th scope="col">Preço</th>
            <th scope="col">Criado em</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($produtos)): ?>
            <tr>
                <td colspan="2">Nenhum registro encontrado</td>
            </tr>
        <?php else: ?>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id'] ?></td>
                    <td><?= $produto['codigo'] ?></td>
                    <td><?= $produto['descricao'] ?></td>
                    <td><?= $produto['unidade'] ?? '' ?></td>
                    <td><?= $produto['preco'] ?? 0 ?></td>
                    <td><?= $produto['created_at'] ?? '' ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<div style="margin-top: 15px;">
    <?= $links ?>
</div>
