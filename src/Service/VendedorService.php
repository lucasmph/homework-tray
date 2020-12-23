<?php

namespace api\Tray\Service;

use api\Tray\Modelo\Vendedor;
use api\Tray\Repositorio\VendedorRepositorio;

class VendedorService
{
    private array $requestData;
    private VendedorRepositorio $vendedorRepositorio;

    public function __construct($data)
    {
        $this->requestData = $data;
        $this->vendedorRepositorio = new VendedorRepositorio();
    }

    public function criarVendedor($dados)
    {
        $vendedor = new Vendedor(null, $dados['nome'], $dados['email']);
        $retorno = $this->vendedorRepositorio->insert($vendedor);
        if($retorno){
            return json_encode($retorno);
        }
        return json_encode(array('status' => 'erro', 'mensagem' => 'erro ao inserir o vendedor'));
    }

    public function buscaVendedores()
    {
        $retorno = $this->vendedorRepositorio->selectVendedores();
        return json_encode($retorno);
    }
}