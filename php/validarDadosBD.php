<?php
 include "conection.php";
 include "class.objetos.php";
 $adminClass=new site;
 $tabela=$adminClass->tornarSegura($_POST['tabela']);
 $requestBack=$adminClass->tornarSegura($_POST['requestBack']);

 switch ($tabela) {
    case 'student':
      try {
        //code...
        $nbi= $adminClass->tornarSegura($_POST['nbi']);
        $name = $adminClass->tornarSegura($_POST['fullname']);
        $birth = $_POST['birth'];
        $gender = $adminClass->tornarSegura($_POST['gender']);
        $course= $adminClass->tornarSegura($_POST['course']);
        $ano_academico=$adminClass->tornarSegura($_POST['ano_academico']);
        $payment=$adminClass->tornarSegura($_POST['payment']);
        $modalidade=$adminClass->tornarSegura($_POST['modalidade']);
        $phone=$adminClass->tornarSegura($_POST['phone']);
        if (isset($_POST['biconj'])) {
          $biconj = $adminClass->tornarSegura($_POST['biconj']);
        }
        $statement = $pdo->prepare("SELECT * FROM student WHERE bi=?");
        $statement->execute(array($nbi));
        $total = $statement->rowCount();
        if($total) {
          $_SESSION['error']="Estudante já Inscrito";
        }
        else{
          $statement = $pdo->prepare("INSERT INTO 
          student (bi,name,data_nasc,genero,course,pagamento,phone,modalidade,ano,nbiconj) 
          VALUES (?,?,?,?,?,?,?,?,?,?)");
          $statement->execute(array($nbi,$name,$birth,$gender,$course,$payment,$phone,$modalidade,$ano_academico,$nbiconj));
          $_SESSION['msg']="Registo efectuado com sucesso!!!";
        }
        header ("location:".$requestBack);
      } catch (\Throwable $th) {
        $_SESSION['error']=$th;
        header ("location:".$requestBack);
      }
    break;
    case 'studentedit':
      try {
        //code...
        $nbi= $adminClass->tornarSegura($_POST['nbi']);
        $status=$adminClass->tornarSegura($_POST['status']);
        
        $statement = $pdo->prepare("SELECT * FROM student WHERE bi=?");
        $statement->execute(array($nbi));
        $total = $statement->rowCount();
        if($total>0) {
          $row = $statement->fetch(PDO::FETCH_ASSOC); // Pega o registro como um array associativo
          $id = $row['id']; // Obtém o ID do registro
              // Atualizando os dados na tabela
              $statement = $pdo->prepare("
                  UPDATE student
                  SET 
                      status = ?
                  WHERE id = ?
              ");
              $statement->execute(array($status,$id));
              // Mensagem de sucesso
              $_SESSION['msg'] = "Dados atualizados com sucesso!";
              header ("location:".$requestBack);
              exit();  
        }
        
        header ("location:".$requestBack);
      } catch (\Throwable $th) {
        $_SESSION['error']=$th;
        header ("location:".$requestBack);
      }
    break;

 }