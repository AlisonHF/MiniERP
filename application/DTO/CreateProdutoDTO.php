<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class CreateProdutoDTO
{
    private string $codigo;
    private string $descricao;
    private ?string $unidade;
    private ?float $preco;
    private ?string $image;
    private int $id_empresa;

    public function __construct(
        string $codigo,
        string $descricao,
        ?string $unidade,
        ?float $preco,
        ?string $image,
        int $id_empresa
    ) {
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->unidade = $unidade;
        $this->preco = $preco;
        $this->image = $image;
        $this->id_empresa = $id_empresa;
    }

    public function getCodigo(): string
    {
        return $this->codigo;
    }

    public function setCodigo(string $codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    public function getDescricao(): string
    {
        return $this->descricao;
    }

    public function setDescricao(string $descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getUnidade(): ?string
    {
        return $this->unidade;
    }

    public function setUnidade(?string $unidade)
    {
        $this->unidade = $unidade;

        return $this;
    }

    public function getPreco(): ?float
    {
        return $this->preco;
    }

    public function setPreco(?float $preco)
    {
        $this->preco = $preco;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image)
    {
        $this->image = $image;

        return $this;
    }

    public function getIdEmpresa(): int
    {
        return $this->id_empresa;
    }

    public function setIdEmpresa(int $id_empresa)
    {
        $this->id_empresa = $id_empresa;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'codigo' => $this->codigo,
            'descricao' => $this->descricao,
            'unidade' => $this->unidade,
            'preco' => $this->preco,
            'imagem' => $this->image,
            'id_empresa' => $this->id_empresa,
        ];
    }
}
