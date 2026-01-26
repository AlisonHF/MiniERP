<?php
declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private array $user;

    public function __construct()
    {
        parent::__construct();
        $this->user = [
            'usuario_id' => $this->session->userdata('usuario_id') ?? null,
            'empresa_id' => $this->session->userdata('empresa_id') ?? null,
            'tipo_usuario' => $this->session->userdata('tipo_usuario') ?? null,
        ];
    }

    public function outputJson(array $data)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($data));
    }

    public function checkAuth()
    {
        return (
            $this->session->has_userdata('usuario_id') &&
            $this->session->has_userdata('empresa_id') &&
            $this->session->has_userdata('tipo_usuario')
        );
    }

    public function getUser()
    {
        return $this->user;
    }
}
