<?php 

//Este arquivo serve para consulta do Local de Destino requisitados pelo arquivo Busca.html

ini_set('display_errors', 1); // Exibir erros
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Relatar todos os erros

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

try {

// Recebe os dados JSON enviados pelo JavaScript
  $data = json_decode(file_get_contents("php://input"), true);
  $nome_Local = $data['nome_Local'];
  $tipo_Local = $data['tipo_Local'];

// Inicializa a consulta e os parâmetros
$sql = "SELECT id_Local, nome_Local, tipo_Local, observacao FROM local_destino WHERE 1=1";
$params = [];
$param_types = "";

// Verifica se 'nome_Local' ou 'tipo_Local' foram enviados e adiciona à consulta
if (isset($data['nome_Local']) && !empty($data['nome_Local'])) {
    $sql .= " AND nome_Local = ?";
    $params[] = "%" . $data['nome_Local'] . "%";
    $param_types .= "s"; // 's' indica que é uma string
}

if (isset($data['tipo_Local']) && !empty($data['tipo_Local'])) {
    $sql .= " AND tipo_Local LIKE ?";
    $params[] = "%" . $data['tipo_Local'] . "%"; // LIKE para pesquisa parcial
    $param_types .= "s"; // 's' indica que é uma string
}

// Prepara e executa a consulta com os parâmetros definidos
$stmt = $mysqli->prepare($sql);
if ($param_types) { // Verifica se há parâmetros a serem vinculados
    $stmt->bind_param($param_types, ...$params);
}
else {
    // Consulta padrão se nenhum campo foi enviado
    $sql = "SELECT * FROM local_destino";
    $stmt = $mysqli->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

  // Verifica se encontrou algum resultado
  if ($result->num_rows > 0) {
      $locais = [];
      while ($row = $result->fetch_assoc()) {
          $locais[] = $row;
      }
      echo json_encode(["status" => "sucesso", "resultados" => $locais]);
  } else {
      echo json_encode(["status" => "erro", "mensagem" => "Local de destino não encontrado."]);
  }

  $stmt->close();
  $mysqli->close();

} catch (Exception $e) {
  echo json_encode(["status" => "erro", "mensagem" => "Erro ao executar a consulta."]);
}
?>