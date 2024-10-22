<?php include 'sql/db_connect.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MRP-Login</title>
    <link rel="shortcut icon" href="Imagens/logo.png" />
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="FundoLogin">
        <div class="Conteudo">
            <div class="perfil" style="margin-top: 0px; padding: 42px;">
                <img src="module/Autenticação/Imagens/Usuario.png" alt="perfil">
            </div>
            
            <form action="processar_login.php" method="post">
                <div class="label"></div>
                <input type="text" name="nome" class="input-field" placeholder="Nome" required />
                
                <div class="label"></div>
                <input type="password" name="senha" class="input-field" placeholder="Senha" required />

                <div class="EsqueciSenha">
                    <div class="Cadeado">
                        <img src="module/Autenticação/Imagens/cadeado.png" alt="cadeado">
                    </div>
                    <div class="EsqueciSenha">
                        <a href="module/Autenticação/HTML/Redefinir.html" class="link">Esqueci minha senha</a>
                    </div>
                </div>

                <div class="botaoDiv">
                    <button type="submit" class="botao"> <div class="textoentrar">Entrar</div> </button>
                </div>
            </form>
            

            <div class="Emporio">
                <img src="module/Autenticação/Imagens/Emporio maxx s-fundo.png" alt="Emporio">
            </div>
        </div>
    </div>
</body>
</html>