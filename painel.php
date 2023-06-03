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
      width: 250px;
      background-color: #343a40;
      color: #fff;
      height: 100vh;
      position: fixed;
    }

    .content {
      margin-left: 250px;
      padding: 20px;
    }

    .content h2 {
      margin-bottom: 20px;
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
  <div class="sidebar">
    <h4 class="text-center py-3">Painel de Administração</h4>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link text-light" href="#" onclick="mostrarDashboard()">Dashboard</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#" onclick="mostrarFormulario()">Funcionários</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Precificações</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-light" href="#">Sair</a>
      </li>
    </ul>
  </div>

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
    <form>
      <div class="form-group">
        <label for="usuario">Usuário:</label>
        <input type="text" class="form-control" id="usuario" placeholder="Digite o nome do usuário">
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" id="senha" placeholder="Digite a senha do usuário">
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>
  </div>

  <script>
    function mostrarFormulario() {
      document.getElementById('container').classList.add('hidden');
      document.getElementById('formulario').classList.remove('hidden');
    }
    function mostrarDashboard(){
      document.getElementById('formulario').classList.add('hidden');
      document.getElementById('container').classList.remove('hidden');
    }
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
