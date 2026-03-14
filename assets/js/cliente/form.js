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