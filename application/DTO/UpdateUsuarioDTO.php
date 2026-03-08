<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateUsuarioDTO {
    private int $id;
    private string $nome;
    private string $email;
    private ?string $senha;
    private int $tipo_usuario;

    public function __construct(
        int $id,
        string $nome,
        string $email,
        ?string $senha,
        int $tipo_usuario
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipo_usuario = $tipo_usuario;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function getTipoUsuario()
    {
        return $this->tipo_usuario;
    }
}