<?php

use api\Tray\Util\Util;
use api\Tray\Validador\ValidaRequisicao;

require_once 'autoload.php';
header('Content-Type: application/json');
header('Cache-Control: no-cache, no-store, must-revalidate');
header('Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE');

try {
    $requestValidator = new ValidaRequisicao(Util::getRota());
    $controle = $requestValidator->processaRequest();
    echo $controle;
} catch (Exception $e) {
    echo $e->getMessage();
}