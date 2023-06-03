<?php
include_once('conexao.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados pelo formulário
    $usuario = $_POST["nome"];
    $senha = $_POST["password"];
    $admin = $_POST["admin"];

    // Gera o hash da senha
    $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);

    // Prepara a consulta SQL para inserir o novo funcionário no banco de dados
    $stmt = $connect->prepare("INSERT INTO usuarios (nome, senha, admin) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $usuario, $hashedSenha, $admin);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        header("Location: painel.php");
    } else {
        echo "Erro ao cadastrar o funcionário: " . $stmt->error;
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt->close();
    $connect->close();
}
?>