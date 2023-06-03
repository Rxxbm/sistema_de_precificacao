<?php
session_start();
    if(isset($_POST['submit']) && !empty($_POST['name']) && !empty($_POST['password'])){
        include_once('conexao.php');
        
        $nome = $_POST['name'];
        $senha = $_POST['password'];
        
        $sql = "SELECT * FROM usuarios WHERE nome = '$nome' and senha = '$senha'";
        
        $resultado = $connect->query($sql);
        $row = $resultado->fetch_assoc();
        if(mysqli_num_rows($resultado) < 1){
            header("Location: index.php");
        }else{
            $_SESSION['nome'] = $nome;
            $_SESSION['senha'] = $senha;
            if($row['admin'] == 1){
                header("Location: painel.php");
            }else{    
                header('Location: consultas.php');
            }

        }
    }

?>