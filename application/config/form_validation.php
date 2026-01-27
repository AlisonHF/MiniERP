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
            'rules' => 'required|min_length[9]|max_length[15]'
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
            'rules' => 'required|max_length[20]|is_unique[produto.codigo]'
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
        [
            'field' => 'preco',
            'label' => 'Preço',
            'rules' => 'decimal'
        ],
        [
            'field' => 'imagem',
            'label' => 'Imagem',
            'rules' => 'max_size[2048]|is_image'
        ],
    ]
];
