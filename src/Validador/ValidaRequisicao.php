<?php

namespace api\Tray\Validador;

use api\Tray\Service\VendaService;
use api\Tray\Service\VendedorService;
use api\Tray\Util\Util;
use InvalidArgumentException;

class ValidaRequisicao
{
    private array $request;
    private array $dadosRequest;

    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Matodo para processar requisição
     */
    public function processaRequest()
    {
        $metodo = $this->request['metodo'];
        if (($this->request['rota'] === 'vendedor' || $this->request['rota'] === 'venda' || $this->request['rota'] === 'email')  && $metodo === 'POST' ) {
            $this->dadosRequest = Util::tratarEntrada();
        }
        if($metodo === 'GET' && ($this->request['rota'] === 'vendedor' && !is_null($this->request['recurso']))){
            $this->dadosRequest = Util::tratarEntrada();
        }
        
        return $this->$metodo();
    }

    private function post(): string
    {
        if($this->request['rota'] === 'vendedor' && !is_null($this->dadosRequest)){
            $vendedorService = new VendedorService($this->request);
            $resultado = $vendedorService->criarVendedor($this->dadosRequest);
            return $resultado;
        }
        if($this->request['rota'] === 'venda' && !is_null($this->dadosRequest)){
            $vendaService = new VendaService($this->request);
            $resultado = $vendaService->lancarVenda($this->dadosRequest);
            return $resultado;
        }
        if($this->request['rota'] === 'email' && !is_null($this->dadosRequest)){
            $vendaService = new VendaService($this->request);
            $resultado = $vendaService->enviarEmail($this->dadosRequest);
            return $resultado;
        }
        throw new InvalidArgumentException('Dados de entrada da requisição inválidos');
    }

    private function get()
    {
        if($this->request['rota'] === 'vendedor' && !isset($this->dadosRequest)){
            $vendedorService = new VendedorService($this->request);
            $resultado = $vendedorService->buscaVendedores();
            return $resultado;
        }
        if($this->request['rota'] === 'vendedor' && isset($this->dadosRequest)){
            $vendedorService = new VendaService($this->request);
            $resultado = $vendedorService->buscaVendas($this->dadosRequest);
            return $resultado;
        }
        throw new InvalidArgumentException('Problemas na requisição');
    }
}