<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getPaginated(int $limit, int $offset = 0, int $empresaId)
    {
        return $this->db->select([
            'id',
            'codigo',
            'descricao',
            'unidade',
            'preco',
            'created_at']
        )
        ->from('produto')
        ->where('id_empresa', $empresaId)
        ->limit($limit, $offset)
        ->get()
        ->result_array();
    }

    public function countAll(int $empresaId)
    {
        $this->db->from('produto');
        $this->db->where('id_empresa', $empresaId);
        return $this->db->count_all_results();
    }

    public function store(CreateProdutoDTO $createProdutoDTO)
    {
        try {
            $this->db->insert('produto', $createProdutoDTO->toArray());
            return $this->db->insert_id();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
