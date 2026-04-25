$('#redefinirForm').submit(function (event) {
    event.preventDefault();

    let token = $('#token').val();
    let senha = $('#senha').val();
    let confirmar = $('#confirmar_senha').val();

    let errors = [];

    if (!senha || senha.length < 6) {
        errors.push('A senha deve ter no mínimo 6 caracteres.');
    }

    if (senha !== confirmar) {
        errors.push('As senhas não conferem.');
    }

    if (errors.length > 0) {
        Swal.fire({
            icon: 'error',
            title: 'Campos inválidos!',
            html: errors.join('<br/>')
        });
        return;
    }

    let formData = new FormData();
    formData.append('token', token);
    formData.append('senha', senha);
    formData.append('confirmar_senha', confirmar);

    fetch('/senha/atualizar', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            Swal.fire({
                icon: 'success',
                title: 'Sucesso',
                text: data.message
            }).then(() => {
                window.location.href = '/auth';
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Erro',
                html: data.message
            });
        }
    })
    .catch(() => {
        Swal.fire({ icon: 'error', title: 'Falha de comunicação.' });
    });
});
