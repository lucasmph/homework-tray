<?php

namespace api\Tray\Modelo;

class Vendedor
{
    private ?int $id;
    private string $nome;
    private string $email;
    private float $comissao;

    public function __construct(?int $id, string $nome, string $email)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getComissao(): float
    {
        return $this->comissao;
    }

    public function setComissao($valor)
    {
        $this->comissao = $valor;
    }
}