<?php

namespace api\Tray\Service;

use api\Tray\Modelo\Venda;
use api\Tray\Repositorio\VendaRepositorio;

class VendaService
{
    private array $requestData;
    private VendaRepositorio $vendaRepositorio;
    
    public function __construct($data)
    {
        $this->requestData = $data;
        $this->vendaRepositorio = new VendaRepositorio();
        
    }

    public function lancarVenda($dados)
    {
        $venda = new Venda(null, $dados['id_vendedor'], $dados['valor']);
        $retorno = $this->vendaRepositorio->insert($venda);
        if($retorno){
            return json_encode($retorno);
        }
        return json_encode(array('status' => 'erro', 'mensagem' => 'erro ao inserir o vendedor'));
    }

    public function buscaVendas($dados)
    {
        $retorno = $this->vendaRepositorio->selectVendasPorVendedor($dados);
        return json_encode($retorno);
    }

    public function enviarEmail($dados)
    {
        $retorno = $this->vendaRepositorio->disparaEmail($dados);
        return json_encode($retorno);
    }
}