function validateForm(
    nome,
    email,
    senha,
    tipoUsuario,
    url
) {
    let errors = [];

    if (!nome) {
        errors.push('Nome é obrigatório.');
    } else if (nome.length < 3) {
        errors.push('Nome deve ter no mínimo 3 caracteres.');
    }

    if (!email) {
        errors.push('E-mail é obrigatório.');
    } else if (email.length > 255) {
        errors.push('E-mail deve ter no máximo 255 caracteres.');
    }

    if (url == 'create')
    {
        if (!senha) {
            errors.push('O campo Senha é obrigatório.');
        } else if (senha.length < 6) {
            errors.push('O campo Senha deve ter 6 digitos ou mais.');
        }
    }

    if (!tipoUsuario) {
        errors.push('O campo Tipo de usuário é obrigatório.');
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

function sendForm(url) {
    let nome = $('#nome').val();
    let email = $('#email').val();
    let senha = $('#senha').val();
    let tipoUsuario = $('#tipo_usuario').val();

    if (!validateForm(nome, email, senha, tipoUsuario, url)) {
        return false;
    }

    let formData = new FormData();

    formData.append('nome', nome);
    formData.append('email', email);
    formData.append('senha', senha);
    formData.append('tipo_usuario', tipoUsuario);

    if (url == 'update') {
        let id = $('#id').val();

        formData.append('id', id);
    }

    fetch(`/usuario/${url}`, {
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
                    window.location.href = '/usuario';
                    return;
                }
                
                window.location.href = '/usuario/create';
                
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