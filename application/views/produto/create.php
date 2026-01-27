<div class="container-fluid auth-page">
    <div class="row h-100 justify-content-center align-items-center">

        <div class="product-wrapper product-edit">

            <form id="createForm" class="auth-form">
                <div class="row g-4">

                    <!-- PREVIEW DA IMAGEM -->
                    <div class="col-md-4">
                        <div class="image-preview">
                            <img
                                id="previewImagem"
                                src="<?= $produto->imagem ?? base_url('assets/img/no-image.jpg') ?>"
                                alt="Imagem do produto"
                            >
                            <label for="imagem" class="btn btn-outline-primary btn-sm mt-3 w-100">
                                Alterar imagem
                            </label>
                            <input
                                type="file"
                                class="d-none"
                                accept="image/*"
                            >
                        </div>
                    </div>

                    <!-- FORMULÁRIO -->
                    <div class="col-md-8">
                        <div class="product-header mb-4">
                            <i class="bi bi-box-seam"></i>
                            <h1><?= isset($produto) ? 'Editar produto' : 'Cadastrar produto' ?></h1>
                            <span>WorkUp</span>
                        </div>

                        <div class="mb-3">
                            <label for="codigo" class="form-label">Código</label>
                            <input
                                type="text"
                                class="form-control"
                                id="codigo"
                                name="codigo"
                                value="<?= $produto->codigo ?? '' ?>"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            <input
                                type="text"
                                class="form-control"
                                id="descricao"
                                name="descricao"
                                value="<?= $produto->descricao ?? '' ?>"
                                
                            >
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="unidade" class="form-label">Unidade</label>
                                <select class="form-control" id="unidade" name="unidade">
                                    <option value="">Selecione</option>
                                    <option value="UN" <?= ($produto->unidade ?? '') === 'UN' ? 'selected' : '' ?>>Unidade</option>
                                    <option value="KG" <?= ($produto->unidade ?? '') === 'KG' ? 'selected' : '' ?>>Kg</option>
                                    <option value="LT" <?= ($produto->unidade ?? '') === 'LT' ? 'selected' : '' ?>>Litro</option>
                                    <option value="CX" <?= ($produto->unidade ?? '') === 'CX' ? 'selected' : '' ?>>Caixa</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="preco" class="form-label">Preço</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="preco"
                                    name="preco"
                                    value="<?= $produto->preco ?? '' ?>"
                                >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <?= isset($produto) ? 'Salvar alterações' : 'Cadastrar produto' ?>
                        </button>
                    </div>

                </div>
            </form>

        </div>

    </div>
</div>
