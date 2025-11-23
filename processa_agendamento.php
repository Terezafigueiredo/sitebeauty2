<?php
// CONFIGURAÇÕES DO BANCO
$host = "localhost";
$port = "5432";
$dbname = "sitebeauty";
$user = "postgres";
$password = "#Te88510674";

// PEGANDO DADOS (sanitizados)
$nome = htmlspecialchars($_POST['nome'] ?? '', ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES, 'UTF-8');
$servico = htmlspecialchars($_POST['servico'] ?? '', ENT_QUOTES, 'UTF-8');
$mensagem = htmlspecialchars($_POST['mensagem'] ?? '', ENT_QUOTES, 'UTF-8');

try {
    // Conexão
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Inserção
    $sql = "INSERT INTO agendamentos (nome, email, servico, mensagem, data_envio) 
            VALUES (:nome, :email, :servico, :mensagem, NOW())";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':servico', $servico);
    $stmt->bindParam(':mensagem', $mensagem);
    $stmt->execute();

    // ================================
    // PÁGINA DE SUCESSO SUPER GLAM
    // ================================
    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Agendamento enviado ✨</title>

        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: 'Poppins', sans-serif;
                background: radial-gradient(circle at top, #2a2438 0%, #1a1625 90%);
                color: #fff;
            }

            .card {
                width: 92%;
                max-width: 520px;
                background: rgba(42,36,56,0.5);
                border-radius: 22px;
                padding: 50px;
                text-align: center;
                backdrop-filter: blur(12px);
                box-shadow: 
                    0 0 25px rgba(245,193,223,0.35),
                    0 0 45px rgba(245,193,223,0.25);
                border: 2px solid rgba(245,193,223,0.5);
                animation: glamFade .9s ease-out;
                position: relative;
                overflow: hidden;
            }

            .card::before {
                content: '';
                position: absolute;
                top: -80px;
                left: -80px;
                width: 200px;
                height: 200px;
                background: rgba(255,255,255,0.15);
                filter: blur(80px);
                border-radius: 50%;
                animation: shine 6s infinite alternate;
            }

            @keyframes shine {
                0% { transform: translate(0,0); opacity: .15; }
                100% { transform: translate(120px, 120px); opacity: .3; }
            }

            .card h1 {
                font-size: 32px;
                color: #f5c1df;
                letter-spacing: 1px;
                margin-bottom: 12px;
                text-shadow: 0 0 10px rgba(245,193,223,0.4);
            }

            .card p {
                font-size: 18px;
                color: #e8d8e8;
                margin-bottom: 35px;
                line-height: 1.5;
            }

            .btn {
                background: linear-gradient(45deg, #e8a4cb, #f5c1df);
                padding: 14px 35px;
                border-radius: 14px;
                text-decoration: none;
                color: #1a1625;
                font-weight: bold;
                font-size: 16px;
                box-shadow: 0 0 15px rgba(245,193,223,0.45);
                transition: .3s;
            }

            .btn:hover {
                transform: scale(1.08);
                box-shadow: 0 0 25px rgba(245,193,223,0.6);
            }

            @keyframes glamFade {
                from { opacity: 0; transform: scale(.94); }
                to { opacity: 1; transform: scale(1); }
            }
        </style>
    </head>

    <body>
        <div class='card'>
            <h1>Agendamento enviado ✨</h1>
            <p>Obrigada por entrar em contato!<br>Retornarei em breve para confirmar tudo 💖</p>
            <a class='btn' href='site.php'>Voltar ao site</a>
        </div>
    </body>
    </html>";
    exit;

} catch (PDOException $e) {

    // ================================
    // PÁGINA DE ERRO SUPER GLAM
    // ================================
    echo "
    <!DOCTYPE html>
    <html lang='pt-br'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Erro ao enviar ❌</title>

        <style>
            body {
                margin: 0;
                padding: 0;
                height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                font-family: 'Poppins', sans-serif;
                background: radial-gradient(circle at top, #2a2438 0%, #1a1625 90%);
                color: #fff;
            }

            .card {
                width: 92%;
                max-width: 520px;
                background: rgba(42,36,56,0.45);
                border-radius: 22px;
                padding: 50px;
                text-align: center;
                backdrop-filter: blur(12px);
                box-shadow: 
                    0 0 25px rgba(255,79,123,0.35),
                    0 0 45px rgba(255,79,123,0.25);
                border: 2px solid rgba(255,79,123,0.5);
                animation: glamFade .8s ease-out;
            }

            .card h1 {
                font-size: 32px;
                color: #ff4f7b;
                margin-bottom: 12px;
            }

            .card p {
                font-size: 18px;
                color: #e8d8e8;
                margin-bottom: 20px;
            }

            .erro-detalhe {
                background: rgba(30,30,40,0.6);
                padding: 12px;
                border-radius: 10px;
                border: 1px solid #ff4f7b;
                color: #ff8aa8;
                margin-bottom: 25px;
                font-size: 14px;
            }

            .btn {
                background: #ff4f7b;
                padding: 14px 35px;
                border-radius: 14px;
                text-decoration: none;
                color: #1a1625;
                font-weight: bold;
                font-size: 16px;
                box-shadow: 0 0 15px rgba(255,79,123,0.45);
                transition: .3s;
            }

            .btn:hover {
                transform: scale(1.08);
            }
        </style>
    </head>

    <body>
        <div class='card'>
            <h1>Ops! Algo deu errado</h1>
            <p>Não foi possível salvar seu agendamento.</p>
            <div class='erro-detalhe'>".$e->getMessage()."</div>
            <a class='btn' href='site.php'>Voltar ao site</a>
        </div>
    </body>
    </html>";
    exit;
}
?>
