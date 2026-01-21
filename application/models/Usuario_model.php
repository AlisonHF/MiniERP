<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    public function store(CreateUsuarioDTO $createUsuarioDTO)
    {
        try {
            $this->db->insert('usuario', $createUsuarioDTO->toArray());
            return $this->db->insert_id();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_by_email($email)
    {
        return $this->db->get_where('usuario', ['email' => $email])->row_array();
    }
}
