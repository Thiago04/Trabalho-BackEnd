<?php
// LOCAL: app/Models/UsuarioModel.php

class UsuarioModel
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
        $sql = "INSERT INTO pecas (nome, email, senha) VALUES (:nome, :email, :senha)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'nome' => $dados['nome'],
            'email' => $dados['email'],
            'senha' => password_hash($dados['senha'], PASSWORD_DEFAULT)
        ]);
        return $this->db->lastInsertId();
    }

    public function atualizar($id, $dados)
    {
        $updateFields = ['nome' => $dados['nome'], 'email' => $dados['email'], 'id' => $id];
        $sql = "UPDATE pecas SET nome = :nome, email = :email";
        
        if (!empty($dados['senha'])) {
            $sql .= ", senha = :senha";
            $updateFields['senha'] = password_hash($dados['senha'], PASSWORD_DEFAULT);
        }
        
        $sql .= " WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($updateFields);
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM pecas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['id' => $id]);
    }
}