<?php

namespace api\Tray\Repositorio;

use api\Tray\Infra\CriaConexao;
use api\Tray\Modelo\Venda;
use Exception;
use PDO;

class VendaRepositorio
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = CriaConexao::criaConexao();
    }

    public function insert(Venda $venda)
    {
        $vendedorRepositorio = new VendedorRepositorio();
        $verifica = $vendedorRepositorio->selectPorId($venda->getIdVendedor());
        if(sizeof($verifica) === 0){
            throw new Exception('id de vendedor inexistente');
        }
        $sqlInsert= 'INSERT INTO vendas (id_vendedor, valor, comissao, data) VALUES (:id_vendedor, :valor, :comissao, :data)';
        
        $statement = $this->conexao->prepare($sqlInsert);
        $statement->bindValue(':id_vendedor', $venda->getIdVendedor());
        $statement->bindValue(':valor', $venda->getValor());
        $statement->bindValue(':comissao', $venda->getComissao());
        $statement->bindValue(':data', $venda->getData());
        $executa = $statement->execute();
        if($executa){
            $id = $this->conexao->lastInsertId();
            $retorno = ["id" => $id, "nome" => $verifica[0]['nome'], "email" => $verifica[0]['email'], "comissao" => $venda->getComissao(), "valor" => $venda->getValor(), "data" => $venda->getData()];
            return $retorno;
        }
        return $executa;
    }

    public function selectVendasPorVendedor($dados)
    {
        $id = $dados['id_vendedor'];
        $vendedorRepositorio = new VendedorRepositorio();
        $verifica = $vendedorRepositorio->selectPorId($id);
        if(sizeof($verifica) === 0){
            throw new Exception('id de vendedor inexistente');
        }

        $sqlSelect = 'SELECT a.id, b.nome, b.email, a.comissao, a.valor, a.data FROM vendas a JOIN vendedores b ON b.id = a.id_vendedor  WHERE a.id_vendedor = :id_vendedor';
        $statement = $this->conexao->prepare($sqlSelect);
        $statement->bindValue(':id_vendedor', $id);
        $statement->execute();
        $retorno = $statement->fetchAll($this->conexao::FETCH_ASSOC);
        
        return $retorno;
    }

    public function disparaEmail($dados)
    {
        $data = date("Y-m-d");
        $sqlSelect = 'SELECT SUM(valor) as soma FROM vendas WHERE data = :data';
        $statement = $this->conexao->prepare($sqlSelect);
        $statement->bindValue(':data', $data);
        $statement->execute();
        $result = $statement->fetchAll($this->conexao::FETCH_ASSOC);
        $from = "test@teste.com";
        $to = $dados['email'];
        $subject = "Relatório Diario";
        $message = "Valor total das Vendas de hoje: ".$result[0]['soma'];
        $headers = "From:" . $from;
        $retonro = mail($to,$subject,$message, $headers);
        return $retonro;
    }
}