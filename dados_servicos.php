<?php
include_once('conexao.php');
    // Verifica se a ação é de alteração de Serviços
    if (isset($_POST["acao"]) && $_POST["acao"] == "alteracao") {
        // Obtém os valores enviados pelo formulário
        $id = $_POST["id"];
        $servico = $_POST["nome_servico"];
        $empresa = $_POST["nome_empresa"];
        $porte = $_POST["porte_empresa"];
        $dias_uteis = $_POST["dias_uteis"];
        $valor_dia = $_POST["valor_dia"];
        $membros = $_POST["quantidade_membros"];
        $custo_fixo = $_POST["custo_fixo"];
        $custos_variaveis = $_POST["custos_variaveis"];
        $margem = $_POST["margem_incerteza"];
        $modalidade = $_POST["modalidade"];

        // Prepara a consulta SQL para atualizar o serviço no banco de dados
        $stmt = $connect->prepare("UPDATE servicos SET servico=?, empresa=?, porte=?, dias_uteis=?, valor_dia=?, membros=?, custo_fixo=?, custos_variaveis=?, margem_incerteza=?, modalidade=? WHERE id=?");
        $stmt->bind_param("ssssssssssi", $servico, $empresa, $porte, $dias_uteis, $valor_dia, $membros, $custo_fixo, $custos_variaveis, $margem, $modalidade, $id);

        // Executa a consulta SQL
        if ($stmt->execute()) {
            header("Location: painel.php");
        } else {
            echo "Erro ao atualizar o funcionário: " . $stmt->error;
        }

        // Fecha a declaração
        $stmt->close();
    }

    // Verifica se a ação é de exclusão de Serviço
    elseif (isset($_POST["acao"]) && $_POST["acao"] == "exclusao") {
        // Obtém o ID do funcionário a ser excluído
        $id = $_POST["id"];

        // Prepara a consulta SQL para excluir o serviço do banco de dados
        $stmt = $connect->prepare("DELETE FROM servicos WHERE id=?");
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