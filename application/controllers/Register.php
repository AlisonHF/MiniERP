<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('usuario_model');
        $this->load->model('empresa_model');

        $this->load->library('form_validation');
    }

    public function index()
    {
        $conteudo = $this->load->view('register/index', [], true);
        $css = ['register/index'];
        $js = ['register/index'];

        $this->load->view('template/template', [
            'conteudo' => $conteudo,
            'css'      => $css,
            'js'       => $js
        ]);
    }

    public function store()
    {
        $data = $this->input->post();

        if (!$this->form_validation->run('register/')) {
            return $this->outputJson([
                'status' => false,
                'message' => validation_errors()
            ]);
        }

        $this->db->trans_begin();

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

        $empresaId = $this->empresa_model->store($createEmpresaDto);

        if (!$empresaId) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao cadastrar empresa'
            ]);
        }

        $hashSenha = password_hash($data['senha'], PASSWORD_DEFAULT);

        $createUsuarioDto = new CreateUsuarioDTO(
            $data['nome'],
            $data['email'],
            $hashSenha,
            1,
            $empresaId // vínculo
        );

        $usuarioId = $this->usuario_model->store($createUsuarioDto);

        if (!$usuarioId) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao cadastrar usuário'
            ]);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao finalizar cadastro'
            ]);
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Conta criada com sucesso'
        ]);
    }
}
