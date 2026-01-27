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
            'usuario_id' => $this->session->userdata('usuario_id') ?? '',
            'empresa_id' => $this->session->userdata('empresa_id') ?? '',
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
}
