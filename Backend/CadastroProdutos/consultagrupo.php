<?php 

//Este arquivo serve para consulta  grupos/sub grupos de Produtos

ini_set('display_errors', 1); // Exibir erros
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Relatar todos os erros

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

try {

// Recebe os dados JSON enviados pelo JavaScript
  $data = json_decode(file_get_contents("php://input"), true);
  $grupo = $data['grupo'] ?? null;
  $sub_Grupo = $data['subgrupo'] ?? null;

// Inicializa a consulta e os parâmetros
$sql = "SELECT grupo, sub_Grupo FROM produto WHERE 1=1";
$params = [];
$param_types = "";

// Verifica se grupo ou sub_Grupo foram enviados e adiciona à consulta
if (isset($data['grupo']) && !empty($data['grupo'])) {
    $sql .= " AND grupo LIKE ?";
    $params[] = "%" . $data['grupo'] . "%"; // LIKE para pesquisa parcial
    $param_types .= "s"; // 's' indica que é uma string
}

if (isset($data['sub_Grupo']) && !empty($data['sub_Grupo'])) {
    $sql .= " AND sub_Grupo LIKE ?";
    $params[] = "%" . $data['sub_Grupo'] . "%"; // LIKE para pesquisa parcial
    $param_types .= "s"; // 's' indica que é uma string
}

// Prepara e executa a consulta com os parâmetros definidos
$stmt = $mysqli->prepare($sql);
if ($param_types) { // Verifica se há parâmetros a serem vinculados
    $stmt->bind_param($param_types, ...$params);
}
else {
    // Consulta padrão se nenhum campo foi enviado
    $sql = "SELECT * FROM produto";
    $stmt = $mysqli->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

  // Verifica se encontrou algum resultado
  if ($result->num_rows > 0) {
      $produtos = [];
      while ($row = $result->fetch_assoc()) {
          $produtos[] = $row;
      }
      echo json_encode(["status" => "sucesso", "resultados" => $produtos]);
  } else {
      echo json_encode(["status" => "erro", "mensagem" => "Produto não encontrado."]);
  }

  $stmt->close();
  $mysqli->close();

} catch (Exception $e) {
  echo json_encode(["status" => "erro", "mensagem" => "Erro ao executar a consulta."]);
}
?>