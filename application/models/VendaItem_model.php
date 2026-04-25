<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class VendaItem_model extends CI_Model
{
    private string $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = 'venda_item';

        $this->load->database();
    }

    public function store(CreateVendaItemDTO $createVendaItemDTO)
    {
        try {
            $this->db->insert($this->table, $createVendaItemDTO->toArray());
            return (int) $this->db->insert_id();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getByVenda(int $idVenda)
    {
        return $this->db->select([
            'venda_item.id',
            'venda_item.id_produto',
            'venda_item.quantidade',
            'venda_item.preco_unitario',
            'venda_item.subtotal',
            'produto.codigo',
            'produto.descricao',
            'produto.unidade',
        ])
        ->from($this->table)
        ->join('produto', 'produto.id = venda_item.id_produto', 'left')
        ->where('venda_item.id_venda', $idVenda)
        ->get()
        ->result_array();
    }

    public function deleteByVenda(int $idVenda)
    {
        try {
            $this->db->delete($this->table, ['id_venda' => $idVenda]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
