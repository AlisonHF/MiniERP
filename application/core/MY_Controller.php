<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private array|bool $user;

    public function __construct()
    {
        parent::__construct();

        $this->user = [
            'id_usuario' => $this->session->userdata('id_usuario') ?? '',
            'id_empresa' => $this->session->userdata('id_empresa') ?? '',
            'tipo_usuario' => $this->session->userdata('tipo_usuario') ?? '',
        ];

        $this->user = array_filter($this->user) ? $this->user : false;

        $this->load->vars([
            'user' => $this->user
        ]);
    }

    public function outputJson(array $data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function checkAuth()
    {
        if ($this->user)
        {
            return true;
        }

        return false;
    }

    public function getEmpresaiD()
    {
        return (int) $this->user['empresa_id'];
    }

    protected function onlyPost(): void
    {
        if ($this->input->method() !== 'post') {
            if ($this->checkAuth()) {
                redirect('home');
                exit;
            }

            redirect('usuario');
            exit;
        }
    }
}
