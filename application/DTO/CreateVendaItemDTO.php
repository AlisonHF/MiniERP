<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class CreateVendaItemDTO
{
    private int $idVenda;
    private int $idProduto;
    private int $idEmpresa;
    private float $quantidade;
    private float $precoUnitario;
    private float $subtotal;

    public function __construct(
        int $idVenda,
        int $idProduto,
        int $idEmpresa,
        float $quantidade,
        float $precoUnitario,
        float $subtotal
    ) {
        $this->idVenda       = $idVenda;
        $this->idProduto     = $idProduto;
        $this->idEmpresa     = $idEmpresa;
        $this->quantidade    = $quantidade;
        $this->precoUnitario = $precoUnitario;
        $this->subtotal      = $subtotal;
    }

    public function getIdVenda(): int
    {
        return $this->idVenda;
    }

    public function setIdVenda(int $idVenda): self
    {
        $this->idVenda = $idVenda;
        return $this;
    }

    public function getIdProduto(): int
    {
        return $this->idProduto;
    }

    public function getIdEmpresa(): int
    {
        return $this->idEmpresa;
    }

    public function getQuantidade(): float
    {
        return $this->quantidade;
    }

    public function getPrecoUnitario(): float
    {
        return $this->precoUnitario;
    }

    public function getSubtotal(): float
    {
        return $this->subtotal;
    }

    public function toArray(): array
    {
        return [
            'id_venda'       => $this->idVenda,
            'id_produto'     => $this->idProduto,
            'id_empresa'     => $this->idEmpresa,
            'quantidade'     => $this->quantidade,
            'preco_unitario' => $this->precoUnitario,
            'subtotal'       => $this->subtotal,
        ];
    }
}
