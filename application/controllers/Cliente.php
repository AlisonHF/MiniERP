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
        // $this->load->library('pagination');
        // $this->load->helper('Render_pagination_helper');

        // $params = $this->input->post();
        
        // $like = [];

        // $total_rows = $this->Usuario_model->countAll($this->getEmpresaiD(), $like);
        // $per_page = isset($params['limite']) ? (int) $params['limite'] : 15;
        // $offset = (int) $this->uri->segment(2);

        // $links = render_pagination_helper($total_rows, $per_page, 'usuario');

        // $data['links'] = $links;
        // $data['cliente'] = $this->Cliente_model->getPaginated($per_page, $offset, $this->getEmpresaiD(), $like);

        $this->load->view('cliente/index');
    }

    public function create()
    {
        $this->load->view('cliente/form');
    }

//     public function store()
//     {
//         $this->onlyPost();

//         $data = $this->input->post();

//         if (!$this->form_validation->run('cliente/store')) {
//             return $this->outputJson(['status' => false, 'message' => validation_errors()]);
//         }

//         $this->db->trans_begin();

//         $clienteId = $this->Cliente_model->store();

//         if (!$clienteId) {
//             $this->db->trans_rollback();

//             return $this->outputJson([
//                 'status'  => false,
//                 'message' => 'Erro ao cadastrar cliente'
//             ]);
//         }

//         $this->db->trans_commit();

//         return $this->outputJson([
//             'status'  => true,
//             'message' => 'Cliente cadastrado com sucesso'
//         ]);

//     }

//     public function edit(int $id)
//     {
//         $data = [];

//         $cliente = $this->Cliente_model->getById($id);

//         $tiposUsuario = $this->TipoUsuario_model->getAll();

//         $data['tiposUsuario'] = $tiposUsuario;

//         if (!$cliente) {
//             redirect(base_url() . 'cliente/');
//             return;
//         }

//         $data['usuario'] = $cliente;

//         $this->load->view('cliente/form', $data);
//     }

//     public function update()
//     {
//         $this->onlyPost();

//         $cliente = $this->input->post();

//         if (!$this->form_validation->run('cliente/update')) {
//             return $this->outputJson(['status' => false, 'message' => validation_errors()]);
//         }

//         $update = $this->Cliente_model->update();
        
//         if (!$update)
//         {
//             $this->db->trans_rollback();

//             $this->outputJson(['status'  => false, 'message' => 'Erro ao editar o cliente!']);
//             return;
//         }

//         $this->db->trans_commit();

//         $this->outputJson(['status'  => true, 'message' => 'Cliente editado com sucesso!']);
//         return;
//     }

//     public function delete()
//     {
//         $this->onlyPost();

//         $id = (int) ($this->input->post())['id'];

//         $this->db->trans_begin();

//         $delete = $this->Cliente_model->delete($id, $this->getEmpresaiD());

//         if (!$delete)
//         {
//             $this->db->trans_rollback();

//             return $this->outputJson(['status'  => false, 'message' => 'Ocorreu um erro ao excluir esse cliente!']);
//         }

//         $this->db->trans_commit();

//         $this->outputJson(['status'  => true, 'message' => 'Cliente excluído com sucesso!']);
//         return;
//     }
}
