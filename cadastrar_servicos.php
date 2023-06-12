<?php
include_once('conexao.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores enviados pelo formulário
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

    // Prepara a consulta SQL para inserir o novo funcionário no banco de dados
    $stmt = $connect->prepare("INSERT INTO servicos (servico, empresa, porte, dias_uteis, valor_dia, membros, custo_fixo, custos_variaveis, margem_incerteza, modalidade) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $servico, $empresa, $porte, $dias_uteis, $valor_dia, $membros, $custo_fixo, $custos_variaveis, $margem, $modalidade);

    // Executa a consulta SQL
    if ($stmt->execute()) {
        header("Location: painel.php");
    } else {
        echo "Erro ao cadastrar o serviços: " . $stmt->error;
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt->close();
    $connect->close();
}
?>