<?php

declare(strict_types=1);

class TipoUsuario_model extends CI_Model
{
    private string $table;

    public function __construct()
    {
        $this->load->database();

        $this->table = 'tipo_usuario';
    }

    public function getAll()
    {
        return $this->db->get($this->table)->result_array();
    }
}
