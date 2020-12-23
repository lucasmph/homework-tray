<?php

namespace api\Tray\Modelo;

class Venda
{
    private ?int $id;
    private int $idVendedor;
    private float $valor;
    private float $comissao;
    private string $data;

    public function __construct(?int $id, int $idVendedor, float $valor)
    {
        $this->idVendedor = $idVendedor;
        $this->valor = number_format($valor, 2, '.', '');
        $this->comissao = $this->calculaComissao($valor);
        $this->data = date("Y-m-d");
    }

    public function getId()
    {
        return $this->id;
    }

    public function getIdVendedor()
    {
        return $this->idVendedor;
    }

    public function getValor()
    {
        return $this->valor;
    }

    public function getComissao()
    {
        return $this->comissao;
    }

    public function getData()
    {
        return $this->data;
    }

    public function calculaComissao($valor): float
    {
        $result = $valor * 0.085;
        return number_format(floor($result*100)/100, 2, '.', '');
    }
}