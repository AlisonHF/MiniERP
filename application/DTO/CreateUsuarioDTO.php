<?php

declare(strict_types=1);

class CreateUsuarioDTO
{
    private string $nome;
    private string $email;
    private string $senha;
    private ?int $tipoUsuario = null;
    private ?int $empresa = null;

    public function __construct(string $nome, string $email, string $senha, $tipoUsuario = null, $empresa = null)
    {
        $this->nome = $nome;
        $this->email = $email;
        $this->senha = $senha;
        $this->tipoUsuario = $tipoUsuario;
        $this->empresa = $empresa;
    }

    public function getNome(): string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
        return $this;
    }

    public function getSenha(): string
    {
        return $this->senha;
    }

    public function setSenha(string $senha)
    {
        $this->senha = $senha;
        return $this;
    }

    public function getTipoUsuario(): ?int
    {
        return $this->tipoUsuario;
    }

    public function setTipoUsuario(int $tipoUsuario)
    {
        $this->tipoUsuario = $tipoUsuario;
        return $this;
    }

    public function getEmpresa()
    {
        return $this->empresa;
    }

    public function setEmpresa(int $empresa)
    {
        $this->empresa = $empresa;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'senha' => $this->senha,
            'tipo_usuario' => $this->tipoUsuario,
            'empresa' => $this->empresa,
        ];
    }
}
