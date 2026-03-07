<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends MY_Controller
{
    public function __construct() 
    {
        parent::__construct();

        if (!$this->checkAuth()) {
            redirect(base_url() . 'auth/');
        }

        $this->load->model('Usuario_model');
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

        if (!empty($params['email'])) {
            $like['email'] = $params['email'];
        }

        $total_rows = $this->Usuario_model->countAll($this->getEmpresaiD(), $like);
        $per_page = isset($params['limite']) ? (int) $params['limite'] : 15;
        $offset = (int) $this->uri->segment(2);

        $links = render_pagination_helper($total_rows, $per_page, 'usuario');

        $data['links'] = $links;
        $data['usuarios'] = $this->Usuario_model->getPaginated($per_page, $offset, $this->getEmpresaiD(), $like);

        $this->load->view('usuario/index', $data);
    }

    public function create()
    {
        $this->load->view('usuario/form');
    }

    public function store()
    {
        $this->onlyPost();

        
        $data = $this->input->post();

        if (!$this->form_validation->run('usuario/store')) {
            return $this->outputJson(['status' => false, 'message' => validation_errors()]);
        }

        $hashSenha = password_hash($data['senha'], PASSWORD_DEFAULT);

        $createUsuarioDto = new CreateUsuarioDTO(
            $data['nome'],
            $data['email'],
            $hashSenha,
            (int) $data['tipo'],
            $this->getEmpresaiD()
        );

        $this->db->trans_begin();

        $usuarioId = $this->Usuario_model->store($createUsuarioDto);

        if (!$usuarioId) {
            $this->db->trans_rollback();

            return $this->outputJson([
                'status'  => false,
                'message' => 'Erro ao cadastrar usuário'
            ]);
        }

        $this->db->trans_commit();

        return $this->outputJson([
            'status'  => true,
            'message' => 'Usuário criado com sucesso'
        ]);

    }

}
