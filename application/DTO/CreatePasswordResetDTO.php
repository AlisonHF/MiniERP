<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class CreatePasswordResetDTO
{
    private int $idUsuario;
    private string $token;
    private string $expiresAt;

    public function __construct(int $idUsuario, string $token, string $expiresAt)
    {
        $this->idUsuario = $idUsuario;
        $this->token     = $token;
        $this->expiresAt = $expiresAt;
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpiresAt(): string
    {
        return $this->expiresAt;
    }

    public function toArray(): array
    {
        return [
            'id_usuario' => $this->idUsuario,
            'token'      => $this->token,
            'expires_at' => $this->expiresAt,
            'used'       => 0,
        ];
    }
}
