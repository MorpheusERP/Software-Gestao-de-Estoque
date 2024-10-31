<?php 
    include("conexao.php");

    $sql = "SELECT nivel, nome, sobrenome, funcao, logi, senha FROM usuario";

    $resultado = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($resultado)) {
        echo "<table class='table'><thead><tr><th>Nível</th><th>Nome</th><th>Sobrenome</th><th>Função</th><th>Login</th><th>Senha</th></tr></thead><tbody>";
        
        while ($row = mysqli_fetch_assoc($resultado)) {
            echo "<tr><td>" . $row['nivel'] . "</td>
            <td>" . $row['nome'] ."</td>
            <td>" . $row['sobrenome'] ."</td>
            <td>" . $row['funcao'] . "</td>
            <td>" . $row['logi'] . "</td>
            <td>" . $row['senha'] . "</td></tr>";
        }

        echo "</tbody></table>";
    } else {
        echo "Zero Resultados";
    }

    mysqli_close($conexao);
?>

