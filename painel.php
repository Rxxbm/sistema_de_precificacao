<?php 
  session_start();

  // Verifica se o usuário está logado e se possui permissão de administrador
  if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || $_SESSION['admin'] !== 1) {
      // Redireciona para a página de login ou exibe uma mensagem de erro
      header("Location: index.php");
      exit; // Importante: encerra a execução do script após o redirecionamento
  }
  if (isset($_GET['logout'])) {
    // Destroi a sessão atual
    session_destroy();

    // Redireciona para a página de login ou qualquer outra página desejada após o logout
    header("Location: index.php");
    exit; // Importante: encerra a execução do script após o redirecionamento
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel de Administração - Sistema de Precificação</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .sidebar {
      background-color: #343a40;
      color: #fff;
      min-height: 100vh;
    }

    .content {
      padding: 20px;
    }

    .card {
      margin-bottom: 20px;
    }

    .hidden {
      display: none;
    }
    
  </style>
</head>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3 col-lg-2 sidebar" >
        <h4 class="text-center py-3">Painel de Administração</h4>
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link text-light" href="#" onclick="mostrarDashboard()">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#" onclick="mostrarFormulario()">Funcionários</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="#" onclick="mostrarPrecificacoes()">Precificações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="consultas.php">Consultar Precificações</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-light" href="?logout=true">Sair</a>
          </li>
        </ul>
      </div>

      <div class="col-md-9 col-lg-10">
        <div id="container" class="content">
          <h2>Dashboard</h2>
          <div class="row">
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Usuários</h5>
                  <p class="card-text">Gerencie os usuários do sistema.</p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Precificações</h5>
                  <p class="card-text">Gerencie as precificações do sistema.</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        

        <div id="formulario" class="content hidden">
          <h2>Cadastro de Funcionários</h2>
          <form method="post" action="cadastrar_funcionarios.php">
            <div class="form-group">
              <label for="usuario">Usuário:</label>
              <input type="text" class="form-control" name="nome" id="usuario" placeholder="Digite o nome do usuário">
            </div>
            <div class="form-group">
              <label for="senha">Senha:</label>
              <input type="password" class="form-control" name="password" id="senha" placeholder="Digite a senha do usuário">
            </div>
            <div class="form-group">
              <label for="admin">Admin:</label>
              <select class="form-control" id="admin" name="admin" required>
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
          </form>
        </div>

        <div id="tabela" class="content hidden">
          <h2>Lista de Funcionários</h2>
          <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Usuário</th>
                <th scope="col">Senha</th>
                <th scope="col">Admin</th>
                <th scope="col">Ações</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop através dos funcionários do banco de dados -->
              <?php
              // Prepara e executa a consulta SQL para obter os funcionários do banco de dados
              include_once('conexao.php');
              $sql = "SELECT id, nome, senha, admin FROM usuarios";
              $result = $connect->query($sql);

              // Verifica se foram encontrados funcionários
              if ($result->num_rows > 0) {
                // Loop através dos resultados da consulta
                while ($row = $result->fetch_assoc()) {
                  $id = $row["id"];
                  $usuario = $row["nome"];
                  $senha = $row["senha"];
                  $admin = $row["admin"];

                  // Exibe cada funcionário na tabela
                  echo "<tr>";
                  echo "<th scope='row'>$id</th>";
                  echo "<td id='usuario-$id'>$usuario</td>";
                  echo "<td id='senha-$id'>$senha</td>";
                  echo "<td id='admin-$id'>$admin</td>";
                  echo "<td>";
                  echo "<button class='btn btn-primary' onclick='alterarFuncionario($id)'>Alterar</button>";
                  echo "<button class='btn btn-danger' onclick='excluirFuncionario($id)'>Excluir</button>";
                  echo "</td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='5'>Nenhum funcionário encontrado.</td></tr>";
              }

              // Libera os resultados da consulta
              $result->free_result();
              ?>
            </tbody>
          </table>
          </div>
          
        </div>

        <!-- Formulário de alteração de funcionário -->
        <div id="alteracao-formulario" class="content hidden">
          <h2>Alteração de Funcionário</h2>
          <form action="dados_funcionarios.php" method="POST">
            <input type="hidden" name="acao" value="alteracao">
            <input type="hidden" id="alteracao-id" name="id" value="">
            <div class="form-group">
              <label for="alteracao-usuario">Usuário:</label>
              <input type="text" class="form-control" id="alteracao-usuario" name="nome" placeholder="Digite o nome do usuário" required>
            </div>
            <div class="form-group">
              <label for="alteracao-senha">Senha:</label>
              <input type="password" class="form-control" id="alteracao-senha" name="senha" placeholder="Digite a senha do usuário" required>
            </div>
            <div class="form-group">
              <label for="alteracao-admin">Admin:</label>
              <select class="form-control" id="alteracao-admin" name="admin" required>
                <option value="0">Não</option>
                <option value="1">Sim</option>
              </select>
            </div>

              

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          </form>
        </div>

       <div class="content hidden" id="precificacao">
        <h2>Cadastro de Precificação</h2>
        <form method="post" action="cadastrar_servicos.php">
          <div class="form-group">
            <label for="nome_servico">Nome do Serviço:</label>
            <input type="text" class="form-control" name="nome_servico" id="nome_servico" placeholder="Digite o nome do serviço" required>
          </div>
          <div class="form-group">
            <label for="nome_empresa">Nome da Empresa:</label>
            <input type="text" class="form-control" name="nome_empresa" id="nome_empresa" placeholder="Digite o nome da empresa" required>
          </div>
          <div class="form-group">
            <label for="porte_empresa">Porte da Empresa:</label>
            <select class="form-control" id="porte_empresa" name="porte_empresa" required>
              <option value="Pequeno">Pequeno</option>
              <option value="Médio">Médio</option>
              <option value="Grande">Grande</option>
              <option value="Empreendedor">Empreendedor</option>
              <option value="Microempresa">Microempresa</option>
            </select>
          </div>
          <div class="form-group">
            <label for="dias_uteis">Dias Úteis:</label>
            <input type="number" class="form-control" name="dias_uteis" id="dias_uteis" placeholder="Digite a quantidade de dias úteis" required>
          </div>
          <div class="form-group">
            <label for="valor_dia">Valor Dia:</label>
            <input type="number" class="form-control" name="valor_dia" id="valor_dia" placeholder="Digite a valor por dia" required>
          </div>
          <div class="form-group">
            <label for="quantidade_membros">Quantidade de Membros:</label>
            <input type="number" class="form-control" name="quantidade_membros" id="quantidade_membros" placeholder="Digite a quantidade de membros" required>
          </div>
          <div class="form-group">
            <label for="custo_fixo">Custo Fixo:</label>
            <input type="text" class="form-control" name="custo_fixo" id="custo_fixo" placeholder="Digite o custo fixo" required>
          </div>
          <div class="form-group">
            <label for="custos_variaveis">Custos Variáveis:</label>
            <input type="text" class="form-control" name="custos_variaveis" id="custos_variaveis" placeholder="Digite os custos variáveis" required>
          </div>
          <div class="form-group">
            <label for="margem_incerteza">Margem de Incerteza:</label>
            <select class="form-control" id="margem_incerteza" name="margem_incerteza" required>
              <option value="0">0%</option>
              <option value="0.01">1%</option>
              <option value="0.02">2%</option>
              <option value="0.03">3%</option>
              <option value="0.04">4%</option>
              <option value="0.05">5%</option>
              <option value="0.06">6%</option>
              <option value="0.07">7%</option>
              <option value="0.08">8%</option>
              <option value="0.09">9%</option>
              <option value="0.1">10%</option>
              </select>
          </div>

          <div class="form-group">
            <label for="modalidade">Modalidade:</label>
            <select class="form-control" id="modalidade" name="modalidade" required>
              <option value="Online">Online</option>
              <option value="Presencial">Presencial</option>
            </select>
          </div>
          <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
        </form>

        <div class="container content hidden" id="tabela_precificacao">
        <h1>Tabela de Precificações</h1>
        <table class="table-responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Serviço</th>
                    <th>Empresa</th>
                    <th>Porte</th>
                    <th>Dias Úteis</th>
                    <th>Valor por Dia</th>
                    <th>Membros</th>
                    <th>Custo Fixo</th>
                    <th>Custos Variáveis</th>
                    <th>Margem de Incerteza</th>
                    <th>Modalidade</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Conexão com o banco de dados aqui...
                include_once('conexao.php');
                // Consulta SQL para selecionar os dados da tabela
                $sql = "SELECT * FROM servicos";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["servico"] . "</td>";
                        echo "<td>" . $row["empresa"] . "</td>";
                        echo "<td>" . $row["porte"] . "</td>";
                        echo "<td>" . $row["dias_uteis"] . "</td>";
                        echo "<td>R$ " . $row["valor_dia"] . "</td>";
                        echo "<td>" . $row["membros"] . "</td>";
                        echo "<td>R$ " . $row["custo_fixo"] . "</td>";
                        echo "<td>R$ " . $row["custos_variaveis"] . "</td>";
                        echo "<td>" . $row["margem_incerteza"] . "</td>";
                        echo "<td>" . $row["modalidade"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='11'>Nenhum dado encontrado</td></tr>";
                }

                // Fecha a conexão
                $connect->close();
                ?>
            </tbody>
        </table>
    </div>

      </div>
    </div>
  </div>

  <script>
    function mostrarFormulario() {
      document.getElementById('container').classList.add('hidden');
      document.getElementById('formulario').classList.remove('hidden');
      document.getElementById('tabela').classList.remove('hidden');
      document.getElementById('precificacao').classList.add('hidden');
      document.getElementById('tabela_precificacao').classList.add('hidden');
    }

    function mostrarDashboard() {
      document.getElementById('formulario').classList.add('hidden');
      document.getElementById('container').classList.remove('hidden');
      document.getElementById('tabela').classList.add('hidden');
      document.getElementById('precificacao').classList.add('hidden');
      document.getElementById('tabela_precificacao').classList.add('hidden');
    }
    function mostrarPrecificacoes(){
      document.getElementById('formulario').classList.add('hidden');
      document.getElementById('container').classList.add('hidden');
      document.getElementById('tabela').classList.add('hidden');
      document.getElementById('precificacao').classList.remove('hidden');
      document.getElementById('tabela_precificacao').classList.remove('hidden');
    }

    function alterarFuncionario(id) {
      // Obtém os valores do funcionário a ser alterado
      var usuario = document.getElementById("usuario-" + id).innerText;
      var senha = document.getElementById("senha-" + id).innerText;
      var admin = document.getElementById("admin-" + id).innerText;

      // Preenche o formulário de alteração com os valores do funcionário
      document.getElementById("alteracao-id").value = id;
      document.getElementById("alteracao-usuario").value = usuario;
      document.getElementById("alteracao-admin").value = admin;

      // Exibe o formulário de alteração
      document.getElementById("alteracao-formulario").classList.remove("hidden");
    }

    function excluirFuncionario(id) {
      if (confirm("Deseja realmente excluir este funcionário?")) {
        // Cria um formulário para enviar o ID do funcionário a ser excluído
        var form = document.createElement("form");
        form.method = "POST";
        form.action = "dados_funcionarios.php";

        var input = document.createElement("input");
        input.type = "hidden";
        input.name = "acao";
        input.value = "exclusao";
        form.appendChild(input);

        input = document.createElement("input");
        input.type = "hidden";
        input.name = "id";
        input.value = id;
        form.appendChild(input);

        // Adiciona o formulário à página e envia-o
        document.body.appendChild(form);
        form.submit();
      }
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
