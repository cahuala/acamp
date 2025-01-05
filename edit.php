<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Maravilha | Acampamento</title>
  <link rel="stylesheet" href="styles/index.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous">
    </script>
  <link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />

  <script src="assets/sweetalert2/dist/sweetalert2.all.min.js"></script>
  <link rel="stylesheet" href="assets/sweetalert2/dist/sweetalert2.min.css">

  <link rel="shortcut icon" href="assets/ISPMico.ico">
</head>
<body>
  <header>
    <div class="container py-base">
      <nav class="flex items-center gap-1.5">
        <a href="/">
          <img src="assets/ISPMico.ico" alt="Zingen">
        </a>
        <a href="/" class="desketop-only">Sobre o acampamento</a>
        <a href="/" class="desketop-only">Atrativos</a>
        <a href="/" class="desketop-only">Preços</a>
      </nav>
    </div>
  </header>
  <section class="form">
    
      <form action="php/validarDadosBD.php" method="POST" enctype="multipart/form-data">
      <input type="text" name="requestBack" value="../edit.php" hidden="true" />
      <input type="text" name="tabela" value="studentedit" hidden="true" />
        <div class="container py-xl">
        <h1>Formulário de actualização</h1>
       
        <p style="color: #F7B733;">Actualize os pagamentos</p>
        <div id="msgBI" style="display: none; color: red;" role="alert" >
          
         </div>
        <fieldset class="child-info">
          <legend>Dados pessoais</legend>
          <div class="input-wrapper">
              <label for="nbi">Nº BI</label>
              <input id="nbi" type="text" name="nbi" placeholder="Qual é o BI">
          </div>
          <div class="input-wrapper">
              <label for="fullname">Nome Completo</label>
              <input disabled id="fullname" type="text" name="fullname" readonly placeholder="Qual é nome completo">
      </div>
        <div class="input-wrapper">
          <label for="course">Curso</label>
          <input disabled name="course" readonly id="course">
        </div>
        <div class="select-wrapper">
          <label for="status">Status</label>
          <select name="status" id="status">
            <option value="1ª Parcela">1ª Parcela</option>
            <option value="Pago">Pago</option>   
          </select>
        </div>
       
        </fieldset>
        <div class="actions-wrapper">
          <button class="btn-primary" type="submit">Actualizar</button>
          <a href="imprimir.php" class="btn-primary" target="_blank">Imprimir</a>
       </div>
      </div>
      </form>
  </section>
<?php include "php/alertaSucess.php";
			include "php/alertaErros.php"; 
?>

<script src="assets/select2/dist/js/select2.min.js"></script>
</body>
</html>
<script>
	const bi = document.querySelector('#nbi');
const fullname = document.querySelector('#fullname');
const course  = document.querySelector('#course');

bi.addEventListener("input", async function(event) {
  if (event.target.value.length > 9) {
    try {
      const result = await fetch(`./php/search.php?bi=${event.target.value}`);
      const resposta = await result.json();

      if (resposta.success === false) {
        const msgBI = document.getElementById('msgBI');
        msgBI.innerHTML = "<p>Estudante não encontrado</p>";
        msgBI.style.display = "block";
      } else {
        fullname.value = resposta.data.name;
        course.value  = resposta.data.course;
     
      }
    } catch (error) {
      console.error("Erro ao buscar informações:", error);
    }
  }
});

</script>