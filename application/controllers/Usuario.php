<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller
{
    private array $rules;

    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Usuario/Usuario_model');

        $this->rules = [
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
            ]
        ];
    }

    public function index(): void
    {
        $conteudo = $this->load->view('usuario/login', [] , true);
        $css = ['usuario/login/login'];
        $js = ['usuario/login/login'];

        $this->load->view('template/template', [
            'conteudo' => $conteudo,
            'css' => $css,
            'js' => $js    
        ]);
    }

    public function create()
    {
        $conteudo = $this->load->view('usuario/create', [] , true);
        $css = ['usuario/create/create'];
        $js = ['usuario/create/create'];

        $this->load->view('template/template', [
            'conteudo' => $conteudo,
            'css' => $css,
            'js' => $js    
        ]);
    }

    public function store()
    {
        $this->load->helper('form_validation');
        $data = $this->input->post();

        $nome = $data['nome'];
        $email = $data['email'];
        $senha = $data['senha'];

        // Validação backend

        $validation = form_validation_helper($this->rules);

        if (!empty($validation)) {
            return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
                'status' => false,
                'message' => $validation
            ]));
        }

        // Fim validação

        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

        $createUsuarioDTO = new CreateUsuarioDTO($nome, $email, $hashSenha);

        $this->Usuario_model->store($createUsuarioDTO);

        return $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode([
            'status' => true,
            'message' => ['Usuário cadastrado com sucesso!'],
        ]));

    }
}
