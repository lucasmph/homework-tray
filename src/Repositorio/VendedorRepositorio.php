<?php

namespace api\Tray\Repositorio;

use api\Tray\Infra\CriaConexao;
use api\Tray\Modelo\Vendedor;
use Exception;
use PDO;

class VendedorRepositorio
{
    private PDO $conexao;

    public function __construct()
    {
        $this->conexao = CriaConexao::criaConexao();
    }

    public function insert(Vendedor $vendedor)
    {
        $verifica = $this->selectPorEmail($vendedor->getEmail());
        if(sizeof($verifica) > 0){
            throw new Exception('vendedor já cadastrado');
        }
        $sqlInsert= 'INSERT INTO vendedores (nome, email) VALUES (:nome, :email)';
        
        $statement = $this->conexao->prepare($sqlInsert);
        $statement->bindValue(':nome', $vendedor->getNome());
        $statement->bindValue(':email', $vendedor->getEmail());
        $executa= $statement->execute();
        if($executa){
            $id = $this->conexao->lastInsertId();
            $retorno = ["id" => $id, "nome" => $vendedor->getNome(), "email" => $vendedor->getEmail()];
            return $retorno;
        }
        return $executa;
        
    }

    public function selectVendedores(): array
    {
        $sqlSelect= 'SELECT * FROM vendedores ORDER BY id asc';
        
        $statement = $this->conexao->query($sqlSelect);
        $statement->execute();
        $retorno = $statement->fetchAll($this->conexao::FETCH_ASSOC);
        
        return $retorno;
    }

    public function selectPorEmail($email)
    {
        $sqlSelect= 'SELECT * FROM vendedores where email = :email';
        
        $statement = $this->conexao->prepare($sqlSelect);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $retorno = $statement->fetchAll($this->conexao::FETCH_ASSOC);
        
        return $retorno;
    }

    public function selectPorId($id)
    {
        $sqlSelect= 'SELECT * FROM vendedores where id = :id';
        
        $statement = $this->conexao->prepare($sqlSelect);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $retorno = $statement->fetchAll($this->conexao::FETCH_ASSOC);
        
        return $retorno;
    }
}