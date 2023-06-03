<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Consulta de Precificações</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .container {
      margin-top: 50px;
    }

    h1 {
      color: #007bff;
      text-align: center;
      margin-bottom: 50px;
    }

    .table-container {
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: center;
    }

    th,
    td {
      padding: 12px;
    }

    th {
      background-color: #007bff;
      color: #fff;
      font-weight: 500;
    }

    tr:nth-child(even) {
      background-color: #f8f9fa;
    }

    tr:hover {
      background-color: #e2e6ea;
    }

    .header {
      background-color: #343a40;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    .header h1 {
      margin: 0;
      font-size: 24px;
      font-weight: bold;
    }

    .header .nav-links {
      margin-top: 20px;
    }

    .header .nav-links a {
      color: #fff;
      margin-right: 10px;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <div class="header">
    <h1>Consulta de Precificações</h1>
    <div class="nav-links">
      <a href="#">Home</a>
      <a href="#">Página 1</a>
      <a href="#">Página 2</a>
      <a href="#">Página 3</a>
    </div>
  </div>
  <div class="container">

    <div class="table-container">
      <table class="table table-striped table-hover">
        <thead>
          <tr>
            <th scope="col">Produto</th>
            <th scope="col">Preço</th>
            <th scope="col">Quantidade</th>
            <th scope="col">Mês</th>
            <th scope="col">Total</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Produto A</td>
            <td>R$ 100,00</td>
            <td>10</td>
            <td>Janeiro</td>
            <td>R$ 1.000,00</td>
          </tr>
          <tr>
            <td>Produto B</td>
            <td>R$ 150,00</td>
            <td>15</td>
            <td>Fevereiro</td>
            <td>R$ 2.250,00</td>
          </tr>
          <tr>
            <td>Produto C</td>
            <td>R$ 200,00</td>
            <td>5</td>
            <td>Março</td>
            <td>R$ 1.000,00</td>
          </tr>
          <!-- Adicione mais linhas de dados conforme necessário -->
        </tbody>
      </table>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/js/bootstrap.bundle.min.js"></script>
</body>

</html>
