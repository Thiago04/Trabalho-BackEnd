<?php
// LOCAL: app/Controllers/UsuarioController.php

require_once __DIR__ . "/../Models/PecaModel.php";

class PecaController
{

    public function home($pdo, $id = null)
    {
        $model = new PecaModel($pdo);
        $pecas = $model->buscarTodos();
        $pecaEditando = $id ? $model->buscarPorId($id) : null;
        require __DIR__ . "/../../views/pecas.php";
    }

    public function cadastrar($pdo)
    {
        $model = new PecaModel($pdo);
        $model->criar($_POST);
        header("Location: index.php");
        exit;
    }

    public function atualizar($pdo, $id)
    {
        $model = new PecaModel($pdo);
        $model->atualizar($id, $_POST);
        header("Location: index.php");
        exit;
    }

    public function excluir($pdo, $id)
    {
        $model = new PecaModel($pdo);
        $model->excluir($id);
        header("Location: index.php");
        exit;
    }
}
