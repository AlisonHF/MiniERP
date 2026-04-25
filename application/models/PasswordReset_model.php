<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class PasswordReset_model extends CI_Model
{
    private string $table;

    public function __construct()
    {
        parent::__construct();

        $this->table = 'password_reset';

        $this->load->database();
    }

    public function store(CreatePasswordResetDTO $dto)
    {
        try {
            $this->db->insert($this->table, $dto->toArray());
            return (int) $this->db->insert_id();
        } catch (Exception $e) {
            return false;
        }
    }

    public function getValidByToken(string $token)
    {
        return $this->db->from($this->table)
            ->where('token', $token)
            ->where('used', 0)
            ->where('expires_at >=', date('Y-m-d H:i:s'))
            ->get()
            ->row_array();
    }

    public function markAsUsed(int $id): bool
    {
        try {
            $this->db->update($this->table, ['used' => 1], ['id' => $id]);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function invalidatePrevious(int $idUsuario): void
    {
        $this->db->update($this->table, ['used' => 1], ['id_usuario' => $idUsuario, 'used' => 0]);
    }
}
