<?php

declare(strict_types=1);

defined('BASEPATH') OR exit('No direct script access allowed');

class CreateClienteDTO
{
    private ?string $cpf;
    private ?string $cnpj;
    private ?string $nome;
    private ?string $razaoSocial;
    private ?string $apelido;
    private ?string $nomeFantasia;
    private ?string $inscricaoEstadual;
    private ?string $rg;
    private string $tipoPessoa;
    private ?string $dataNascimento;
    private ?string $dataAbertura;
    private int $idEmpresa;

    public function __construct(
        ?string $cpf,
        ?string $cnpj,
        ?string $nome,
        ?string $razaoSocial,
        ?string $apelido,
        ?string $nomeFantasia,
        ?string $inscricaoEstadual,
        ?string $rg,
        string $tipoPessoa,
        ?string $dataNascimento,
        ?string $dataAbertura,
        int $idEmpresa
    ) {
        $this->cpf = $cpf;
        $this->cnpj = $cnpj;
        $this->nome = $nome;
        $this->razaoSocial = $razaoSocial;
        $this->apelido = $apelido;
        $this->nomeFantasia = $nomeFantasia;
        $this->inscricaoEstadual = $inscricaoEstadual;
        $this->rg = $rg;
        $this->tipoPessoa = $tipoPessoa;
        $this->dataNascimento = $dataNascimento;
        $this->dataAbertura = $dataAbertura;
        $this->idEmpresa = $idEmpresa;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf)
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getCnpj(): ?string
    {
        return $this->cnpj;
    }

    public function setCnpj(string $cnpj)
    {
        $this->cnpj = $cnpj;
        return $this;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getRazaoSocial(): ?string
    {
        return $this->razaoSocial;
    }

    public function setRazaoSocial(string $razaoSocial)
    {
        $this->razaoSocial = $razaoSocial;
        return $this;
    }

    public function getApelido(): ?string
    {
        return $this->apelido;
    }

    public function setApelido(string $apelido)
    {
        $this->apelido = $apelido;
        return $this;
    }

    public function getNomeFantasia(): ?string
    {
        return $this->nomeFantasia;
    }

    public function setNomeFantasia(string $nomeFantasia)
    {
        $this->nomeFantasia = $nomeFantasia;
        return $this;
    }

    public function getInscricaoEstadual(): ?string
    {
        return $this->inscricaoEstadual;
    }

    public function setInscricaoEstadual(string $inscricaoEstadual)
    {
        $this->inscricaoEstadual = $inscricaoEstadual;
        return $this;
    }

    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function setRg(string $rg)
    {
        $this->rg = $rg;
        return $this;
    }

    public function getTipoPessoa(): string
    {
        return $this->tipoPessoa;
    }

    public function setTipoPessoa(string $tipoPessoa)
    {
        $this->tipoPessoa = $tipoPessoa;
        return $this;
    }

    public function getDataNascimento(): ?string
    {
        return $this->dataNascimento;
    }

    public function setDataNascimento(string $dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
        return $this;
    }

    public function getDataAbertura(): ?string
    {
        return $this->dataAbertura;
    }

    public function setDataAbertura(string $dataAbertura)
    {
        $this->dataAbertura = $dataAbertura;
        return $this;
    }

    public function getIdEmpresa(): int
    {
        return $this->idEmpresa;
    }

    public function setIdEmpresa(int $idEmpresa)
    {
        $this->idEmpresa = $idEmpresa;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'cpf' => $this->cpf,
            'cnpj' => $this->cnpj,
            'nome' => $this->nome,
            'razao_social' => $this->razaoSocial,
            'apelido' => $this->apelido,
            'nome_fantasia' => $this->nomeFantasia,
            'inscricao_estadual' => $this->inscricaoEstadual,
            'rg' => $this->rg,
            'tipo_pessoa' => $this->tipoPessoa,
            'data_nascimento' => $this->dataNascimento,
            'data_abertura' => $this->dataAbertura,
            'id_empresa' => $this->idEmpresa,
        ];
    }
}
