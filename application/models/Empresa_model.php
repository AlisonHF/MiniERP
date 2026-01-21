<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }

    public function store(CreateEmpresaDTO $createEmpresaDto)
    {
        try {
            $this->db->insert('empresa', $createEmpresaDto->asArray());
            return $this->db->insert_id();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
