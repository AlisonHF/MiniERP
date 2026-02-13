<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Auth_model');
    }

    public function index(): void
    {
        if ($this->checkAuth())
        {
            redirect(base_url() . 'home/');
        }
    
        $this->load->view('auth/index');
    }

    public function login()
    {
        $this->onlyPost();

        $data = $this->input->post();

        $email = $data['email'];
        $senha = $data['senha'];

        $usuario = $this->Auth_model->get_by_email($email);

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

        $this->session->set_userdata([
            'id_usuario' => $usuario['id'],
            'id_empresa' => $usuario['id_empresa'],
            'tipo_usuario' => $usuario['tipo_usuario']
        ]);

        $this->session->sess_regenerate();

        return $this->outputJson([
            'status' => true,
            'message' => ['Logado!'],
        ]);
    }

    public function logout()
    {
        $this->session->unset_userdata('id_usuario');
        $this->session->unset_userdata('id_empresa');
        $this->session->unset_userdata('tipo_usuario');

        $this->session->sess_regenerate();

        redirect(base_url() . 'auth/');
    }
}
