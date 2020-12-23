<?php

namespace api\Tray\Util;

use InvalidArgumentException;
use JsonException;

class Util
{
    public static function getRota(): array
    {
        $uri = str_replace('/tray-api', '', $_SERVER['REQUEST_URI']);
        $caminho = explode('/', trim($uri, '/'));

        
        $request = [];
        $request['rota'] = $caminho[0];
        $request['recurso'] = $caminho[1] ?? null;
        $request['metodo'] = $_SERVER['REQUEST_METHOD'];
        return $request;
    }

    public static function tratarEntrada()
    {
        try {
            $postJson = json_decode(file_get_contents('php://input'), true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $e) {
            throw new InvalidArgumentException('Dados de entrada vazios');
        }
        if (is_array($postJson) && count($postJson) > 0) {
            return $postJson;
        }
    }
}