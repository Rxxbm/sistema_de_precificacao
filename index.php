<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HOME - Sistema de Precificação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
    body {
      background-color: #a6c2dd;
    }

    .login-container {
      max-width: 400px;
      color: #fff;
      margin: 0 auto;
      margin-top: 100px;
      padding: 20px;
      background-color: #474343;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-group label {
      font-weight: 500;
    }

    .form-group input {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-group button {
      width: 100%;
      padding: 10px;
      font-size: 16px;
      color: #fff;
      background-color: #007bff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

  </style>
</head>
<body>
    <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto login-container">
        <h2 style="font-weight: 600;">Acesso</h2>
        <form method="post" action="processar_login.php">
          <div class="form-group">
            <label for="username">Usuário</label>
            <input type="text" id="name" name="username" required>
          </div>
          <div class="form-group">
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div class="form-group">
            <button type="submit">Entrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>