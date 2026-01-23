function formValidate(email, senha)
{
    let errors = [];

    if (!email) {
        errors.push('O campo e-mail é obrigatório!');
    } else if (!/^\S+@\S+\.\S+$/.test(email)) {
        errors.push('Digite um e-mail válido!');
    }

    if (!senha) {
        errors.push('O campo senha é obrigatório!');
    }

    if (errors.length > 0)
    {
        Swal.fire({
            icon: 'error',
            title: 'Ocorreu um erro!',
            html: errors.map(error => error).join('<br/>')
        })
        return false;
    }

    return true;
}

function sendForm()
{
    let email = $('#email').val().trim();
    let senha = $('#senha').val().trim();

    if (formValidate(email, senha)) {
        let formData = new FormData();

        formData.append('email', email);
        formData.append('senha', senha);

        fetch('/usuario/login', {
            method: 'post',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const messages = data.message ? Object.values(data.message).map(message => message).join('<br>') : '';

            if (data.status) {
                window.location.href = '/home';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Login negado!',
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

$('#loginForm').submit(function(event) {
    event.preventDefault();

    sendForm();
});