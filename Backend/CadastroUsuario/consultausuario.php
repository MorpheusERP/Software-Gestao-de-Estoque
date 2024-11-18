<?php 

//Este arquivo serve para consulta de usuarios requisitados pelo arquivo Busca.html

ini_set('display_errors', 1); // Exibir erros
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); // Relatar todos os erros

include '../conexao.php';

header('Content-Type: application/json'); // Define o cabeçalho para JSON

try {

// Recebe os dados JSON enviados pelo JavaScript
  $data = json_decode(file_get_contents("php://input"), true);
  $id_Usuario = $data['id_Usuario'];
  $nome_Usuario = $data['nome_Usuario'];
  $sobrenome = $data['sobrenome'];
  $funcao = $data['funcao'];  

// Inicializa a consulta e os parâmetros
$sql = "SELECT id_Usuario, nivel_Usuario, nome_Usuario, sobrenome, funcao, login FROM usuario WHERE 1=1";
$params = [];
$param_types = "";

// Verifica se 'id_usuario', 'nome_Usuario', 'sobrenome' ou 'funcao' foram enviados e adiciona à consulta
if (isset($data['id_Usuario']) && !empty($data['id_Usuario'])) {
    $sql .= " AND id_Usuario = ?";
    $params[] = $data['id_Usuario'];
    $param_types .= "i"; // 'i' indica que é um inteiro
}

if (isset($data['nome_Usuario']) && !empty($data['nome_Usuario'])) {
    $sql .= " AND nome_Usuario LIKE ?";
    $params[] = "%" . $data['nome_Usuario'] . "%"; // LIKE para pesquisa parcial
    $param_types .= "s"; // 's' indica que é uma string
}

if (isset($data['sobrenome']) && !empty($data['sobrenome'])) {
    $sql .= " AND sobrenome LIKE ?";
    $params[] = "%" . $data['sobrenome'] . "%"; // LIKE para pesquisa parcial
    $param_types .= "s";
}

if (isset($data['funcao']) && !empty($data['funcao'])) {
    $sql .= " AND funcao LIKE ?";
    $params[] = "%" . $data['funcao'] . "%";
    $param_types .= "s";
}

// Prepara e executa a consulta com os parâmetros definidos
$stmt = $mysqli->prepare($sql);
if ($param_types) { // Verifica se há parâmetros a serem vinculados
    $stmt->bind_param($param_types, ...$params);
}
else {
    // Consulta padrão se nenhum campo foi enviado
    $sql = "SELECT * FROM usuario";
    $stmt = $mysqli->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result();

  // Verifica se encontrou algum resultado
  if ($result->num_rows > 0) {
      $usuarios = [];
      while ($row = $result->fetch_assoc()) {
          $usuarios[] = $row;
      }
      echo json_encode(["status" => "sucesso", "resultados" => $usuarios]);
  } else {
      echo json_encode(["status" => "erro", "mensagem" => "Usuário não encontrado."]);
  }

  $stmt->close();
  $mysqli->close();

} catch (Exception $e) {
  echo json_encode(["status" => "erro", "mensagem" => "Erro ao executar a consulta."]);
}
?>