<?php 

//Este arquivo serve para consulta de fornecedores requisitados pelo arquivo Busca.html

ini_set('display_errors', 1); // Exibir erros
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Relatar todos os erros

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

try {

// Recebe os dados JSON enviados pelo JavaScript
  $data = json_decode(file_get_contents("php://input"), true);
  $razao_Social = $data['razao_Social'];
  $nome_Fantasia = $data['nome_Fantasia'];
  $apelido = $data['apelido'];
  $grupo = $data['grupo'];
  $sub_Grupo = $data['sub_Grupo'];

// Inicializa a consulta e os parâmetros
$sql = "SELECT razao_Social, nome_Fantasia, apelido, grupo, sub_Grupo FROM fornecedor WHERE 1=1";
$params = [];
$param_types = "";

// Verifica se 'razao_Social', 'nome_Fantasia', 'apelido', 'grupo' ou 'sub_Grupo' foram enviados e adiciona à consulta
if (isset($data['razao_Social']) && !empty($data['razao_Social'])) {
    $sql .= " AND razao_Social = ?";
    $params[] = "%" . $data['razao_Social'] . "%";
    $param_types .= "s"; // 's' indica que é uma string
}

if (isset($data['nome_Fantasia']) && !empty($data['nome_Fantasia'])) {
    $sql .= " AND nome_Fantasia LIKE ?";
    $params[] = "%" . $data['nome_Fantasia'] . "%"; // LIKE para pesquisa parcial
    $param_types .= "s"; // 's' indica que é uma string
}

if (isset($data['apelido']) && !empty($data['apelido'])) {
    $sql .= " AND apelido LIKE ?";
    $params[] = "%" . $data['apelido'] . "%"; // LIKE para pesquisa parcial
    $param_types .= "s";
}

if (isset($data['grupo']) && !empty($data['grupo'])) {
    $sql .= " AND grupo LIKE ?";
    $params[] = "%" . $data['grupo'] . "%";
    $param_types .= "s";
}

if (isset($data['sub_Grupo']) && !empty($data['sub_Grupo'])) {
    $sql .= " AND sub_Grupo LIKE ?";
    $params[] = "%" . $data['sub_Grupo'] . "%";
    $param_types .= "s";
}

// Prepara e executa a consulta com os parâmetros definidos
$stmt = $mysqli->prepare($sql);
if ($param_types) { // Verifica se há parâmetros a serem vinculados
    $stmt->bind_param($param_types, ...$params);
}
else {
    // Consulta padrão se nenhum campo foi enviado
    $sql = "SELECT * FROM fornecedor";
    $stmt = $mysqli->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

  // Verifica se encontrou algum resultado
  if ($result->num_rows > 0) {
      $fornecedor = [];
      while ($row = $result->fetch_assoc()) {
          $fornecedor[] = $row;
      }
      echo json_encode(["status" => "sucesso", "resultados" => $fornecedor]);
  } else {
      echo json_encode(["status" => "erro", "mensagem" => "Usuário não encontrado."]);
  }

  $stmt->close();
  $mysqli->close();

} catch (Exception $e) {
  echo json_encode(["status" => "erro", "mensagem" => "Erro ao executar a consulta."]);
}
?>