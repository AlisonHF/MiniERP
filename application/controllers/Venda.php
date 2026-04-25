<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Venda extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->checkAuth()) {
            redirect(base_url() . 'auth/');
        }

        $this->load->model('Venda_model');
        $this->load->model('VendaItem_model');
        $this->load->model('Cliente_model');
        $this->load->model('Produto_model');
        $this->load->library('form_validation');
    }

    private function getIdUsuario(): int
    {
        return (int) $this->session->userdata('id_usuario');
    }

    public function index(): void
    {
        $this->load->library('pagination');
        $this->load->helper('Render_pagination_helper');

        $params = $this->input->post();

        $like = [];

        if (!empty($params['numero'])) {
            $like['venda.numero'] = $params['numero'];
        }

        if (!empty($params['status'])) {
            $like['venda.status'] = $params['status'];
        }

        $total_rows = $this->Venda_model->countAll($this->getEmpresaiD(), $like);
        $per_page   = isset($params['limite']) ? (int) $params['limite'] : 15;
        $offset     = (int) $this->uri->segment(2);

        $links = render_pagination_helper($total_rows, $per_page, 'venda');

        $data['links']  = $links;
        $data['vendas'] = $this->Venda_model->getPaginated($per_page, $offset, $this->getEmpresaiD(), $like);

        $this->load->view('venda/index', $data);
    }

    public function create(): void
    {
        $data = [
            'clientes' => $this->Cliente_model->getAllByEmpresa($this->getEmpresaiD()),
            'produtos' => $this->Produto_model->getAllByEmpresa($this->getEmpresaiD()),
            'numero'   => $this->Venda_model->generateNumero($this->getEmpresaiD()),
        ];

        $this->load->view('venda/form', $data);
    }

    public function store()
    {
        $this->onlyPost();

        $data  = $this->input->post();
        $itens = $data['itens'] ?? [];

        if (!$this->form_validation->run('venda/store')) {
            return $this->outputJson(['status' => false, 'message' => validation_errors()]);
        }

        if (empty($itens) || !is_array($itens)) {
            return $this->outputJson(['status' => false, 'message' => 'Adicione ao menos um item à venda.']);
        }

        $total = 0.0;

        foreach ($itens as $item) {
            $total += (float) ($item['subtotal'] ?? 0);
        }

        $createVendaDTO = new CreateVendaDTO(
            $data['numero'],
            (int) $data['id_cliente'],
            $this->getIdUsuario(),
            $this->getEmpresaiD(),
            $data['status'] ?? 'aberta',
            ($data['observacao'] ?? '') ?: null,
            $total
        );

        $this->db->trans_begin();

        $vendaId = $this->Venda_model->store($createVendaDTO);

        if (!$vendaId) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao cadastrar venda.',
            ]);
        }

        foreach ($itens as $item) {
            $itemDto = new CreateVendaItemDTO(
                $vendaId,
                (int) $item['id_produto'],
                (float) $item['quantidade'],
                (float) $item['preco_unitario'],
                (float) $item['subtotal']
            );

            if (!$this->VendaItem_model->store($itemDto)) {
                $this->db->trans_rollback();

                return $this->outputJson([
                    'status'  => false,
                    'message' => 'Erro ao cadastrar item da venda.',
                ]);
            }
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Venda cadastrada com sucesso!',
        ]);
    }

    public function edit(int $id): void
    {
        $venda = $this->Venda_model->getById($id, $this->getEmpresaiD());

        if (!$venda) {
            redirect(base_url() . 'venda/');
            return;
        }

        $data = [
            'venda'    => $venda,
            'itens'    => $this->VendaItem_model->getByVenda($id),
            'clientes' => $this->Cliente_model->getAllByEmpresa($this->getEmpresaiD()),
            'produtos' => $this->Produto_model->getAllByEmpresa($this->getEmpresaiD()),
        ];

        $this->load->view('venda/form', $data);
    }

    public function update()
    {
        $this->onlyPost();

        $data  = $this->input->post();
        $itens = $data['itens'] ?? [];

        if (!$this->form_validation->run('venda/update')) {
            return $this->outputJson(['status' => false, 'message' => validation_errors()]);
        }

        if (empty($itens) || !is_array($itens)) {
            return $this->outputJson(['status' => false, 'message' => 'Adicione ao menos um item à venda.']);
        }

        $total = 0.0;

        foreach ($itens as $item) {
            $total += (float) ($item['subtotal'] ?? 0);
        }

        $updateVendaDTO = new UpdateVendaDTO(
            (int) $data['id'],
            (int) $data['id_cliente'],
            $this->getEmpresaiD(),
            $data['status'] ?? 'aberta',
            ($data['observacao'] ?? '') ?: null,
            $total
        );

        $this->db->trans_begin();

        $update = $this->Venda_model->update($updateVendaDTO);

        if (!$update) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao editar a venda!',
            ]);
        }

        $this->VendaItem_model->deleteByVenda((int) $data['id']);

        foreach ($itens as $item) {
            $itemDto = new CreateVendaItemDTO(
                (int) $data['id'],
                (int) $item['id_produto'],
                (float) $item['quantidade'],
                (float) $item['preco_unitario'],
                (float) $item['subtotal']
            );

            if (!$this->VendaItem_model->store($itemDto)) {
                $this->db->trans_rollback();

                return $this->outputJson([
                    'status'  => false,
                    'message' => 'Erro ao atualizar itens da venda.',
                ]);
            }
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Venda editada com sucesso!',
        ]);
    }

    public function delete()
    {
        $this->onlyPost();

        $id = (int) ($this->input->post())['id'];

        $this->db->trans_begin();

        $delete = $this->Venda_model->delete($id, $this->getEmpresaiD());

        if (!$delete) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao excluir a venda!',
            ]);
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Venda excluída com sucesso!',
        ]);
    }
}
