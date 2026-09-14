<?php
// LOCAL: index.php

require "conexao.php";                       // precisa deixar $pdo pronto
require "app/Controllers/PecaController.php";

$controller = new PecaController();
$acao = $_GET['acao'] ?? 'home';
$id = $_GET['id'] ?? null;

switch ($acao) {
    case 'cadastrar': $controller->cadastrar($pdo); break;
    case 'atualizar': $controller->atualizar($pdo, $id); break;
    case 'excluir':   $controller->excluir($pdo, $id); break;
    default:          $controller->home($pdo, $id); // lista + form (vazio ou preenchido se veio ?id=)
}