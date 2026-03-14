function validatePessoaFisica(nome, cpf, rg, apelido, data_nascimento) {
    let errors = [];

    if (!nome) {
        errors.push('Nome é obrigatório.');
    } else if (nome.length > 150) {
        errors.push('Nome deve ter no máximo 255 caracteres.');
    }

    if (!cpf) {
        errors.push('CPF é obrigatório.');
    } else if (cpf.length > 14) {
        errors.push('CPF deve ter no máximo 14 caracteres.');
    }

    if (rg && rg.length > 15) {
        errors.push('RG deve ter no máximo 15 caracteres.');
    }

    if (apelido && apelido.length > 255) {
        errors.push('Apelido deve ter no máximo 255 caracteres.');
    }

    if (data_nascimento && data_nascimento.length > 10) {
        errors.push('Data de nascimento inválida.');
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

function validatePessoaJuridica(razao_social, cnpj, inscricao_estadual, nome_fantasia, data_abertura) {
    let errors = [];

    if (!razao_social) {
        errors.push('Razão social é obrigatória.');
    } else if (razao_social.length > 150) {
        errors.push('Razão social deve ter no máximo 255 caracteres.');
    }

    if (!cnpj) {
        errors.push('CNPJ é obrigatório.');
    } else if (cnpj.length > 18) {
        errors.push('CNPJ deve ter no máximo 18 caracteres.');
    }

    if (nome_fantasia && nome_fantasia.length > 255) {
        errors.push('Nome fantasia deve ter no máximo 255 caracteres.');
    }

    // Inscrição Estadual
    if (inscricao_estadual && inscricao_estadual.length > 30) {
        errors.push('Inscrição estadual deve ter no máximo 30 caracteres.');
    }

    // Data de abertura
    if (data_abertura && data_abertura.length > 10) {
        errors.push('Data de abertura inválida.');
    }

    if (errors.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Campos inválidos!',
            html: errors.map(field => `${field}`).join('<br/>')
        });

        return false;
    }

    return true;
}

function sendForm(url)
{
    let tipo_pessoa = $("#tipo_pessoa").val();
    let nome = $("#nome").val();
    let razao_social = $("#razao_social").val();
    let cpf = $("#cpf").val();
    let cnpj = $("#cnpj").val();
    let rg = $("#rg").val();
    let inscricao_estadual = $("#inscricao_estadual").val();
    let apelido = $("#apelido").val();
    let nome_fantasia = $("#nome_fantasia").val();
    let data_nascimento = $("#data_nascimento").val();
    let data_abertura = $("#data_abertura").val();

    let formData = new FormData();

    if (tipo_pessoa == 'F') {
        if (!validatePessoaFisica(nome, cpf, rg, apelido, data_nascimento)) {
            return false;
        }

        formData.append('nome', nome);
        formData.append('cpf', cpf);
        formData.append('rg', rg);
        formData.append('apelido', apelido);
        formData.append('data_nascimento', data_nascimento);
    } else {
        if (!validatePessoaJuridica(razao_social, cnpj, inscricao_estadual, nome_fantasia, data_abertura)) {
            return false;
        }

        formData.append('razao_social', razao_social);
        formData.append('cnpj', cnpj);
        formData.append('inscricao_estadual', inscricao_estadual);
        formData.append('nome_fantasia', nome_fantasia);
        formData.append('data_abertura', data_abertura);
    }

    if (url == 'update') {
        let id = $('#id').val();

        formData.append('id', id);
    }

    fetch(`/cliente/${url}`, {
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
                if (url == 'update') {
                    window.location.href = '/cliente';
                    return;
                }
                
                window.location.href = '/cliente/create';
                
            })
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
            message: error
        });
    });
}

$('#createForm').submit(function(e) {
    e.preventDefault();

    sendForm('store');
});

$('#editForm').submit(function(e) {
    e.preventDefault();

    sendForm('update');
});

$(document).ready(function () {
    $("#tipo_pessoa").on('change', function (){
        let tipoPessoa = $("#tipo_pessoa").val();

        // Campos

        let divNome = $("#div_nome");
        let divRazao = $("#div_razao");
        let divCpf = $("#div_cpf");
        let divCnpj = $("#div_cnpj");
        let divRg = $("#div_rg");
        let divInscricao = $("#div_inscricao");
        let divApelido = $("#div_apelido");
        let divNomeFantasia = $("#div_nome_fantasia");
        let divDataNascimento = $("#div_data_nascimento");
        let divDataAbertura = $("#div_data_abertura");
        
        if (tipoPessoa.toUpperCase() == 'F') {
            divRazao.hide();
            divCnpj.hide();
            divInscricao.hide();
            divNomeFantasia.hide();
            divDataAbertura.hide();

            divNome.show();
            divCpf.show();
            divRg.show();
            divApelido.show();
            divDataNascimento.show();
        } else if (tipoPessoa.toUpperCase() == 'J') {
            divNome.hide();
            divCpf.hide();
            divRg.hide();
            divApelido.hide();
            divDataNascimento.hide();

            divRazao.show();
            divCnpj.show();
            divInscricao.show();
            divNomeFantasia.show();
            divDataAbertura.show();            
        }
    });

    $("#tipo_pessoa").trigger('change');
})