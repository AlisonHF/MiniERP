$('#solicitarForm').submit(function (event) {
    event.preventDefault();

    let email = $('#email').val().trim();

    if (!email) {
        Swal.fire({ icon: 'error', title: 'Informe um e-mail.' });
        return;
    }

    let formData = new FormData();
    formData.append('email', email);

    fetch('/senha/enviar', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.status) {
            Swal.fire({
                icon: 'success',
                title: 'Pronto!',
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
