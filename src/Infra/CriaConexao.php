<?php

namespace api\Tray\Infra;

use PDO;

class CriaConexao
{
    public static function criaConexao(): PDO
    {
        $conexao =  new PDO('mysql:host=localhost;dbname=tray_vendas','root', '');
        $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        return $conexao;
    }
}