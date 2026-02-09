<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Produto_model extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->load->database();

        $this->table = 'produto';
    }

    public function getPaginated(int $limit, int $offset = 0, int $empresaId, array $like = [])
    {
        return $this->db->select([
            'id',
            'codigo',
            'descricao',
            'unidade',
            'preco',
            'created_at']
        )
        ->from($this->table)
        ->where('id_empresa', $empresaId)
        ->like($like)
        ->limit($limit, $offset)
        ->get()
        ->result_array();
    }

    public function countAll(int $empresaId, array $like = [])
    {
        $this->db->from($this->table);
        $this->db->where('id_empresa', $empresaId);
        $this->db->like($like);
        return $this->db->count_all_results();
    }

    public function store(CreateProdutoDTO $createProdutoDTO)
    {
        try {
            $this->db->insert($this->table, $createProdutoDTO->toArray());
            return $this->db->insert_id();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function getById(int $id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function update(UpdateProdutoDTO $updateProdutoDto)
    {
        $this->db->update(
            $this->table,
            [
                'codigo' => $updateProdutoDto->getCodigo(),
                'descricao' => $updateProdutoDto->getDescricao(),
                'unidade' => $updateProdutoDto->getUnidade(),
                'preco' => $updateProdutoDto->getPreco(),
                'imagem' => $updateProdutoDto->getImagem(),
                'update_at' => $updateProdutoDto->getUpdateAt()
            ],
            [
                'id_empresa' => $updateProdutoDto->getIdEmpresa(),
                'id' => $updateProdutoDto->getId()
            ]
        );

        return true;
    }

    public function delete(int $id, int $id_empresa)
    {
        $this->db->delete($this->table, ['id' => $id, 'id_empresa' => $id_empresa]);

        return true;
    }

}
