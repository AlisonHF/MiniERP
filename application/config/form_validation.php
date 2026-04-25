<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

$config = [
    'register/' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|min_length[3]|max_length[100]'
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[usuario.email]'
        ],
        [
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required|min_length[6]|max_length[255]'
        ],
        [
            'field' => 'confirmarSenha',
            'label' => 'Confirme sua senha',
            'rules' => 'required|matches[senha]'
        ],
        [
            'field' => 'razaoSocial',
            'label' => 'Razão Social',
            'rules' => 'required|min_length[3]|max_length[255]'
        ],
        [
            'field' => 'nomeFantasia',
            'label' => 'Nome Fantasia',
            'rules' => 'min_length[3]|max_length[255]'
        ],
        [
            'field' => 'cnpj',
            'label' => 'CNPJ',
            'rules' => 'required|exact_length[14]|is_unique[empresa.cnpj]'
        ],
        [
            'field' => 'inscricaoEstadual',
            'label' => 'Inscrição Estadual',
            'rules' => 'max_length[15]'
        ],
        [
            'field' => 'cep',
            'label' => 'CEP',
            'rules' => 'required|exact_length[8]'
        ],
        [
            'field' => 'endereco',
            'label' => 'Endereço',
            'rules' => 'required|max_length[255]'
        ],
        [
            'field' => 'bairro',
            'label' => 'Bairro',
            'rules' => 'required|max_length[255]'
        ],
        [
            'field' => 'numero',
            'label' => 'Número',
            'rules' => 'required|max_length[10]'
        ],
        [
            'field' => 'cidade',
            'label' => 'Cidade',
            'rules' => 'required|min_length[3]|max_length[255]'
        ],
        [
            'field' => 'uf',
            'label' => 'UF',
            'rules' => 'required|exact_length[2]'
        ],
    ],
    'produto/store' => [
        [
            'field' => 'codigo',
            'label' => 'Código',
            'rules' => 'required|max_length[20]|unique_field[produto.codigo.id.id_empresa]'
        ],
        [
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'required|max_length[255]'
        ],
        [
            'field' => 'unidade',
            'label' => 'Unidade',
            'rules' => 'max_length[10]'
        ],
    ],
    'produto/update' => [
        [
            'field' => 'codigo',
            'label' => 'Código',
            'rules' => 'required|max_length[20]|unique_field[produto.codigo.id.id_empresa]'
        ],
        [
            'field' => 'descricao',
            'label' => 'Descrição',
            'rules' => 'required|max_length[255]'
        ],
        [
            'field' => 'unidade',
            'label' => 'Unidade',
            'rules' => 'max_length[10]'
        ],
    ],
    'usuario/store' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|min_length[3]|max_length[100]'
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|is_unique[usuario.email]'
        ],
        [
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required|min_length[6]|max_length[255]'
        ],
        [
            'field' => 'tipo_usuario',
            'label' => 'Tipo usuário',
            'rules' => 'required'
        ],
    ],
    'usuario/update' => [
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'required|min_length[3]|max_length[100]'
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email|unique_field[usuario.email.id.id_empresa]'
        ],
        [
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'min_length[6]|max_length[255]'
        ],
        [
            'field' => 'tipo_usuario',
            'label' => 'Tipo usuário',
            'rules' => 'required'
        ],
    ],
    'cliente/update' => [
        [
            'field' => 'id',
            'label' => 'ID',
            'rules' => 'required|integer'
        ],
        [
            'field' => 'cpf',
            'label' => 'CPF',
            'rules' => 'max_length[11]'
        ],
        [
            'field' => 'cnpj',
            'label' => 'CNPJ',
            'rules' => 'max_length[14]'
        ],
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'razao_social',
            'label' => 'Razão Social',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'apelido',
            'label' => 'Apelido',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'nome_fantasia',
            'label' => 'Nome Fantasia',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'inscricao_estadual',
            'label' => 'Inscrição Estadual',
            'rules' => 'max_length[30]'
        ],
        [
            'field' => 'rg',
            'label' => 'RG',
            'rules' => 'max_length[14]'
        ],
        [
            'field' => 'tipo_pessoa',
            'label' => 'Tipo Pessoa',
            'rules' => 'required'
        ],
        [
            'field' => 'data_nascimento',
            'label' => 'Data Nascimento',
            'rules' => 'max_length[10]'
        ],
        [
            'field' => 'data_abertura',
            'label' => 'Data Abertura',
            'rules' => 'max_length[10]'
        ],
    ],
    'cliente/store' => [
        [
            'field' => 'cpf',
            'label' => 'CPF',
            'rules' => 'max_length[11]|is_unique[cliente.cpf]'
        ],
        [
            'field' => 'cnpj',
            'label' => 'CNPJ',
            'rules' => 'max_length[14]|is_unique[cliente.cnpj]'
        ],
        [
            'field' => 'nome',
            'label' => 'Nome',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'razao_social',
            'label' => 'Razão Social',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'apelido',
            'label' => 'Apelido',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'nome_fantasia',
            'label' => 'Nome Fantasia',
            'rules' => 'max_length[255]'
        ],
        [
            'field' => 'inscricao_estadual',
            'label' => 'Inscrição Estadual',
            'rules' => 'max_length[30]'
        ],
        [
            'field' => 'rg',
            'label' => 'RG',
            'rules' => 'max_length[14]'
        ],
        [
            'field' => 'tipo_pessoa',
            'label' => 'Tipo Pessoa',
            'rules' => 'required'
        ],
        [
            'field' => 'data_nascimento',
            'label' => 'Data Nascimento',
            'rules' => 'max_length[10]'
        ],
        [
            'field' => 'data_abertura',
            'label' => 'Data Abertura',
            'rules' => 'max_length[10]'
        ]
    ],
    'venda/store' => [
        [
            'field' => 'numero',
            'label' => 'Número',
            'rules' => 'required|max_length[20]'
        ],
        [
            'field' => 'id_cliente',
            'label' => 'Cliente',
            'rules' => 'required|integer'
        ],
        [
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required|in_list[aberta,finalizada,cancelada]'
        ],
    ],
    'senha/atualizar' => [
        [
            'field' => 'token',
            'label' => 'Token',
            'rules' => 'required|min_length[10]'
        ],
        [
            'field' => 'senha',
            'label' => 'Senha',
            'rules' => 'required|min_length[6]|max_length[255]'
        ],
        [
            'field' => 'confirmar_senha',
            'label' => 'Confirmar senha',
            'rules' => 'required|matches[senha]'
        ],
    ],
    'venda/update' => [
        [
            'field' => 'id',
            'label' => 'ID',
            'rules' => 'required|integer'
        ],
        [
            'field' => 'id_cliente',
            'label' => 'Cliente',
            'rules' => 'required|integer'
        ],
        [
            'field' => 'status',
            'label' => 'Status',
            'rules' => 'required|in_list[aberta,finalizada,cancelada]'
        ],
    ],
];
