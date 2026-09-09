<?php
// LOCAL: app/Controllers/UsuarioController.php

require_once __DIR__ . "/../Models/UsuarioModel.php";

class UsuarioController {

    public function home($pdo, $id = null) {
        $model = new UsuarioModel($pdo);
        $pecas = $model->buscarTodos();
        $pecasEditando = $id ? $model->buscarPorId($id) : null;
        require __DIR__ . "/../../views/usuarios.php";
    }

    public function cadastrar($pdo) {
        $model = new UsuarioModel($pdo);
        $model->criar($_POST);
        header("Location: index.php");
        exit;
    }

    public function atualizar($pdo, $id) {
        $model = new UsuarioModel($pdo);
        $model->atualizar($id, $_POST);
        header("Location: index.php");
        exit;
    }

    public function excluir($pdo, $id) {
        $model = new UsuarioModel($pdo);
        $model->excluir($id);
        header("Location: index.php");
        exit;
    }
}