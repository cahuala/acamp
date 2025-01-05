<?php 
 include "conection.php";
 include "class.objetos.php";
 $adminClass=new site;
header('Content-Type: application/json');


try {
  
    // Verifica se o parâmetro 'bi' foi enviado
    if (isset($_GET['bi']) && !empty($_GET['bi'])) {
        $bi = htmlspecialchars($_GET['bi']); // Sanitiza o input do usuário
        // Consulta no banco de dados
        $stmt = $pdo->prepare("SELECT * FROM student WHERE bi = :bi");
        $stmt->bindParam(':bi', $bi, PDO::PARAM_STR);
        $stmt->execute();

        // Verifica se encontrou o registro
        if ($stmt->rowCount() > 0) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            echo json_encode(['success' => true, 'data' => $data]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Nenhum registro encontrado para este BI.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Parâmetro BI ausente ou inválido.']);
    }
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erro ao conectar ao banco de dados: ' . $e->getMessage()]);
}
