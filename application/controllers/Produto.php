<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Produto extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->checkAuth()) {
            redirect(base_url() . 'usuario/');
        }

        $this->load->model('Produto_model', 'produto_model');
        $this->load->library('form_validation');
    }

    public function create()
    {
        $js = ['produto/create'];
        $css = ['produto/create'];

        $this->load->view('produto/create', [
            'css' => $css,
            'js' => $js
        ]);
    }

    public function store()
    {
        $produtos = $this->input->post();

        if (!$this->form_validation->run('produto/store')) {
            return $this->outputJson([
                'status' => false,
                'message' => validation_errors()
            ]);
        }

        $createProdutoDTO = new CreateProdutoDTO(
            $produtos['codigo'],
            $produtos['descricao'],
            $produtos['unidade'] ?? null,
            (float) $produtos['preco'] ?? null,
            $produtos['image'] ?? null
        );

        $this->db->trans_begin();

        $produto = $this->produto_model->store($createProdutoDTO);

        if (!$produto) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao cadastrar empresa'
            ]);
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Produto cadastrado com sucesso!'
        ]);
    }
}
