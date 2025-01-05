<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Relatório de Inscritos</title>
  <link rel="shortcut icon" href="assets/ISPMico.ico">
  <style>
    @page {
      size: landscape;
    }

    body {
      font-family: 'Roboto', Arial, sans-serif;
      margin: 20px;
      text-align: center;
    }

    h1, h2, h3 {
      font-size: 14px;
      margin-bottom: 3px;
      font-weight: 400;
    }

    .logo {
      width: 100px;
      height: auto;
      margin: 10px auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      margin-bottom: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    th, td {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
      font-size: 14px;
    }

    th {
      background-color: rgb(76, 119, 175);
      color: white;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:nth-child(odd) {
      background-color: #ffffff;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .summary {
      text-align: left;
      font-weight: bold;
      font-size: 16px;
      margin: 10px 0;
      color: #333;
    }

    .total {
      text-align: right;
      font-weight: bold;
      font-size: 18px;
      margin-top: 10px;
      color: #333;
    }

    .date-footer {
      margin-top: 20px;
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      color: #555;
    }
  </style>
</head>
<body>
  <img src="assets/ISPMico.ico" alt="Logo" class="logo">
  <h1>INSTITUTO SUPERIOR MARAVILHA DE BENGUELA</h1>
  <h2>ASSOCIAÇÃO DOS ESTUDANTES</h2>
  <h3>RELATÓRIO DE INSCRITOS</h3>
  <table>
    <thead>
      <tr>
        <th>BI</th>
        <th>Nome</th>
        <th>Género</th>
        <th>Modalidade</th>
        <th>Status</th>
        <th>Valor</th>
      </tr>
    </thead>
    <tbody>
      <?php
      // Configuração da conexão com o banco de dados
      $host = 'localhost';
      $user = 'root';
      $password = '';
      $database = 'acamp_maravilha';

      $conn = new mysqli($host, $user, $password, $database);

      if ($conn->connect_error) {
          die("Conexão falhou: " . $conn->connect_error);
      }

      $sql = "SELECT bi, name, modalidade, status, genero FROM student";
      $result = $conn->query($sql);

      $total = 0;
      $masculino = 0;
      $feminino = 0;

      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $valor = $row['modalidade'] === 'Casal' ? 75000 : 40000;
              if ($row['status'] === '1ª Parcela') {
                $valor = $valor / 2;
              }

              $total += $valor;

              // Contagem por gênero
              if ($row['genero'] === 'M') {
                  $masculino++;
              } elseif ($row['genero'] === 'F') {
                  $feminino++;
              }

              echo "
                <tr>
                  <td>{$row['bi']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['genero']}</td>
                  <td>{$row['modalidade']}</td>
                  <td>{$row['status']}</td>
                  <td>" . number_format($valor, 2, ',', '.') . " AOA</td>
                </tr>
              ";
          }
      } else {
          echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
      }

      $conn->close();
      ?>
    </tbody>
  </table>
  <div class="summary">
    <?php
    echo "Total de Homens: {$masculino}<br>";
    echo "Total de Mulheres: {$feminino}<br>";
    ?>
  </div>
  <div class="total">
    <?php echo "Total: " . number_format($total, 2, ',', '.') . " AOA"; ?>
  </div>
  <div class="date-footer">
    <?php
   $meses = array(
    '01' => 'Janeiro',
    '02' => 'Fevereiro',
    '03' => 'Março',
    '04' => 'Abril',
    '05' => 'Maio',
    '06' => 'Junho',
    '07' => 'Julho',
    '08' => 'Agosto',
    '09' => 'Setembro',
    '10' => 'Outubro',
    '11' => 'Novembro',
    '12' => 'Dezembro'
);

$mes = date('m');
$ano = date('Y');
$dia = date('d');

echo "Benguela, aos {$dia} de {$meses[$mes]} de {$ano}.";

    ?>
  </div>
</body>
</html>
