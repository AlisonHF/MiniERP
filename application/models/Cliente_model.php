<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model
{
    private string $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = 'cliente';

        $this->load->database();
    }

    public function getPaginated(int $limit, int $offset = 0, int $idEmpresa, array $like = [])
    {
        try {
            return $this->db->select([
                'id',
                'nome',
                'razao_social',
                'apelido',
                'nome_fantasia',
                'cpf',
                'cnpj',
                'tipo_pessoa',
                'data_nascimento',
                'data_abertura',
                'created_at',
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

    public function store(CreateClienteDTO $createClienteDTO)
    {
        try {
            $this->db->insert($this->table, $createClienteDTO->toArray());
            return $this->db->insert_id();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getById(int $id, int $idEmpresa)
    {
        return $this->db->select([
            'id',
            'nome',
            'razao_social',
            'apelido',
            'nome_fantasia',
            'cpf',
            'cnpj',
            'rg',
            'inscricao_estadual',
            'tipo_pessoa',
            'data_nascimento',
            'data_abertura',
        ])
        ->from($this->table)
        ->where('id', $id)
        ->where('id_empresa', $idEmpresa)
        ->get()
        ->row_array();
    }

    public function update(UpdateClienteDTO $updateClienteDTO)
    {
        try {
            $this->db->update(
                $this->table,
                $updateClienteDTO->toArray(),
                ['id' => $updateClienteDTO->getId(), 'id_empresa' => $updateClienteDTO->getIdEmpresa()]
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
}
