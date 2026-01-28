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
        $css = ['usuario/login'];
        $js = ['usuario/login'];

        $this->load->view('usuario/login', [
            'css' => $css,
            'js' => $js
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

        $this->session->set_userdata([
            'usuario_id' => $usuario['id'],
            'empresa_id' => $usuario['empresa'],
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
        $this->session->unset_userdata('usuario_id');
        $this->session->unset_userdata('empresa_id');
        $this->session->unset_userdata('tipo_usuario');

        $this->session->sess_regenerate();

        redirect(base_url() . 'usuario/');
    }
}
