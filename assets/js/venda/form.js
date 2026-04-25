function formatBRL(value) {
    return 'R$ ' + (Number(value) || 0).toFixed(2).replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function formatQtd(value) {
    let formatted = (Number(value) || 0).toFixed(3).replace('.', ',');
    return formatted.replace(/,?0+$/, '');
}

function recalcularTotal() {
    let total = 0;

    $('#itensTable .item-row').each(function () {
        total += parseFloat($(this).attr('data-subtotal')) || 0;
    });

    $('#totalVenda').text(formatBRL(total));
}

function adicionarItem() {
    let $select = $('#produto_select');
    let idProduto = $select.val();

    if (!idProduto) {
        Swal.fire({ icon: 'warning', title: 'Selecione um produto.' });
        return;
    }

    let $opt = $select.find('option:selected');
    let codigo = $opt.data('codigo');
    let descricao = $opt.data('descricao');
    let quantidade = parseFloat($('#quantidade_input').val()) || 0;
    let preco = parseFloat($('#preco_input').val()) || 0;

    if (quantidade <= 0) {
        Swal.fire({ icon: 'warning', title: 'Informe uma quantidade válida.' });
        return;
    }

    if (preco < 0) {
        Swal.fire({ icon: 'warning', title: 'Informe um preço válido.' });
        return;
    }

    let subtotal = quantidade * preco;

    let row = `
        <div class="user-row item-row"
             data-id-produto="${idProduto}"
             data-quantidade="${quantidade}"
             data-preco="${preco}"
             data-subtotal="${subtotal.toFixed(2)}">
            <span data-label="Produto">${codigo} - ${descricao}</span>
            <span data-label="Qtd">${formatQtd(quantidade)}</span>
            <span data-label="Preço Unit.">${formatBRL(preco)}</span>
            <span data-label="Subtotal">${formatBRL(subtotal)}</span>
            <span class="actions" data-label="Ações">
                <a href="#" class="btn btn-sm btn-danger removeItem" title="Remover">
                    <i class="bi bi-trash"></i>
                </a>
            </span>
        </div>
    `;

    $('#itensTable').append(row);

    $select.val('');
    $('#quantidade_input').val('1');
    $('#preco_input').val('0.00');

    recalcularTotal();
}

function coletarItens() {
    let itens = [];

    $('#itensTable .item-row').each(function () {
        itens.push({
            id_produto:     $(this).attr('data-id-produto'),
            quantidade:     $(this).attr('data-quantidade'),
            preco_unitario: $(this).attr('data-preco'),
            subtotal:       $(this).attr('data-subtotal'),
        });
    });

    return itens;
}

function sendForm(url) {
    let numero      = $('#numero').val();
    let id_cliente  = $('#id_cliente').val();
    let status      = $('#status').val();
    let observacao  = $('#observacao').val();
    let itens       = coletarItens();

    let errors = [];

    if (!numero) errors.push('Número da venda é obrigatório.');
    if (!id_cliente) errors.push('Cliente é obrigatório.');
    if (itens.length === 0) errors.push('Adicione ao menos um item.');

    if (errors.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Campos inválidos!',
            html: errors.join('<br/>')
        });
        return false;
    }

    let formData = new FormData();
    formData.append('numero', numero);
    formData.append('id_cliente', id_cliente);
    formData.append('status', status);
    formData.append('observacao', observacao);

    itens.forEach((item, idx) => {
        formData.append(`itens[${idx}][id_produto]`, item.id_produto);
        formData.append(`itens[${idx}][quantidade]`, item.quantidade);
        formData.append(`itens[${idx}][preco_unitario]`, item.preco_unitario);
        formData.append(`itens[${idx}][subtotal]`, item.subtotal);
    });

    if (url === 'update') {
        formData.append('id', $('#id').val());
    }

    fetch(`/venda/${url}`, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        const messages = data.message;

        if (data.status) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                html: messages,
            })
            .then(() => {
                window.location.href = '/venda';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                html: messages
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Ocorreu uma falha',
            text: error
        });
    });
}

$(document).ready(function () {
    $('#produto_select').on('change', function () {
        let preco = $(this).find('option:selected').data('preco') || 0;
        $('#preco_input').val(parseFloat(preco).toFixed(2));
    });

    $('#addItem').on('click', function () {
        adicionarItem();
    });

    $('#itensTable').on('click', '.removeItem', function (e) {
        e.preventDefault();
        $(this).closest('.item-row').remove();
        recalcularTotal();
    });

    $('#createForm').submit(function (e) {
        e.preventDefault();
        sendForm('store');
    });

    $('#editForm').submit(function (e) {
        e.preventDefault();
        sendForm('update');
    });

    recalcularTotal();
});
