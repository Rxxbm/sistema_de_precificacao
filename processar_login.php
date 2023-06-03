<?php

    if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['password'])){
        include_once('conexao.php');
        
        $nome = $_POST['name'];
        $senha = $_POST['password'];
        $stmt = $connect->prepare("SELECT senha, admin FROM usuarios WHERE nome = ?");
        $stmt->bind_param("s", $nome);
        
        // Executa a consulta SQL
        $stmt->execute();
        
        // Obtém o resultado da consulta
        $result = $stmt->get_result();
        
        // Verifica se o usuário foi encontrado
        if ($result->num_rows == 1) {
            // Obtém o hash da senha armazenada no banco de dados
            $row = $result->fetch_assoc();
            $hash = $row['senha'];
        
            // Verifica se a senha fornecida corresponde ao hash
            if (password_verify($senha, $hash)) {
                // Senha correta, o login é bem-sucedido
                if($row['admin'] === 1){
                    session_start();
                    $_SESSION['logged_in'] = true;
                    $_SESSION['admin'] = 1;
                    header("Location: painel.php");
                    exit;
                }else{
                    session_start();
                    $_SESSION['logged_in'] = true;
                    header("Location: consultas.php");
                }
                
            } else {
                // Senha incorreta
                header("Location: index.php");
            }
        } else {
            // Nome de usuário não encontrado
            header("Location: index.php");
        }
        
        // Fecha a declaração e a conexão com o banco de dados
        $stmt->close();
        $connect->close();
    }

?>