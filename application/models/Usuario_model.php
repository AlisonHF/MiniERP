<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model
{
    private string $table;
    public function __construct()
    {
        parent::__construct();

        $this->table = 'usuario';

        $this->load->database();
    }

    public function getPaginated(int $limit, int $offset = 0, int $idEmpresa, array $like = [])
    {
        try {
            return $this->db->select([
                'id',
                'nome',
                'email',
                'tipo_usuario',
                'created_at'
            ])
            ->from($this->table)
            ->where('id_empresa', $idEmpresa)
            ->like($like)
            ->limit($limit, $offset)
            ->get()
            ->result_array();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function countAll(int $idEmpresa, array $like = [])
    {
        $this->db->from($this->table)
        ->where('id_empresa', $idEmpresa)
        ->like($like);
        return $this->db->count_all_results();
    }
    
    public function store(CreateUsuarioDTO $createUsuarioDTO)
    {
        try {
            $this->db->insert($this->table, $createUsuarioDTO->toArray());
            return $this->db->insert_id();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function get_by_email($email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row_array();
    }
}
