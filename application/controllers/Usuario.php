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
        $this->load->model('TipoUsuario_model');

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
        $tiposUsuario = $this->TipoUsuario_model->getAll();

        $data['tiposUsuario'] = $tiposUsuario;

        $this->load->view('usuario/form', $data);
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
            (int) $data['tipo_usuario'],
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

    public function edit(int $id)
    {
        $data = [];

        $usuario = $this->Usuario_model->getById($id);

        $tiposUsuario = $this->TipoUsuario_model->getAll();

        $data['tiposUsuario'] = $tiposUsuario;

        if (!$usuario) {
            redirect(base_url() . 'usuario/');
            return;
        }

        $data['usuario'] = $usuario;

        $this->load->view('usuario/form', $data);
    }

    public function update()
    {
        $this->onlyPost();

        $usuario = $this->input->post();

        if (!$this->form_validation->run('usuario/update')) {
            return $this->outputJson(['status' => false, 'message' => validation_errors()]);
        }

        $hashSenha = null;

        if (!empty($usuario['senha']))
        {
            $hashSenha = password_hash($usuario['senha'], PASSWORD_DEFAULT);
        }

        $updateUsuarioDto = new UpdateUsuarioDTO(
            (int) $usuario['id'],
            $usuario['nome'],
            $usuario['email'],
            $hashSenha,
            (int) $usuario['tipo_usuario']
        );

        $update = $this->Usuario_model->update($updateUsuarioDto);
        
        if (!$update)
        {
            $this->db->trans_rollback();

            $this->outputJson(['status'  => false, 'message' => 'Erro ao editar o usuário!']);
            return;
        }

        $this->db->trans_commit();

        $this->outputJson(['status'  => true, 'message' => 'Usuário editado com sucesso!']);
        return;
    }
}
