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
        <input type="text" name="requestBack" value="../views.php" hidden="true" />
          <input type="text" name="tabela" value="student" hidden="true" />
        <div class="container py-xl">
        <h1>Formulário de inscrição</h1>
        <p>Preencha os dados abaixo para inscrever-se  na excursão do instituto maravilha de Benguela.</p>
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
              <input id="fullname" type="text" name="fullname" readonly placeholder="Qual é nome completo">
          </div>
          
            <div class="input-wrapper">
              <label for="birth">Data de nascimento</label>
              <input type="date" name="birth" id="birth" readonly lang="pt-br">
            </div>
            <div class="input-wrapper">
              <label for="gender">Género</label>
              <input name="gender" readonly id="gender">
            </div>
          
          
        
        <div class="select-wrapper">
          <label for="course">Curso</label>
          <select name="course" id="course">
            <option value="Contabilidade e Auditoria">Contabilidade e Auditoria</option>
            <option value="Direito">Direito</option>
            <option value="Economia">Economia</option>
            <option value="Educação Física e Desporto">Educação Física e Desporto</option>
            <option value="Engenharia Informática">Engenharia Informática</option>
            <option value="Ensino de Biologia">Ensino de Biologia</option>
            <option value="Ensino de Geografia">Ensino de Geográfia</option>
            <option value="Ensino de História">Ensino de História</option>
            <option value="Ensino de Sociologia">Ensino de Sociológia</option>
            <option value="Gestão de Recursos Humanos">Gestão de Recursos Humanos</option>
            <option value="Psicologia">Psicologia</option>
            <option value="Relações Internacionais">Relações Internacionais</option>
           
          </select>
        </div>
        <div class="select-wrapper">
          <label for="ano_academico">Ano Acadêmico</label>
          <select name="ano_academico" id="ano_academico">
            <option value="1º Ano">1º Ano</option>
            <option value="2º Ano">2º Ano</option>
            <option value="3º Ano">3º Ano</option>
            <option value="4º Ano">4º Ano</option>
            <option value="5º Ano">5º Ano</option>
          </select>
        </div>
        <div class="input-wrapper">
          <label for="phone">Telefone</label>
          <input name="phone"  id="phone">
        </div>
        <div class="select-wrapper">
          <label for="payment">Forma de pagamento</label>
          <select name="payment" id="payment">
            <option value="Prestações/Parcelas">Prestações/Parcelas</option>
            <option value="Pronto pagamento">Pronto pagamento</option>   
          </select>
        </div>
        <div class="select-wrapper">
          <label for="modalidade">Modalidade</label>
          <select name="modalidade" id="modalidade">
            <option value="Casal">Casal</option>
            <option value="Individual">Individual</option>   
          </select>
        </div>
        <div class="input-wrapper" id="binconj" style="display: none;">
          <label for="biconj">BI do cônjuge</label>
          <input id="biconj" type="text" name="biconj" disabled placeholder="Qual é o BI do cônjuge">
        </div>
        </fieldset>
        <div class="actions-wrapper">
          <button class="btn-primary" type="submit">Fazer inscrição</button>
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
	// BUSCAR INFORMAÇÔES DO SEPE
const bi = document.querySelector('#nbi');
const fullname = document.querySelector('#fullname')
const genero = document.querySelector('#gender');
const birth = document.querySelector('#birth');
bi.addEventListener("input", async function(event) {
  if(event.target.value.length > 9) {
    const result = await fetch("./php/sepeBI.php?bi="+event.target.value)
    const resposta = await result.json();
    if(resposta.success ===false) {
        const msgBI = document.getElementById('msgBI');
        msgBI.innerHTML="<p>Serviço temporariamente indisponível, Tente mais tarde</p>"
        msgBI.style.display = "block";
    }else{
        fullname.value = resposta.data.nome;
        genero.value=resposta.data.genero;
        birth.value = resposta.data.data_nasc;

    }

  }
});

const modalidadeSelect = document.getElementById('modalidade');
const binconjDiv = document.getElementById('binconj');
const biconjInput = document.getElementById('biconj');

// Monitorando mudanças no select
modalidadeSelect.addEventListener('change', function () {
  if (this.value === 'Casal') {
    binconjDiv.style.display = 'block'; // Exibe a div
    biconjInput.disabled = false;      // Habilita o input
  } else {
    binconjDiv.style.display = 'none'; // Oculta a div
    biconjInput.disabled = true;       // Desabilita o input
  }
});
</script>