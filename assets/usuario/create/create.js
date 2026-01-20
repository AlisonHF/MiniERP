function formValidate(nome, email, senha, confirmarSenha) {
    let errors = [];

    // Validações
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
    // Fim validações

    if (errors.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Ocorreu um erro!',
            html: errors.map(field => `${field}`).join('<br/>')
        })

        return false;
    }

    return true;
}

function sendForm() {
    let nome = $('#nome').val();

    let email = $('#email').val();

    let senha = $('#senha').val();

    let confirmarSenha = $('#confirmarSenha').val();

    if (formValidate(nome, email, senha, confirmarSenha)) {
        let formData = new FormData();

        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('senha', senha);
        formData.append('confirmarSenha', confirmarSenha);

        fetch('/usuario/store', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const messages = data.message ? Object.values(data.message).map(message => message).join('<br>') : '';

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
                    title: 'Ocorreu um erro!',
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
