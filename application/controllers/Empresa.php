<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');


class Empresa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $conteudo = $this->load->view('empresa/create', [] , true);
        $css = ['empresa/create/create'];
        $js = ['empresa/create/create'];

        $this->load->view('template/template', [
            'conteudo' => $conteudo,
            'css' => $css,
            'js' => $js    
        ]);
    }

    public function store()
    {
        $data = $this->input->post();

        print_r($data);
        die;
    }
}
