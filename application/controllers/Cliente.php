<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->checkAuth()) {
            redirect(base_url() . 'auth/');
        }

        $this->load->model('Cliente_model');
        $this->load->library('form_validation');
    }

    public function index(): void
    {
        $this->load->library('pagination');
        $this->load->helper('Render_pagination_helper');

        $params = $this->input->post();

        $like = [];

        if (!empty($params['nome'])) {
            $like['nome'] = $params['nome'];
        }

        if (!empty($params['razao_social'])) {
            $like['razao_social'] = $params['razao_social'];
        }

        $total_rows = $this->Cliente_model->countAll($this->getEmpresaiD(), $like);
        $per_page   = isset($params['limite']) ? (int) $params['limite'] : 15;
        $offset     = (int) $this->uri->segment(2);

        $links = render_pagination_helper($total_rows, $per_page, 'cliente');

        $data['links']    = $links;
        $data['clientes'] = $this->Cliente_model->getPaginated($per_page, $offset, $this->getEmpresaiD(), $like);

        $this->load->view('cliente/index', $data);
    }

    public function create(): void
    {
        $this->load->view('cliente/form');
    }

    public function store()
    {
        $this->onlyPost();

        $data = $this->input->post();

        if (!$this->form_validation->run('cliente/store')) {
            return $this->outputJson(['status' => false, 'message' => validation_errors()]);
        }

        $clienteDto = new CreateClienteDTO(
            $data['cpf'] ?? null,
            $data['cnpj'] ?? null,
            $data['nome'] ?? null,
            $data['razao_social'] ?? null,
            $data['apelido']       ?? null,
            $data['nome_fantasia'] ?? null,
            $data['inscricao_estadual'] ?? null,
            $data['rg'] ?? null,
            $data['tipo_pessoa'],
            ($data['data_nascimento'] ?? '') ?: null,
            ($data['data_abertura']   ?? '') ?: null,
            $this->getEmpresaiD()
        );

        $this->db->trans_begin();

        $clienteId = $this->Cliente_model->store($clienteDto);

        if (!$clienteId) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao cadastrar cliente.',
            ]);
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Cliente cadastrado com sucesso!',
        ]);
    }

    public function edit(int $id): void
    {
        $cliente = $this->Cliente_model->getById($id, $this->getEmpresaiD());

        if (!$cliente) {
            redirect(base_url() . 'cliente/');
            return;
        }

        $this->load->view('cliente/form', ['cliente' => $cliente]);
    }

    public function update()
    {
        $this->onlyPost();

        $data = $this->input->post();

        if (!$this->form_validation->run('cliente/update')) {
            return $this->outputJson(['status' => false, 'message' => validation_errors()]);
        }

        $updateClienteDto = new UpdateClienteDTO(
            (int) $data['id'],
            $data['cpf'] ?? null,
            $data['cnpj'] ?? null,
            $data['nome'] ?? null,
            $data['razao_social'] ?? null,
            $data['apelido'] ?? null,
            $data['nome_fantasia'] ?? null,
            $data['inscricao_estadual'] ?? null,
            $data['rg'] ?? null,
            $data['tipo_pessoa'],
            ($data['data_nascimento'] ?? '') ?: null,
            ($data['data_abertura']   ?? '') ?: null,
            $this->getEmpresaiD()
        );

        $this->db->trans_begin();

        $update = $this->Cliente_model->update($updateClienteDto);

        if (!$update) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao editar o cliente!',
            ]);
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Cliente editado com sucesso!',
        ]);
    }

    public function delete()
    {
        $this->onlyPost();

        $id = (int) ($this->input->post())['id'];

        $this->db->trans_begin();

        $delete = $this->Cliente_model->delete($id, $this->getEmpresaiD());

        if (!$delete) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao excluir o cliente!',
            ]);
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Cliente excluído com sucesso!',
        ]);
    }
}
