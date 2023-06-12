<?php
include_once('conexao.php');
    // Verifica se a ação é de alteração de funcionário
    if (isset($_POST["acao"]) && $_POST["acao"] == "alteracao") {
        // Obtém os valores enviados pelo formulário
        $id = $_POST["id"];
        $nome = $_POST["nome"];
        $senha = $_POST["senha"];
        $admin = $_POST["admin"];

        // Gera o hash da senha
        $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

        // Prepara a consulta SQL para atualizar o funcionário no banco de dados
        $stmt = $connect->prepare("UPDATE usuarios SET nome=?, senha=?, admin=? WHERE id=?");
        $stmt->bind_param("sssi", $nome, $hashedSenha, $admin, $id);

        // Executa a consulta SQL
        if ($stmt->execute()) {
            header("Location: painel.php");
        } else {
            echo "Erro ao atualizar o funcionário: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    }

    // Verifica se a ação é de exclusão de funcionário
    elseif (isset($_POST["acao"]) && $_POST["acao"] == "exclusao") {
        // Obtém o ID do funcionário a ser excluído
        $id = $_POST["id"];

        // Prepara a consulta SQL para excluir o funcionário do banco de dados
        $stmt = $connect->prepare("DELETE FROM usuarios WHERE id=?");
        $stmt->bind_param("i", $id);

        // Executa a consulta SQL
        if ($stmt->execute()) {
            header("Location: painel.php");
        } else {
            echo "Erro ao excluir o funcionário: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    }

    // Fecha a conexão com o banco de dados
    $connect->close();

?>