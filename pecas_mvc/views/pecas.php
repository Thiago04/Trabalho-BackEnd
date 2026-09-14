<?php
// views/pecas.php
$pecaEditando = $pecaEditando ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Peças</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
        }
        .form-section {
            background-color: #f9f9f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 12px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
            font-weight: bold;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }
        button:hover {
            background-color: #45a049;
        }
        button.delete {
            background-color: #f44336;
        }
        button.delete:hover {
            background-color: #da190b;
        }
        button.edit {
            background-color: #2196F3;
        }
        button.edit:hover {
            background-color: #0b7dda;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f0f0f0;
            font-weight: bold;
            color: #333;
        }
        table tr:hover {
            background-color: #f5f5f5;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
        .actions form {
            display: inline;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Gerenciar Peças</h1>

        <!-- Formulário de Cadastro/Edição -->
        <div class="form-section">
            <h2><?= $pecaEditando ? 'Editar Peça' : 'Cadastrar Nova Peça' ?></h2>
            <form method="POST" action="index.php">
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required value="<?= htmlspecialchars($pecaEditando['nome'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="categoria">Categoria:</label>
                    <input type="text" id="categoria" name="categoria" required value="<?= htmlspecialchars($pecaEditando['categoria'] ?? '') ?>">
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="number" id="quantidade" name="quantidade" min="0" required value="<?= htmlspecialchars($pecaEditando['quantidade'] ?? '') ?>">
                </div>
                <?php if ($pecaEditando): ?>
                    <input type="hidden" name="action" value="atualizar">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($pecaEditando['id']) ?>">
                    <button type="submit">Atualizar Peça</button>
                    <a href="index.php" style="margin-left: 10px;">
                        <button type="button">Cancelar</button>
                    </a>
                <?php else: ?>
                    <input type="hidden" name="action" value="cadastrar">
                    <button type="submit">Cadastrar Peça</button>
                <?php endif; ?>
            </form>
        </div>

        <!-- Lista de Peças -->
        <h2>Lista de Peças</h2>
        <?php if (empty($pecas)): ?>
            <p>Nenhuma peça cadastrada ainda.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Categoria</th>
                        <th>Quantidade</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pecas as $peca): ?>
                        <tr>
                            <td><?= htmlspecialchars($peca['id']) ?></td>
                            <td><?= htmlspecialchars($peca['nome']) ?></td>
                            <td><?= htmlspecialchars($peca['categoria']) ?></td>
                            <td><?= htmlspecialchars($peca['quantidade']) ?></td>
                            <td>
                                <div class="actions">
                                    <form method="GET" action="index.php" style="display: inline;">
                                        <input type="hidden" name="action" value="editar">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($peca['id']) ?>">
                                        <button type="submit" class="edit">Editar</button>
                                    </form>
                                    <form method="POST" action="index.php" onsubmit="return confirm('Tem certeza que deseja deletar esta peça?');" style="display: inline;">
                                        <input type="hidden" name="action" value="excluir">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($peca['id']) ?>">
                                        <button type="submit" class="delete">Deletar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>