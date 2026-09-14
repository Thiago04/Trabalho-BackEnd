<?php
// LOCAL: app/Models/PecaModel.php

class PecaModel
{
    private $db;

    public function __construct($conexao)
    {
        $this->db = $conexao;
    }

    public function buscarTodos()
    {
        $sql = "SELECT * FROM pecas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorId($id)
    {
        $sql = "SELECT * FROM pecas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function criar($dados)
    {
        $this->validar($dados);

        $sql = "INSERT INTO pecas (nome, categoria, quantidade) VALUES (:nome, :categoria, :quantidade)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome' => $dados['nome'],
            'categoria' => $dados['categoria'],
            'quantidade' => $dados['quantidade'],
        ]);
        return $this->db->lastInsertId();
    }

    public function atualizar($id, $dados)
    {
        $this->validar($dados);

        $sql = "UPDATE pecas SET nome = :nome, categoria = :categoria, quantidade = :quantidade WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nome'       => $dados['nome'],
            'categoria'  => $dados['categoria'],
            'quantidade' => $dados['quantidade'],
            'id'         => $id,
        ]);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM pecas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }

    private function validar($dados)
    {
        if (empty($dados['nome']) || !is_string($dados['nome'])) {
            throw new InvalidArgumentException('O campo "nome" é obrigatório e deve ser texto.');
        }
        if (empty($dados['categoria']) || !is_string($dados['categoria'])) {
            throw new InvalidArgumentException('O campo "categoria" é obrigatório e deve ser texto.');
        }
        if (!isset($dados['quantidade']) || !is_numeric($dados['quantidade']) || $dados['quantidade'] < 0) {
            throw new InvalidArgumentException('O campo "quantidade" deve ser um número não negativo.');
        }
    }
}