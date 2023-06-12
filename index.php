<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> HOME - Sistema de Precificação</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
      background: rgb(71,67,67);
      background: linear-gradient(90deg, rgba(71,67,67,1) 5%, rgba(71,67,67,1) 47%, rgba(71,67,67,1) 96%);
      color: #fff;
      font-family: Arial, sans-serif;
    }

    .login-container {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 100px;
      padding: 20px;
      background-color: #474343;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 1, 0.7);
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 20px;
      font-weight: 600;
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

    .form-group button:hover {
      background-color: #0069d9;
    }

    .icon {
      margin-right: 10px;
    }

  </style>
</head>
<body>
    <div class="container">
    <div class="row">
      <div class="col-md-6 mx-auto login-container">
        <h2>Acesso</h2>
        <form method="POST" action="processar_login.php">
          <div class="form-group">
            <label for="name"><i class="fas fa-user icon"></i>Usuário</label>
            <input type="text" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="password"><i class="fas fa-lock icon"></i>Senha</label>
            <input type="password" id="password" name="password" required>
          </div>
          <div class="form-group">
            <button type="submit" name="submit"><i class="fas fa-sign-in-alt icon"></i>Entrar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
