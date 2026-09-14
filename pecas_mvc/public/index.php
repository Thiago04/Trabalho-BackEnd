<?php
// LOCAL: public/index.php

require_once "../config/conexao.php";
require_once "../app/Controllers/PecaController.php";

$controller = new PecaController();

// Lê a ação tanto do POST (formulários) quanto do GET (links "Editar")
// Corrigido: a view manda o campo como "action", não "acao"
$acao = $_POST['action'] ?? $_GET['action'] ?? 'home';
$id = $_POST['id'] ?? $_GET['id'] ?? null;

switch ($acao) {
    case 'cadastrar':
        $controller->cadastrar($pdo);
        break;
    case 'atualizar':
        $controller->atualizar($pdo, $id);
        break;
    case 'excluir':
        $controller->excluir($pdo, $id);
        break;
    case 'editar':
        $controller->home($pdo, $id);
        break;
    default:
        $controller->home($pdo, $id);
}
