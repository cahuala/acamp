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
    
      <form action="" method="POST" enctype="multipart/form-data">
       
        <div class="container py-xl">
        <h1>Formulário de pesquisa</h1>
       
        <p style="color: #F7B733;">Após a inscrição dirija-se a ao instituto para o devido pagamento, ou efectue a sua transfêrência no <strong>IBAN 0051 0000 2786 0287 1010 8</strong> , e envie o seu comprovativo via WhatsApp 931 006 769/937 172 494</p>
        <p style="color: #F7B733;">A confirmação do pagamento tem a duração de 24 Horas</p>
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
              <label for="birth">Data de nascimento</label>
              <input disabled type="date" name="birth" id="birth" readonly lang="pt-br">
            </div>
            <div class="input-wrapper">
              <label for="gender">Género</label>
              <input disabled name="gender" readonly id="gender">
            </div>
          
          
        
        <div class="input-wrapper">
          <label for="course">Curso</label>
          <input disabled name="course" readonly id="course">
           
        </div>
        <div class="input-wrapper">
          <label for="ano_academico">Ano Acadêmico</label>
          <input disabled name="ano_academico" readonly id="ano_academico">
        </div>
        <div class="input-wrapper">
          <label for="phone">Telefone</label>
          <input disabled name="phone" readonly  id="phone">
        </div>
        <div class="input-wrapper">
          <label for="payment">Forma de pagamento</label>
          <input disabled name="payment" readonly id="payment">
        </div>
        <div class="input-wrapper">
          <label for="modalidade">Modalidade</label>
          <input disabled name="modalidade" readonly id="modalidade">
        </div>
        <div class="input-wrapper">
          <label for="status">Status</label>
          <input disabled name="status" readonly id="status">
        </div>
       
        </fieldset>
      
      </div>
      </form>
  </section>
<?php include "php/alertaSucess.php";
			include "php/alertaErros.php"; 
?>

</body>
</html>
<script>
	const bi = document.querySelector('#nbi');
const fullname = document.querySelector('#fullname');
const genero = document.querySelector('#gender');
const birth = document.querySelector('#birth');
const course  = document.querySelector('#course');
const ano_academico = document.querySelector('#ano_academico');
const phone = document.querySelector('#phone');
const payment = document.querySelector('#payment');
const modalidade = document.querySelector('#modalidade');
const status = document.querySelector('#status');


bi.addEventListener("input", async function(event) {
  if (event.target.value.length > 9) {
    
      const result = await fetch(`./php/search.php?bi=${event.target.value}`);
      const resposta = await result.json();

      if (resposta.success === false) {
        const msgBI = document.getElementById('msgBI');
        msgBI.innerHTML = "<p>Estudante não encontrado</p>";
        msgBI.style.display = "block";
      } else {
        fullname.value = resposta.data.name;
        genero.value = resposta.data.genero;
        birth.value = resposta.data.data_nasc;
        course.value  = resposta.data.course;
        modalidade.value = resposta.data.modalidade;
        payment.value = resposta.data.pagamento;
        status.value = resposta.data.status;
        phone.value = resposta.data.phone;
        ano_academico.value = resposta.data.ano;
      }
   
  }
});

</script>