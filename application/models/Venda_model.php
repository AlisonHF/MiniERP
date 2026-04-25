<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Venda_model extends CI_Model
{
    private string $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = 'venda';

        $this->load->database();
    }

    public function getPaginated(int $limit, int $offset = 0, int $idEmpresa, array $like = [])
    {
        try {
            return $this->db->select([
                'venda.id',
                'venda.numero',
                'venda.status',
                'venda.total',
                'venda.created_at',
                'cliente.nome',
                'cliente.razao_social',
                'cliente.tipo_pessoa',
            ])
            ->from($this->table)
            ->join('cliente', 'cliente.id = venda.id_cliente', 'left')
            ->where('venda.id_empresa', $idEmpresa)
            ->like($like)
            ->order_by('venda.id', 'DESC')
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

    public function store(CreateVendaDTO $createVendaDTO)
    {
        try {
            $this->db->insert($this->table, $createVendaDTO->toArray());
            return (int) $this->db->insert_id();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getById(int $id, int $idEmpresa)
    {
        return $this->db->select([
            'id',
            'numero',
            'id_cliente',
            'status',
            'observacao',
            'total',
            'created_at',
        ])
        ->from($this->table)
        ->where('id', $id)
        ->where('id_empresa', $idEmpresa)
        ->get()
        ->row_array();
    }

    public function update(UpdateVendaDTO $updateVendaDTO)
    {
        try {
            $this->db->update(
                $this->table,
                $updateVendaDTO->toArray(),
                ['id' => $updateVendaDTO->getId(), 'id_empresa' => $updateVendaDTO->getIdEmpresa()]
            );

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function delete(int $id, int $idEmpresa)
    {
        try {
            $this->db->delete($this->table, ['id' => $id, 'id_empresa' => $idEmpresa]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function generateNumero(int $idEmpresa): string
    {
        $row = $this->db->select_max('id')->from($this->table)->where('id_empresa', $idEmpresa)->get()->row_array();
        $next = ((int) ($row['id'] ?? 0)) + 1;

        return str_pad((string) $next, 6, '0', STR_PAD_LEFT);
    }
}
