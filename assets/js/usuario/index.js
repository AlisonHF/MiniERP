$('.delete').on('click', function() {
    Swal.fire({
        title: "Tem certeza?",
        text: "Após a exclusão, não será possível recuperar este usuário!",
        icon: "warning",
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Sim, excluir',
        cancelButtonText: 'Cancelar',
    })
    .then((result) => {
        if (result.isConfirmed) {
            let formData = new FormData;
            let id = $(this).attr('id');

            formData.append('id', id);

            fetch('/usuario/delete', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const messages = data.message;

                if (data.status) {
                    Swal.fire({
                        title: 'Sucesso',
                        text: messages,
                        icon: "success",
                    })
                    .then(() => {
                        window.location.href = '/usuario';
                        return;
                    })

                } else {
                    Swal.fire({
                        title: 'Ocorreu um erro',
                        text: messages,
                        icon: "error",
                    });
                }
            })
        } else {
            Swal.fire({
                title: 'Cancelado',
                text: 'O usuário não foi excluído!',
                icon: "error",
            });
        }
    });
})
