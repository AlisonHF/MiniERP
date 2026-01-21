<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Empresa_model');
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
        $this->load->library('form_validation');
        $data = $this->input->post();

        if (!$this->form_validation->run('empresa/store')) {
            return $this->outputJson([
                'status' => false,
                'message' => validation_errors()
            ]);
        }

        $createEmpresaDto = new CreateEmpresaDTO(
            $data['razaoSocial'],
            $data['nomeFantasia'],
            $data['cnpj'],
            $data['inscricaoEstadual'],
            $data['cep'],
            $data['endereco'],
            $data['bairro'],
            $data['numero'],
            $data['cidade'],
            $data['uf']
        );

        $id = $this->Empresa_model->store($createEmpresaDto);

        if ($id > 0) {
            return $this->outputJson([
                'status' => true,
                'message' => 'Empresa cadastrada com sucesso!',
                'id' => $id
            ]);
        }

        return $this->outputJson([
            'status' => false,
            'message' => 'Erro ao cadastrar empresa!'
        ]);

    }
}
