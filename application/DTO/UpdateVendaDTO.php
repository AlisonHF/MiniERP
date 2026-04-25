<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class UpdateVendaDTO
{
    private int $id;
    private int $idCliente;
    private int $idEmpresa;
    private string $status;
    private ?string $observacao;
    private float $total;

    public function __construct(
        int $id,
        int $idCliente,
        int $idEmpresa,
        string $status,
        ?string $observacao,
        float $total
    ) {
        $this->id         = $id;
        $this->idCliente  = $idCliente;
        $this->idEmpresa  = $idEmpresa;
        $this->status     = $status;
        $this->observacao = $observacao;
        $this->total      = $total;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdCliente(): int
    {
        return $this->idCliente;
    }

    public function getIdEmpresa(): int
    {
        return $this->idEmpresa;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getObservacao(): ?string
    {
        return $this->observacao;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function toArray(): array
    {
        return [
            'id_cliente' => $this->idCliente,
            'status'     => $this->status,
            'observacao' => $this->observacao,
            'total'      => $this->total,
        ];
    }
}
