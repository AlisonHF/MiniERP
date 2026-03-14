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
                'usuario.id',
                'nome',
                'email',
                'tipo_usuario.descricao',
                'created_at'
            ])
            ->from($this->table)
            ->join('tipo_usuario', 'usuario.tipo_usuario = tipo_usuario.id')
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

    public function getByEmail(string $email)
    {
        return $this->db->get_where($this->table, ['email' => $email])->row_array();
    }

    public function getById(int $id)
    {
        return $this->db->select([
            'id',
            'nome',
            'email',
            'senha',
            'tipo_usuario'
        ])
        ->from($this->table)
        ->where('id', $id)
        ->get()
        ->row_array();
    }

    public function update(UpdateUsuarioDTO $updateUsuarioDTO)
    {
        if ($updateUsuarioDTO->getSenha()) {
            $this->db->update(
                $this->table,
                [
                    'nome' => $updateUsuarioDTO->getNome(),
                    'email' => $updateUsuarioDTO->getEmail(),
                    'senha' => $updateUsuarioDTO->getSenha(),
                    'tipo_usuario' => $updateUsuarioDTO->getTipoUsuario(),
                ],
                [
                    'id' => $updateUsuarioDTO->getId()
                ]
            );
        } else {
            $this->db->update(
                $this->table,
                [
                    'nome' => $updateUsuarioDTO->getNome(),
                    'email' => $updateUsuarioDTO->getEmail(),
                    'tipo_usuario' => $updateUsuarioDTO->getTipoUsuario(),
                ],
                [
                    'id' => $updateUsuarioDTO->getId()
                ]
            );
        }

        return true;
    }

    public function delete(int $id, int $idEmpresa)
    {
        $usuario = $this->db->select('tipo_usuario')
        ->from($this->table)
        ->where('id', $id)
        ->where('id_empresa', $idEmpresa)
        ->get()
        ->row();

        if ($usuario->tipo_usuario == 3) {
            return false;
        }

        $this->db->delete($this->table, ['id' => $id, 'id_empresa' => $idEmpresa, 'tipo_usuario !=' => 3]);

        return true;
    }
}
