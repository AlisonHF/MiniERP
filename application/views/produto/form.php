<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="product-wrapper product-edit">

            <form id="<?= isset($produto) ? 'edit' : 'create' ?>Form" class="auth-form">
                <div class="row g-4">

                    <div class="product-header mb-2">
                        <i class="bi bi-box-seam"></i>
                        <h1><?= isset($produto) ? 'Editar produto' : 'Cadastrar produto' ?></h1>
                        <hr/>
                    </div>

                    <?php if (isset($produto)): ?>
                        <input id="id" name="id" value="<?= $produto['id'] ?>" hidden>
                    <?php endif; ?>

                    <div class="row mb-1">
                        <div class="col-md-4">
                            <label for="codigo" class="form-label">Código</label>
                            <input
                                type="text"
                                class="form-control"
                                id="codigo"
                                name="codigo"
                                value="<?= $produto['codigo'] ?? '' ?>"
                                required
                            >
                        </div>

                        <div class="col-md-8">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input
                                type="text"
                                class="form-control"
                                id="descricao"
                                name="descricao"
                                value="<?= $produto['descricao'] ?? '' ?>"
                            >
                        </div>
                    </div>

                    <div class="row mb-1">
                        <div class="col-md-6">
                            <label for="unidade" class="form-label">Unidade</label>
                            <select class="form-control" id="unidade" name="unidade">
                                <option value="">Selecione</option>
                                <?php
                                    $unidades = [
                                        'UN'  => 'Unidade',
                                        'PC'  => 'Peça',
                                        'KIT' => 'Kit',
                                        'PCT' => 'Pacote',
                                        'CX'  => 'Caixa',
                                        'DZ'  => 'Dúzia',
                                        'PAR' => 'Par',
                                        'KG'  => 'Quilograma',
                                        'G'   => 'Grama',
                                        'TON' => 'Tonelada',
                                        'LT'  => 'Litro',
                                        'ML'  => 'Mililitro',
                                        'M'   => 'Metro',
                                        'M2'  => 'Metro quadrado',
                                        'M3'  => 'Metro cúbico',
                                        'CM'  => 'Centímetro',
                                        'FR'  => 'Frasco',
                                        'LATA'=> 'Lata',
                                        'ROL' => 'Rolo',
                                        'SC'  => 'Saco',
                                    ];
                                    $unidadeAtual = $produto['unidade'] ?? '';
                                ?>
                                <?php foreach ($unidades as $sigla => $descricao): ?>
                                    <option value="<?= $sigla ?>" <?= $unidadeAtual === $sigla ? 'selected' : '' ?>>
                                        <?= $sigla ?> - <?= $descricao ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="preco" class="form-label">Preço</label>
                            <div class="input-group">
                                <span class="input-group-text">R$</span>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="preco"
                                    name="preco"
                                    value="<?= $produto['preco'] ?? '' ?>"
                                >
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100 form-control">
                            <?= isset($produto) ? 'Salvar alterações' : 'Cadastrar produto' ?>
                        </button>
                    </div>
                </div>
            </form>

        </div>

    </div>
</div>
