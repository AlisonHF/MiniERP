<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();
        $this->load->model('Usuario_model');
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
        $this->load->library('form_validation');
        $data = $this->input->post();

        $nome = $data['nome'];
        $email = $data['email'];
        $senha = $data['senha'];

        // Validação backend
        if (!$this->form_validation->run('usuario/store')) {
            return $this->outputJson([
                'status' => false,
                'message' => validation_errors()
            ]);
        }
        // Fim validação

        $hashSenha = password_hash($senha, PASSWORD_DEFAULT);

        $createUsuarioDTO = new CreateUsuarioDTO($nome, $email, $hashSenha);

        $this->Usuario_model->store($createUsuarioDTO);

        return $this->outputJson([
            'status' => true,
            'message' => ['Usuário cadastrado com sucesso!'],
        ]);
    }

    public function login()
    {
        $data = $this->input->post();

        $email = $data['email'];
        $senha = $data['senha'];

        $usuario = $this->Usuario_model->get_by_email($email);

        if (!$usuario) {
            return $this->outputJson([
                'status' => false,
                'message' => ['Usuário não encontrado!'],
            ]);
        }

        if (!password_verify($senha, $usuario['senha'])) {
            return $this->outputJson([
                'status' => false,
                'message' => ['Senha incorreta!'],
            ]);
        }

        return $this->outputJson([
            'status' => true,
            'message' => ['Logado!'],
        ]);
    }
}
