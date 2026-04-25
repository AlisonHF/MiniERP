<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class CreateVendaDTO
{
    private string $numero;
    private int $idCliente;
    private int $idUsuario;
    private int $idEmpresa;
    private string $status;
    private ?string $observacao;
    private float $total;

    public function __construct(
        string $numero,
        int $idCliente,
        int $idUsuario,
        int $idEmpresa,
        string $status,
        ?string $observacao,
        float $total
    ) {
        $this->numero     = $numero;
        $this->idCliente  = $idCliente;
        $this->idUsuario  = $idUsuario;
        $this->idEmpresa  = $idEmpresa;
        $this->status     = $status;
        $this->observacao = $observacao;
        $this->total      = $total;
    }

    public function getNumero(): string
    {
        return $this->numero;
    }

    public function getIdCliente(): int
    {
        return $this->idCliente;
    }

    public function getIdUsuario(): int
    {
        return $this->idUsuario;
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
            'numero'     => $this->numero,
            'id_cliente' => $this->idCliente,
            'id_usuario' => $this->idUsuario,
            'id_empresa' => $this->idEmpresa,
            'status'     => $this->status,
            'observacao' => $this->observacao,
            'total'      => $this->total,
        ];
    }
}
