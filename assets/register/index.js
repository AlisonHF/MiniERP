function formValidateEmpresa(
    razaoSocial,
    nomeFantasia,
    cnpj,
    inscricaoEstadual,
    cep,
    endereco,
    bairro,
    numero,
    cidade,
    uf
) {
    let errors = [];

    if (!razaoSocial) {
        errors.push('Razão Social é obrigatória.');
    } else if (razaoSocial.length > 255) {
        errors.push('Razão Social deve ter no máximo 255 caracteres.');
    }

    if (nomeFantasia.length > 255) {
        errors.push('Nome Fantasia deve ter no máximo 255 caracteres.');
    }

    if (!cnpj) {
        errors.push('CNPJ é obrigatório.');
    } else if (cnpj.length > 14 || cnpj.length < 14) {
        errors.push('CNPJ deve ter 14 caracteres.');
    }

    if (!inscricaoEstadual) {
        errors.push('Inscrição Estadual é obrigatória.');
    } else if (inscricaoEstadual.length > 14) {
        errors.push('Inscrição Estadual deve ter no máximo 14 caracteres.');
    } else if (inscricaoEstadual.length < 7) {
        errors.push('Inscrição Estadual deve ter no mínimo 7 caracteres.');
    }

    if (!cep) {
        errors.push('CEP é obrigatório.');
    } else if (cep.length > 8 || cep.length < 8) {
        errors.push('CEP inválido.');
    }

    if (!endereco) {
        errors.push('Endereço é obrigatório.');
    } else if (endereco.length > 255) {
        errors.push('Endereço deve ter no máximo 255 caracteres.');
    }

    if (!bairro) {
        errors.push('Bairro é obrigatório.');
    } else if (bairro.length > 255) {
        errors.push('Bairro deve ter no máximo 255 caracteres.');
    }

    if (!numero) {
        errors.push('Número é obrigatório.');
    }

    if (!cidade) {
        errors.push('Cidade é obrigatória.');
    } else if (cidade.length > 255) {
        errors.push('Cidade deve ter no máximo 255 caracteres.');
    }

    if (!uf) {
        errors.push('UF é obrigatória.');
    } else if (uf.length > 2) {
        errors.push('UF deve ter 2 caracteres.');
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

function formValidateUsuario(nome, email, senha, confirmarSenha) {
    let errors = [];

    if (!nome) {
        errors.push('O campo nome é obrigatório!');
    } else if (nome.length < 3) {
        errors.push('O nome precisa ter mais de 3 caracteres!');
    } else if (nome.length > 100) {
        errors.push('O nome não pode ter mais de 100 caracteres!');
    }

    if (!email) {
        errors.push('O campo e-mail é obrigatório!');
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
        errors.push('Digite um e-mail válido!');
    }

    if (!senha) {
        errors.push('O campo senha é obrigatório!');
    } else if (senha.length < 6) {
        errors.push('O campo senha deve ter mais de 6 caracteres!');
    } else if (senha.length > 32) {
        errors.push('O campo senha não pode conter mais que 32 caracteres!');
    }

    if (!confirmarSenha) {
        errors.push('O campo confirme sua senha é obrigatório!');
    } else if (senha != confirmarSenha) {
        errors.push('As senhas são diferentes!');
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

function sendForm() {
    // Usuario
    let nome = $('#nome').val();

    let email = $('#email').val();

    let senha = $('#senha').val();

    let confirmarSenha = $('#confirmarSenha').val();

    // Empresa
    let razaoSocial = $('#razaoSocial').val();
    
    let nomeFantasia = $('#nomeFantasia').val();
    
    let cnpj = $('#cnpj').val();
    
    let inscricaoEstadual = $('#inscricaoEstadual').val();
    
    let cep = $('#cep').val();
    
    let endereco = $('#endereco').val();
    
    let bairro = $('#bairro').val();
    
    let numero = $('#numero').val();
    
    let cidade = $('#cidade').val();
    
    let uf = $('#uf').val();

    if (formValidateUsuario(nome, email, senha, confirmarSenha) && 
        formValidateEmpresa(razaoSocial, nomeFantasia, cnpj, inscricaoEstadual, cep, endereco, bairro, numero, cidade, uf)
    ) {
        let formData = new FormData();

        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('senha', senha);
        formData.append('confirmarSenha', confirmarSenha);
        formData.append('razaoSocial', razaoSocial);
        formData.append('nomeFantasia', nomeFantasia);
        formData.append('cnpj', cnpj);
        formData.append('inscricaoEstadual', inscricaoEstadual);
        formData.append('cep', cep);
        formData.append('endereco', endereco);
        formData.append('bairro', bairro);
        formData.append('numero', numero);
        formData.append('cidade', cidade);
        formData.append('uf', uf);

        fetch('/register/store', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const messages = data.message;

            if (data.status) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sucesso!',
                    html: messages,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/';
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Campo inválido!',
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
}

$('#createForm').submit(function(event) {
    event.preventDefault();
    sendForm();
});
