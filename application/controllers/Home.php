<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('usuario_id') ||
            !$this->session->userdata('empresa_id') ||
            !$this->session->userdata('tipo_usuario')
        ) {
            redirect(base_url() . 'usuario/');
        }
    }

    public function index()
    {
        $conteudo = $this->load->view('home/index', [], true);

        $css = ['home/index/index'];

        $this->load->view('template/template', [
            'conteudo' => $conteudo,
            'css' => $css,
            'user' => $this->getUser()
        ]);
    }
}
