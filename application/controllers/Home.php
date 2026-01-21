<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $conteudo = $this->load->view('home/index', [], true);

        $css = ['home/index/index'];

        $data = [ 
            'total_empresas' => 2,
            'total_produtos' => 15,
            'total_usuarios' => 4];

        $this->load->view('template/template', [
            'conteudo' => $conteudo,
            'css' => $css,
        ]);
    }
}
