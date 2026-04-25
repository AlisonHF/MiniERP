<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateProdutoDTO
{
    private int $id;
    private string $codigo;
    private string $descricao;
    private ?string $unidade;
    private ?float $preco;
    private int $id_empresa;

    public function __construct(
        int $id,
        string $codigo,
        string $descricao,
        ?string $unidade,
        ?float $preco,
        int $id_empresa
    ) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->descricao = $descricao;
        $this->unidade = $unidade;
        $this->preco = $preco;
        $this->id_empresa = $id_empresa;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getUnidade()
    {
        return $this->unidade;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getIdEmpresa()
    {
        return $this->id_empresa;
    }
}
