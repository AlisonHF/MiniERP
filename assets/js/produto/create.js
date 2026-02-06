/* @TODO implementar o upload de imagens*/

function validateForm(
    codigo,
    descricao,
    unidade,
    preco
) {
    let errors = [];
    let numberPreco = Number(preco);

    if (!codigo) {
        errors.push('Código é obrigatório.');
    } else if (codigo.length > 20) {
        errors.push('Código deve ter no máximo 20 caracteres.');
    }

    if (!descricao) {
        errors.push('Descrição é obrigatória.');
    } else if (descricao.length > 255) {
        errors.push('Descrição deve ter no máximo 255 caracteres.');
    }

    if (unidade.length > 10) {
        errors.push('Unidade deve ter no máximo 20 caracteres.');
    }

    if (!numberPreco && !Number.isFinite(numberPreco)) {
        errors.push('Preço deve ser númerico.');
    }

    if (errors.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Campos inválidos!',
            html: errors.map(field => `${field}`).join('<br/>')
        })

        return false;
    }

    return true;
}

function sendForm(url)
{
    let codigo = $('#codigo').val();
    let descricao = $('#descricao').val();
    let unidade = $('#unidade').val();
    let preco = $('#preco').val();

    if (!validateForm(codigo, descricao, unidade, preco)) {
        return false;
    }

    let formData = new FormData();

    formData.append('codigo', codigo);
    formData.append('descricao', descricao);
    formData.append('unidade', unidade);
    formData.append('preco', preco);

    fetch(`/produto/${url}`, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        const messages = data.message;

        if (data.status) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                html: messages,
            })
            .then(() => {
                if (url == 'edit') {
                    window.location.href = '/produto';
                }
                
                window.location.href = '/produto/create';
                
            })
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro!',
                html: messages
            });
        }
    })
    .catch(error => {
        Swal.fire({
            icon: 'error',
            title: 'Ocorreu um erro!',
            message: error
        });
    });
}

$('#createForm').submit(function(e) {
    e.preventDefault();

    sendForm('create');
});

$('#editForm').submit(function(e) {
    e.preventDefault();

    sendForm('edit');
});
